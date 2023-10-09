<?php

use Core\App;
use Faker\Factory;
use Core\Database\Connection;
use Core\Database\QueryBuilder;

require 'vendor/autoload.php';


// cms argv order=N & meat=N

App::bind('config', require 'config.php');

App::bind('database', new QueryBuilder(
    Connection::make(App::get('config'))
));

parse_str($argv[1], $order);

$faker = Faker\Factory::create();

if (isset($order['order'])) {
    $n = $order['order'];
    for ($i = 0; $i < $n; $i++) {
        $paramsOrder = array(
            'date' => $faker->unixTime(),
            'shipping_country' => $faker->countryCode(),
        );
        try {
            App::get('database')->insert('orders', $paramsOrder);
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
    echo 'orders OK';
}

if (isset($order['meat'])) {
    $n = $order['meat'];
    for ($i = 0; $i < $n; $i++) {
        $paramsMeat = array(
            'name' => $faker->word(),
            'co2' => $faker->randomNumber(2, false),
        );
        try {
            App::get('database')->insert('meats', $paramsMeat);
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
    echo 'meats OK';
}