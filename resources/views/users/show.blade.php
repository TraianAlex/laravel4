@extends('layouts.main')
@section('content')
<div class="content">
    <div class="title">Laravel 5</div>
    <h3>User:</h3>
    {{$user->name}} <a class="btn btn-disabled" href="{{url('users/'.$user->id.'/edit')}}" role="button">Edit</a>{!!delete_form(['users.destroy', $user->id])!!}
    <br>
    {{$user->email}}<br>
    @if($user->country)
    	<b>Country: </b>{{$user->country->name}}<br>
    @endif
    @if($user->phone)
    	<b>Phone: </b>{{$user->phone->name}}
    @endif

<!------------------------------------------------------------------------------------------>

    <h4>Roles:</h4>
    @foreach ($user->roles as $role)
		<a href="{{url('roles/'.$role->role)}}">{{$role->role}}</a>
		<b>Created at: </b>{{$role->pivot->created_at}}
		<b>Updated at: </b>{{$role->pivot->updated_at}}<br>
	@endforeach
	<hr>

<!------------------------------------------------------------------------------------------>


	<h3>Posts</h3>
	@foreach ($posts as $post)
		{{$post->title}}<br>
		{{$post->body}}<br>
		@foreach ($comments as $comment)
    		<h4>Comment</h4>
    		{{$comment->comment}}
    		<br>
		@endforeach
		{!!$comments->render()!!}
	@endforeach
	{!!$posts->render()!!}
	
<!------------------------------------------------------------------------------------------>

	<h4>All {{$user->name}} comments</h4><hr>
	@foreach ($all_comments as $comment)
		{{$comment->comment}}<br>
	@endforeach
	{!!$all_comments->render()!!}
</div>
@endsection