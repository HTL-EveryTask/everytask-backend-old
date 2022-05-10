DROP DATABASE IF EXISTS `every_task_db`;
CREATE DATABASE IF NOT EXISTS `every_task_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `every_task_db`;


CREATE TABLE IF NOT EXISTS `account` (
  `pk_account_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`pk_account_id`)
);


-- create a table which stores tasks
CREATE TABLE IF NOT EXISTS `task` (
  `pk_task_id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fk_pk_account_id` int NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `done` boolean NOT NULL,
  `due_time` datetime NOT NULL,
  `create_time` datetime NOT NULL,
  `note` text NOT NULL,
   CONSTRAINT FOREIGN KEY task_account (fk_pk_account_id) REFERENCES account (pk_account_id) ON DELETE NO ACTION
);


INSERT INTO `account` (username, password, email, token)
VALUES (
    'admin',
    '$2y$10$s18Qy/iZQpWhgldcm6JLbetKU9L6UCw5pM1uhYJBPbpqd/IeyrKXG',
    'admin@admin.com',
    'admin'
);


INSERT INTO task (fk_pk_account_id, title, description, done, due_time, create_time, note)
                VALUES (1, 'test task', 'description hehe', false, '2019-03-10 02:55:05', '2019-03-10 02:55:05', '');

SELECT pk_task_id FROM task WHERE fk_pk_account_id = 1 AND description = 'description hehe' AND due_time = '2019-03-10 02:55:05' AND create_time = '2018-03-10 02:55:05';


UPDATE task
SET fk_pk_account_id = 6, title = 'cool updated task', description = 'Bubugugi', done = false, due_time = '2019-03-10 02:55:05', create_time = '2018-03-10 02:55:05', note = ''
WHERE fk_pk_account_id = 1 AND description = 'description hehe' AND due_time = '2019-03-10 02:55:05' AND create_time = '2018-03-10 02:55:05';


SELECT * FROM Task;