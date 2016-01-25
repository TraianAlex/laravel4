<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CreatePostRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Comment;
use App\Country;
use App\Like;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post_all = Post::latest()->published()->paginate(5);

        //get one to many
        $post = Post::find(11);
        $comments = $post->comments()->get();
        //$comments->posts()->where('active', 1)->get();
        //$comments = Post::find(11)->comments()->where('title', 'foo')->first();

        //inverse
        $comment = Comment::find(1);
        $post_found = $comment->post->title;

        //many to many
        $user = User::find(11);
        $roles = $user->roles;
        $roles2 = User::find(11)->roles()->orderBy('role')->get();

        //Has Many Through
        $country = Country::find(1);
        $post_by_country = $country->posts;

        //inverse
        $like = Like::find(1);
        $likeable = $like->likeable;

        //Many To Many Polymorphic
        //$post = App\Post::find(1);
        //foreach ($post->tags as $tag) {}

        //inverse
        $tag = Tag::find(1);

        //Querying Relationship Existence
        // Retrieve all posts that have at least one comment...
        //$posts = Post::has('comments')->get();
        // Retrieve all posts that have three or more comments...
        $posts = Post::has('comments', '>=', 3)->get();
        // Retrieve all posts that have at least one comment with votes...
        //$posts = Post::has('comments.votes')->get();
        // Retrieve all posts with at least one comment containing words like foo%
        // $posts = Post::whereHas('comments', function ($query) {//orWhereHas
        //     $query->where('content', 'like', 'foo%');
        // })->get();

        //Eager loading
        $post2 = Post::with('user')->get();

        //Eager Loading Multiple Relationships
        //Sometimes you may need to eager load several different relationships in a single operation. To do so, just pass additional arguments to the with method:
        //$books = Post::with('user', 'publisher')->get();

        //Nested Eager Loading
        //To eager load nested relationships, you may use "dot" syntax. For example, let's eager load all of the book's authors and all of the author's personal contacts in one Eloquent statement:
        //$books = App\Book::with('author.contacts')->get();

        //Constraining Eager Loads
        //Sometimes you may wish to eager load a relationship, but also specify additional query constraints for the eager loading query. Here's an example:
        // $users = App\User::with(['posts' => function ($query) {
        //     $query->where('title', 'like', '%first%');
        // }])->get();

        //In this example, Eloquent will only eager load posts that if the post's title column contains the word first. Of course, you may call other query builder to further customize the eager loading operation:
        // $users = App\User::with(['posts' => function ($query) {
        //     $query->orderBy('created_at', 'desc');
        // }])->get();

        //Lazy Eager Loading
        //Sometimes you may need to eager load a relationship after the parent model has already been retrieved. For example, this may be useful if you need to dynamically decide whether to load related models:
        //$books = App\Book::all();
        // if ($someCondition) {
        //     $books->load('author', 'publisher');
        // }

        //If you need to set additional query constraints on the eager loading query, you may pass a Closure to the load method:
        // $books->load(['author' => function ($query) {
        //     $query->orderBy('published_date', 'asc');
        // }]);

        return view('posts.index', compact('post', 'comments', 'post_found', 'user', 'roles',
            'roles2', 'country', 'post_by_country', 'likeable', 'tag', 'post2', 'post_all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        auth()->user()->posts()->create($request->all());
        return redirect('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
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