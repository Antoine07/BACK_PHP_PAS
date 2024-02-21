<?php

namespace App\DataFixtures;

use App\Entity\Pastry;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PastryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $pastries = $this->getPastries();

        foreach($pastries as $pastry){
            $name = $pastry['name'];
            $image = $pastry['image'];
            $price = $pastry['price'];
            $calory = $pastry['calory'];
            $origin = $pastry['origin'];

            $p = new Pastry();
            $p->setName($name);
            $p->setImage($image);
            $p->setPrice($price);
            $p->setCalory($calory);
            $p->setOrigin($origin);

            $manager->persist($p);
        }

        $manager->flush();
    }

    private function getPastries(): array{
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
