<?php

// src/Form/Type/ShippingType.php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

class DiceType extends AbstractType
{



    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('dice1', HiddenType::class)
            ->add('dice2', HiddenType::class)
            ->add('dice3', HiddenType::class)
            ->add('dice4', HiddenType::class)
            ->add('dice5', HiddenType::class)
            ->add('dice6', HiddenType::class);
    }
}
