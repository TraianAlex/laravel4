@extends('layouts.main')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-4">
            <b>{{$post->title}}</b> by: {{$post->user->name}}
        </div>
        <div class="col-md-9">
            {{$post->body}}<br><br>
        </div>
        <div class="col-md-1">
            <a href="{{url('posts/'.$post->id.'/edit')}}">edit</a>
        </div>
        <div class="col-md-2">
            {!!delete_form(['posts.destroy', $post->id])!!}
        </div>
       
         <a href="{{ url('likes/like', ['postId' => $post->id]) }}">Like</a>
        {{ $post->likes->count() }} {{ str_plural('like', $post->likes->count()) }}
        
        @foreach ($comments as $comment)
        	@if($comment->user)
                <div class="col-md-4">
        		  {{$comment->id}}. <b>{{$comment->user->name}}:</b> {{$comment->created_at}}

                  <a href="{{ url('likes/like-comment', ['commentId' => $comment->id]) }}">Like</a>
                  {{ $comment->likes->count() }} {{ str_plural('like', $comment->likes->count()) }}
                </div>
                <br>
        	@endif
            <div class="col-md-9">
        	   {{$comment->comment}}
            </div>
            <div class="col-md-1">
                <a href="{{url('comments/'.$comment->id.'/edit')}}">edit</a>
            </div>
            <div class="col-md-2">
                {!!delete_form(['comments.destroy', $comment->id])!!}
            </div>
            <br>
            <br>
        @endforeach
    </div>

    @unless($post->tags->isEmpty())
        <h4>Tags:</h4>
        <ul>
            @foreach ($post->tags as $tag)
                <li><a href="{{url("tags/$tag->name")}}">{{ $tag->name }}</a></li>
            @endforeach
        </ul>
    @endunless
    <br>

    <div class="row">
	   <b>Comments by: {{$post->user->name}}</b>{{$post->user->comments}}
    </div>
    <br>
    <div class="row">
        @include('comments.create')
    </div>
</div>
@endsection