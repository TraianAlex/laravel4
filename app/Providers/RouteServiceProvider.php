<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        $router->bind('posts', function($id)
        {
            return \App\Post::published()->findOrFail($id);
        });

        $router->bind('users', function($id)
        {
            return \App\User::findOrFail($id);
        });

        $router->bind('roles', function($name)
        {
            return \App\Role::where('role', $name)->firstOrFail();
        });

        $router->bind('comments', function($id)
        {
            return \App\Comment::findOrFail($id);
        });

        $router->bind('tags', function($name)
        {
            return \App\Tag::where('name', $name)->firstOrFail();
        });
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
