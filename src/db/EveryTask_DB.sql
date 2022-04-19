DROP DATABASE IF EXISTS `every_task_db`;
CREATE DATABASE IF NOT EXISTS `every_task_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `every_task_db`;


CREATE TABLE IF NOT EXISTS `account` (
  `pk_account_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`pk_account_id`)
);


-- create a table which stores tasks
CREATE TABLE IF NOT EXISTS `task` (
  `pk_task_id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fk_pk_account_id` int NOT NULL FOREIGN KEY REFERENCES `account`(`account_id`),
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `done` boolean NOT NULL,
  `due_time` datetime NOT NULL,
  `create_time` datetime NOT NULL,
  `note` text NOT NULL,
   CONSTRAINT FOREIGN KEY task_account (creator_id) REFERENCES Flugzeughersteller (pk_HerstellerID) ON DELETE NO ACTION
);


INSERT INTO `account` (`account_id`, `username`, `password`, `email`)
VALUES (
    1,
    'admin',
    '$2y$10$s18Qy/iZQpWhgldcm6JLbetKU9L6UCw5pM1uhYJBPbpqd/IeyrKXG',
    'admin@admin.com'
  );


SELECT *
FROM account
WHERE email = 'admin@admin.com'
  AND password = 'admin';