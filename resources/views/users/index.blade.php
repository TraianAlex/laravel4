@extends('layouts.main')
@section('content')
<div class="content">
    <div class="title">Users</div>
    	@if($users)
		    @foreach ($users as $user)
		    	<a class="btn btn-default" href="{{url('users/'.$user->id)}}">{{$user->name}}</a>
		    @endforeach
		@endif
</div>
@endsection