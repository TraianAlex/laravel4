@extends('layouts.main')
@section('content')
<div class="content">
	<div class="row">
    	<b>{{$user->name}}</b>
	    <br>
	    <b>Email: </b>{{$user->email}}<br>
	    @if($user->country)
	    	<b>Country: </b>{{$user->country->name}}
	    @endif
	    <br>
	    @if($user->phone)
	    	<b>Phone: </b>{{$user->phone->name}}
	    @endif
	    <br>

<!------------------------------------------------------------------------------------------>

	    <b>Roles:</b>
	    @foreach ($user->roles as $role)
			<a href="{{url('roles/'.$role->role)}}">{{$role->role}}</a><br>
			<b>Created at: </b>{{$role->pivot->created_at}}<br>
			<b>Updated at: </b>{{$role->pivot->updated_at}}<br>
		@endforeach
		</div>
		@if($user->can('edit', $user))
			<div class="col-md-1">
		    	<a class="btn btn-disabled" href="{{url('users/'.$user->id.'/edit')}}" role="button">Edit</a>
		    </div>
		    <div class="col-md-2">
		    	{!!delete_form(['users.destroy', $user->id])!!}
		    </div>
	    @endif
	    <br>
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