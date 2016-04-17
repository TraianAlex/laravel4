<?php

resource('posts', 'PostController');//method index
resource('comments', 'CommentController', ['except' => ['index', 'create', 'show']]);
resource('users', 'UserController', ['except' => ['create', 'store']]);

post('posts/{posts}/comments', 'CommentController@store');
//resource('roles', 'RoleController', ['only' => ['show']]);
get('roles/{roles}', 'RoleController@show');
get('tags/{tags}', 'TagController@show');

$router->controllers([
	'likes' => 'LikeController',
	'home' => 'HomeController',//method getIndex
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'/' => 'WelcomeController',
]);


//Route::get() or $router->get() or get()

//Route::resource('home', 'HomeController');//method index

// Route::controllers([
// 	'home' => 'HomeController',//method getIndex
// 	'auth' => 'Auth\AuthController',
// 	'password' => 'Auth\PasswordController',
// 	'test' => 'TraianController',
// 	'/' => 'WelcomeController',
// ]);

//Route::controller('/', 'WelcomeController');