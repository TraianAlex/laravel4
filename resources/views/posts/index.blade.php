@extends('layouts.main')
@section('content')
<div class="content">
	<a href="{{route('posts.create')}}" type="button" class="btn btn-primary">Create a post</a>
	
	<h4>Posts</h4>
	@foreach ($post_all as $post)
		<b><a href="{{ $post->path() }}">{{$post->title}}</a></b> by {{$post->user->name}}<br>
		{{$post->body}}<br>
		<a href="{{url('/posts', $post->id)}}">comment</a><hr>
	@endforeach
	{!!$post_all->render()!!}
	<hr>

<!-------------------------------------------------------------------------------------->

    @if($post)
    	<h4>Post get his comments -- one to many</h4>
		{{$post->title}}<br>
		{{$post->body}}<br>
		@if(isset($comments))
		    @foreach ($comments as $comment)
		    	<h4>Comment</h4>
		    	{{$comment->comment}}
		    	<hr>
			@endforeach
		@endif
	@endif

<!-------------------------------------------------------------------------------------->

	@if($user)
		@foreach ($user->posts as $post)
	    	{{$post}}<br>
		@endforeach
	@endif

<!-------------------------------------------------------------------------------------->

	@if(isset($post_found))
		<h4>Comment nr ### found his post -- many to one</h4>
		{{$post_found}}
		<hr>
	@endif

<!-------------------------------------------------------------------------------------->

	<h4>Many to many</h4>

	@if($user)
		@foreach ($user->roles as $role)
			<b>Name:</b> {{$user->name}}<br>
			<b>Role:</b> {{$role->role}}<br>
			<b>Created at: </b>{{$role->pivot->created_at}}<br>
		@endforeach
	@endif
	<hr>

	@if(isset($roles))
		@foreach($roles as $role)
			{{$role->role}} | 
		@endforeach
		<hr>
	@endif

	@if(isset($roles2))
		@foreach($roles2 as $role)
			{{$role->role}} | 
		@endforeach
		<hr>
	@endif

<!-------------------------------------------------------------------------------------->

	@if($post)
		<h4>Has Many Through</h4>

		<h5>Post by {{$country->name}}</h5>
		@foreach($post_by_country as $post)
			{{$post->title}}
		@endforeach
		<hr>

<!-------------------------------------------------------------------------------------->

		<h4>Polymorphic</h4>

		@foreach ($post->likes as $like)
			<b>Likes:</b> {{$like}}
		@endforeach
		<hr>
	@endif

<!-------------------------------------------------------------------------------------->

    <h4>Owner of polymorphic</h4>

    @if(isset($likeable))
    	{{$likeable}}
    @endif	
    <hr>

<!-------------------------------------------------------------------------------------->

	@if($post)
	    <h4>Many To Many Polymorphic</h4>
	    
	    @foreach ($post->tags as $tag)
	    	<b>Tags:</b> {{$tag}}
	    @endforeach    
    	<hr>
	@endif

<!-------------------------------------------------------------------------------------->

    <h4>Owner of Many To Many Polymorphic</h4>

    @foreach ($tag->videos as $video)
    	<b>Video tagged:</b> {{$video}}
	@endforeach
    <hr>

<!-------------------------------------------------------------------------------------->

    <h4>Eager loading</h4>

    @foreach ($post2 as $post)
    	{{$post->user->name}}<br>
    	{{$post->title}}<br>
    @endforeach
    <hr>
</div>
@endsection