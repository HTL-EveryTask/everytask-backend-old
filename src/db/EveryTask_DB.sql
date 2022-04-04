DROP DATABASE IF EXISTS `every_task_db`;
CREATE DATABASE IF NOT EXISTS `every_task_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `every_task_db`;

CREATE TABLE IF NOT EXISTS `account` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


INSERT INTO `account` (`account_id`, `username`, `password`, `email`)
VALUES (1, 'admin', 'admin', 'admin@admin.com');