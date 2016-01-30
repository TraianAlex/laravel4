@extends('layouts.main')
@section('content')
<div class="content">
    <h2>Users</h2>
	@if($users)
    	<ul>
    	@foreach ($users as $user)
    		<li><a href="{{url("users/$user->id")}}"><strong>Name:</strong> {{ $user->name }}</a> {{$user->email}}</li>
    	@endforeach
    	</ul>
	@endif
</div>
@endsection