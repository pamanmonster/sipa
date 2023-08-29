DROP TABLE IF EXISTS `product_promo`;

CREATE TABLE `product_promo` (
  `promo_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `promo_discount` double DEFAULT NULL,
  `promo_price` int DEFAULT NULL,
  `promo_start` date DEFAULT NULL,
  `promo_end` date DEFAULT NULL,
  `active` int DEFAULT NULL,
  `promo_desc` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`promo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;