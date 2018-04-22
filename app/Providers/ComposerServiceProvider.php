<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('webbase.content', 'App\Http\ViewComposers\Autoload@GetMenu');
        View::composer('webbase.menu', 'App\Http\ViewComposers\Autoload@CheckLogin');
        View::composer('webbase.content', 'App\Http\ViewComposers\Autoload@GetTxt');
        View::composer('webbase.header', 'App\Http\ViewComposers\Autoload@GetTxt');
        View::composer('webbase.unlogin_content', 'App\Http\ViewComposers\Autoload@GetTxt');
        View::composer('webbase.nav', 'App\Http\ViewComposers\Autoload@CheckLogin');
        View::composer('webbase.nav', 'App\Http\ViewComposers\Autoload@GetTxt');
        View::composer('webbase.nav', 'App\Http\ViewComposers\Autoload@GetMsg');
        View::composer('webbase.search_tool', 'App\Http\ViewComposers\Autoload@GetTxt');
        View::composer('webbase.search_tool', 'App\Http\ViewComposers\Autoload@SearchTool');
        View::composer('webbase.content', 'App\Http\ViewComposers\Autoload@ErrorMsg');
        View::composer('webbase.nav', 'App\Http\ViewComposers\Autoload@GetPhoto');
        View::composer('webbase.menu', 'App\Http\ViewComposers\Autoload@GetPhoto');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
