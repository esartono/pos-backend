<?php


/*
|--------------------------------------------------------------------------
| API Authenticate Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api->group(['prefix' => 'auth'], function ($api) {
    $api->post('login', 'LoginController@login');
    $api->post('forgot-password', 'ForgotPasswordController@sendResetLinkEmail');
    $api->post('reset-password', 'ResetPasswordController@reset');
});
