<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        
		$this->composeNavigation();
        
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    public function composeNavigation(){
		
		view()->composer('partials._nav', 'App\Http\MenuComposers\NavigationComposer');
		view()->composer('partials.side_content', 'App\Http\MenuComposers\SideComposer');
		
	}	
    
}
