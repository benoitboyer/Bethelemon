<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Category;
use App\Post;
use DB;

class PagesController extends Controller
{
	public function getAbout()
	{
		return view('pages.about');
	}
	
	public function getContact()
	{
		return view('pages.contact');
	}
	
	public function getIndex()
	{
		$posts=Post::where('published','=',1)->paginate(8);
		return view('pages.welcome')->withPosts($posts);
	}

	public function getPagesIndex($page, $category=null)
	{
		if($category !=null) {
			$cat=DB::table('categories')->where('name','=',$category)->value('id');
			$posts=Post::
            	leftJoin('pages', 'posts.page_id', '=', 'pages.id')
            	->where('pages.name','=',$page)
           		->where('category_id','=',$cat)
            	->get();         
		}
		else {
			$posts=Post::
				leftJoin('pages', 'posts.page_id', '=', 'pages.id')
            	->where('pages.name','=',$page)
				->get();
		}
       
		return view('blog.index')->withPosts($posts);
	
	}

	public function showTargetPost($page, $category=null, $slug)
	{
		$cat=$category;
		$post=Post::where('slug','=',$slug)->first();
		
		return view('blog.single')->withPost($post)->withCat($cat);
	}

	//assumes you want to run this via root url (/)
   	public function getTarget( $target)
   	{
	    //this practically get you any parameter after public/ (root url)
	    $categories=explode('/', $target);
	    $countSeg   = count($categories);

     	$cat=null;
     	$page=null;
     	$slug=null;
     	for($i = 0; $i < $countSeg; $i++) {
       		//this part of iteration is hypothetical - you had to try it to make sure it had the desired outcome
       		if(($i + 1) == $countSeg) {
         		//make sure fcategory != null, it should throw 404 otherwise
         		//you have to add code for that here
         		$slug = Post::where('slug', $categories[$i])->first();
       		}
	       	if($i == 0) {
	        	//find initial category, if no result, throw 404
	         	$page = Page::where('name', $categories[0])->value('name');
	       	}
	       	else {
	         //take it's child category if possible, otherwise throw 404
	         $cat = Category::where('name', $categories[$i])->value('id');
	       	}
    	}

     	if($slug!=null) {
		 $post=$slug;
		 return view('blog.single')->withPost($post);
	 	}
	 	elseif($cat!=null) {
			$posts=Post::
	            leftJoin('pages', 'posts.page_id', '=', 'pages.id')
	            ->where('published','=',1)
	            ->where('pages.name','=',$page)
	            ->where('category_id','=',$cat)
	            ->get();
	        $section=Category::where('id', $cat)->value('category_img');
			
			return view('blog.index')->withPosts($posts)->withSection($section);
	 	}
	 	else {
			if($page!=null) {
				$posts=Post::leftJoin('pages', 'posts.page_id', '=', 'pages.id')
					->where('published','=',1)
					->where('pages.name','=',$page)
					->get();
				 //$section=$page;
				 $section=Page::where('name', $page)->value('page_img');
				
				return view('blog.index')->withPosts($posts)->withSection($section);
			}
			else {
				return view('404');
			}
		}
    }	
}
