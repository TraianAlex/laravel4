@extends('layouts.main')
@section('content')
<div class="content">
    <h4>{{$post->title}}</h4> by: {{$post->user->name}}
    <a href="{{url('posts/'.$post->id.'/edit')}}">edit</a>
    <a href="#">delete</a>
    <br>
    {{$post->body}}<br><br>

    @foreach ($comments as $comment)
    	@if($comment->user)
    		{{$comment->id}}. <b>{{$comment->user->name}}:</b> {{$comment->created_at}}<br>
    	@endif
    	{{$comment->comment}}<br>
    @endforeach
    <br>
	<b>Comments by: {{$post->user->name}}</b>{{$post->user->comments}}<br>
	<br>

    @include('comments.create')
</div>
@endsection