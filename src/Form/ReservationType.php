<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\User;
use App\Entity\Horaire;
use PhpParser\Node\Stmt\Label;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options,): void
    {
        $builder


            ->add('date', DateTimeType::class, [
                'label' => 'Réserver une table',
                'help' => 'Date prévue pour votre venue parmi nous',
                'widget' => 'single_text',
            ])
            ->add('nombreDePersonnes', NumberType::class, [
                'label' => 'Nombre de convives',
                'help' => 'Merci de nous informer du nombre de convives vous compris',
            ])
            ->add('allergies', ChoiceType::class, [
                'choices' => [
                    'Rien à signaler' => 1,
                    'Lait' => 2,
                    'Oeuf' => 3,
                    'Fruits à coque' => 4,
                    'arachide' => 5,
                    'Moutarde' => 6,
                    'crustacés' => 7,
                    'poisson' => 8,
                    'soja' => 9,
                    'gluten' => 10,
                    'Sulfites' => 11,
                    'Blé' => 12
                ],
                'help' => 'Merci de nous informer de vos allergies',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
