<?php

namespace App\Service;

class Yams
{
    public function isYams($dice): bool
    {
        // Vérifie si tous les dés sont égaux
        return count(array_unique($dice)) == 1;
    }

    public function isSquare($dice): bool
    {
        // Vérifie si au moins quatre dés sont identiques
        $occurrences = array_count_values($dice);
        return in_array(4, $occurrences);
    }

    public function isLargeStraight(array $dices): bool
    {
        sort($dices); // ordonne par ordre croissant        
        $count = 0;
        $s = [1, 2, 3, 4, 5];
        for ($i = 0; $i < 5; $i++) {
            if ($s[$i] == $dices[$i]) $count++;
        }

        if ($count == 5) return true;

        $count = 0;
        $s = [2, 3, 4, 5, 6];
        for ($i = 0; $i < 5; $i++) {
            if ($s[$i] == $dices[$i]) $count++;
        }

        if ($count == 5) return true;

        return false;
    }

    public function dice(): int
    {
        // Génère un nombre aléatoire entre 1 et 6 pour simuler le dé
        return rand(1, 6);
    }

    public function playDices(): array
    {
        $i  = 0;
        $dies = [];
        while ($i < 5) {
            $dies[] = $this->dice();
            $i++;
        }

        return $dies;
    }

    public function game(array $dices): int
    {
        if ($this->isYams($dices))
            return 4;

        if ($this->isSquare($dices))
            return 2;

        if ($this->isLargeStraight($dices))
            return 1;

        return 0;
    }
}
