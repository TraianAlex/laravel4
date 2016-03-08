<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Controllers\Controller;
use App\Comment;
use App\Post;
use Gate;

class CommentController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCommentRequest $request)
    {
        $post = Post::find($request->post_id);
        ////$comment = new Comment;
        ////$comment->comment = $request->comment;
        ////$comment->user_id = auth()->user()->id;

        //$comment = new Comment(['comment' => $request->comment, 'user_id' => auth()->user()->id]);

        //$post->comments()->save($comment);
        // $post->comments()->save(
        //     new Comment(['comment' => $request->comment, 'user_id' => auth()->user()->id]);
        // );

        $post->addComment(
            new Comment(['comment' => $request->comment, 'user_id' => auth()->user()->id])
        );
        
        //$comment = $post->comments()->create(['comment' => $request->comment,
        //                                      'user_id' => auth()->user()->id]);
        //return redirect("posts/$request->post_id");
        return back();
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
    public function edit(Comment $comment)
    {
        if(Gate::denies('edit', $comment)) abort(403, 'Sorry, not sorry.');
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        if(Gate::denies('edit', $comment)) abort(403, 'Sorry, not sorry.');
        $comment->update($request->all());
        return redirect('posts/'.$comment->post_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if(Gate::denies('edit', $comment)) abort(403, 'Sorry, not sorry.');
        $comment->likes()->delete();
        $comment->delete();
        return redirect('posts/'.$comment->post_id);
    }
}