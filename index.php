<?php


require 'vendor/autoload.php';

require 'core/bootstrap.php';
use Core\Router;
use Core\Request;

//add request URI
Router::load('routes.php')
    ->direct(Request::uri(), Request::method());