# 02 TP API MongoDB

### Étape 1: Prérequis

Assurez-vous d'avoir installé les dépendances nécessaires :

- PHP
- Composer
- MongoDB

### Étape 2: Création du projet

```bash
# Créez un nouveau projet
composer init

# Installez les dépendances nécessaires
composer require mongodb/mongodb symfony/http-foundation
```

### Étape 3: Structure du projet

```
- api/
  - bootstrap.php
  - api.php
- vendor/
  (répertoire généré par Composer)
- composer.json
```

### Étape 4: Configuration de MongoDB

Créez un fichier `bootstrap.php` pour gérer la configuration de MongoDB :

```php
// bootstrap.php

require_once __DIR__ . '/vendor/autoload.php' ;

use MongoDB\Client;

$client = new Client('mongodb://root:example@localhost:27017');
$collection = $client->ny->restaurants;
```

### Étape 5: API avec Symfony HTTP Foundation

Créez un fichier `api.php` pour définir votre API :

```php
// api.php

require_once __DIR__ . '/../bootstrap.php';

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();
$action = $request->query->get('action');

$response = new Response();

if ($action == 'all') {

    $response->setContent(json_encode([
        'data' => '',
    ]));
}

if ($action == 'averageScore') {
    $pipeline = [
      

    ];

    $collection->aggregate($pipeline)->toArray();

    $response->setContent(json_encode([
        'data' => $collection->aggregate($pipeline)->toArray();
    ]));
}

$response->headers->set('Content-Type', 'application/json');

$response->send();
```

### Étape 6: Tester l'API

- Exécutez votre serveur PHP local.
- Testez les différentes actions de l'API avec un outil comme Postman.
- Consultez la documentation de l'API pour comprendre comment utiliser chaque endpoint.

Adaptez ce tutoriel en fonction de vos besoins spécifiques et de votre structure de base de données. N'oubliez pas de sécuriser votre API, notamment en implémentant des mécanismes d'authentification si nécessaire.

## Étape 7: Les requêtes en fonction des routes

### Lire tous les restaurants

#### Endpoint
GET /api.php?action=getRestaurants

#### Réponse
Retourne la liste de tous les restaurants au format JSON.

### Lire un restaurant par ID

#### Endpoint
GET /api.php?action=restaurants&id={restaurant_id}

#### Paramètres
- {id}: ID du restaurant à récupérer (obligatoire)

#### Réponse
Retourne les détails du restaurant spécifié au format JSON.

## Restaurants par quartier

### Endpoint
GET /api.php?action=restaurantsByBorough

### Réponse
Retourne le nombre total de restaurants par quartier au format JSON.

