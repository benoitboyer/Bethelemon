<?php

namespace App\Http\MenuComposers;

use App\Post;
use Illuminate\View\View;

class SideComposer
{

    public function compose(View $view)
    {
			$posts=Post::all();
            $view->withPosts($posts);
    }
}
