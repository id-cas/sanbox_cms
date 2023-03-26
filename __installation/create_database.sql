CREATE DATABASE `db_sandbox_cms` CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE USER 'usr_sandbox_cms'@'localhost' IDENTIFIED BY '!kl0dOg=FZ3-jx';
GRANT ALL ON `db_sandbox_cms`.* TO 'usr_sandbox_cms'@'localhost';
flush privileges;

