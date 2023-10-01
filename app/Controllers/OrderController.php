<?php

namespace App\Controllers;

use Core\App;
use Core\Request;

class OrderController
{
    public function index()
    {
        $orders = App::get('database')->getAll('orders');
        return view('index', ['orders' => $orders]);
    }

    public function show()
    {

        $order = App::get('database')->getOne('orders', 'id', Request::getParam());

        return responseJson(json_encode($order));
    }

    public function create()
    {
        $params = array(
            'date' => $_GET['date'],
            'shipping_country' => $_GET['country'],
        );

        $res = App::get('database')->insert('orders', $params);

        return responseJson(json_encode($res));
    }

    public function update()
    {

        $params = $_GET;

        $res = App::get('database')->update('orders', $params, 'id', Request::getParam());

        return responseJson(json_encode($res));
    }

    public function delete()
    {

        $res = App::get('database')->delete('orders', 'id', Request::getParam());

        return responseJson(json_encode($res));
    }
}