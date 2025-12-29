<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Post;
use App\Models\Service;
use App\Models\Country;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap.';

    public function handle()
    {
        $sitemap = Sitemap::create();

        // 1. Add Static Pages
        $sitemap->add(Url::create('/'));
        $sitemap->add(Url::create('/about-us'));
        $sitemap->add(Url::create('/contact'));

        // 2. Add Dynamic Services
        Service::all()->each(function (Service $service) use ($sitemap) {
            $sitemap->add(Url::create("/services/{$service->slug}"));
        });

        // 3. Add Dynamic Countries
        Country::all()->each(function (Country $country) use ($sitemap) {
            $sitemap->add(Url::create("/destinations/{$country->slug}"));
        });

        // 4. Add Blog Posts
        Post::all()->each(function (Post $post) use ($sitemap) {
            $sitemap->add(Url::create("/blog/{$post->slug}"));
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));
        
        $this->info('Sitemap generated successfully!');
    }
}