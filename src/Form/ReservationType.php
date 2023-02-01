<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\User;
use App\Entity\Horaire;
use PhpParser\Node\Stmt\Label;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder


            ->add('date', DateType::class, [
                'label' => 'Réserver une table',
                'help' => 'Date prévue pour votre venue parmi nous',
                'widget' => 'single_text',
            ])
            ->add('nombreDePersonnes', NumberType::class, [
                'label' => 'Nombre de convives',
                'help' => 'Merci de nous informer du nombre de convives vous compris',


            ],)
            ->add('horaireDeVenue', TimeType::class, [
                // 'choices' => [
                //     '12:00' => 1,
                //     '12:30' => 2,
                //     '13:00' => 3,
                //     '13:30' => 4,
                //     '19:00' => 5,
                //     '19:30' => 6,
                //     '20:00' => 7,
                //     '20:30' => 8,
                //     '21:00' => 9,
                //     '21:30' => 10,
                //     '22:00' => 11,
                //     '22:30' => 12,
                //     '23:00' => 13,
                //     '23:30' => 14,
                // ],
                'help' => 'Merci de nous informer de votre heure d\'arrivée',
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
