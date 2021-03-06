<?php

// Define app routes

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Tuupola\Middleware\HttpBasicAuthentication;

return function (App $app) {
    // Redirect to Swagger documentation
    $app->get('/', \App\Action\Home\HomeAction::class)->setName('home');
    
    //Show Posts
    $app->get('/showPosts', \App\Action\Posts\PostsShowAction::class)->setName('showPosts');
    
    $app->post('/filterPosts', \App\Action\Posts\PostsFilterAction::class);

    // Swagger API documentation
    $app->get('/docs/v1', \App\Action\OpenApi\Version1DocAction::class)->setName('docs');
die(var_dump($app));
    // Password protected area
    $app->group(
        '/api',
        function (RouteCollectorProxy $app) {
            $app->get('/users', \App\Action\User\UserFindAction::class);
            $app->post('/users', \App\Action\User\UserCreateAction::class);
            $app->get('/users/{user_id}', \App\Action\User\UserReadAction::class);
            $app->put('/users/{user_id}', \App\Action\User\UserUpdateAction::class);
            $app->delete('/users/{user_id}', \App\Action\User\UserDeleteAction::class);
        }
    )->add(HttpBasicAuthentication::class);
    
   
};
