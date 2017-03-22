SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dt_add` datetime NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `gif_id` int(11) unsigned NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `gif_id` (`gif_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`gif_id`) REFERENCES `gifs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `gifs`;
CREATE TABLE `gifs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `dt_add` datetime NOT NULL,
  `show_count` int(11) unsigned NOT NULL DEFAULT '0',
  `like_count` int(11) NOT NULL DEFAULT '0',
  `fav_count` int(11) NOT NULL DEFAULT '0',
  `title` char(255) NOT NULL,
  `description` text,
  `path` char(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `gifs_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `gifs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `gifs_fav`;
CREATE TABLE `gifs_fav` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `gif_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `gif_id` (`gif_id`),
  CONSTRAINT `gifs_fav_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `gifs_fav_ibfk_2` FOREIGN KEY (`gif_id`) REFERENCES `gifs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `gifs_like` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `gif_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `gif_id` (`gif_id`),
  CONSTRAINT `gifs_like_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `gifs_like_ibfk_2` FOREIGN KEY (`gif_id`) REFERENCES `gifs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dt_add` datetime NOT NULL,
  `email` char(255) NOT NULL,
  `name` char(255) NOT NULL,
  `password` char(64) NOT NULL,
  `avatar_path` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO categories (name) VALUES ("Фильмы и анимация"), ("Животные"), ("Спорт"), ("Видеоигры"), ("Приколы"),
  ("Наука"), ("Фейлы");

ALTER TABLE `gifs_like` ADD UNIQUE INDEX (`user_id`, `gif_id`);
ALTER TABLE `gifs_fav` ADD UNIQUE INDEX (`user_id`, `gif_id`) ;

ALTER TABLE `users` ADD COLUMN `token` char(32) NOT NULL AFTER `avatar_path`;
