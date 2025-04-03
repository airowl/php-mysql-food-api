<?php

namespace App\Controllers;

use Core\App;
use Core\Request;

class OrderController
{
    public function index()
    {
        $res = [];
        $orders = App::get('database')->getAll('orders');

        foreach ($orders as $order) {
            $res[$order->id] = $order;
            $pivots = App::get('database')->getOne('orders_meats', 'orders_id', $order->id);
            if(!isset($pivots)){
                return [];
            }

            foreach ($pivots as $pivot) {
                $meat = App::get('database')->getOne('meats', 'id', $pivot->meats_id);
                $res[$order->id]->products[$pivot->meats_id] = $meat ?? 'not exist';
            }

        }

        //return view('index', ['orders' => $orders]);
        return responseJson(json_encode($res));
    }

    public function show()
    {
        $res = (object)[];

        $order = App::get('database')->getOne('orders', 'id', Request::getParam());
        if(!isset($order)){
            return [];
        }

        $res = $order[0];
        $pivots = App::get('database')->getOne('orders_meats', 'orders_id', Request::getParam());
        if(!isset($pivots)){
            return [];
        }

        foreach ($pivots as $pivot) {
            $meat = App::get('database')->getOne('meats', 'id', $pivot->meats_id);
            $res->products[$pivot->meats_id] = $meat ?? 'not exist';
        }

        if(isset($res)){
            return responseJson(json_encode($res));
        }
        return [];

    }

    public function create()
    {
        $res = (object)[];
        // da aggiornare
        $params = array(
            'date' => $_GET['date'],
            'shipping_country' => $_GET['country'],
        );

        $order = App::get('database')->insert('orders', $params);
        $res = $order;

        $productIds = array($_GET['productIds']);

        var_dump($res);exit;
        exit;

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

    public function fullOrders()
    {
        $pivot = App::get('database')->getAll('orders_meats');
        var_dump($pivot);exit;

        //$order = App::get('database')->getOne('orders', 'id', $pivot->);

        return responseJson(json_encode($res));
    }
}