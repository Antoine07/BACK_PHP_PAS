<?php

namespace App\Controller;

use App\Service\Yams;
use App\Form\Model\Dice;
use App\Form\Type\DiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GameController extends AbstractController
{
    #[Route('/game', name: 'app_game')]
    public function index(Request $request, Yams $yams, SessionInterface $session): Response
    {
        // has méthode pour tester si la variable dans les sessions existes set et get méthodes sur le service Session
        $dices = $session->has('dices') ? $session->get('dices') :  [0, 0, 0, 0, 0];

        if (!$session->has('counter')) $session->set('counter', 5);

        $counter = $session->get('counter');

        // un formulaire factice pour avoir le submit...
        $form = $this->createFormBuilder()
            ->add('game', HiddenType::class)
            ->getForm();

        $form->handleRequest($request);

        // METHOD POST
        if ($form->isSubmitted()) {
            
            // récupération des 5 dés
            $dices = $yams->playDices();
            // enregistre en session
            $session->set('dices', $dices);

            // test du jeu savoir si on a gagné 0, 1, 2, 4
            $result = $yams->game($dices);

            // On 5 chances / parties on décrémente à chaque tour
            $session->set('counter', $counter - 1 ) ;

            // on a fait tous les coups 
            if( $counter == 0 ) return $this->redirectToRoute('app_result');

            // On peut rejouer 
            if ($result == 0)
                return $this->redirectToRoute('app_game'); // METHOD GET

            $session->set('result', $result);

            return $this->redirectToRoute('app_result'); // on a gagné
        }

        return $this->render('game/index.html.twig', [
            'form' => $form->createView(),
            'dices' => $dices,
            'counter' => $counter
        ]);
    }
}
