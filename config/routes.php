<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;
use Zend\Expressive\Session\SessionMiddleware;

/**
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/:id', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Handler\ContactHandler::class,
 *     Zend\Expressive\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */
return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {
    $app->route('/', [
            //\Zend\Expressive\Authentication\AuthenticationMiddleware::class,

            App\Handler\HomePageHandler::class,
        ], ['GET'], 'home');
    $app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');
    $app->get('/hello', App\Handler\HelloHandler::class, 'hello');
    $app->get('/redirect', App\Handler\RedirectHandler::class, 'redirect');
    $app->post('/oauth2/token', \Zend\Expressive\Authentication\OAuth2\TokenEndpointHandler::class);
    $app->route('/oauth2/authorize', [
        SessionMiddleware::class,

        \Zend\Expressive\Authentication\OAuth2\AuthorizationMiddleware::class,

        // The following middleware is provided by your application (see below):
        App\OAuthAuthorizationMiddleware::class,

        \Zend\Expressive\Authentication\OAuth2\AuthorizationHandler::class
    ], ['GET', 'POST']);
    $app->route('/login', [
        App\LoginMiddleware::class,
        // for authentication next handling
        \Zend\Expressive\Authentication\AuthenticationMiddleware::class,
    ], ['GET', 'POST'], 'login');

};
