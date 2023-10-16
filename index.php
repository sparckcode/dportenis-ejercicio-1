<?php

require_once 'modelo/Api.php';

header("HTTP/1.1 200");
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

$method =  $_SERVER['REQUEST_METHOD'];

$api = new Api($method);
$api->call();
