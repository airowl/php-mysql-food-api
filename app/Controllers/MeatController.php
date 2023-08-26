<?php

namespace App\Controllers;

class MeatController
{
    public function index()
    {
        //var_dump('foo');exit;
        $data = [
            'ciao' => 'foo'
        ];
        return responseJson(json_encode($data));
    }
}