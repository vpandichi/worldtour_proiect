<?php 
session_start();

require('db/db_connection.php');
require('functions/general.php');
require('functions/users.php');

$current_file = explode('/', $_SERVER['SCRIPT_NAME']); // contine path-ul paginii pe care ne aflam
$current_file = end($current_file); 				   // vrem sa extragem doar numele paginii pe care ne aflam fara path, ex: recover.php in loc de sites/worldtour/public/recover.php

if (logged_in() === true) {
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'user_id', 'username', 'password', 'first_name', 'last_name', 'email', 'active', 'pwd_recovery', 'type', 'allow_email', 'profile'); // campurile pe care le preluam din baza de date. Aceasta metoda este foarte flexibila deoarece daca adaugam 1 camp bazei de date tot ce trebuie sa facem e sa adaugam numele campului in acest sir
	if (user_active($user_data['username']) === false) {
		session_destroy();
		header('Location: index.php');
		exit(); // daca un utilizator este deactivat in timp ce este logat pe site, vom forta delogarea acestuia.
	}
	if ($current_file !== 'changepw.php' && $current_file !== 'logout.php' && $user_data['pwd_recovery'] == 1) {
		header('Location: changepw.php?force'); // dupa ce userul s-a logat cu parola primita in email, vrem sa-l fortam sa o schimbe
		exit();
	}
}

$errors = array();
?>