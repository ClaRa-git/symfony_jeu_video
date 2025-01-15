/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.6.2-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: video_games
-- ------------------------------------------------------
-- Server version	11.6.2-MariaDB-ubu2404

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `age`
--

DROP TABLE IF EXISTS `age`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `age` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `age`
--

LOCK TABLES `age` WRITE;
/*!40000 ALTER TABLE `age` DISABLE KEYS */;
INSERT INTO `age` VALUES
(1,'3','pegi3.png'),
(2,'7','pegi7.png'),
(3,'12','pegi12.png'),
(4,'16','pegi16.png'),
(5,'18','pegi18.png');
/*!40000 ALTER TABLE `age` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `console`
--

DROP TABLE IF EXISTS `console`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `console` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `console`
--

LOCK TABLES `console` WRITE;
/*!40000 ALTER TABLE `console` DISABLE KEYS */;
INSERT INTO `console` VALUES
(1,'PS4'),
(2,'PS5'),
(3,'360'),
(4,'XBOX Séries'),
(5,'ONE4'),
(6,'SWITCH'),
(7,'PC');
/*!40000 ALTER TABLE `console` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES
('DoctrineMigrations\\Version20250109102128','2025-01-15 08:51:06',354),
('DoctrineMigrations\\Version20250109103941','2025-01-15 08:51:07',28);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note_id` int(11) DEFAULT NULL,
  `age_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `price` int(11) NOT NULL,
  `release_date` datetime NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_232B318C26ED0855` (`note_id`),
  KEY `IDX_232B318CCC80CD12` (`age_id`),
  CONSTRAINT `FK_232B318C26ED0855` FOREIGN KEY (`note_id`) REFERENCES `note` (`id`),
  CONSTRAINT `FK_232B318CCC80CD12` FOREIGN KEY (`age_id`) REFERENCES `age` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game`
--

LOCK TABLES `game` WRITE;
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
INSERT INTO `game` VALUES

(2,2,5,'Call of Duty : Modern Warfare 2','Il s\'agit d\'une version reboot de l\'emblématique jeu de tir à la première personne Call of Duty Modern Warfare 2, sorti en 2009. Le jeu bénéficie de nouveaux graphismes et d\'une refonte complète. Le jeu devrait être le début d\'une nouvelle ère pour la licence.',5999,'2022-10-28 00:00:00','call-of-duty.jpg'),
(3,3,1,'Fall Guys : Ultimate Knockout','Fall Guys : Ultimate Knockout réunit 60 participants en ligne dans une course chaotique et effrénée qui ne couronnera qu’un seul gagnant. Les obstacles étranges, le manque de discipline des concurrents et les lois inflexibles de la physique se dressent sur la route du succès de cet intervilles moderne.',0,'2020-08-04 00:00:00','fall-guys.jpg'),
(4,4,1,'FIFA 23','Il s\'agit de la dernière version du célèbre licence de football en collaboration avec la FIFA. FIFA 23 apporte des améliorations techniques, de nouveaux modes et de nouveaux joueurs pour créer les équipes de foot.',5699,'2022-09-30 00:00:00','fifa-23.jpg'),
(5,5,5,'Grand Theft Auto V','Jeu d\'action-aventure en monde ouvert, Grand Theft Auto (GTA) V vous place dans la peau de trois personnages inédits : Michael, Trevor et Franklin. Ces derniers ont élu domicile à Los Santos, ville de la région de San Andreas. Braquages et missions font partie du quotidien du joueur.',2999,'2013-09-17 00:00:00','gta-v.jpg'),
(6,6,2,'Human Fall Flat','Human : Fall Flat est un jeu d\'aventure puzzle qui propose au joueur de prendre possession de Bob un personnage désarticulé qui doit se dépatouiller dans 8 niveaux remplis d’énigmes. Ces dernières sont basées sur la physique et notre héros devra gérer au mieux ses bras pour soulever s’agripper et actionner divers mécanismes.',2499,'2016-06-22 00:00:00','Human-Fall-Flat.jpg'),
(7,7,1,'Mario Kart 8 Deluxe','Mario Kart 8 sur Switch est un jeu de course coloré et délirant qui reprend les personnages phares des grandes licences Nintendo. Le joueur peut y affronter ses amis dans différents modes et types de coupes et a accès à 32 circuits aux environnements variés.',4999,'2017-04-28 00:00:00','mario-kart-8.jpg'),
(8,8,1,'Super Mario Odyssey','Super Mario Odyssey est un jeu de plate-forme sur Switch où la princesse Peach a été enlevée par Bowser. Mario quitte le royaume Champignon à bord de l’Odyssey. Accompagné de Cappy son chapeau vivant il doit parcourir différents royaumes pour sauver la princesse.',4499,'2017-10-27 00:00:00','mario-odyssey.jpg'),
(9,9,2,'Minecraft','Jeu bac à sable indépendant et pixelisé dont le monde infini est généré aléatoirement Minecraft permet au joueur de récolter divers matériaux d’élever des animaux et de modifier le terrain selon ses choix en solo ou en multi.',2249,'2011-11-18 00:00:00','minecraft.jpg'),
(10,10,2,'Légendes Pokémon: Arceus','Légendes Pokémon : Arceus tranche avec les précédents opus Pokémon puisqu\'il prend place dans un monde ouvert. Le joueur incarne un dresseur chargé de créer le premier Pokédex de Sinnoh.',4499,'2022-01-28 00:00:00','pokemon.jpg'),
(11,11,4,'PlayerUnknown\'s Battlegrounds','PlayerUnknown\'s Battlegrounds est un jeu multijoueur de type Battle Royale. En partant de rien il vous faut trouver des armes et des ressources afin d\'être le dernier survivant.',995,'2017-03-23 00:00:00','PUBG-Battlegrounds.jpg'),
(12,12,5,'Red Dead Redemption II','Suite du précédent volet multi récompensé Red Dead Redemption II permet de se plonger dans une ambiance western. L\'histoire se déroule en 1899 avant le premier volet au moment où Arthur Morgan doit fuir avec sa bande après un braquage raté.',1399,'2018-10-26 00:00:00','red-dead-redemption.jpg'),
(13,13,5,'The Elder Scrolls V : Skyrim','The Elder Scrolls V: Skyrim est le cinquième épisode de la saga. Le joueur incarne le Dovahkiin seul capable de contrer Alduin un dragon apocalyptique dans un monde gigantesque rempli de quêtes et d\'aventures.',1990,'2011-11-11 00:00:00','The-Elder-Scrolls-Skyrim.jpg'),
(14,14,3,'The Legend of Zelda : Breath of the Wild','The Legend of Zelda: Breath of the Wild est un jeu d\'action/aventure. Link se réveille d\'un sommeil de 100 ans dans un royaume d\'Hyrule dévasté et doit percer les mystères de son passé pour vaincre Ganon le fléau.',5199,'2017-03-03 00:00:00','zelda.jpg'),
(16,16,3,'The Legend of Zelda : Tears of the Kingdom','Repoussez les limites de l’aventure. Faites le grand saut : la suite de l’aventure en monde ouvert acclamée par la critique vous attend ! Après The Legend of Zelda : Breath of The Wild, plongez dans des terres d’Hyrule ravagées par les forces obscures dans The Legend of Zelda : Tears of the Kingdom. Incarnez le héros de la légende, Link, et décidez du chemin que vous voulez suivre à travers les immenses terres d\'Hyrule et les vastes cieux qui les surplombent. Créez votre propre aventure dans un monde où vous pouvez donner libre cours à votre imagination. Saurez-vous maîtriser la puissance des nouvelles capacités de Link pour lutter contre les forces maléfiques qui menacent le royaume ?',5999,'2023-05-12 11:48:00','zeldatotk-6787b27dac8cc.webp');
/*!40000 ALTER TABLE `game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_console`
--

DROP TABLE IF EXISTS `game_console`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game_console` (
  `game_id` int(11) NOT NULL,
  `console_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`console_id`),
  KEY `IDX_A3C1B099E48FD905` (`game_id`),
  KEY `IDX_A3C1B09972F9DD9F` (`console_id`),
  CONSTRAINT `FK_A3C1B09972F9DD9F` FOREIGN KEY (`console_id`) REFERENCES `console` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_A3C1B099E48FD905` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_console`
--

LOCK TABLES `game_console` WRITE;
/*!40000 ALTER TABLE `game_console` DISABLE KEYS */;
INSERT INTO `game_console` VALUES
(2,1),
(2,2),
(2,4),
(2,5),
(2,7),
(3,1),
(3,2),
(3,4),
(3,5),
(3,7),
(4,1),
(4,2),
(4,4),
(4,5),
(4,7),
(5,1),
(5,2),
(5,3),
(5,4),
(5,5),
(5,7),
(6,1),
(6,2),
(6,4),
(6,5),
(6,7),
(7,6),
(8,6),
(9,1),
(9,2),
(9,3),
(9,4),
(9,5),
(9,6),
(9,7),
(10,6),
(11,1),
(11,5),
(11,7),
(12,1),
(12,5),
(12,7),
(13,1),
(13,2),
(13,3),
(13,4),
(13,5),
(13,7),
(14,6),
(16,6);
/*!40000 ALTER TABLE `game_console` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `note`
--

DROP TABLE IF EXISTS `note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_note` int(11) NOT NULL,
  `user_note` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `note`
--

LOCK TABLES `note` WRITE;
/*!40000 ALTER TABLE `note` DISABLE KEYS */;
INSERT INTO `note` VALUES
(2,19,10),
(3,20,15),
(4,13,11),
(5,20,19),
(6,11,13),
(7,11,19),
(8,12,19),
(9,18,14),
(10,19,16),
(11,17,10),
(12,13,17),
(13,20,10),
(14,14,16),
(16,19,15);
/*!40000 ALTER TABLE `note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES
(1,'admin@admin.com','[\"ROLE_ADMIN\"]','$2y$13$uG44mUYLltkeaTuhQfWKcuePEQWsKa4r7l/ZFb0dOvtpmMo3tjRym','administrateur'),
(2,'user@user.com','[\"ROLE_USER\"]','$2y$13$Ky31cxgxFv7HQo02hq9Cuuulx4kyATqVWZDNCpjo7ijrKNxof5Jh6','utilisateur');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-01-15 13:43:39
