<?php

namespace App\Form;

use App\Entity\Plat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PlatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, [
                'label' => 'Nom Du plat',
                'help' => 'Le nom du plat doit être unique.',
            ])
            ->add('description', null, [
                'label' => 'Description',
                'help' => 'La description du plat doit être courte et précise.',
            ])
            ->add('prix', MoneyType::class, [
                'currency' => 'EUR',
                'divisor' => 100,
                'label' => 'Prix',
                'help' => 'Le prix du plat doit être indiqué en euros.',
            ])
            ->add('afficherSurPageAccueil', CheckboxType::class, [
                'label' => 'Afficher sur la page d\'accueil',
                'required' => false,
                'help' => 'Si vous cochez cette case, le plat sera affiché sur la page d\'accueil.',
            ])
            ->add('categoriePlat', ChoiceType::class, [
                'label' => 'Catégorie',
                'choices' => [
                    'Entrées' => 'Entrées',
                    'Plats' => 'Plats',
                    'Desserts' => 'Desserts',
                ],
                'help' => 'La catégorie du plat doit être choisie parmi les catégories proposées.',
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image du plat',
                'required' => false,
                'help' => 'L\'image du plat doit être au format JPG ou PNG',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plat::class,
        ]);
    }
}
