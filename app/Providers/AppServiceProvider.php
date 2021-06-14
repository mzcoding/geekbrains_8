<?php

namespace App\Providers;

use App\Contracts\ParserServiceContract;
use App\Contracts\SocialServiceContract;
use App\Services\ParserService;
use App\Services\SocialService;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    	$this->app->bind(ParserServiceContract::class, ParserService::class);
    	$this->app->bind(SocialServiceContract::class, SocialService::class);

		Paginator::useBootstrap();
    }
}