<?php 
	include('core/init.php'); 
	not_logged_in_redirect();

	if (empty($_POST) === false) {
		$required_fields = array('first_name', 'email');
		foreach ($_POST as $key => $value) {
			if (empty($value) && in_array($key, $required_fields) === true) {
				$errors[] = 'Campurile marcate cu * sunt obligatorii.';
				break 1;
			}
		}

		if (empty($errors) === true) {
			if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
				$errors[] = 'Adresa de email nu este valida.';
			} else if (email_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email']) {
				$errors[] = 'Adresa de email \'' . $_POST['email'] . '\' este deja in uz.';
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>worldtour | profil</title>
	<link rel="stylesheet" href="styles/login.css">
</head>
<body>
<div id="body_wrap">
<nav id="nav">
<ul>
	<li><a href="recom.php">recomandari</a></li>
	<li><a href="blog.php">blog</a></li>
	<li><a href="index.php#contact">contact</a></li>
	<li><a href='includes/logout.php'>delogare</a></li>
	<li><a href="<?php echo $user_data['username']; ?>">vizualizare profil</a></li>
	<li><a href="../en/login.php">en</a></li>
</ul>
<div id="logo"><a href="index.php"><img src="img/provisory-logo.gif"></a></div>
</nav>
<?php 
if (isset($_GET['success']) && empty($_GET['success'])) {
	echo '<body>
	<div id="body_wrap">
		<nav id="nav">
			<ul>
				<li><a href="recom.php">recomandari</a></li>
				<li><a href="blog.php">blog</a></li>
				<li><a href="index.php#contact">contact</a></li>
				<li><a href="includes/logout.php">delogare</a></li>
				<li><a href="login.php">setari profil</a></li>
				<li><a href="../en/login.php">en</a></li>
			</ul>
			<div id="logo"><a href="index.php"><img src="img/provisory-logo.gif"></a></div>
		</nav>';
	echo '<h3 class="update_success">Profilul a fost actualizat cu succes!</h3>';
} else {
	if (empty($_POST) === false && empty($errors) === true) {
		$allow_email = ($_POST['allow_email'] == 'on') ? 1 : 0;
		$update_data = array(
			'first_name' 	=> $_POST['first_name'],
			'last_name'  	=> $_POST['last_name'],
			'email' 	 	=> $_POST['email'],
			'allow_email'	=> $allow_email,
		);
		update_user($session_user_id, $update_data);
		header('Location: profile.php?success');
		exit();
	} else if (empty($errors) === false) {
		echo output_errors($errors);
	}
?>
<h4 class="updateacc_headers">Actualizeaza-ti profilul...</h4>
<form action="" method="post" id="updateacc">
	<input type="text" id="fname" name="first_name" placeholder="prenume... *" value="<?php echo $user_data['first_name']; ?>">
	<input type="text" id="lname" name="last_name" placeholder="nume... " value="<?php echo $user_data['last_name']; ?>">
	<input type="text" id="email" name="email" placeholder="adresa email... *" value="<?php echo $user_data['email']; ?>">
	<input type="submit" id="submit" name="submit" value="actualizeaza">
	<input type="checkbox" class="email_checkbox" name="allow_email" <?php if ($user_data['allow_email'] == 1) { echo 'checked = "checked"';} ?>> <p class="email_checkbox_p">Abonat la stirile noastre?</p>
</form>
<?php 
}
include 'includes/footer.php';  
?>
