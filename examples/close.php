<?php

use seregazhuk\React\Memcached\Factory;

require '../vendor/autoload.php';

$loop = React\EventLoop\Factory::create();
$client = Factory::createClient($loop);

$client->set('name', 'test')->then(function () {
    echo "The value was stored\n";
}, function (Exception $e) {
    echo 'set: ', $e->getMessage(), "\n";
});
$client->close();
$client->get('name')->then(function ($data) {
    var_dump($data);
    echo "The value was retrieved\n";
}, function (Exception $e) {
    echo 'get: ', $e->getMessage(), "\n";
});

$loop->run();
