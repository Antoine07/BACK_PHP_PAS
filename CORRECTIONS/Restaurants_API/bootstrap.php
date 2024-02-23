<?php 

require_once __DIR__ . '/vendor/autoload.php' ;

use MongoDB\Client;

$client = new Client('mongodb://root:example@localhost:27017');

$collection = $client->ny->restaurants;

// var_dump($collection);


// var_dump($cursor->toArray()) ;