CREATE TABLE `gifs`
(
  `id`          int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) unsigned NOT NULL,
  `user_id`     int(11) unsigned NOT NULL,
  `dt_add`      timestamp default current_timestamp NOT NULL,
  `like_count`  int(11) unsigned NOT NULL DEFAULT '0',
  `title`       char(255) NOT NULL,
  `path`        char(255) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
);