<?php

namespace App\Http\Controllers;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request; // Import the Request class
use Illuminate\View\View;
use Illuminate\Support\Facades\Redis;
class ArticleController extends Controller
{


    public function index(Request $request)
    {
//        $perPage = 10; // Number of articles per page
//
//        // Check if cached data exists
//        $articles = Cache::remember('nytimes_articles', 60, function () {
//            // Fetch articles from the NY Times API
//            $response = Http::get('https://api.nytimes.com/svc/mostpopular/v2/viewed/1.json', [
//                'api-key' => 'e2o1Nf5YamMD78tZP8vG3TvbUKQ6jF9j',
//            ]);
//
//            return $response->json()['results'];
//        });
//
//        // Filter articles based on search parameters
//        $filteredArticles = $this->filterArticles($articles);
//
//        return view('pages.articles.index', ['articles' => $filteredArticles]);

        // Fetch articles from the NY Times API
        $response = Http::get('https://api.nytimes.com/svc/mostpopular/v2/viewed/1.json', [
            'api-key' => 'e2o1Nf5YamMD78tZP8vG3TvbUKQ6jF9j',
        ]);

        // Extract the results from the response
        $articles = collect($response->json()['results']);

        // Filter articles based on search parameters
        $title = $request->input('title');
        $url = $request->input('url');

        if ($title) {
            $articles = $articles->filter(function ($article) use ($title) {
                return strpos($article['title'], $title) !== false;
            });
        }
        if ($url) {
            $articles = $articles->filter(function ($article) use ($url) {
                return strpos($article['url'], $url) !== false;
            });
        }

        // Paginate the filtered articles
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10; // Adjust as needed
        $currentPageItems = $articles->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $articles = new LengthAwarePaginator($currentPageItems, $articles->count(), $perPage);

        // Add query parameters to pagination links
        $articles->appends($request->except('page'));

        return view('pages.articles.index', compact('articles'));
    }

    private function filterArticles($articles)
    {
        $title = Request::input('title');
        $url = Request::input('url');

        if ($title) {
            $articles = array_filter($articles, function ($article) use ($title) {
                return strpos($article['title'], $title) !== false;
            });
        }

        if ($url) {
            $articles = array_filter($articles, function ($article) use ($url) {
                return strpos($article['url'], $url) !== false;
            });
        }

        return $articles;
    }





    public function getArticleById($articleId)
    {
        $articles = Cache::get('nytimes_articles');

        // Search for the article with the given ID
        $article = collect($articles)->firstWhere('id', $articleId);

        return $article;
    }


    // Example function where you want to retrieve the article
    public function show($id)
    {
        $article = $this->getArticleById($id);

        if ($article) {
            // Article found, do something with it
        } else {
            // Article not found
            echo "Article not found.";
        }
        return view('pages.articles.show', ['article' => $article]);
    }
}
