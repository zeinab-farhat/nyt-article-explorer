<?php

namespace App\Http\Controllers;

use App\Console\Commands\UpdateNyTimesArticlesCommand;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;


class ArticleController extends Controller
{
    /**
     * Display a paginated list of articles with filtering options.
     * If cached articles are available, retrieves them; otherwise, fetches articles from the API.
     * Allows filtering by article title and URL.
     * Paginates the filtered articles and passes them to the view for display.
     */
    public function index(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        // Define the cache key
        $cacheKey = 'nytimes_articles';

        // Check if the data exists in the cache
        if (Cache::has($cacheKey) && $articles = Cache::get('nytimes_articles') != null) {

            // Retrieve data from cache
            $articles = Cache::get($cacheKey);
        } else {
            // Data is not cached, fetch it from the API using the script
            $this->fetchAndCacheArticles();
            // Retrieve the articles from cache
            $articles = Cache::get($cacheKey);
        }

        $articles = collect($articles);
        // Filter articles based on search parameters
        $title = $request->input('title');
        $url = $request->input('url');
        $search = $request->input('search');

        if ($search) {
            $articles = $articles->filter(function ($article) use ($search) {
                return stripos($article['title'], $search) !== false ||
                    stripos($article['url'], $search) !== false;
            });
        }

        if ($title) {
            $title = strtolower($title); // Convert search query to lowercase
            $articles = $articles->filter(function ($article) use ($title) {
                return strpos(strtolower($article['title']), $title) !== false; // Convert article title to lowercase
            });
        }

        if ($url) {
            $url = strtolower($url); // Convert search query to lowercase
            $articles = $articles->filter(function ($article) use ($url) {
                return strpos(strtolower($article['url']), $url) !== false; // Convert article URL to lowercase
            });
        }

        // Paginate the filtered articles
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;
        $currentPageItems = $articles->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $articles = new LengthAwarePaginator($currentPageItems, $articles->count(), $perPage);

        // Add query parameters to pagination links
        $articles->appends($request->except('page'));

        return view('articles.index', compact('articles'));
    }

    // Instantiate the script and call its handle method to fetch data from API and update cache
    private function fetchAndCacheArticles()
    {
        $script = new UpdateNyTimesArticlesCommand();
        $script->handle();
    }

    // Search for the article with the given ID
    public function getArticleById($articleId)
    {
        $articles = Cache::get('nytimes_articles');
        $article = collect($articles)->firstWhere('id', $articleId);

        return $article;
    }

    public function show($id): View|Application|Factory|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $article = $this->getArticleById($id);

        if ($article) {
            return view('articles.show', ['article' => $article]);
        } else {
            return Redirect::back()->withErrors(['error' => 'Article not found']);
        }
    }

    /**
     * Save an article to the user's profile.
     * Retrieves the article URI from the request, then fetches the corresponding article from the cached articles.
     * Extracts the title from the fetched article and checks if it's already saved in the user's profile.
     * If not saved, adds the article title to the user's saved_articles array and updates the user record.
     * Redirects back with a success message if the article is successfully saved; otherwise, redirects back with message telling that the article is already saved.
     */
    public function saveArticle(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $uri = $request->input('uri');
        $articles = cache('nytimes_articles');
        $article = collect($articles)->firstWhere('uri', $uri);
        $title = $article['title'];
        // Get the saved article IDs
        $savedArticleTitles = $user->saved_articles;

        // Check if the article Title is already saved
        if (!$savedArticleTitles || !in_array($title, $savedArticleTitles)) {
            // Append the article ID to the saved_articles array
            $savedArticleTitles[] = $title;

            // Update the saved_articles attribute
            $user->saved_articles = $savedArticleTitles;
            $user->save();

            return redirect()->back()->with('status', 'Article is saved successfully for profile');
        } else {

            return redirect()->back()->with('status', 'Article is already saved in your profile');
        }
    }

    // Remove the article title from the saved_articles array
    public function removeSavedArticle($articleTitle): RedirectResponse
    {
        $user = auth()->user();

        $user->saved_articles = array_diff($user->saved_articles, [$articleTitle]);
        $user->save();

        return back()->with('success', 'Article removed successfully.');
    }
}
