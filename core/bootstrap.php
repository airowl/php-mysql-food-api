<?php

use Core\App;
use Core\Database\Connection;
use Core\Database\QueryBuilder;

$app = [];

App::bind('config', require 'config.php');

App::bind('database', new QueryBuilder(
    Connection::make(App::get('config'))
));

function responseJson($data){
    header('Content-type: Application/json');

    if(isset($data)){
        http_response_code(200);
        die($data);
    } else {
        http_response_code(404);
    }

}