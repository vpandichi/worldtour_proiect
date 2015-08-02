<?php  

include('core/init.php');
logged_in_redirect();

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

		if (strlen($password) > 32) {
			$errors[] = 'Password too long';
		}

		$login = login($username, $password);
		if ($login === false) {
			$errors[] = 'Username/password incorrect';
		} else {
			$_SESSION['user_id'] = $login;
			header("Location: login.php");
			exit;
		}
	}
} else {
	$errors[] = 'No data received';
}

include('includes/header.php');

if (empty($errors) === false) {
?>
	<h2 class="wetried">We tried to log you in, but...</h2>
<?php  
	echo output_errors($errors);
}
	include('includes/footer.php');
?>
