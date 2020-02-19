<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use WimmCMS\core\Models\Article;
use WimmCMS\core\Models\Category;

class SiteMapGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This generates a new sitemap';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/'))
            ->add(Url::create('/about'));

        Category::all()->each(function (Category $category) use ($sitemap) {
            $sitemap->add(Url::create("/category/{$category->id}"));
        });

        Article::all()->each(function (Article $post) use ($sitemap) {
            $sitemap->add(Url::create("/articles/{$post->id}/s-{$post->slug}"));
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));

    }
}
