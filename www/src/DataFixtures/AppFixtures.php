<?php

namespace App\DataFixtures;

use App\Entity\Age;
use App\Entity\Console;
use App\Entity\Game;
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

        // Appel de la méthode pour générer des notes
        $this->loadNotes($manager);

        // Appel de la méthode pour générer des jeux
        $this->loadGames($manager);

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

    /**
     * Méthode pour générer des notes
     * @param ObjectManager $manager
     * @return void
     */
    public function loadNotes(ObjectManager $manager): void
    {
        // Utilisation d'une boucle pour générer les notes
        for ($i = 1; $i < 15; $i++) {
            $note = new Note();
            $note->setMediaNote($this->randomNote(1, 20));
            $note->setUserNote($this->randomNote(1, 20));
            $manager->persist($note);
            $this->addReference('note_' . $i, $note);
        }
    }

    /**
     * Méthode qui génère un nombre aléatoire
     * @param int $min
     * @param int $max
     * @return int
     */
    public function randomNote(int $min, int $max): int
    {
        return rand($min, $max);
    }

    /**
     * Méthode pour générer des jeux
     * @param ObjectManager $manager
     * @return void
     */
    public function loadGames(ObjectManager $manager): void
    {
        $array_games = [
            [
                'title' => 'Animal Crossing : New Horizons',
                'description' => 'Animal Crossing : New Horizons vous emmène de nouveau dans le monde mignon d\'Animal Crossing, sur Nintendo Switch. Cultivez votre potager, pêchez, et faites votre vie avec vos compagnons en temps réel grâce à l\'horloge de la console.',
                'price' => 4490,
                'releaseDate' => new \DateTime('2020-03-20'),
                'imagePath' => 'animal-crossing.jpg',
                'note' => 1,
                'age' => 1,
                'console' => [6],
            ],
            [
                'title' => 'Call of Duty : Modern Warfare 2',
                'description' => 'Il s\'agit d\'une version reboot de l\'emblématique jeu de tir à la première personne Call of Duty Modern Warfare 2, sorti en 2009. Le jeu bénéficie de nouveaux graphismes et d\'une refonte complète. Le jeu devrait être le début d\'une nouvelle ère pour la licence.',
                'price' => 5999,
                'releaseDate' => new \DateTime('2022-10-28'),
                'imagePath' => 'call-of-duty.jpg',
                'note' => 2,
                'age' => 5,
                'console' => [1, 2, 4, 5, 7],
            ],
            [
                'title' => 'Fall Guys : Ultimate Knockout',
                'description' => 'Fall Guys : Ultimate Knockout réunit 60 participants en ligne dans une course chaotique et effrénée qui ne couronnera qu’un seul gagnant. Les obstacles étranges, le manque de discipline des concurrents et les lois inflexibles de la physique se dressent sur la route du succès de cet intervilles moderne.',
                'price' => 0,
                'releaseDate' => new \DateTime('2020-08-04'),
                'imagePath' => 'fall-guys.jpg',
                'note' => 3,
                'age' => 1,
                'console' => [1, 2, 4, 5, 7],
            ],
            [
                'title' => 'FIFA 23',
                'description' => 'Il s\'agit de la dernière version du célèbre licence de football en collaboration avec la FIFA. FIFA 23 apporte des améliorations techniques, de nouveaux modes et de nouveaux joueurs pour créer les équipes de foot.',
                'price' => 5699,
                'releaseDate' => new \DateTime('2022-09-30'),
                'imagePath' => 'fifa-23.jpg',
                'note' => 4,
                'age' => 1,
                'console' => [1, 2, 4, 5, 7],
            ],
            [
                'title' => 'Grand Theft Auto V',
                'description' => 'Jeu d\'action-aventure en monde ouvert, Grand Theft Auto (GTA) V vous place dans la peau de trois personnages inédits : Michael, Trevor et Franklin. Ces derniers ont élu domicile à Los Santos, ville de la région de San Andreas. Braquages et missions font partie du quotidien du joueur.',
                'price' => 2999,
                'releaseDate' => new \DateTime('2013-09-17'),
                'imagePath' => 'gta-v.jpg',
                'note' => 5,
                'age' => 5,
                'console' => [1, 2, 3, 4, 5, 7],
            ],
            [
                'title' => 'Human Fall Flat',
                'description' => 'Human : Fall Flat est un jeu d\'aventure puzzle qui propose au joueur de prendre possession de Bob un personnage désarticulé qui doit se dépatouiller dans 8 niveaux remplis d’énigmes. Ces dernières sont basées sur la physique et notre héros devra gérer au mieux ses bras pour soulever s’agripper et actionner divers mécanismes.',
                'price' => 2499,
                'releaseDate' => new \DateTime('2016-06-22'),
                'imagePath' => 'Human-Fall-Flat.jpg',
                'note' => 6,
                'age' => 2,
                'console' => [1, 2, 4, 5, 7],
            ],
            [
                'title' => 'Mario Kart 8 Deluxe',
                'description' => 'Mario Kart 8 sur Switch est un jeu de course coloré et délirant qui reprend les personnages phares des grandes licences Nintendo. Le joueur peut y affronter ses amis dans différents modes et types de coupes et a accès à 32 circuits aux environnements variés.',
                'price' => 4999,
                'releaseDate' => new \DateTime('2017-04-28'),
                'imagePath' => 'mario-kart-8.jpg',
                'note' => 7,
                'age' => 1,
                'console' => [6],
            ],
            [
                'title' => 'Super Mario Odyssey',
                'description' => 'Super Mario Odyssey est un jeu de plate-forme sur Switch où la princesse Peach a été enlevée par Bowser. Mario quitte le royaume Champignon à bord de l’Odyssey. Accompagné de Cappy son chapeau vivant il doit parcourir différents royaumes pour sauver la princesse.',
                'price' => 4499,
                'releaseDate' => new \DateTime('2017-10-27'),
                'imagePath' => 'mario-odyssey.jpg',
                'note' => 8,
                'age' => 1,
                'console' => [6],
            ],
            [
                'title' => 'Minecraft',
                'description' => 'Jeu bac à sable indépendant et pixelisé dont le monde infini est généré aléatoirement Minecraft permet au joueur de récolter divers matériaux d’élever des animaux et de modifier le terrain selon ses choix en solo ou en multi.',
                'price' => 2249,
                'releaseDate' => new \DateTime('2011-11-18'),
                'imagePath' => 'minecraft.jpg',
                'note' => 9,
                'age' => 2,
                'console' => [1, 2, 3, 4, 5, 6, 7],
            ],
            [
                'title' => 'Légendes Pokémon: Arceus',
                'description' => 'Légendes Pokémon : Arceus tranche avec les précédents opus Pokémon puisqu\'il prend place dans un monde ouvert. Le joueur incarne un dresseur chargé de créer le premier Pokédex de Sinnoh.',
                'price' => 4499,
                'releaseDate' => new \DateTime('2022-01-28'),
                'imagePath' => 'pokemon.jpg',
                'note' => 10,
                'age' => 2,
                'console' => [6],
            ],
            [
                'title' => 'PlayerUnknown\'s Battlegrounds',
                'description' => 'PlayerUnknown\'s Battlegrounds est un jeu multijoueur de type Battle Royale. En partant de rien il vous faut trouver des armes et des ressources afin d\'être le dernier survivant.',
                'price' => 995,
                'releaseDate' => new \DateTime('2017-03-23'),
                'imagePath' => 'PUBG-Battlegrounds.jpg',
                'note' => 11,
                'age' => 4,
                'console' => [1, 5, 7],
            ],
            [
                'title' => 'Red Dead Redemption II',
                'description' => 'Suite du précédent volet multi récompensé Red Dead Redemption II permet de se plonger dans une ambiance western. L\'histoire se déroule en 1899 avant le premier volet au moment où Arthur Morgan doit fuir avec sa bande après un braquage raté.',
                'price' => 1399,
                'releaseDate' => new \DateTime('2018-10-26'),
                'imagePath' => 'red-dead-redemption.jpg',
                'note' => 12,
                'age' => 5,
                'console' => [1, 5, 7],
            ],
            [
                'title' => 'The Elder Scrolls V : Skyrim',
                'description' => 'The Elder Scrolls V: Skyrim est le cinquième épisode de la saga. Le joueur incarne le Dovahkiin seul capable de contrer Alduin un dragon apocalyptique dans un monde gigantesque rempli de quêtes et d\'aventures.',
                'price' => 1990,
                'releaseDate' => new \DateTime('2011-11-11'),
                'imagePath' => 'The-Elder-Scrolls-Skyrim.jpg',
                'note' => 13,
                'age' => 5,
                'console' => [1, 2, 3, 4, 5, 7],
            ],
            [
                'title' => 'The Legend of Zelda : Breath of the Wild',
                'description' => 'The Legend of Zelda: Breath of the Wild est un jeu d\'action/aventure. Link se réveille d\'un sommeil de 100 ans dans un royaume d\'Hyrule dévasté et doit percer les mystères de son passé pour vaincre Ganon le fléau.',
                'price' => 5199,
                'releaseDate' => new \DateTime('2017-03-03'),
                'imagePath' => 'zelda.jpg',
                'note' => 14,
                'age' => 3,
                'console' => [6],
            ],
        ];

        foreach ($array_games as $key => $value) {
            $game = new Game();
            $game->setTitle($value['title']);
            $game->setDescription($value['description']);
            $game->setPrice($value['price']);
            $game->setReleaseDate($value['releaseDate']);
            $game->setImagePath($value['imagePath']);

            // Appel des références pour les relations
            $game->setNote($this->getReference('note_' . $value['note'], Note::class));
            $game->setAge($this->getReference('age_' . $value['age'], Age::class));

            // Boucle pour les consoles
            foreach ($value['console'] as $console) {
                $game->addConsole($this->getReference('console_' . $console, Console::class));
            }

            $manager->persist($game);
        }
    }
}
