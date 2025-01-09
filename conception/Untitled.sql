CREATE TABLE `console` (
  `id` int PRIMARY KEY,
  `label` varchar(255)
);

CREATE TABLE `game` (
  `id` int PRIMARY KEY,
  `title` varchar(255),
  `description` text,
  `price` int,
  `releaseDate` datetime,
  `imagePath` varchar(255),
  `note_id` int,
  `age_id` int
);

CREATE TABLE `note` (
  `id` int PRIMARY KEY,
  `mediaNote` int,
  `userNote` int
);

CREATE TABLE `age` (
  `id` int PRIMARY KEY,
  `label` varchar(255),
  `imagePath` varchar(255)
);

CREATE TABLE `game_console` (
  `console_id` int,
  `game_id` int,
  PRIMARY KEY (`console_id`, `game_id`)
);

CREATE TABLE `user` (
  `id` int PRIMARY KEY,
  `email` varchar(255),
  `password` varchar(255),
  `role` varchar(255)
);

ALTER TABLE `game_console` ADD FOREIGN KEY (`console_id`) REFERENCES `console` (`id`);

ALTER TABLE `game_console` ADD FOREIGN KEY (`game_id`) REFERENCES `game` (`id`);

ALTER TABLE `note` ADD FOREIGN KEY (`id`) REFERENCES `game` (`note_id`);

ALTER TABLE `age` ADD FOREIGN KEY (`id`) REFERENCES `game` (`age_id`);
