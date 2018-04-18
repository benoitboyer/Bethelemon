<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Page;
use App\Category;
use Session;
use Purifier;
use Image;
use Storage;

class PostController extends Controller
{
	
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$posts=Post::all();

        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$categories=Category::all();
		$pages=Page::all();
        return view('posts.create')->withPages($pages)->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
			'title'			=>'required|max:255',
			'slug' 			=> 'required|alpha_dash|min:5|max:255|unique:posts,slug',
			'page_id'	=>'required',
			'body'			=>'required',
			'featured_image' => 'sometimes|image'
        ));
        
        $post= new Post;
        $post->title = $request->title;
        $post->slug = $request->slug;

        if($request->category_id !='') {
			$post->category_id = $request->category_id;
		}
		else {
			$post->category_id = null;
		}

        $post->page_id = $request->page_id;
        $post->body= Purifier::clean($request->body);
        $post->featured= $request->featured;
        $post->published= $request->published;
        
        //save our image
        if($request->hasFile('featured_image')) {

			$image = $request->file('featured_image');
			$filename = time(). '.'. $image->getClientOriginalExtension();
			$location = public_path('images/'.$filename);
			
			Image::make($image)->resize(800,null, function ($constraint) {$constraint->aspectRatio();})->save($location);
			
			$post->featured_image = $filename;	
		}
        $post->save();
        
        Session::flash('success', 'Le Post a bien été créé!');
        
        return redirect()->route('posts.show', $post->id); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$post= Post::find($id);
		
       
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $post=Post::find($id);
        $pages=Page::all();
        $categories=Category::all();
       
        return view('posts.edit')->withPost($post)->withPages($pages)->withCategories($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post=Post::find($id);
        if($request->slug == $post->slug) {
			
			$this->validate($request, array(
				'title'			=>'required|max:255',
				'page_id'		=>'required',
				'body'			=>'required',
				'featured_image'=>'sometimes|image'    
			));        
		}
		else {
			
			$this->validate($request, array(
				'title'			=>'required|max:255',
				'slug'			=>"required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
				'page_id'		=>'required',
				'body'			=>'required',
				'featured_image'=>'sometimes|image'      
			));   
		}	  
        
        $post->title = $request->title;
        $post->slug = $request->slug;

        if($request->category_id !='') {
			$post->category_id = $request->category_id;
		}
		else {
			$post->category_id = null;
		}

        $post->page_id = $request->page_id;
        $post->body = Purifier::clean($request->input('body'));
        $post->featured= $request->featured;
        $post->published= $request->published;

        if($request->hasFile('featured_image')) {
			//delete the old photo, add the new photo and update the database
			
			$image = $request->file('featured_image');
			$filename = time(). '.'. $image->getClientOriginalExtension();
			$location = public_path('images/'.$filename);
			Image::make($image)->resize(800,null, function ($constraint) {$constraint->aspectRatio();})->save($location);
			$oldFilename=$post->featured_image;
			//save the new photo
			$post->featured_image = $filename;	
			//delete the old photo
			Storage::delete($oldFilename);	 
		}
        
        $post->save();
        
        Session::flash('success', 'Le Post a bien été mis à jour!');
        
        return redirect()->route('posts.show', $post->id);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $post=Post::find($id);
       Storage::delete($post->featured_image);
       $post->delete();
       Session::flash('success', 'Le Post a bien été supprimé!');
       return redirect()->route('posts.index');
       
    }
}
