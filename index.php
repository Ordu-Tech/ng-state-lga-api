<?php

use Api\Api;

header("Content-Type: application/json charset=utf-8");
if (!isset($_SERVER['HTTP_ORIGIN']) && !isset($_GET)) {
    echo json_encode(['message' => 'Cant access the api']);
    die;
}
header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        // may also be using PUT, PATCH, HEAD etc
        header("Access-Control-Allow-Methods: GET, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

$parts = explode('/', $_SERVER['REQUEST_URI']);
if (isset($parts[1]) && $parts[1] == 'api') {
    // if (gettype($parts[2]) != 'string') {
    //     http_response_code(400);
    //     echo json_encode(['error' => 'String requared in state param']);
    //     return;
    // };
    include __DIR__ . '/Api.php';
    $api = new Api($parts);
    die;
}