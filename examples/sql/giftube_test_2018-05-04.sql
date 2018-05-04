# ************************************************************
# Sequel Pro SQL dump
# Версия 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Адрес: 127.0.0.1 (MySQL 5.7.21)
# Схема: giftube_test
# Время создания: 2018-05-04 14:32:56 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Дамп таблицы categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`id`, `name`)
VALUES
	(4,'Видеоигры'),
	(2,'Животные'),
	(8,'Люди'),
	(6,'Наука'),
	(5,'Приколы'),
	(3,'Спорт'),
	(7,'Фейлы'),
	(1,'Фильмы и анимация');

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы comments
# ------------------------------------------------------------

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

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;

INSERT INTO `comments` (`id`, `dt_add`, `user_id`, `gif_id`, `content`)
VALUES
	(1,'2017-03-29 16:33:27',1,9,'Тестовый комментарий'),
	(2,'2017-04-01 17:07:49',3,11,'Да я также могу '),
	(3,'2017-04-06 16:08:20',6,15,'Это комментарий, с помощью которого я проверяю, работают ли в рамках этого сервиса комментарии. '),
	(4,'2017-04-06 16:09:50',6,15,'Так это что же получается - можно стать фуллстэк-разработчиком?\r\nАкадемия, я вас люблю.'),
	(5,'2017-04-11 19:23:54',12,14,'круто'),
	(6,'2017-04-11 19:24:11',12,14,'проверка'),
	(7,'2017-04-13 21:18:05',13,11,'И я\r\n'),
	(8,'2017-05-15 16:24:58',27,6,'dsgsdfgdfgsdfg'),
	(9,'2017-05-15 16:25:03',27,6,'asdfasdfasdf'),
	(10,'2017-05-15 16:25:37',27,6,'<?php echo \"test commetn\"; ?>'),
	(11,'2017-05-30 06:23:35',32,11,'234'),
	(12,'2017-06-16 09:28:49',35,15,'Прикольный :)'),
	(13,'2017-07-13 18:50:12',39,16,'кекс'),
	(14,'2017-08-28 13:23:21',48,11,'hi'),
	(15,'2017-09-11 16:44:40',55,16,'Пекс\r\n'),
	(17,'2017-10-08 07:04:24',53,4,'крутой контент!'),
	(18,'2017-10-17 18:44:39',63,26,'ooo'),
	(19,'2017-10-19 14:06:03',53,16,'шмекс'),
	(20,'2017-10-31 16:20:52',68,11,'zxcasd'),
	(22,'2017-12-01 20:45:48',79,22,'Коммент'),
	(23,'2017-12-01 21:59:26',80,27,'Cool gif'),
	(24,'2017-12-06 10:03:13',85,26,'Ffffffff gggggggggFfffffff gggggggggFfffffff gggggggggFfffffff gggggggggFfffffff gggggggggFfffffff Ffffffff ggggggggg Ffffffff ggggggggg'),
	(25,'2017-12-09 20:56:12',89,7,'хех)'),
	(26,'2017-12-24 02:15:44',90,7,'Жестко\r\n'),
	(27,'2017-12-24 02:16:11',90,8,')))\r\n'),
	(28,'2017-12-24 02:17:21',90,12,'С такой скоростью бы код писать)'),
	(29,'2018-01-11 18:07:52',93,15,'ччч'),
	(30,'2018-01-15 17:57:02',97,4,'по кайфу'),
	(31,'2018-02-09 12:29:47',98,16,'eeeeeeeee'),
	(32,'2018-02-09 12:30:35',98,20,'eeeeeeee'),
	(33,'2018-02-10 11:13:50',99,9,'g\r\n'),
	(34,'2018-03-13 15:28:36',111,31,'ddd'),
	(35,'2018-03-18 03:09:49',112,16,'Рыжая красотка');

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы gifs
# ------------------------------------------------------------

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

LOCK TABLES `gifs` WRITE;
/*!40000 ALTER TABLE `gifs` DISABLE KEYS */;

