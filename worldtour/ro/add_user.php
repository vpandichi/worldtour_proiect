<?php 
include('core/init.php'); 
not_logged_in_redirect();
admin_protect();

if (empty($_POST) === false) {
	$required_fields = array('usernamne', 'password', 'password_again', 'first_name', 'active', 'email');
	foreach ($_POST as $key => $value) {
		if (empty($value) && in_array($key, $required_fields) === true) {	
			$errors[] = 'Campurile marcate cu * sunt obligatorii.';
			break 1; 
		} 
	} 

	if (empty($errors) === true) {
		if (user_exists($_POST['username']) === true) {
		$errors[] = 'Utilizatorul \'' . $_POST['username'] . '\' este deja inregistrat. Poti incerca ' . $_POST['username'] . rand(7, 77);
		}
		if (preg_match("/\\s/", $_POST['username']) == true) { // verificam daca numele de untilizator contine spatii libere 
			$errors[] = 'Numele de utilizator nu poate contine spatii libere.';
		}
		if (!ctype_alnum($_POST['username'])) {
			$errors[] = 'Nu sunt permise caracterele speciale.';
		}
		if (strlen($_POST['password']) < 7) {
			$errors[] = 'Parola trebuie sa fie de cel putin 7 caractere.';
		}
		if ($_POST['password'] !== $_POST['password_again']) {
			$errors[] = 'Parolele introduse nu se potrivesc.';
		}
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = 'Adresa de email introdusa nu este corecta.';
		}
		if (email_exists($_POST['email']) === true) {
			$errors[] = 'Ne pare rau, email-ul \'' . $_POST['email'] . '\' este deja in uz.';
		}
		if (empty($_POST['captcha_results']) === true) {
			$errors[] = 'Te rugam sa rezolvi captcha.';
		} else if ($_POST['captcha_results'] != $_POST['num1'] + $_POST['num2']) {
			$errors[] = "Raspunsul la captcha este incorect.";
		}
	}
}
// print_r($errors);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>worldtour | adaugare utilizator</title>
	<link rel="stylesheet" href="styles/login.css">
</head>
<?php 
	if(isset($_GET['success']) && empty($_GET['success'])) {
		echo '<body>
				<div id="body_wrap">
					<nav id="nav">
						<ul>
							<li><a href="recom.php">recomandari</a></li>
							<li><a href="blog.php">blog</a></li>
							<li><a href="includes/logout.php">delogare</a></li>
							<li><a href="admin.php">pagina admin</a></li>
							<li><a href="../en/login.php">en</a></li>
						</ul>
						<div id="logo"><a href="index.php"><img src="img/provisory-logo.gif"></a></div>
					</nav>';
		echo '<h3 class="reg_success">Utilizatorul a fost adaugat cu succes!</h3>';
	} else {
		if (empty($_POST) === false && empty($errors) === true) {
			$register_data = array(
				'username' 		=> $_POST['username'],
				'password' 		=> $_POST['password'],
				'first_name' 	=> $_POST['first_name'],
				'last_name' 	=> $_POST['last_name'],
				'email' 		=> $_POST['email'],
				'active'		=> isset($_POST['active']) ? 1 : 0,
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
						<li><a href="recom.php">recomandari</a></li>
						<li><a href="blog.php">blog</a></li>
						<li><a href="index.php#contact">contact</a></li>
						<li><a href="includes/logout.php">delogare</a></li>
						<li><a href="admin.php">pagina admin</a></li>
						<li><a href="../en/login.php">en</a></li>
					</ul>
					<div id="logo"><a href="index.php"><img src="img/provisory-logo.gif"></a></div>
				</nav>
	
				<div id="register_box">
					<h1 class="loreg">Adaugare utilizator</h1>
					<form action="" method="post" id="contact_form">
						<input type="text" name="username" placeholder="nume utilizator... *" id="username"><br>
						<input type="password" name="password" placeholder="parola... *" id="password"><br>
						<input type="password" name="password_again" placeholder="verifica parola... *" id="password2"><br>
						<input type="text" name="first_name" placeholder="prenume... *" id="fname">
						<input type="text" name="last_name" placeholder="nume... " id="lname">
						<input type="text" name="email" placeholder="email... *" id="email"><br>
						<div id="add_user_activ_inactiv">Utilizator activ? &nbsp; <input type="checkbox" name="active" value="1" checked></div>
						<input type="submit" name="register" class="button" value="adaugare" id="register">
						<div id='register_captcha'><?php create_captcha(); ?></div>
					</form>
				</div>
<?php 
}
include 'includes/footer.php'; 
?>
