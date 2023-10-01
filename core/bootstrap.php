<?php

use Core\App;
use Core\Database\Connection;
use Core\Database\QueryBuilder;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

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

function view($name, $data = []){
    try {
        $loader = new FilesystemLoader(dirname(__DIR__) . '/views');
        $twig = new Environment($loader, array(
            //'cache' => dirname(__DIR__) . '/cache',
            //'cache' => FALSE,
            'debug' => true
        ));
        $twig->addExtension(new \Twig\Extension\DebugExtension());
    
        echo $twig->render($name . '.view.twig', $data);
    } catch (\Exception $e) {
        die($e->getMessage());
    }
}