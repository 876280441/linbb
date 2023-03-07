<?php

namespace App\Providers;

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
        //用户观察器
		\App\Models\User::observe(\App\Observers\UserObserver::class);
        //帖子模型观察器
		\App\Models\Topic::observe(\App\Observers\TopicObserver::class);
        //分页使用 bootstrap
        \Illuminate\Pagination\Paginator::useBootstrap();
        //
    }
}