INSERT INTO `gifs` (`id`, `category_id`, `user_id`, `dt_add`, `show_count`, `like_count`, `fav_count`, `title`, `description`, `path`)
VALUES
	(2,5,1,'2017-03-29 16:00:58',1505,2,0,'Конец рабочего дня','Когда хорошо поработал','gif58dbda3a4313d.gif'),
	(3,2,1,'2017-03-29 16:15:43',1649,3,3,'Учим новичка решать задачи','Тяжело в учении, легко в бою','gif58dbddaf5ce7e.gif'),
	(4,8,1,'2017-03-29 16:19:13',2010,4,4,'Когда любишь порядок','Все вещи должны быть на своем месте','gif58dbde81b4a8b.gif'),
	(5,8,1,'2017-03-29 16:22:10',1529,2,1,'Премии на моей бывшей работе','Горькая правда','gif58dbdf3251fcf.gif'),
	(6,8,1,'2017-03-29 16:24:32',739,2,1,'Отличные витаминки','Бодрят не по детски','gif58dbdfc01c1a4.gif'),
	(7,7,1,'2017-03-29 16:25:53',855,0,0,'Командная работа','Когда попросил коллег помочь исправить баг','gif58dbe01159218.gif'),
	(8,7,1,'2017-03-29 16:28:19',689,1,0,'Рыбак','Новая техника рыбалки','gif58dbe0a3bef37.gif'),
	(9,1,1,'2017-03-29 16:32:56',712,2,1,'Восторг','Когда видишь своего кумира','gif58dbe1b8426e5.gif'),
	(10,2,1,'2017-03-29 16:35:28',936,0,1,'Доминирование','Когда показываешь новичку как ты используешь любимый фреймворк','gif58dbe2501a265.gif'),
	(11,4,1,'2017-03-29 16:37:21',2950,10,7,'Unstoppable','Мастер дигла 80 лвл','gif58dbe2c14330a.gif'),
	(12,2,1,'2017-03-29 16:38:21',2263,4,3,'Типичный юзер','В интернете никто не знает что ты - кот','gif58dbe2fd97ceb.gif'),
	(13,4,1,'2017-03-29 16:40:18',1171,2,1,'Battlefield 1','Когда лучше подождать','gif58dbe37205fd3.gif'),
	(14,6,1,'2017-03-29 16:41:54',2015,4,2,'Science, bitch','У этого учителя не хочется прогуливать уроки химии','gif58dbe3d2edd03.gif'),
	(15,1,1,'2017-03-29 16:43:01',1464,2,2,'Енотик','Енотик бежит записываться на курсы htmlacademy','gif58dbe4151ca72.gif'),
	(16,8,1,'2017-03-29 16:44:00',4875,20,12,'Рыжая','У рыжих нет души','gif58dbe4506f446.gif'),
	(17,3,1,'2017-03-29 16:46:18',714,1,0,'Жестокий спорт','Это футбол, здесь можно и по лицу получить','gif58dbe4da0dcb8.gif'),
	(20,5,17,'2017-04-19 18:52:40',691,2,0,'Колесо опаздывает на встречу','Когда нажал тревожную кнопку под столом, а магазин под охраной автоботов.','gif58f7b1f852ae7.gif'),
	(21,2,18,'2017-04-19 20:28:02',651,2,1,'Твоя девушка, когда слышит комплимент','Чихуа','gif58f7c85275d79.gif'),
	(22,2,18,'2017-04-19 20:32:15',895,1,2,'Кот-ненависть','котяра','gif58f7c94fe1902.gif'),
	(24,6,3,'2017-07-04 16:44:13',692,4,2,'Треуголик','Красиво вертится','gif595bc5ddadf65.gif'),
	(25,8,35,'2017-10-13 12:19:37',215,0,0,'Во все тяжкие','Короткое описание','gif59e0af59ef743.'),
	(26,2,63,'2017-10-17 18:44:10',284,2,0,'fff','ccc','gif59e64f7a49911.gif'),
	(27,2,80,'2017-12-01 21:58:26',219,1,1,'Nemo','Movie','gif5a21a652cf033.gif'),
	(28,2,88,'2017-12-09 12:18:14',73,0,0,'T','B','gif5a2baa56dcbe5.'),
	(29,1,94,'2018-01-14 01:47:32',225,1,0,'Em','Eminem - Without me','gif5a5a8c84a41ed.gif'),
	(30,2,105,'2018-03-07 22:15:14',52,0,1,'Животное','Животное','gif5aa03a4203cfb.'),
	(31,6,111,'2018-03-13 15:28:00',42,1,0,'ddd','ddd','gif5aa7c3d050e73.');

