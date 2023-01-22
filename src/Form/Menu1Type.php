<?php

namespace App\Form;

use App\Entity\Menu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class Menu1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, [
                'label' => 'Nom du menu',
            ])
            ->add(
                'formule',
                ChoiceType::class,
                [
                    'label' => 'Formule',
                    'choices' => [
                        'Formule Midi' => 'Formule Midi',
                        'Formule Soir' => 'Formule Soir',
                        'Formule Weekend' => 'Formule Weekend',
                    ],
                ]
            )
            ->add('prix', MoneyType::class, [
                'label' => 'Prix',
                'currency' => 'EUR',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
