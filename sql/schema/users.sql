CREATE TABLE `users`
(
  `id`          int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dt_add`      timestamp default current_timestamp NOT NULL,
  `email`       char(255) NOT NULL,
  `name`        char(255) NOT NULL,
  `password`    char(64),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
);