<?php  

include('core/init.php');

if (user_exists('superuser') === true) {
	echo 'exists';
} else {echo 'does not exist';}
die();

if (empty($_POST) === false) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (empty($username) === true || empty($password) === true) {
		$errors[] = 'Username and/or password fields must not be left blank';
	} else if (user_exists($username) === false) {
		$errors[] = 'Username does not exist! Please register before logging in.';
	}
}

?>