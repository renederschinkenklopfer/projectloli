DROP DATABASE IF EXISTS webapp;
CREATE DATABASE webapp;
USE webapp;

CREATE TABLE user
(
	pk_user_id INT PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(15) NOT NULL,
	password BINARY(60) NOT NULL,
	mail VARCHAR(20) NOT NULL,
	last_login TIMESTAMP NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE thread
(
	pk_thread_id INT PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(20),
	threadname VARCHAR(50) NOT NULL,
	message TEXT NOT NULL,
	image_name VARCHAR(25) NOT NULL,
	likes INT NOT NULL,
	date_created TIMESTAMP NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE post
(
	pk_post_id INT PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(20) NOT NULL,
	message TEXT NOT NULL,
	image_name VARCHAR(25) NOT NULL,
	date_created TIMESTAMP NOT NULL,
	fk_thread_id INT NOT NULL,
	FOREIGN KEY (fk_thread_id) REFERENCES thread(pk_thread_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


