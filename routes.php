<?php


//$router->define([
//    '' => 'MeatController@index',
//]);

$router->get('', 'MeatController@index');
$router->get('meat/{id}', 'MeatController@show');
$router->post('meat', 'MeatController@create');
$router->patch('meat/{id}', 'MeatController@update');
$router->delete('meat/{id}', 'MeatController@delete');