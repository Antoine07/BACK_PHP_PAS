<?php

namespace App\Controller;

use App\Repository\PastryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class ResultController extends AbstractController
{
    #[Route('/result', name: 'app_result')]
    public function index(PastryRepository $repository,SessionInterface $session): Response
    {
       $result = (int) $session->get('result'); // la session le type c'est string
       $dices = $session->get('dices');
       $session->remove('result'); // suppression
       $session->remove('dices'); // suppression
       $session->remove('counter'); // on supprimer le compteur il n'existe plus

        return $this->render('result/index.html.twig', [
            'controller_name' => 'ResultController',
            'dices' => $dices ??  [], // test si $dices est null si c'est null execute le code alternatif 
            'result' => $result ?? '',
            'pastries' =>  $repository->findPastries($result)
        ]);
    }
}
