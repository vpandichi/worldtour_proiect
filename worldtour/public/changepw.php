<?php 
	include('core/init.php'); 
	not_logged_in_redirect();
	if (empty($_POST) === false) {
		$required_fields = array('current_password', 'password', 'password_again');
		foreach ($_POST as $key => $value) {
			if (empty($value) && in_array($key, $required_fields) === true) {	
				$errors[] = 'Fields marked with an asterisk are required';
				break 1; // breaks to foreach (if 1 error is found, we can't do anything else so there's no point for checking further)
			} 
		}

		if (md5($_POST['current_password']) === $user_data['password']) { // codificam parola pe care userul o introduce si verificam daca aceasta exista in baza de date
			if (trim($_POST['password']) !== trim($_POST['password_again'])) { // folosim functia trim pentru a sterge orice spatiu pe care userul il poate insera din greseala
				$errors[] = 'Your new passwords do not match.';
			} else if (strlen($_POST['password']) < 6) {
				$errors[] = 'Your password must be at least 6 characters.';
			}
		} else {
			$errors[] = 'Whoops... you misspelled your current password, try again.';
		}
	} // for every item that we post ($key = name attribute from form) verify this.
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
		<nav id="nav">
			<ul>
				<li><a href="recom.php">recommendations</a></li>
				<li><a href="blog.php">blog</a></li>
				<li><a href="index.php#contact">contact</a></li>
				<li>
					<?php 
						if (logged_in() === true) {
							echo "<a href='includes/logout.php'>log out</a>";
						} else {
							echo "<a href='login.php'>log in</a>";
							echo "</li><li><a href='register.php'>register</a>";
						}
					?>	
				</li>
				<li><a href="/sites/worldtour/ro/public/login.php">ro</a></li>
			</ul>
			<div id="logo"><a href="index.php"><img src="/sites/worldtour/public/img/provisory-logo.gif"></a></div>
		</nav>
		<?php 
			if (isset($_GET['success']) && empty($_GET['success'])) { // empty($_get['success']) previne introducerea de caractere in url dupa cuvantul 'success'. ex: change_pw.php?success=jasljd
				echo '<h3 class="reset_success">Your have successfully reseted your password.</h3>';
			} else {
				if (empty($_POST) === false && empty($errors) === true) {
					change_password($session_user_id, $_POST['password']);
					header('Location: changepw.php?success');
				} else if (empty($errors) === false) {
					echo output_errors($errors);
				}
			?>
				<h4 class="changepw">Change your password...</h4>
				<form action="" method="post" id="changepwform">
					<input type="password" id="password" name="current_password" placeholder="current password... *">
					<input type="password" id="password" name="password" placeholder="new password... *">
					<input type="password" id="password" name="password_again" placeholder="password check... *">
					<input type="submit" id="submit" name="submit" value="change">
				</form>
		<?php 
			}
			include 'includes/footer.php'; 
		?>