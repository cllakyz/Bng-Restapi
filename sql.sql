CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;