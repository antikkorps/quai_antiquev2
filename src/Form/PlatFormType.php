<?php

namespace App\Form;

use App\Entity\Plat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class PlatFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, [
                'label' => 'Nom Du plat',
            ])
            ->add('description', null, [
                'label' => 'Description',
            ])
            ->add('prix', MoneyType::class, [
                'currency' => 'EUR',
                'divisor' => 100,
            ])
            ->add('photo', null, [
                'label' => 'Image du plat',
            ])
            ->add('display_in_gallery', null, [
                'label' => 'Afficher dans la galerie',
            ])
            ->add('categorie_id', null, [
                'label' => 'Catégorie',
            ])
            ->add('formules', null, [
                'label' => 'Formules',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plat::class,
        ]);
    }
}
