<?php

namespace App\Providers;

use App\Services\ArticleService;
use App\Services\CarouselService;
use App\Services\GroupService;
use App\Services\QuotationService;
use App\Services\SocialService;
use App\Services\SystemService;
use App\Services\ThemeService;
use App\Services\TypeService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ArticleService::class, function ($app) {
            return new ArticleService();
        });

        $this->app->singleton(GroupService::class, function ($app) {
            return new GroupService();
        });
        $this->app->singleton(TypeService::class, function ($app) {
            return new TypeService();
        });
        $this->app->singleton(ThemeService::class, function ($app) {
            return new ThemeService();
        });
        $this->app->singleton(CarouselService::class, function ($app) {
            return new CarouselService();
        });
        $this->app->singleton(SystemService::class, function ($app) {
            return new SystemService();
        });
        $this->app->singleton(QuotationService::class, function ($app) {
            return new QuotationService();
        });
        $this->app->singleton(SocialService::class, function ($app) {
            return new SocialService();
        });
  
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
