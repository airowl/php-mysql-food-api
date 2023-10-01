<?php


//$router->define([
//    '' => 'MeatController@index',
//]);

$router->get('meat', 'MeatController@index');
$router->get('meat/{id}', 'MeatController@show');
$router->post('meat', 'MeatController@create');
$router->patch('meat/{id}', 'MeatController@update');
$router->delete('meat/{id}', 'MeatController@delete');



$router->get('order', 'OrderController@index');
$router->get('order/{id}', 'OrderController@show');
$router->post('order', 'OrderController@create');
$router->patch('order/{id}', 'OrderController@update');
$router->delete('order/{id}', 'OrderController@delete');

