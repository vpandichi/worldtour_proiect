<?php  
	include('core/init.php');
	not_logged_in_redirect();
	admin_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>worldtour | email utilizatori</title>
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
			<li><a href="login.php">setari profil</a></li>	
			<li><a href="../en/login.php">en</a></li>
		</ul>
		<div id="logo"><a href="index.php"><img src="img/provisory-logo.gif"></a></div>
	</nav>
	<?php 
		if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
		?>
			<h3 class="email_success">Mesajele au fost trimise.</h2>
			<a href="admin.php" class="email_success_a">Inapoi la pagina de admin</a>
		<?php 
		} else {
			if (empty($_POST) === false) {
				if (empty($_POST['subject']) === true) {
					$errors[] = 'Subiect mesajului este necesar.';
				}
				if (empty($_POST['body']) === true) {
					$errors[] = 'Continutul mesajului este necesar.';
				}
				if (empty($_POST['captcha_results']) === true) {
					$errors[] = 'Va rugam sa introduceti captcha.';
				} else if ($_POST['captcha_results'] != $_POST['num1'] + $_POST['num2']) {
					$errors[] = "Valoarea introdusa in captcha este incorecta.";
				}
				if (empty($errors) === false) {
					echo output_errors($errors);
				} else {
					email_users($_POST['subject'], $_POST['body']);
					exit();
				}
			}
		?>
			<h2 class="email_users_headers">Email utilizatori...</h2>
			<form action="" method="post" id="email_users">
				<input type="text" name="subject" id="email_users_subject" placeholder="subiect... *">
				<textarea name="body" id="email_users_body" placeholder="mesajul tau... *" cols="30" rows="5" maxlength="3220"></textarea>
				<div id='email_captcha'><?php create_captcha(); ?></div>
				<input type="submit" value="trimite" id="send_email">
			</form>
<?php
		}
include('includes/footer.php');  
?>