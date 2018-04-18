<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Page;
use Session;

class MenuController extends Controller
{
    public function getMenu(){
		$menu_pages=Page::all();
		$menu_categories=Category::all();
		
		return view('main ');
		
	}
}