/*!40000 ALTER TABLE `gifs` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы gifs_fav
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gifs_fav`;

CREATE TABLE `gifs_fav` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `gif_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_2` (`user_id`,`gif_id`),
  KEY `user_id` (`user_id`),
  KEY `gif_id` (`gif_id`),
  CONSTRAINT `gifs_fav_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `gifs_fav_ibfk_2` FOREIGN KEY (`gif_id`) REFERENCES `gifs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `gifs_fav` WRITE;
/*!40000 ALTER TABLE `gifs_fav` DISABLE KEYS */;

INSERT INTO `gifs_fav` (`id`, `user_id`, `gif_id`)
VALUES
	(1,1,3),
	(2,1,12),
	(19,3,4),
	(3,3,11),
	(20,3,24),
	(4,6,15),
	(6,12,14),
	(7,13,11),
	(8,13,14),
	(16,13,16),
	(46,17,9),
	(9,17,11),
	(10,17,15),
	(26,17,22),
	(13,27,6),
	(14,28,16),
	(29,35,4),
	(28,35,16),
	(21,43,3),
	(22,52,16),
	(30,53,12),
	(44,53,16),
	(23,55,16),
	(25,55,24),
	(42,68,11),
	(43,68,16),
	(45,75,10),
	(47,78,5),
	(48,79,22),
	(49,80,27),
	(50,85,21),
	(52,95,4),
	(51,95,16),
	(55,97,16),
	(57,98,3),
	(56,98,16),
	(59,102,4),
	(58,102,12),
	(60,104,16),
	(61,105,30),
	(62,111,11),
	(63,116,16),
	(64,131,13);

/*!40000 ALTER TABLE `gifs_fav` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы gifs_like
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gifs_like`;

CREATE TABLE `gifs_like` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `gif_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_2` (`user_id`,`gif_id`),
  KEY `user_id` (`user_id`),
  KEY `gif_id` (`gif_id`),
  CONSTRAINT `gifs_like_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `gifs_like_ibfk_2` FOREIGN KEY (`gif_id`) REFERENCES `gifs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `gifs_like` WRITE;
/*!40000 ALTER TABLE `gifs_like` DISABLE KEYS */;

INSERT INTO `gifs_like` (`id`, `user_id`, `gif_id`)
VALUES
	(1,1,2),
	(100,2,16),
	(24,3,5),
	(26,3,16),
	(28,3,24),
	(2,6,11),
	(7,12,14),
	(4,12,16),
	(12,13,3),
	(9,13,11),
	(10,13,12),
	(13,13,14),
	(11,13,17),
	(15,14,11),
	(102,17,11),
	(99,17,15),
	(101,17,16),
	(16,17,20),
	(31,17,24),
	(17,18,21),
	(20,27,6),
	(21,29,14),
	(44,35,4),
	(45,35,6),
	(39,35,16),
	(27,39,16),
	(29,43,11),
	(30,46,16),
	(32,52,16),
	(38,53,4),
	(47,53,12),
	(59,53,16),
	(49,55,2),
	(34,55,9),
	(71,55,13),
	(35,55,15),
	(37,55,24),
	(36,56,16),
	(43,61,3),
	(40,61,11),
	(41,61,14),
	(42,61,24),
	(46,63,26),
	(56,68,11),
	(57,68,16),
	(60,75,26),
	(64,79,22),
	(65,80,27),
	(66,85,21),
	(68,90,5),
	(69,90,8),
	(70,90,12),
	(67,90,16),
	(72,94,29),
	(76,95,4),
	(74,95,16),
	(79,96,11),
	(80,97,16),
	(83,98,3),
	(82,98,16),
	(84,99,9),
	(86,102,4),
	(85,102,12),
	(87,104,16),
	(91,111,11),
	(92,111,31),
	(93,112,16),
	(94,112,20),
	(97,114,11),
	(98,116,16),
	(103,119,16),
	(104,131,13);

