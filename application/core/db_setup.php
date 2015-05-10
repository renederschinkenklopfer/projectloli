<?php

	$database = Database::getFactory()->getConnection();

	$database->query('DROP DATABASE IF EXISTS webapp;');
	$database->query('CREATE DATABASE webapp;');

	$database->query('USE webapp;');

	$database->query('
	CREATE TABLE user
	(
		pk_user_id INT PRIMARY KEY AUTO_INCREMENT,
		username VARCHAR(15) NOT NULL,
		password BINARY(60) NOT NULL,
		mail VARCHAR(20) NOT NULL,
		last_login TIMESTAMP NOT NULL
	)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');

	$database->query('
	CREATE TABLE board
	(
		pk_board_id INT PRIMARY KEY AUTO_INCREMENT,
		board_name VARCHAR(30) NOT NULL
	)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');

	$database->query('
	CREATE TABLE thread
	(
		pk_thread_id INT PRIMARY KEY AUTO_INCREMENT,
		username VARCHAR(20),
		threadname VARCHAR(50) NOT NULL,
		message TEXT NOT NULL,
		image_name VARCHAR(25) NOT NULL,
		likes INT NOT NULL,
		date_created TIMESTAMP NOT NULL,
		fk_board_id INT NOT NULL,
		FOREIGN KEY (fk_board_id) REFERENCES board(pk_board_id)
	)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');


	$database->query('
	CREATE TABLE post
	(
		pk_post_id INT PRIMARY KEY AUTO_INCREMENT,
		username VARCHAR(20) NOT NULL,
		message TEXT NOT NULL,
		image_name VARCHAR(25) NOT NULL,
		date_created TIMESTAMP NOT NULL,
		fk_thread_id INT NOT NULL,
		FOREIGN KEY (fk_thread_id) REFERENCES thread(pk_thread_id)
	)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');

	$database->query("INSERT INTO `webapp`.`board` (`pk_board_id`, `board_name`) VALUES (NULL, 'Computer/Tech');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'Jo so lässig', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1337.jpg', '133', CURRENT_TIMESTAMP, '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'g654g', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1338.jpg', '133', CURRENT_TIMESTAMP, '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', '777777', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '133', CURRENT_TIMESTAMP, '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'j67j67j', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1338.jpg', '133', CURRENT_TIMESTAMP, '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '133', CURRENT_TIMESTAMP, '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '133', CURRENT_TIMESTAMP, '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '133', CURRENT_TIMESTAMP, '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '133', CURRENT_TIMESTAMP, '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '133', CURRENT_TIMESTAMP, '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '133', CURRENT_TIMESTAMP, '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '133', CURRENT_TIMESTAMP, '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '133', CURRENT_TIMESTAMP, '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '133', CURRENT_TIMESTAMP, '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '133', CURRENT_TIMESTAMP, '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '133', CURRENT_TIMESTAMP, '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '133', CURRENT_TIMESTAMP, '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '133', CURRENT_TIMESTAMP, '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '133', CURRENT_TIMESTAMP, '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '133', CURRENT_TIMESTAMP, '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '133', CURRENT_TIMESTAMP, '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `likes`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '133', CURRENT_TIMESTAMP, '1');");

?>
