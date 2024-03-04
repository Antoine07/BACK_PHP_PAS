<?php

require_once __DIR__ . '/../bootstrap.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use MongoDB\BSON\Regex ;

$request = Request::createFromGlobals();
$action = $request->query->get('action');
$response = new Response();

if ($action == 'all') {
    $result = $collection->find(
        [
            'cuisine' => 'Italian',
        ],
        [
            'limit' => 10,
            'projection' => [
                'name' => 1,
                '_id' => 0,
                'cuisine' => 1
            ],
        ]
    );

    $response->setContent(json_encode(["restaurants" => $result->toArray()]));
}

// Lire un restaurant par ID
elseif ($action == 'cuisine') {
    $name = (string) $request->query->get('name') ?? '';

    $result = $collection->find(
        [
            'cuisine' => $name,
        ],
        [
            'projection' => [
                'name' => 1,
                '_id' => 0,
                'cuisine' => 1
            ],
            'limit' =>  $request->query->get('limit') ?? 10,
        ]
    );

    $response->setContent(json_encode(["restaurants" => $result->toArray()]));
}

// Restaurants par quartier
elseif ($action == 'restaurantsByBorough') {
    $limit = $request->query->get('limit') ?? 10;
    $pipeline = [
        [
            '$group' => [
                '_id' => '$borough',
                'count' => ['$sum' => 1]
            ]
        ],
        ['$limit' => (int) $limit]
    ];
    $result = $collection->aggregate($pipeline);

    $response->setContent(json_encode(["restaurants" => $result->toArray()]));
}

// Nombre de restaurants dans le dataset
elseif ($action == 'count') {
    $count = $collection->countDocuments();

    $response->setContent(json_encode(["restaurants" => $result->toArray()]));
}

// Moyenne des scores par quartier
elseif ($action == 'averageByBorough') {
    $limit = $request->query->get('limit') ?? 10;
    $pipeline = [
        [
            '$match' => [
                'grades.score' => ['$exists' => true],
                'borough' => ['$exists' => true]
            ],
        ],
        [
            '$unwind' => '$grades' // Dépliez le tableau grades
        ],
        [
            '$group' => [
                '_id' => '$borough',
                'averageScore' => ['$avg' => '$grades.score']
            ]
        ],
        ['$limit' => $limit]
    ];
    $result = $collection->aggregate($pipeline);

    $response->setContent(json_encode(["restaurants" => $result->toArray()]));
} elseif($action === 'regex') {
        $name = $request->query->get('name') ?? 'coffee';
        $filter = [
            'name' => new Regex($name, 'i')
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
// 404
else {
    $response->setContent(json_encode(["restaurants" => "error 404"]));
}

$response->headers->set('Content-Type', 'application/json');
$response->send();
