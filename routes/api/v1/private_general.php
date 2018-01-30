<?php

$api->get('auth/logout', 'Auth\LoginController@logout');

$api->get('vouchers', 'VoucherController@index');
$api->post('vouchers', 'VoucherController@create');
$api->put('vouchers/{id}', 'VoucherController@update');
$api->delete('vouchers/{id}', 'VoucherController@delete');
