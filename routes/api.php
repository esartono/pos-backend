<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

/**
 *  Public APIs
 */
$api->version('v1', ['namespace' => 'App\Http\Controllers\V1'], function ($api) {
    require __DIR__ . '/api/v1/public.php';
});

/**
 * Public AUTH APIs
 */
$api->version('v1', [
    'middleware' => [],
    'namespace'  => 'App\Http\Controllers\V1\Auth',
], function ($api) {
    require __DIR__ . '/api/v1/auth.php';
});

/**
 *  Private APIs
 */
$api->version('v1', [
    'middleware' => ['api.auth'],
    'providers'  => 'jwt',
    'namespace'  => 'App\Http\Controllers\V1',
], function ($api) {
    require __DIR__ . '/api/v1/private_general.php';
});
