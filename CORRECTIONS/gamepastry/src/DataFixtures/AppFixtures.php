<?php

namespace App\DataFixtures;

use App\Entity\Pastry;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('Alice');
        $user->setScore(0);
        $user->setEmail('alice@alice.fr');
        $manager->persist($user) ;

        $pastries = $this->getData();

        foreach ($pastries as $pastry) {
            $name = $pastry['name'];
            $image = $pastry['image'];
            $image = $pastry['image'];
            $price = $pastry['price'];
            $calory = $pastry['calory'];
            $origin = $pastry['origin'];

            $pastry = new Pastry();
            $pastry->setName($name);
            $pastry->setImage($image);
            $pastry->setPrice($price);
            $pastry->setCalory($calory);
            $pastry->setOrigin($origin);

            $manager->persist($pastry);
        }

        $manager->flush();
    }

    private function getData(): array
    {
        return [
            [
                "name" => "Fondant suprême",
                "image" => "http://placehold.it/32x32",
                "quantity" => 4,
                "origin" => [
                    "country" => "France",
                    "region" => "Île-de-France",
                ],
                "calory" => 300,
                "price" => 5.5,
            ],
            [
                "name" => "Cake tout Chocolat",
                "image" => "http://placehold.it/32x32",
                "quantity" => 3,
                "origin" => [
                    "country" => "Belgium",
                    "region" => "Brussels",
                ],
                "calory" => 300,
                "price" => 7.5,
            ],
            [
                "name" => "Cake Framboise chocolat",
                "image" => "http://placehold.it/32x32",
                "quantity" => 4,
                "origin" => [
                    "country" => "France",
                    "region" => "Provence-Alpes-Côte d'Azur",
                ],
                "calory" => 300,
                "price" => 6.5,
            ],
            [
                "name" => "Brioche sucrée avec chocolat",
                "image" => "http://placehold.it/32x32",
                "quantity" => 3,
                "origin" => [
                    "country" => "France",
                    "region" => "Normandy",
                ],
                "calory" => 300,
                "price" => 4.5,
            ],
            [
                "name" => "Cake glacé fondant au chocolat",
                "image" => "http://placehold.it/32x32",
                "quantity" => 2,
                "origin" => [
                    "country" => "Switzerland",
                    "region" => "Zurich",
                ],
                "calory" => 380,
                "price" => 8.5,
            ],
            [
                "name" => "Éclairs au chocolat",
                "image" => "http://placehold.it/32x32",
                "quantity" => 5,
                "origin" => [
                    "country" => "France",
                    "region" => "Centre-Val de Loire",
                ],
                "calory" => 300,
                "price" => 3.5,
            ],
            [
                "name" => "Tarte poire chocolat",
                "image" => "http://placehold.it/32x32",
                "quantity" => 5,
                "origin" => [
                    "country" => "France",
                    "region" => "Brittany",
                ],
                "calory" => 380,
                "price" => 9.5,
            ],
            [
                "name" => "Banana au chocolat",
                "image" => "http://placehold.it/32x32",
                "quantity" => 3,
                "origin" => [
                    "country" => "United States",
                    "region" => "California",
                ],
                "calory" => 300,
                "price" => 5.0,
            ],
        ];
    }
}
