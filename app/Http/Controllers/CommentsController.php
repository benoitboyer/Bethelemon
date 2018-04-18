<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Session;
use App\Post;

class CommentsController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth',['except'=>'store']);
    }
	
    
    public function store(Request $request, $post_id)
    {
			$this->validate($request, array(
				'author'		=>	'required|max:255',
				'body'	=>	'required|min:5|max:2000',
				'email'		=>	'required|email|max:255',
			));
			
			$post= Post::find($post_id);
			
			$comment= new Comment();
			$comment->author = $request->author;
			$comment->body = $request->body;
			$comment->email = $request->email;
			
			$comment->post()->associate($post);
			
			$comment->save();
			
			Session::flash('success', 'Votre commentaire a bien été ajouté');
			
			//return view->route('blog.single')->withType($post->category->name)->withPost($post); 
			return view('blog.single')->withPost($post);
		
			
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('comments.edit')->withComment($comment);
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
        $comment = Comment::find($id);
        $this->validate($request , array('body' =>'required'));
        
        $comment->body= $request->body;
        $comment->save();;
        
        
        Session::flash('success', 'The comment has been edited');
        return redirect()->route('posts.show',$comment->post->id);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function delete($id)
    {
        $comment=Comment::find($id);
        return view('comments.delete')->withComment($comment);
    }
     public function destroy($id)
    {
        $comment = Comment::find($id);
        $post_id=$comment->post->id;
		$comment->delete();
         Session::flash('success', 'The comment has been deleted');
        return redirect()->route('posts.show', $post_id);
        
        
    }
}
