<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Category;
use App\Page;
use Session;
use Image;
use Storage;



class CategoryController extends Controller
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
        //display view of all of our categories
		$categories= Category::all();
		$pages=Page::all();
        //it will also have a form to create a new category
        return view('categories.index')->withCategories($categories)->withPages($pages);
        
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
        $this->validate($request, array('name'=>'required|max:255','featured_image' => 'sometimes|image'));
        $category= new Category;
        $category->name=$request->name;
        $category->page_id=$request->page_id;
         //save our image
        if($request->hasFile('featured_image')){
			$image = $request->file('featured_image');
			$filename = time(). '.'. $image->getClientOriginalExtension();
			$location = public_path('images/'.$filename);
			
			Image::make($image)->resize(800,null, function ($constraint) {$constraint->aspectRatio();})->save($location);
			
			$category->category_img = $filename;	
		}
        
        
        $category->save();
        Session::flash('success', 'New Category has been created');
        
        return redirect()->route('categories.index');
        
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
        $category=Category::find($id);
        Storage::delete($category->category_img);
		$category->delete();
		Session::flash('success', 'Catégorie suprimmée!');
		return redirect()->route('categories.index');
		
    }
}
