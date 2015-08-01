<?php  

include('core/init.php');

if (empty($_POST) === false) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (empty($username) === true || empty($password) === true) {
		$errors[] = 'Username and/or password fields must not be left blank';
	} else if (user_exists($username) === false) {
		$errors[] = 'Username does not exist! Please register before logging in.';
	} else if (user_active($username) === false) {
		$errors[] = 'You haven\'t activated your account yet';
	} else {
		$login = login($username, $password);
		if ($login === false) {
			$errors[] = 'Username/password incorrect';
		} else {
			echo 'ok';
			//set user session
			//redirect user
		}
	}

	print_r($errors);
}

?>