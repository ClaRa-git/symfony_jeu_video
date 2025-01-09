<?php

namespace App\DataFixtures;

use App\Entity\Age;
use App\Entity\Console;
use App\Entity\Note;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    //propriété pour encoder le mot de passe
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        // Appel de la méthode pour générer des utilisateurs
        $this->loadUsers($manager);

        // Appel de la méthode pour générer des consoles
        $this->loadConsoles($manager);

        // Appel de la méthode pour générer des âges
        $this->loadAges($manager);

        $manager->flush();
    }

    /**
     * Méthode pour générer des utilisateurs
     * @param ObjectManager $manager
     * @return void
     */
    public function loadUsers(ObjectManager $manager): void
    {
        // Création d'un tableau avec les infos des utilisateurs
        $array_users = [
            [
                'email' => "admin@admin.com",
                'password' => 'admin',
                'roles' => ['ROLE_ADMIN'],
                'username' => 'administrateur'
            ],
            [
                'email' => "user@user.com",
                'password' => 'user',
                'roles' => ['ROLE_USER'],
                'username' => 'utilisateur'
            ]
        ];

        // Boucle sur le tableau pour créer les utilisateurs
        foreach ($array_users as $key => $value) {
            $user = new User();
            $user->setEmail($value['email']);
            $user->setPassword($this->encoder->hashPassword($user, $value['password']));
            $user->setRoles($value['roles']);
            $user->setUsername($value['username']);

            // Persister les données
            $manager->persist($user);
        }
    }

    /**
     * Méthode pour générer des consoles
     * @param ObjectManager $manager
     * @return void
     */
    public function loadConsoles(ObjectManager $manager): void
    {
        $array_consoles = ['PS4', 'PS5', '360', 'XBOX Séries', 'ONE4', 'SWITCH', 'PC'];

        foreach ($array_consoles as $key => $value) {
            $console = new Console();
            $console->setLabel($value);
            $manager->persist($console);
            // Définir une référence pour chaque console pour pouvoir faire les relations
            $this->addReference('console_' . $key + 1, $console);
        }
    }

    /**
     * Méthode pour générer les âges
     * @param ObjectManager $manager
     * @return void
     */
    public function loadAges(ObjectManager $manager): void
    {
        $array_ages = ['3', '7', '12', '16', '18'];

        foreach ($array_ages as $key => $value) {
            $age = new Age();
            $age->setLabel($value);
            $age->setImagePath('pegi' . $value . '.png');
            $manager->persist($age);
            $this->addReference('age_' . $key + 1, $age);
        }
    }
    // autre méthode pour les âges
    // public function loadAges(ObjectManager $manager): void
    // {
    //     $array_ages = [
    //         ['label' => '3', 'imagePath' => 'pegi3.png'],
    //         ['label' => '7', 'imagePath' => 'pegi7.png'],
    //         ['label' => '12', 'imagePath' => 'pegi12.png'],
    //         ['label' => '16', 'imagePath' => 'pegi16.png'],
    //         ['label' => '18', 'imagePath' => 'pegi18.png']
    //     ];
    //      
    //     foreach ($array_ages as $key => $value) {
    //         $age = new Age();
    //         $age->setLabel($value['label']);
    //         $age->setImagePath($value['imagePath']);
    //         $manager->persist($age);
    //         $this->addReference('age_' . $key + 1, $age);
    //     }
    // }

}
