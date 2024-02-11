<?php

namespace Tests\Unit;

use App\Http\Controllers\ArticleController;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;


class ArticleControllerTest extends TestCase
{
    /** @test */
    public function testIndex()
    {
        $articles = [
            ['id' => 1, 'title' => 'Test Article 1', 'url' => 'example.com'],
            ['id' => 2, 'title' => 'Test Article 2', 'url' => 'example2.com'],
        ];

        // Mock the Cache facade
        Cache::shouldReceive('has')->with('nytimes_articles')->andReturn(true);
        Cache::shouldReceive('get')->with('nytimes_articles')->andReturn($articles);

        // Mock the Request object
        $request = Request::create('/index', 'GET', ['title' => 'Test', 'url' => 'example.com']);

        // Call the index method
        $controller = new ArticleController();
        $response = $controller->index($request);
        // Assertions
        $this->assertInstanceOf(View::class, $response);
        // Add more assertions based on the expected behavior

    }

    /** @test */
    public function testGetArticleById()
    {
        // Mock the articles in the cache
        $articles = [
            ['id' => 1, 'title' => 'Test Article 1'],
            ['id' => 2, 'title' => 'Test Article 2'],
        ];

        Cache::shouldReceive('get')->with('nytimes_articles')->andReturn($articles);

        // Call the getArticleById method
        $controller = new ArticleController();
        $article = $controller->getArticleById(2);

        // Assertions
        $this->assertEquals(['id' => 2, 'title' => 'Test Article 2'], $article);
    }
}

