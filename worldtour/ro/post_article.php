<?php  
	include('core/init.php');
	not_logged_in_redirect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>worldtour | postare articol</title>
	<link rel="stylesheet" href="styles/login.css">
</head>
<body>
	<div id="body_wrap">
		<nav id="nav">
			<ul>
				<li><a href="recom.php">recomandari</a></li>
				<li><a href="blog.php">blog</a></li>
				<li><a href='includes/logout.php'>delogare</a></li>
				<li><a href="login.php">setari profil</a></li>
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
	echo '<h3 class="post_success">Articolul a fost adaugat cu succes!</h3>';
	echo '<a href="blog.php" class="email_success_a">Vizualizare articole</a>';
	} else {
		if (empty($_POST) === false) {
			if (strlen($_POST['title']) > 40 || strlen($_POST['title']) < 10) {
				$errors[] = 'Titlul trebuie sa fie cuprins intre 10 si 40 de caractere.';
			} 
			if (empty($_POST['content']) || empty($_POST['title'])) {
				$errors[] = 'Campurile marcate cu * sunt obligatorii.';
			}
			if (empty($_POST['captcha_results']) === true) {
				$errors[] = 'Te rugam sa introduci captcha.';
			} else if ($_POST['captcha_results'] != $_POST['num1'] + $_POST['num2']) {
				$errors[] = "Raspunsul la captcha este incorect.";
			}
		} 
		if (empty($_POST) === false && empty($errors) === true) {
			post_article($_POST['title'], $_POST['content']);
			header('Location: post_article.php?success');
			exit();
		} else if (empty($errors) === false) {
			echo output_errors($errors);
		}
	?>	

	<h2 class="email_users_headers">Post Article</h1>
	<form action="" method="post" id="post_blog_entry">
		<input type="text" name="title" id="title" placeholder="titlu... *"><br>
		<textarea name="content" id="content" cols="30" rows="5" placeholder="continut... *"></textarea><br>
		<div id='post_captcha'><?php create_captcha(); ?></div>
		<input type="submit" name="publish" value="publica" id="publish">
	</form>
		
<?php 
	} 
	include('includes/footer.php'); 
?>



