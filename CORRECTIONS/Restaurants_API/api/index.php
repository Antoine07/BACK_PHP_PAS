<?php

require_once __DIR__ . '/../bootstrap.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();
$action = $request->query->get('action');
$response = new Response();
if ($action === 'cuisineItalian') {
    $result = $collection->find(
        [
            'cuisine' => 'Italian',
        ],
        [
            'limit' => 5,
            'projection' => [
                'name' => 1,
                '_id' => 0
            ],
        ]
    );

    $response->setContent(json_encode(["restaurants" => $result->toArray()]));
}

if ($action === 'coffee') {

    $filter = [
        'name' => new MongoDB\BSON\Regex('coffee', 'i')
    ];

    $projection = [
        'projection' => [
            '_id' => 0,
            'name' => 1
        ]
    ];

    $result = $collection->find($filter, $projection);
    $response->setContent(json_encode(["restaurants" => $result->toArray()]));
}

$response->headers->set('Content-Type', 'application/json');
$response->send();
