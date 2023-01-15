<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options,): void
    {
        $builder

            //Get the current user name and autofill the form field user with it
            ->add('user', null, [
                'data' => $options['user'],
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('date')
            ->add('horaire')
            ->add('nombreDePersonnes')
            ->add('allergies');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
