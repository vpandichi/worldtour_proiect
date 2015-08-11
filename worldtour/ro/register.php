<?php 
include('core/init.php'); 
logged_in_redirect(); // daca utilizatorul este logat dar totusi incearca sa acceseze pagina de inregistrare, fie prin URL sau de pe site, il vom redirectiona folosind aceasta functie
if (empty($_POST) === false) {
	$required_fields = array('usernamne', 'password', 'password_again', 'first_name', 'email');
	foreach ($_POST as $key => $value) {
		if (empty($value) && in_array($key, $required_fields) === true) {	
			$errors[] = 'Campurile marcate cu * sunt obligatorii.';
			break 1; // breaks to foreach (if 1 error is found, we can't do anything else so there's no point for checking further)
		} 
	} // iterating through our post data - doing a check on each one

	if (empty($errors) === true) {
		if (user_exists($_POST['username']) === true) {
		$errors[] = 'Numele de utilizator \'' . $_POST['username'] . '\' este deja luat. Poti incerca ' . $_POST['username'] . rand(7, 77);
		}
		if (preg_match("/\\s/", $_POST['username']) == true) { // regexp checking for any amount of spaces within the username 
			$errors[] = 'Nu sunt permise spatii in numele de utilizator.';
		}
		if (!ctype_alnum($_POST['username'])) {
			$errors[] = 'Nu sunt permise caractere speciale.';
		}
		if (strlen($_POST['password']) < 7) {
			$errors[] = 'Parola trebuie sa contina minim 7 caractere.';
		}
		if ($_POST['password'] !== $_POST['password_again']) {
			$errors[] = 'Parolele introduse nu se potrivesc.';
		}
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = 'Adresa de email introdusa nu este corecta.';
		}
		if (email_exists($_POST['email']) === true) {
			$errors[] = 'Adresa de email \'' . $_POST['email'] . '\' este deja in uz.';
		}
		if (empty($_POST['captcha_results']) === true) {
			$errors[] = 'Te rugam sa introduci captcha.';
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
	<title>worldtour | inregistrare</title>
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
							<li><a href="index.php#contact">contact</a></li>
							<li>';?> <!-- daca userul s-a inregistrat vrem sa includem header-ul pentru a nu strica felul in care se vede website-ul -->
								<?php 
									if (logged_in() === true) {
										echo "<a href='includes/logout.php'>delogare</a>";
									} else {
										echo "<a href='login.php'>logare</a>";
										echo "</li><li><a href='register.php'>inregistrare</a>";
									}
								?>	
							<?php echo '</li>
							<li><a href="../en/register.php">en</a></li>
						</ul>
						<div id="logo"><a href="index.php"><img src="img/provisory-logo.gif"></a></div>
					</nav>';
		echo '<h3 class="reg_success">Te-ai inregistrat cu succes!</h3><br/><h4 class="activate_account">Te rugam sa-ti verifici adresa de email pentru ati activa contul, sau &nbsp <a href="login.php" id="reglogin"> apasa aici pentru a te loga. </a></h4>';
	} else {
		if (empty($_POST) === false && empty($errors) === true) {
			$register_data = array(
				'username' 		=> $_POST['username'],
				'password' 		=> $_POST['password'],
				'first_name' 	=> $_POST['first_name'],
				'last_name' 	=> $_POST['last_name'],
				'email' 		=> $_POST['email'],
				'email_code'	=> md5($_POST['username'] + microtime()) // dorim sa generam un hash random pentru a-l introduce in linkul din email-ul de activare. folosim numele de utilizator la care adaugam microsecundele din 01/01/1970 pana in prezent
				);

			register_user($register_data);
			header('Location: register.php?success');
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
						<?php 
							if (logged_in() === true) {
								echo "<li><a href='includes/logout.php'>delogare</a></li>";
							} else {
								echo "<li><a href='login.php'>logare</a></li>";
								echo "<li><a href='register.php'>inregistrare</a></li>";
							}
						?>	
						<li><a href="../en/register.php">en</a></li>
					</ul>
					<div id="logo"><a href="index.php"><img src="img/provisory-logo.gif"></a></div>
				</nav>
	
				<div id="register_box">
					<h1 class="loreg">Inregistrare</h1>
					<form action="" method="post" id="contact_form">
						<input type="text" name="username" placeholder="nume utilizator... *" id="username"><br>
						<input type="password" name="password" placeholder="parola... *" id="password"><br>
						<input type="password" name="password_again" placeholder="verificare parola... *" id="password2"><br>
						<input type="text" name="first_name" placeholder="prenume... *" id="fname">
						<input type="text" name="last_name" placeholder="nume... " id="lname">
						<input type="text" name="email" placeholder="email... *" id="email"><br>
						<input type="submit" name="register" class="button" value="confirma" id="register">
						<div id='register_captcha'><?php create_captcha(); ?></div>
						<input type="reset" class="button" value="anuleaza" id="clear">
					</form>
				</div>
<?php 
}
include 'includes/footer.php'; 
?>
