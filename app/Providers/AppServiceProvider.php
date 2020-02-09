<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

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
        Schema::defaultStringLength(191);
        // View::composer('site.layout.layout', function ($view) {
        //     $view->with('partners', \App\Models\Partners::where('status',1)->get(['image','name_en','name','id','slug']));
        // });
        View::composer('site.layout.layout', function ($view) {
            $view->with('socials', \App\Models\Social::where('status',1)->get(['url','social']));
        });

        View::composer('site.layout.layout', function ($view) {
            $view->with('setting', \App\Models\Setting::where('id',1)->first(['title_ar','email','mobile','card']));
        });
    }
}
