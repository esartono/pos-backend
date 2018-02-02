<?php

$api->get('auth/logout', 'Auth\LoginController@logout');

$api->get('vouchers', 'VoucherController@index');
$api->post('vouchers', 'VoucherController@create');
$api->put('vouchers/{id}', 'VoucherController@update');
$api->delete('vouchers/{id}', 'VoucherController@delete');

$api->get('categories', 'CategoryController@index');
$api->post('categories', 'CategoryController@create');
$api->put('categories/{id}', 'CategoryController@update');
$api->delete('categories/{id}', 'CategoryController@delete');

$api->get('units', 'UnitController@index');
$api->post('units', 'UnitController@create');
$api->put('units/{id}', 'UnitController@update');
$api->delete('units/{id}', 'UnitController@delete');

$api->get('products', 'ProductController@index');
$api->post('products', 'ProductController@create');
$api->post('products/{id}', 'ProductController@update');
$api->get('products/{id}', 'ProductController@view');
$api->delete('products/{id}', 'ProductController@delete');
