<?php 
session_start();

require('db/db_connection.php');
require('functions/general.php');
require('functions/users.php');

if (logged_in() === true) {
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'user_id', 'username', 'password', 'first_name', 'last_name', 'email'); // campurile pe care le preluam din baza de date. Aceasta metoda este foarte flexibila deoarece daca adaugam 1 camp bazei de date tot ce trebuie sa facem e sa adaugam numele campului in acest sir
	if (user_active($user_data['username']) === false) {
		session_destroy();
		header('Location: index.php');
		exit(); // daca un utilizator este deactivat in timp ce este logat pe site, vom forta delogarea acestuia.
	}
}

$errors = array();
?>