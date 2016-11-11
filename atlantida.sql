/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;

CREATE TABLE `mi_buildings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  `label` varchar(32) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

INSERT INTO `mi_buildings` VALUES (1,'ферма','farm');
INSERT INTO `mi_buildings` VALUES (2,'ранчо','ranch');
INSERT INTO `mi_buildings` VALUES (3,'мельница','mill');
INSERT INTO `mi_buildings` VALUES (4,'пекарня','bakery');
INSERT INTO `mi_buildings` VALUES (5,'карьер','mine');
INSERT INTO `mi_buildings` VALUES (6,'лесопилка','woodmanhouse');
INSERT INTO `mi_buildings` VALUES (7,'кузница','forge');
INSERT INTO `mi_buildings` VALUES (8,'кирпичи','brickshouse');
INSERT INTO `mi_buildings` VALUES (9,'каменщик','stoneshouse');
INSERT INTO `mi_buildings` VALUES (10,'дом строителя','builderhouse');
INSERT INTO `mi_buildings` VALUES (11,'домик1','h1');
INSERT INTO `mi_buildings` VALUES (12,'домик2','h2');
INSERT INTO `mi_buildings` VALUES (13,'домик3','h3');
INSERT INTO `mi_buildings` VALUES (14,'домик4','h4');
INSERT INTO `mi_buildings` VALUES (15,'таверна','tavern');
INSERT INTO `mi_buildings` VALUES (16,'домик алхимика','alchemisthouse');
INSERT INTO `mi_buildings` VALUES (17,'колодец','well');
INSERT INTO `mi_buildings` VALUES (18,'волш.дерево','magic_tree');
INSERT INTO `mi_buildings` VALUES (19,'дерево','tree');
INSERT INTO `mi_buildings` VALUES (20,'яблонька','apple_tree');
CREATE TABLE `mi_buildings_levels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bid` int(11) unsigned NOT NULL DEFAULT '0',
  `level` int(11) unsigned NOT NULL DEFAULT '0',
  `res_id` int(11) unsigned NOT NULL DEFAULT '0',
  `res_quantity` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `mi_buildings_levels` VALUES (1,1,1,6,50);
INSERT INTO `mi_buildings_levels` VALUES (2,1,1,2,75);
INSERT INTO `mi_buildings_levels` VALUES (3,1,1,7,40);
INSERT INTO `mi_buildings_levels` VALUES (4,11,1,6,25);
INSERT INTO `mi_buildings_levels` VALUES (5,11,1,2,50);
INSERT INTO `mi_buildings_levels` VALUES (6,5,1,12,50);
INSERT INTO `mi_buildings_levels` VALUES (7,5,1,7,50);
INSERT INTO `mi_buildings_levels` VALUES (8,5,1,3,50);
CREATE TABLE `mi_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `mi_players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `money` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `mi_players` VALUES (1,0);
CREATE TABLE `mi_prod_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) unsigned NOT NULL DEFAULT '0',
  `ingredient_id` int(11) unsigned NOT NULL DEFAULT '0',
  `base_quantity` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

