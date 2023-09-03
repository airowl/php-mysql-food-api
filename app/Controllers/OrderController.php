<?php

namespace App\Controllers;

use Core\App;
use Core\Request;

class OrderController
{
    public function index()
    {
        $orders = App::get('database')->getAll('order');

        return responseJson(json_encode($orders));
    }

    public function show()
    {
        $order = App::get('database')->getOne('order', 'id', $_GET['id']);

        return responseJson(json_encode($order));
    }

    public function create()
    {
        $params = array(
            'date' => $_GET['date'],
            'shipping_country' => $_GET['country'],
        );

        $res = App::get('database')->insert('order', $params);

        return responseJson(json_encode($res));
    }

    public function update()
    {

        $params = $_GET;

        $res = App::get('database')->update('order', $params, 'id', Request::getParam());

        return responseJson(json_encode($res));
    }

    public function delete()
    {

        $res = App::get('database')->delete('order', 'id', Request::getParam());

        return responseJson(json_encode($res));
    }
}