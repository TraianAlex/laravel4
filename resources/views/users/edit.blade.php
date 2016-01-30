@extends('layouts.main')
@section('content')
<div class="content">
    <div class="title">Laravel 5</div>
    <h2>Edit: {{ $user->name }}</h2>
	{!! Form::model($user, ['method' => 'PATCH', 'url' => url('users/'.$user->id)]) !!}
		<div class="form-group">
		{!! Form::label('name', 'Name:') !!}
		{!! Form::text('name', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('email', 'Email:') !!}
			{!! Form::text('email', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('country_id', 'Country:') !!}
			{!! Form::select('country_id', $countries, null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('phone', 'Phone:') !!}
			{!! Form::text('phone', $user->phone?$user->phone->name:null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('role_list', 'Roles:') !!}
			{!! Form::select('role_list[]', $roles, null, ['id' => 'role_list', 'class' => 'form-control', 'multiple']) !!}
		</div>
		<div class="form-group">
			{!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
		</div>
	{!! Form::close() !!}
	@include('errors.list')
</div>
@endsection