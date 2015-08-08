<?php  
	include('core/init.php');
	not_logged_in_redirect();
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
				<li><a href='includes/logout.php'>log out</a></li>
				<li><a href="login.php">profile settings</a></li>
				<li><a href="profile.php">view profile</a></li>	
				<li><a href="/sites/worldtour/ro/public/login.php">ro</a></li>
			</ul>
			<div id="logo"><a href="index.php"><img src="/sites/worldtour/public/img/provisory-logo.gif"></a></div>
		</nav>
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
	echo '<h3 class="post_success">Post entry has been added successfully!</h3>';
	echo '<a href="blog.php" class="email_success_a">View blog entries</a>';
	} else {
		if (empty($_POST) === false) {
			if (strlen($_POST['title']) > 40 || strlen($_POST['title']) < 10) {
				$errors[] = 'Title must be less than 40 and more than 10 characters long';
			} 
			if (empty($_POST['content']) || empty($_POST['title'])) {
				$errors[] = 'Fields marked with an asterisk are required';
			}
			if (empty($_POST['captcha_results']) === true) {
				$errors[] = 'Please enter captcha.';
			} else if ($_POST['captcha_results'] != $_POST['num1'] + $_POST['num2']) {
				$errors[] = "Incorrect captcha.";
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
		<input type="text" name="title" id="title" placeholder="title... *"><br>
		<textarea name="content" id="content" cols="30" rows="5" placeholder="content... *"></textarea><br>
		<?php create_captcha(); ?>
		<input type="submit" name="publish" value="post entry" id="publish">
	</form>
		
<?php 
	} 
	include('includes/footer.php'); 
?>



