/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 8.0.29 : Database - sipa
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `asset_categories` */

DROP TABLE IF EXISTS `asset_categories`;

CREATE TABLE `asset_categories` (
  `category_id` int NOT NULL AUTO_INCREMENT COMMENT 'ID Kategori',
  `category_kode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Kode Kategori',
  `category` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Kategori',
  `category_description` text COLLATE utf8mb4_general_ci,
  `dep_calc_interval` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Periode Penentuan nilai penyusutan',
  `active` int DEFAULT '1',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `asset_categories` */

insert  into `asset_categories`(`category_id`,`category_kode`,`category`,`category_description`,`dep_calc_interval`,`active`) values 
(2,'B','Bangunan','Bangunan','10',1);

/*Table structure for table `asset_files` */

DROP TABLE IF EXISTS `asset_files`;

CREATE TABLE `asset_files` (
  `file_id` int NOT NULL AUTO_INCREMENT,
  `asset_id` int DEFAULT NULL,
  `form_kode` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_name` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_size` float DEFAULT NULL,
  `file_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_ext` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`file_id`),
  KEY `asset_id` (`asset_id`),
  CONSTRAINT `asset_files_ibfk_1` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`asset_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `asset_files` */

/*Table structure for table `assets` */

DROP TABLE IF EXISTS `assets`;

CREATE TABLE `assets` (
  `asset_id` int NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `category_id` int DEFAULT NULL,
  `asset_kode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Kode Barang',
  `asset_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Nama Barang',
  `asset_nup` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'NUP',
  `asset_description` text COLLATE utf8mb4_general_ci,
  `asset_condition` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Kondisi',
  `asset_merk` varchar(400) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Merk / Type',
  `asset_ac_date` date DEFAULT NULL COMMENT 'Tgl Perolehan',
  `asset_ac_value` int DEFAULT NULL COMMENT 'Nilai Perolehan',
  `asset_dep_value` int DEFAULT NULL COMMENT 'Nilai Penyusutan',
  `asset_book_value` int DEFAULT NULL COMMENT 'Nilai Buku',
  `asset_qty` int DEFAULT NULL COMMENT 'Kuantitas',
  `asset_lifespan` int DEFAULT NULL COMMENT 'Masa Manfaat (Bulan)',
  `asset_featured` int DEFAULT NULL,
  `user_created` varchar(32) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `time_created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`asset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `assets` */

/*Table structure for table `disposal` */

DROP TABLE IF EXISTS `disposal`;

CREATE TABLE `disposal` (
  `disp_id` int NOT NULL AUTO_INCREMENT,
  `asset_id` int DEFAULT NULL,
  `disp_title` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `disp_date` datetime DEFAULT NULL,
  `disp_last_status` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_created` varchar(32) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `time_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_updated` varchar(32) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `time_updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`disp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `disposal` */

/*Table structure for table `disposal_timeline` */

DROP TABLE IF EXISTS `disposal_timeline`;

CREATE TABLE `disposal_timeline` (
  `tm_id` int NOT NULL AUTO_INCREMENT,
  `disp_id` int DEFAULT NULL,
  `disp_activity` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `approved` int DEFAULT NULL,
  `data` json DEFAULT NULL,
  `user_created` varchar(32) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `time_created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `disposal_timeline` */

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

/*Data for the table `groups` */

insert  into `groups`(`id`,`name`,`description`) values 
(1,'admin','Administrator'),
(2,'members','General User');

/*Table structure for table `groups_menus` */

DROP TABLE IF EXISTS `groups_menus`;

CREATE TABLE `groups_menus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `group_id` int NOT NULL,
  `menu_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `groups_menus` */

/*Table structure for table `login_attempts` */

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

/*Data for the table `login_attempts` */

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu_id` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `folder_id` int DEFAULT NULL,
  `url` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `router` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` int NOT NULL DEFAULT '1',
  `isfolder` int DEFAULT '0',
  `onmenu` int DEFAULT '1',
  `onview` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `onpublic` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `menus` */

insert  into `menus`(`id`,`menu_id`,`folder_id`,`url`,`router`,`name`,`description`,`icon`,`active`,`isfolder`,`onmenu`,`onview`,`onpublic`) values 
(1,'dashboard',0,'/','dashboard/index','Beranda','Beranda','sliders',1,0,1,NULL,0),
(2,'folder-administrator',0,'admin','administrator','Administrator','Administrator','users',1,1,1,NULL,0),
(3,'daftar-user',2,'auth','auth/index','Kelola Pengguna','Kelola Pengguna',NULL,1,0,1,NULL,0),
(5,'folder-produk',0,'asetmanagement','asetManagement','Aset','Aset','grid',1,1,1,NULL,0),
(6,'kategori',5,'asetManagement/category','asetManagement/category','Kategori','Kategori',NULL,1,0,1,NULL,0),
(8,'produk',5,'asetManagement','asetManagement/index','Data Aset','Data Aset',NULL,1,0,1,NULL,0),
(12,'folder-penghapusan',0,'penghapusan','penghapusan','Penghapusan',NULL,'file',1,1,1,NULL,0),
(13,'penghapusan-proses',12,'penghapusan/index','penghapusan/index','Proses Penghapusan',NULL,NULL,1,0,1,NULL,0),
(14,'penghapusan-approval',12,'penghapusan/approval','penghapusan/approval','Ceklis Proses Penghapusan',NULL,NULL,1,0,1,NULL,0),
(15,'pengaturan',0,'settings','settings','Pengaturan',NULL,'settings',1,0,1,NULL,0);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int unsigned NOT NULL,
  `last_login` int unsigned DEFAULT NULL,
  `active` tinyint unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_email` (`email`),
  UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  UNIQUE KEY `uc_remember_selector` (`remember_selector`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

/*Data for the table `users` */

insert  into `users`(`id`,`ip_address`,`username`,`password`,`email`,`activation_selector`,`activation_code`,`forgotten_password_selector`,`forgotten_password_code`,`forgotten_password_time`,`remember_selector`,`remember_code`,`created_on`,`last_login`,`active`,`first_name`,`last_name`,`company`,`phone`) values 
(1,'127.0.0.1','administrator','$2y$10$rr7ap0rtarVLbAeQYvXbaOfqaFxzB3oYDyAXX.k4Pxsm5FajWTyMu','admin@admin.com',NULL,'',NULL,NULL,NULL,NULL,NULL,1268889823,1687023004,1,'Admin','istrator','ADMIN','0');

/*Table structure for table `users_groups` */

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `group_id` mediumint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

/*Data for the table `users_groups` */

insert  into `users_groups`(`id`,`user_id`,`group_id`) values 
(1,1,1),
(2,1,2),
(7,2,1),
(8,2,2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
