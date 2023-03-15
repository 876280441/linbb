<?php

namespace App\Providers;

use App\Models\Reply;
use App\Models\Topic;
use App\Observers\ReplyObserver;
use App\Observers\TopicObserver;
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
        if (app()->isLocal()){
            $this->app->register(\VIACreative\SudoSu\ServiceProvider::class);
        }
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
		\App\Models\Reply::observe(\App\Observers\ReplyObserver::class);
        //帖子模型观察器
		Topic::observe(TopicObserver::class);
        //回复表观察器
//		Reply::observe(ReplyObserver::class);
        //分页使用 bootstrap
        \Illuminate\Pagination\Paginator::useBootstrap();
        \App\Models\Link::observe(\App\Observers\LinkObserver::class);
        //
    }
}
