<?php

/**
 * db_setup.php
 *
 * SQL-Befehle für die Datenbankstruktur, sowie Testdaten einfügen
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @copyright  2015 Yolo Inc.
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    1.0
 */


	$database = Database::getFactory()->getConnection();

	$database->query('DROP DATABASE IF EXISTS webapp;');
	$database->query('CREATE DATABASE webapp;');

	$database->query('USE webapp;');

	$database->query('
	CREATE TABLE user
	(
		pk_user_id INT PRIMARY KEY AUTO_INCREMENT,
		username VARCHAR(15) NOT NULL,
		password BINARY(60) NOT NULL
	)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');

	$database->query('
	CREATE TABLE thread
	(
		pk_thread_id INT PRIMARY KEY AUTO_INCREMENT,
		username VARCHAR(20) NOT NULL,
		threadname VARCHAR(50) NOT NULL,
		message TEXT NOT NULL,
		image_name VARCHAR(25) NOT NULL,
		sticky BOOL NOT NULL DEFAULT FALSE,
		date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		staff BOOL NOT NULL DEFAULT FALSE,
		fk_board_id INT NOT NULL
	)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');


	$database->query('
	CREATE TABLE post
	(
		pk_post_id INT PRIMARY KEY AUTO_INCREMENT,
		username VARCHAR(20) NOT NULL,
		message TEXT NOT NULL,
		image_name VARCHAR(25) NOT NULL,
		date_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		staff BOOL NOT NULL DEFAULT FALSE,
		fk_thread_id INT NOT NULL,
		FOREIGN KEY (fk_thread_id) REFERENCES thread(pk_thread_id) ON DELETE CASCADE
	)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');

	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'Jo so lässig', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1337.jpg', '2015-05-10 15:00:23', '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'g654g', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1338.jpg', '2015-05-10 15:00:23', '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', '777777', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '2015-05-10 15:00:23', '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'j67j67j', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1338.jpg', '2015-05-10 15:00:23', '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '2015-05-10 15:00:23', '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '2015-05-10 15:00:23', '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '2015-05-10 15:00:23', '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '2015-05-10 15:00:23', '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '2015-05-10 15:00:23', '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '2015-05-10 15:00:23', '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '2015-05-10 15:00:23', '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `sticky`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', true, '2015-05-10 15:00:23', '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '2015-05-10 15:00:23', '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '2015-05-10 15:00:23', '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '2015-05-10 15:00:23', '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '2015-05-10 15:00:23', '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '2015-05-10 15:00:23', '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '2015-05-10 15:00:23', '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '2015-05-10 15:00:23', '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '2015-05-10 15:00:23', '1');");
	$database->query("INSERT INTO `webapp`.`thread` (`pk_thread_id`, `username`, `threadname`, `message`, `image_name`, `date_created`, `fk_board_id`) VALUES (NULL, 'Anonymous', 'My new Setup', 'hoi zäme, also ich finds eifach würkli eh saueri was mit dem wc-rand passiert isch
	lg anon', '1339.jpg', '2015-05-10 15:00:23', '1');");
	$database->query("INSERT INTO `webapp`.`post` (`pk_post_id`, `username`, `message`, `image_name`, `date_created`, `fk_thread_id`) VALUES (NULL, 'Anon', 'aha alles kla', '1338.jpg', '2015-05-10 20:57:25', '1');");
	$database->query("INSERT INTO `webapp`.`post` (`pk_post_id`, `username`, `message`, `image_name`, `date_created`, `fk_thread_id`) VALUES (NULL, 'Anon', 'aha alles kla', '1338.jpg', '2015-05-10 20:57:25', '1');");
	$database->query('INSERT INTO `webapp`.`user` (`username`, `password`) VALUES (\'admin\', \'$2y$10$CGrj7l8Dxdj3TjTTG/5bt.6xs3twQ6OqmqnjAD28UavvhFZIsX.9u\');');


?>
