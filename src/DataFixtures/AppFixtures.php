<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        // $product = new Product();
        // $manager->persist($product);

        //Création d'un utilisateur de test
        $user = new User();
     
        $user->setPrenom($faker->firstName());
        $user->setNom($faker->lastName());
        $user->setEmail('franck@gmail.com');
        $user->setRoles(['ROLE_USER']);
        //$user->setPassword('password');

        $password = $this->hasher->hashPassword($user, 'password');
        $user->setPassword($password);

        $manager->persist($user);

        //création d'un utilisateur admin
        $admin = new User();
        $admin->setPrenom($faker->firstName());
        $admin->setNom($faker->lastName());
        $admin->setEmail('franckadmin@gmail.com');
        $admin->setRoles(['ROLE_ADMIN']);

        $password = $this->hasher->hashPassword($admin, 'password');
        $admin->setPassword($password);

        $manager->persist($admin);

        // //création de 10 plats du restaurant
        // for ($i = 0; $i < 10; $i++) {
        //     $plat = new Plat();
        //     $plat->setNom($faker->sentence(1));
        //     $plat->setDescription($faker->paragraph(2));
        //     $plat->setPrix($faker->randomFloat(2, 5, 20));
        //     $plat->setCategorieId($faker->randomElement([1, 2, 3, 4, 5]));
        //     $plat->setPhoto($faker->imageUrl(640, 480, 'food'));
        //     $plat->setDisplayInGallery($faker->randomElement([0, 1]));

        //     $manager->persist($plat);
        // }

        // //création de 5 catégories de plats
        // for ($i = 0; $i < 5; $i++) {
        //     $categorie = new Categorie();
        //     $categorie->setNom($faker->sentence(1));

        //     $manager->persist($categorie);
        // }

        // //creation de 2 formules du restaurant midi et soir
        // for ($i = 0; $i < 2; $i++) {
        //     $formule = new Formule();
        //     $formule->setNom($faker->sentence(1));
        //     $formule->setDescription($faker->paragraph(2));
        //     $formule->setPrix($faker->randomFloat(2, 5, 20));

        //     $manager->persist($formule);
        // }

        // //création de 4 menus du restaurant
        // for ($i = 0; $i < 4; $i++) {
        //     $menu = new Menu();
        //     $menu->setNom($faker->sentence(1));
        //     $menu->setDescription($faker->paragraph(2));
        //     $menu->setPrix($faker->randomFloat(2, 5, 20));

        //     $manager->persist($menu);
        // }


        $manager->flush();
    }
}
