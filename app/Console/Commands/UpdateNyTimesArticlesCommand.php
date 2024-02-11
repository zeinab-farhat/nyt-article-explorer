<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;


/**
 * @command app:update-ny-times-articles-command
 * @description Command description
 */
class UpdateNyTimesArticlesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-ny-times-articles-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch data from the NY Times API
        $response = Http::get('https://api.nytimes.com/svc/mostpopular/v2/viewed/7.json', [
            'api-key' => 'e2o1Nf5YamMD78tZP8vG3TvbUKQ6jF9j',
        ]);

        $articles = $response->json()['results'];

        // Store data in cache
        Cache::forever('nytimes_articles', $articles);
    }
}
