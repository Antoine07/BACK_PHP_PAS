<?php 
namespace App\Service ;
class MessageGenerator{

    public function getHappyMessage():string{

        // retourne une phrase de manière aléatoire, injectez le service dans la méthode index du contrôleur PastryController et afficher la phrase

        // créez maintenant une classe Text qui contient les messages que l'on injectera à la classe MessageGenerator pour constater que SF est capable de résoudre les dépendances de services eux-mêmes.

        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
        ];

        $index = array_rand($messages);

        return $messages[$index] ;
    }

}