<?php 
	include('core/init.php'); 
	not_logged_in_redirect();

	if (empty($_POST) === false) {
		$required_fields = array('first_name', 'email');
		foreach ($_POST as $key => $value) {
			if (empty($value) && in_array($key, $required_fields) === true) {
				$errors[] = 'Fields marked with an asterisk are required.';
				break 1;
			}
		}

		if (empty($errors) === true) {
			if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
				$errors[] = 'That email address is not valid.';
			} else if (email_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email']) {
				$errors[] = 'Sorry, the email \'' . $_POST['email'] . '\' is already in use.';
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to worldtour! Your free touristic guide based on real experiences.</title>
	<link rel="stylesheet" href="/sites/worldtour/public/styles/login.css">
</head>
<body>
	<div id="body_wrap">
		<?php 
			if (isset($_GET['success']) && empty($_GET['success'])) {
				echo '<body>
				<div id="body_wrap">
					<nav id="nav">
						<ul>
							<li><a href="recom.php">recommendations</a></li>
							<li><a href="blog.php">blog</a></li>
							<li><a href="index.php#contact">contact</a></li>
							<li><a href="includes/logout.php">log out</a></li>
							<li><a href="login.php">profile settings</a></li>
							<li><a href="/sites/worldtour/ro/public/login.php">ro</a></li>
						</ul>
						<div id="logo"><a href="index.php"><img src="/sites/worldtour/public/img/provisory-logo.gif"></a></div>
					</nav>';
				echo '<h3 class="update_success">Your profile has been updated successfully!</h3>';
			} else {
				if (empty($_POST) === false && empty($errors) === true) {
					$update_data = array(
						'first_name' => $_POST['first_name'],
						'last_name'  => $_POST['last_name'],
						'email' 	 => $_POST['email'],
					);
					update_user($session_user_id, $update_data);
					header('Location: profile.php?success');
					exit();
				} else if (empty($errors) === false) {
					echo output_errors($errors);
				}
			?>
			<nav id="nav">
				<ul>
					<li><a href="recom.php">recommendations</a></li>
					<li><a href="blog.php">blog</a></li>
					<li><a href="index.php#contact">contact</a></li>
					<li><a href='includes/logout.php'>log out</a></li>
					<li><a href="<?php echo $user_data['username']; ?>">view profile</a></li>
					<li><a href="/sites/worldtour/ro/public/login.php">ro</a></li>
				</ul>
				<div id="logo"><a href="index.php"><img src="/sites/worldtour/public/img/provisory-logo.gif"></a></div>
			</nav>
			
			<h4 class="updateacc">Update your account...</h4>
			<form action="" method="post" id="updateacc">
				<input type="text" id="fname" name="first_name" placeholder="first name... *" value="<?php echo $user_data['first_name']; ?>">
				<input type="text" id="lname" name="last_name" placeholder="last name... " value="<?php echo $user_data['last_name']; ?>">
				<input type="text" id="email" name="email" placeholder="email address... *" value="<?php echo $user_data['email']; ?>">
				<input type="submit" id="submit" name="submit" value="update">
			</form>
	<?php 
		}
		include 'includes/footer.php';  
	?>
