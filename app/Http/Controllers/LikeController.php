<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Comment;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getLike($postId)
    {
        $post = Post::find($postId);

        if(!$post) return redirect()->route('posts.index');
        if(auth()->user()->hasLikedPost($post)){
            $post->likes()->delete();//make toggable
            return redirect()->back();
        } 
        
        $like = $post->likes()->create([]);
        auth()->user()->likes()->save($like);
        return redirect()->back();
    }

    public function getLikeComment($commentId)
    {
        $comment = Comment::find($commentId);

        if(!$comment) return redirect()->route('posts.index');
        if(auth()->user()->hasLikedComment($comment)){
            $comment->likes()->delete();
            return redirect()->back();
        } 
        
        $like = $comment->likes()->create([]);
        auth()->user()->likes()->save($like);
        return redirect()->back();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
