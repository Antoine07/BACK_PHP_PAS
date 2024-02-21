<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // le premier paramètre est le nom du filtre
            new TwigFilter('message', [$this, 'formatMessage']),
        ];
    }

    // la fonction appelée avec un / des paramètre(s)
    public function formatMessage(int $number): string
    {
        if ($number == 1) return "Grande suite";
        if ($number == 2) return "Carré";
        if ($number == 4) return "Yams";

        return '';
    }
}
