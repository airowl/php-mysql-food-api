<?php

namespace App\Controllers;

use Core\App;
use Core\Request;

class MeatController
{
    public function index()
    {
        $meats = App::get('database')->getAll('meats');

        return responseJson(json_encode($meats));
    }

    public function show()
    {
        $meat = App::get('database')->getOne('meats', 'id', Request::getParam());

        return responseJson(json_encode($meat));
    }

    public function create()
    {
        $params = array(
            'name' => $_GET['name'],
            'co2' => $_GET['co2'],
        );

        $res = App::get('database')->insert('meats', $params);

        return responseJson(json_encode($res));
    }

    public function update()
    {

        $params = $_GET;

        $res = App::get('database')->update('meats', $params, 'id', Request::getParam());

        return responseJson(json_encode($res));
    }

    public function delete()
    {

        $res = App::get('database')->delete('meats', 'id', Request::getParam());

        return responseJson(json_encode($res));
    }
}