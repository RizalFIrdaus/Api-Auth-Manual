<?php


/** @var \Laravel\Lumen\Routing\Router $router */


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->home();
});

$router->get('/key', 'KeyGenerator@key');

$router->post('comment/post', function () {
    return "Status : 301 ; Successfully Created";
});

$router->get('/me/{params}', ['as' => 'about.me', function ($params = 'wad') {
    return 'Hello my name ' . $params . ', iam at :' . route('about.me');
}]);

$router->get('who', function () {
    return redirect()->route('about.me');
});

// Prefix
$router->group(['prefix' => 'user'], function () use ($router) {
    $router->get('contact', ['as' => 'user.contact', function () {
        return 'Contact';
    }]);
    $router->get('about', function () {
        return 'Contact';
    });
});

$router->group(['middleware' => 'admin'], function () use ($router) {
    $router->get('admin', function () {
        return "You have been permission for this page";
    });
});

$router->get('r/c', function () {
    return redirect()->route('user.contact');
});
