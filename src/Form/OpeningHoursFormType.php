<?php

namespace App\Form;

use App\Entity\RushHour;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OpeningHoursFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('day', null, [
                'label' => 'Jour',
            ])
            ->add('morning_opening_hour', null, [
                'label' => 'Heure d\'ouverture le midi',
            ])
            ->add('morning_closing_hour', null, [
                'label' => 'Heure de fermeture le soir',
            ])
            ->add('evening_opening_hour', null, [
                'label' => 'Heure d\'ouverture le soir',
            ])
            ->add('evening_closing_hour', null, [
                'label' => 'Heure de fermeture le soir',
            ])
            ->add('capacite', null, [
                'label' => 'Capacité',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RushHour::class,
        ]);
    }
}
