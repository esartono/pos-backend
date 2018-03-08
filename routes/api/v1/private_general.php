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

$api->get('suppliers', 'SupplierController@index');
$api->post('suppliers', 'SupplierController@create');
$api->put('suppliers/{id}', 'SupplierController@update');
$api->delete('suppliers/{id}', 'SupplierController@delete');

$api->get('customers', 'CustomerController@index');
$api->post('customers', 'CustomerController@create');
$api->put('customers/{id}', 'CustomerController@update');
$api->delete('customers/{id}', 'CustomerController@delete');

$api->get('purchases', 'PurchaseController@index');
$api->post('purchases', 'PurchaseController@create');
$api->put('purchases/{id}', 'PurchaseController@update');
$api->get('purchases/{id}', 'PurchaseController@view');
$api->delete('purchases/{id}', 'PurchaseController@delete');

$api->get('sales', 'SaleController@index');
$api->post('sales', 'SaleController@create');
$api->put('sales/{id}', 'SaleController@update');
$api->get('sales/{id}', 'SaleController@view');
$api->delete('sales/{id}', 'SaleController@delete');
