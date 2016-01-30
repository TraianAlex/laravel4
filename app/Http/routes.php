<?php

resource('posts', 'PostController');//method index
resource('comments', 'CommentController');
resource('users', 'UserController', ['except' => ['create', 'store']]);
//resource('roles', 'RoleController', ['only' => ['show']]);
get('roles/{roles}', 'RoleController@show');

$router->controllers([
	'home' => 'HomeController',//method getIndex
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'/' => 'WelcomeController',
]);





//Route::get() or $router->get() or get()