<?php

namespace App\Controller;

use App\Repository\PastryRepository;
use App\Service\MessageGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class PastryController extends AbstractController
{
    #[Route('/pastry', name: 'app_pastry')]
    public function index(PastryRepository $repository, MessageGenerator $messageGenerator): JsonResponse
    {
        dump($repository->findAll());
        dump($repository->sumAllPrices());
        dump('Order');
        dump($repository->findPastryAllOrderByName());
        dump('GreterThan');
        dump($repository->findPastryWithCaloriesGreaterThan(300));

        dump($messageGenerator->getHappyMessage()) ;

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PastryController.php',
        ]);
    }
}
