@extends('layouts.main')
@section('content')
<div class="content">
    <h2>Posts</h2>
	@if($posts)
    	<ul>
    	@foreach ($posts as $post)
    		<li><a href="{{url("posts/$post->id")}}"><strong>{{ $post->title }}</strong></a>
    			{{$post->body}}</li>
    	@endforeach
    	</ul>
	@endif
</div>
@endsection