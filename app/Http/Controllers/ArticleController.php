<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ArticleController extends Controller
{

    public function index(): View
    {
        $perPage = 10; // Number of articles per page
        // Check if cached data exists
        $articles = Cache::remember('nytimes_articles', 60, function () {
            // Fetch articles from the NY Times API
            $response = Http::get('https://api.nytimes.com/svc/mostpopular/v2/viewed/1.json', [
                'api-key' => 'e2o1Nf5YamMD78tZP8vG3TvbUKQ6jF9j',
            ]);

            return $response->json()['results'];
        });

//        // Paginate the articles
//        $currentPage = request()->query('page', 1);
//        $items = collect($articles);
//        $paginatedArticles = new LengthAwarePaginator($items->forPage($currentPage, $perPage), count($items), $perPage, $currentPage);

        return view('pages.articles', ['articles' => $articles]);
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