INSERT INTO `mi_prod_content` VALUES (1,13,28,3,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (2,14,28,6,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (3,15,28,3,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (4,16,8,2,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (5,16,28,3,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (6,17,10,1,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (7,17,9,5,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (8,18,10,2,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (9,18,9,6,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (10,19,10,3,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (11,19,9,7,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (12,20,6,15,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (13,20,9,3,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (14,21,6,10,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (15,21,9,4,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (16,22,6,20,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (17,22,9,5,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (18,24,7,10,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (19,12,28,5,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (20,25,7,5,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (21,23,6,15,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (22,23,9,5,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (23,23,49,2,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (24,30,11,10,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (25,30,9,5,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (26,49,30,5,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (27,49,27,10,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (28,49,26,5,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (29,1,26,3,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (30,2,26,2,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (31,3,26,10,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (32,4,26,5,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (33,5,26,15,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (34,29,26,10,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (35,32,1,5,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (36,33,4,10,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (37,34,4,15,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (38,35,32,5,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (39,35,5,5,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (40,36,33,5,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (41,37,34,5,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (42,38,46,5,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (43,38,37,10,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (44,38,36,3,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (45,6,27,5,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (46,7,27,5,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (47,8,27,10,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (48,9,27,10,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (49,10,27,15,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (50,11,27,5,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (51,39,1,15,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (52,40,2,15,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (53,41,4,10,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (54,42,5,10,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (55,43,39,1,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (56,44,39,2,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (57,44,40,1,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (58,45,41,1,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (59,46,41,2,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (60,46,32,20,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (61,46,40,1,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (62,47,42,2,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (63,47,50,10,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (64,47,40,1,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (65,48,41,1,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (66,48,33,5,'2016-11-11 14:13:54');
INSERT INTO `mi_prod_content` VALUES (67,48,29,5,'2016-11-11 14:13:54');
CREATE TABLE `mi_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `minutes` int(11) unsigned NOT NULL DEFAULT '0',
  `price_one` int(11) unsigned NOT NULL DEFAULT '0',
  `base_amount` int(11) unsigned NOT NULL DEFAULT '0',
  `building_id` int(11) unsigned NOT NULL DEFAULT '0',
  `is_construction` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_food` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `base_level` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `cost` int(10) unsigned NOT NULL DEFAULT '0',
  `price` int(10) unsigned NOT NULL DEFAULT '0',
  `modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

INSERT INTO `mi_products` VALUES (1,'кукуруза',1,5,5,1,0,1,1,0,5,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (2,'тросник',1,2,5,1,1,0,2,0,3,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (3,'бамбук',30,4,10,1,1,0,3,0,4,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (4,'пшеница',10,6,5,1,0,0,7,0,6,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (5,'рис',120,10,5,1,0,0,8,0,10,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (6,'глина',2,7,5,5,1,0,1,0,7,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (7,'камень',5,8,5,5,1,0,4,0,8,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (8,'медь',15,13,5,5,1,0,6,0,13,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (9,'уголь',10,7,10,5,0,0,7,0,7,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (10,'железо',30,20,5,5,1,0,9,0,20,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (11,'песок',5,4,10,5,0,0,12,0,4,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (12,'обр. бревна',3,18,3,6,1,0,1,0,18,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (13,'доски',10,4,10,6,1,0,4,0,4,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (14,'крепкие доски',30,15,5,6,1,0,6,0,15,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (15,'деревянная черепица',60,5,10,6,1,0,12,0,5,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (16,'бронзовые гвозди',1,13,5,7,1,0,1,0,13,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (17,'гвозди',3,12,5,7,1,0,4,0,12,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (18,'большие гвозди',5,29,3,7,1,0,9,0,29,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (19,'маленькие гвозди',60,12,10,7,1,0,13,0,12,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (20,'кирпич',20,27,5,8,1,0,1,0,27,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (21,'черепица',30,11,10,8,1,0,4,0,11,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (22,'большой кирпич',60,60,3,8,1,0,6,0,60,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (23,'прочный кирпич',120,40,5,8,1,0,10,0,40,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (24,'каменный блок',30,30,3,9,1,0,1,0,16,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (25,'брусчатка',120,7,10,9,1,0,4,0,7,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (26,'_вода_',1,2,4,17,0,0,0,0,1,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (27,'_свхрн_',1,6,4,18,0,0,0,5,5,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (28,'_бревна_',1,10,4,19,0,0,0,10,10,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (29,'клубника',60,20,10,1,0,0,10,0,20,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (30,'стекло',180,16,5,8,1,0,8,0,16,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (32,'яйца',7,5,10,2,0,0,8,0,5,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (33,'молоко',30,18,5,2,0,0,10,0,18,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (34,'мясо',120,25,5,2,0,0,12,0,25,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (35,'рис с яйцом',20,60,5,15,0,1,9,0,60,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (36,'сыр',240,80,5,15,0,1,10,0,80,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (37,'колбаски',360,50,10,15,0,1,12,0,50,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (38,'чизбургер',15,320,5,15,0,1,14,0,320,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (39,'мешок кукурузной муки',2,85,1,3,0,0,1,0,85,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (40,'мешок сахара',5,150,1,3,0,0,4,0,150,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (41,'мешок пшеничной муки',30,100,1,3,0,0,7,0,100,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (42,'мешок рисовой муки',60,200,1,3,0,0,9,0,200,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (43,'кукурузные лепешки',15,45,4,4,0,1,1,0,45,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (44,'кукурузные печеньки',45,60,10,4,0,1,3,0,60,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (45,'хлеб',30,90,5,4,0,1,6,0,90,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (46,'булочки',45,120,10,4,0,1,8,0,120,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (47,'пирог',60,430,3,4,0,1,9,0,430,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (48,'пироженка',120,200,5,4,0,1,10,0,200,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (49,'эликсир прочности',240,15,10,16,0,0,1,0,15,'2016-11-11 14:13:16');
INSERT INTO `mi_products` VALUES (50,'_яблоки_',1,22,5,20,0,0,0,0,22,'2016-11-11 14:13:16');

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
