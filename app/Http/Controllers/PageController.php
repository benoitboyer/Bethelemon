<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Page;
use Session;
use Image;
use Storage;

class PageController extends Controller
{
    public function __construct(){
		$this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //display view of all categories
		$pages=Page::all();
		$categories= Category::all();
        //it will also have a form to create a new category
        return view('pages.index')->withPages($pages)->withCategories($categories);
        
    }
  
		

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Save a new category and then redirect to the post.index
        $this->validate($request, array(
			'name'=>'required|max:255',
			'url'=>'required|max:255',
			'featured_image' => 'sometimes|image'
        
        ));
        $page= new Page;
        $page->url=$request->url;
        
        $page->name=$request->name;
        //save our image
        if($request->hasFile('featured_image')){
			$image = $request->file('featured_image');
			$filename = time(). '.'. $image->getClientOriginalExtension();
			$location = public_path('images/'.$filename);
			
			Image::make($image)->resize(800,null, function ($constraint) {$constraint->aspectRatio();})->save($location);
			
			$page->page_img = $filename;	
		}
        
        $page->save();
        Session::flash('success', 'Page créée avec succès');
        
        return redirect()->route('pages.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page=Page::find($id);
        Storage::delete($page->page_img);
		$page->delete();
		Session::flash('success', 'Page suprimmée!');
		return redirect()->route('pages.index');
		
    }
}



