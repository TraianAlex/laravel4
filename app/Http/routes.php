<?php

resource('posts', 'PostController');//method index
resource('comments', 'CommentController');

$router->controllers([
	'home' => 'HomeController',//method getIndex
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'/' => 'WelcomeController',
]);





//Route::get() or $router->get() or get()