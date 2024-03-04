# 02 TP API MongoDB

### Étape 1: Prérequis

Assurez-vous d'avoir installé les dépendances nécessaires :

- PHP
- Composer
- MongoDB

### Étape 2: Création du projet

:rocket: Les deux dépendances **mongodb** et **http-foundation** sont nécessaires pour transmettre nos requêtes à MongoDB et pour gérer les requêtes HTTP ainsi que les réponses en JSON.

```bash
# Créez un nouveau projet
composer init

# Installez les dépendances 
composer require mongodb/mongodb symfony/http-foundation
```

### Étape 3: Structure du projet

```
- api/
  - index.php
- bootstrap.php
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

Créez un fichier `index.php` pour définir votre API :

```php
// api.php
require_once __DIR__ . '/../bootstrap.php';

// utilisation d'une dépandance Symfony pour gérer les requêtes
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();
$action = $request->query->get('action');

$response = new Response();

// traitement des actions de l'API
if ($action == 'all') {
    $cursor = $collection->find(
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

    $response->setContent(json_encode([
        'data' => $cursor->toArray();
    ]));
}
// la réponse est un JSON à préciser pour l'envoi des données au navigateur
$response->headers->set('Content-Type', 'application/json');
// on envoit les données 
$response->send();
```

### Étape 6: Tester l'API

- Exécutez votre serveur PHP local.
- Testez les différentes actions de l'API avec un outil comme Postman.
- Consultez la documentation de l'API pour comprendre comment utiliser chaque endpoint.

Adaptez ce tutoriel en fonction de vos besoins spécifiques et de votre structure de base de données. N'oubliez pas de sécuriser votre API, notamment en implémentant des mécanismes d'authentification si nécessaire.

## Étape 7: Les requêtes en fonction des routes

Toutes les requêtes seront limitées à 10 par défaut, paramètre à préciser dans l'action.

### Lire tous les restaurants

#### Endpoint
GET /index.php?action=all&limit=10

#### Réponse
Retourne la liste de tous les restaurants au format JSON.

### Lire un restaurant par ID

#### Endpoint
GET /index.php?action=cusine&name=(name)limit=10

#### Paramètres
- {name}: type de restaurant à récupérer (obligatoire)

#### Réponse
Retourne les détails du restaurant spécifié au format JSON.

## Restaurants par quartier

### Endpoint
GET /index.php?action=restaurantsByBorough

### Réponse
Retourne le nombre total de restaurants par quartier au format JSON.

## Restaurants par quartier

### Endpoint
GET /index.php?action=restaurantsByBorough

### Réponse
Retourne le nombre total de restaurants par quartier au format JSON.

## Nombre de restaurants dans le dataset 

### Endpoint
GET /index.php?action=count

### Réponse
Retourne le nombre total de restaurants au format JSON.

## Moyenne des scores par quartier

### Endpoint
GET /index.php?action=averageByBorough

### Réponse
Retourne le nombre total de restaurants au format JSON.

## Coffee restaurants

### Endpoint
GET /index.php?action=regex&name=coffee

### Réponse
Retourne les restaurants qui ont dans leur nom coffee