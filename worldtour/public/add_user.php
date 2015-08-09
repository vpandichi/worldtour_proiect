<?php 
include('core/init.php'); 
not_logged_in_redirect();
admin_protect();

if (empty($_POST) === false) {
	$required_fields = array('usernamne', 'password', 'password_again', 'first_name', 'active', 'email');
	foreach ($_POST as $key => $value) {
		if (empty($value) && in_array($key, $required_fields) === true) {	
			$errors[] = 'Fields marked with an asterisk are required';
			break 1; // breaks to foreach (if 1 error is found, we can't do anything else so there's no point for checking further)
		} 
	} // iterating through our post data - doing a check on each one

	if (empty($errors) === true) {
		if (user_exists($_POST['username']) === true) {
		$errors[] = 'Sorry, the username \'' . $_POST['username'] . '\' is already taken. Try ' . $_POST['username'] . rand(7, 77) . ' instead.';
		}
		if (preg_match("/\\s/", $_POST['username']) == true) { // regexp checking for any amount of spaces within the username 
			$errors[] = 'No spaces allowed.';
		}
		if (!ctype_alnum($_POST['username'])) {
			$errors[] = 'No special characters allowed';
		}
		if (strlen($_POST['password']) < 7) {
			$errors[] = 'Your password must be at least 7 characters long.';
		}
		if ($_POST['password'] !== $_POST['password_again']) {
			$errors[] = 'Your passwords do not match.';
		}
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = 'The email address entered is not valid.';
		}
		if (email_exists($_POST['email']) === true) {
			$errors[] = 'Sorry, the email \'' . $_POST['email'] . '\' is already in use.';
		}
		if (strlen($_POST['active']) > 1) {
			$errors[] = 'Active field can only take values of either 1 or 0';
		} else if ($_POST['active'] != 1 && $_POST['active'] != 0) {
			$errors[] = 'Active field can only take values of either 1 or 0';
		}
		if (empty($_POST['captcha_results']) === true) {
			$errors[] = 'Please enter captcha.';
		} else if ($_POST['captcha_results'] != $_POST['num1'] + $_POST['num2']) {
			$errors[] = "Incorrect captcha.";
		}
	}
}
// print_r($errors);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to worldtour! Your free touristic guide based on real experiences.</title>
	<link rel="stylesheet" href="/sites/worldtour/public/styles/login.css">
</head>
<?php 
	if(isset($_GET['success']) && empty($_GET['success'])) {
		echo '<body>
				<div id="body_wrap">
					<nav id="nav">
						<ul>
							<li><a href="recom.php">recommendations</a></li>
							<li><a href="blog.php">blog</a></li>
							<li><a href="includes/logout.php">log out</a></li>
							<li><a href="admin.php">admin page</a></li>
							<li><a href="/sites/worldtour/ro/public/login.php">ro</a></li>
						</ul>
						<div id="logo"><a href="index.php"><img src="/sites/worldtour/public/img/provisory-logo.gif"></a></div>
					</nav>';
		echo '<h3 class="reg_success">User added successfully!</h3>';
	} else {
		if (empty($_POST) === false && empty($errors) === true) {
			$register_data = array(
				'username' 		=> $_POST['username'],
				'password' 		=> $_POST['password'],
				'first_name' 	=> $_POST['first_name'],
				'email' 		=> $_POST['email'],
				'active'		=> $_POST['active'],
				);
			admin_add_user($register_data);
			header('Location: add_user.php?success');
			exit();
		} 
		else if (empty($errors) === false) {
			echo output_errors($errors);
		}
?>
		<body>
			<div id="body_wrap">
				<nav id="nav">
					<ul>
						<li><a href="recom.php">recommendations</a></li>
						<li><a href="blog.php">blog</a></li>
						<li><a href="index.php#contact">contact</a></li>
						<li><a href="includes/logout.php">log out</a></li>
						<li><a href="admin.php">admin page</a></li>
						<li><a href="/sites/worldtour/ro/public/login.php">ro</a></li>
					</ul>
					<div id="logo"><a href="index.php"><img src="/sites/worldtour/public/img/provisory-logo.gif"></a></div>
				</nav>
	
				<div id="register_box">
					<h1 class="loreg">Add user</h1>
					<form action="" method="post" id="contact_form">
						<input type="text" name="username" placeholder="username... *" id="username"><br>
						<input type="password" name="password" placeholder="password... *" id="password"><br>
						<input type="password" name="password_again" placeholder="password check... *" id="password2"><br>
						<input type="text" name="first_name" placeholder="First name... *" id="fname">
						<input type="text" name="active" placeholder="active... * (1 for yes / 0 for no)" id="lname">
						<input type="text" name="email" placeholder="email... *" id="email"><br>
						<input type="submit" name="register" class="button" value="add user" id="register">
						<div id='register_captcha'><?php create_captcha(); ?></div>
						<input type="reset" class="button" value="clear all" id="clear">
					</form>
				</div>

<?php 
}
include 'includes/footer.php'; 
?>