/*!40000 ALTER TABLE `gifs_like` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dt_add` datetime DEFAULT NULL,
  `email` char(255) NOT NULL,
  `name` char(255) NOT NULL,
  `password` char(64) DEFAULT '',
  `avatar_path` char(255) DEFAULT NULL,
  `token` char(32) DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `dt_add`, `email`, `name`, `password`, `avatar_path`, `token`)
VALUES
	(1,'2017-03-29 15:56:39','sks89@mail.ru','frexin','$2y$10$ZjU6ojx3fZmM84Ztzpoj../40Eu72X/ZGbt/ofN/5Eujriw1M6vwO','avatar58dbd9371dab6.png','9e5914a3afc60dc557b15b6dd10cc45b'),
	(4,'2017-04-04 08:26:24','test@test.ru','test','$2y$10$gjRYY91gqH5VZFXBMREA0ukRaccXfXkA6RR0EIxMrAlxtkp5VF11a','avatar58e358b065650.gif','af27fc67f09d386f0688d647cdc256c6'),
	(15,'2017-04-18 14:29:11','cvb@fgdfh.ru','bgfbfg','$2y$10$Vi5827uWnndBHCPbEU4bVuxW8ixpTAzXWZxltoFhOGhrUDoirdp9i','avatar58f622b7d1785.','551f37e2ebdbaacff683a90633280172'),
	(16,'2017-04-18 14:29:42','q@q.ru','q','$2y$10$88KDkWLYM2bry70zgptCB.QOM8c/PelGp/oLNNnBp.aUfBc8px9hq','avatar58f622d62ffdd.','3f27625412c181d2e351ee251cfe25ec'),
	(17,'2017-04-19 18:48:57','frexin@ya.ru','Чукча','$2y$10$.A1gIckEHJ9D4DmGb/hjNOh20vVsAM71vZUMU99ZHAQTJgRVX5Hy6','avatar58f7b1195e5e3.','f6267823d44cfeabcb0adf6815706b9b'),
	(20,'2017-04-25 14:25:07','mail@mail.ru','user','$2y$10$/xVmTJ5zrnUISiY1bNFEOOC1R6YZV05fRpT0kMLhJJ6vTlbDaa5JO','avatar58ff5c43014a5.','ef50fbc064a7fcf056cc9153c75ec17c'),
	(23,'2017-05-09 11:46:42','awdsdgs@wdf.wre','awfda','$2y$10$BNRyyLZSq09ka/mXvRq1K.T3aTpGv2VaWdmSZo/b4GmL762S6Vobe','avatar5911ac223847c.','6f637130453ae1a3f0ae1634e9d8ed3e'),
	(26,'2017-05-14 17:05:03','r8974jjil@gmail.com','Sailipmal','$2y$10$Z.7/M.yZDlzl0LrapQ1TV.iPE1IMOG.WuYpNVdF7w6HqkjK.VYOxe',NULL,'d0de32603c3d26738af0c04c2320671c'),
	(27,'2017-05-15 16:23:16','test@mail.ru','test@mail.ru','$2y$10$QglusMQsMdAcMaycJwcC/OqxzWqAql.M6AF27gvSjA45qtdvna10y','avatar5919d5f4cb1d1.','39d46f0bf454a9eab30d6e545750962b'),
	(31,'2017-05-29 09:30:48','nfbvyqybtoad@dropmail.me','NothingMan','$2y$10$S3W8z9MaEH2K30ycqsET.eGFUHbfCJ3DR.2VcVljWvWz0kqDB89HO','avatar592bea487a8b4.','5e1002f366185ad67beca9bb293d7d32'),
	(34,'2017-06-16 09:23:04','a@a.ru','alex','$2y$10$dX1z/OKr00cyGTC2XhsXa.P3zuAuyeP0Jb09I5yEU6MVVDBuaCc9m','avatar5943a3781c23b.PNG','d5afa0e3a457689ca13346aa1d0b3df2'),
	(36,'2017-06-26 17:14:35','xcv@gfd.re','xcv','$2y$10$RNRo16YOSHwnTbXa1bvFB.NjCTbiZCUmPUAAKJ7inoMO9x00TUswu','avatar595140fb5ae78.','d4811481209fddb53711b1a4a8c2bfec'),
	(43,'2017-08-05 22:19:17','tima@mail.ru','tima','$2y$10$3PSQBx2QoHHyNL6nLuoshOyUjwkrqN7FQ7QSU1GZ/9gUXW6AQjYwC','avatar598644654c221.','8b921dc05f8e5d367a0fe0ae92321194'),
	(49,'2017-08-31 11:26:43','dff33fff@mailinator.com','qweqwe','$2y$10$g7Bgii1FcDR7u.No2RdyremXcA5L5vgEPjMrWbh25N2PeQoOs3Byq','avatar59a7f27344134.','e10f62af3592a44284d5bb89e89a635b'),
	(58,'2017-09-26 06:32:44','1@bk.ru','1','$2y$10$K/CwslKSDidDy4z2QDcFJOeRvN/gpuXcd.u9/306g8SbFaOIYfOH2','avatar59c9f48cb3810.','e28c453ec4a61b524987203f1c577382'),
	(62,'2017-10-15 14:51:08','2@mail.ru','п','$2y$10$KHCFv1L7ZJ/DCd1SxlH9kuWC5URbOFnP7NxKYEw1APRXgVxUYdffO','avatar59e375dc83ada.','91aa1cdfe64929cba111f92d5f8edce9'),
	(63,'2017-10-17 18:41:03','ggg@ggg.gg','kkk','$2y$10$WSfKzdy0KBaFb3StiMWF3..MjCSrStniX1MW7WYQRRul1VRpF06gK','avatar59e64ebf7a061.','0cb248c11ddd5f833a02536f1c636079'),
	(69,'2017-10-31 21:24:07','ddd@mail.ru','dertnh','$2y$10$Jvgq0podpxnWx4dBuw8Ec.5ghEmeI9GULJhmFjZ8LbmysRBvoDMP.','avatar59f8e9f760c93.','809f009c98b7b1dbe818e07f120e5947'),
	(73,'2017-11-12 22:58:28','123@gmail.com','123','$2y$10$sbPsq.Dhn3z4oiSatrwyneMWEAAvWBRb6rszMPUe4TW/CgJG6t.Cu','avatar5a08a7e4006f0.','c1a0ee10fbb8dd8b7e4620d6d2049784'),
	(74,'2017-11-18 09:11:52','adsad@asd.ry','23ada3w','$2y$10$dj7.228xB4DJ7BFmfnbICujr5EVOVC.TWaVNrUCFodteRnxezDhdS','avatar5a0fcf28ba89a.','ceb4af73eff8edbc2239c677f8340fed'),
	(76,'2017-11-22 18:04:39','dfkjhkjs@mail.ru','Kisa','$2y$10$.DNF2q9VGEgsmvqVmywXBe7Zkk7JeGg3Hi.7mabchJco.Rlea3M4.','avatar5a1592073bc8b.','ae16400abf75c1297e43803d7266e7d2'),
	(82,'2017-12-03 11:31:37','dsg@fh.fh','dfjfdj','$2y$10$iIhz6C9tYQ0X16FGWHKWOem2LjUqSc/OH3CX7vONmMM9dcdFk/3Bi','avatar5a23b66909ba7.','ba4400795bbf00d940819c2e7795d711'),
	(83,'2017-12-03 17:51:09','fgdfg@mail.ru','sdfsdf','$2y$10$iU747e9HOYjkKakBsULUr.hOvPSP1NOW45JgjVQ9rA5GTA2Ch/CzS','avatar5a240f5d7f068.','c707fa135dbfb5a0aa2105bd8a8d6d64'),
	(84,'2017-12-03 21:59:18','dadaw@yandex.ru','loooooool','$2y$10$i4k5C.Qt7wyldFuS1awpjuy6i0dm64io/yILUhOOekbAWZPPBufYe','avatar5a2449867a31b.','525fe1b07f337461a61f3c6ac957e1bc'),
	(93,'2018-01-11 18:07:15','jobe@p33.org','12йцфыяч','$2y$10$Z3B7.P1Q.Lnk0Se5R0KL/ewBc2talssHoaboy6MagyYCjHA/uwNl6','avatar5a577da3823f7.','a7b6788fd361f9efb616cb0c404d6090'),
	(104,'2018-03-04 22:12:26','test@test.com','test_account','$2y$10$OIGdB3ypqKNB95TJ590uZONOKSIJjUaQJgGbIXY3JSzfmUlUsn/U2','avatar5a9c451aaf6ac.','1ac612dd9fd8db10d6cbb3e424c779d9'),
	(107,'2018-03-12 03:24:08','sdfgfddf@mail.ru','12345','$2y$10$7ZT5Tty9qNFI3tk4DRaZYubi.Lo6FTWQbh5nYdFLENm67gomr/MbW','avatar5aa5c8a8a891c.','eb30b0b01ffc67015e8ba96661e54b2e'),
	(108,'2018-03-12 03:25:54','12345@mail.eu','12345','$2y$10$S194PoPoetXAImUmTtP2..7N2s95GrI36JUw3NU3CtBGjyhOsX3wm','avatar5aa5c912b3861.','f113729e349adb8d6d91b753c3613c95'),
	(131,'2018-04-30 18:29:25','12345@mail.com','12345','$2y$10$U1HOfd9RnYLbJDiORk3Y5uRAnQ1OzFAstDK/aBGIcn9WdfhcS9XHa','avatar5ae73654f2fd6.','5171c1d12476087b8a41659526309da0');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
