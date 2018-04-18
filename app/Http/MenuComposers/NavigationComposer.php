<?php

namespace App\Http\MenuComposers;

use App\Page;
use App\Category;
use Illuminate\View\View;

class NavigationComposer
{

    public function compose(View $view)
    {
			$pages= Page::all();
			$categories= Category::all();
            $view->withPages($pages)->withCategories($categories);
    }
}
