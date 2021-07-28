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

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->post('user/register', [
        'uses' => AuthController::class.'@register',
    ]);
    $router->patch('user/recover-password', [
        'uses' => AuthController::class.'@recoverPassword',
    ]);
    $router->patch('user/sign-in', [
        'uses' => AuthController::class.'@signIn',
    ]);

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->get('user/companies', [
            'uses' => UserController::class.'@gatCompanies',
        ]);
        $router->post('user/companies', [
            'uses' => UserController::class.'@addCompany',
        ]);
    });

});


