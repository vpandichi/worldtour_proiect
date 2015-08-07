<?php  
	include('core/init.php');
	not_logged_in_redirect();
	admin_protect();
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
			<li><a href='includes/logout.php'>log out</a></li>
			<li><a href="login.php">profile settings</a></li>	
			<li><a href="/sites/worldtour/ro/public/login.php">ro</a></li>
		</ul>
		<div id="logo"><a href="index.php"><img src="/sites/worldtour/public/img/provisory-logo.gif"></a></div>
	</nav>
	<?php 
		if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
		?>
			<h3 class="email_success">Emails have been sent</h2>
			<a href="admin.php" class="email_success_a">Go back to the admin page</a>
		<?php 
		} else {
			if (empty($_POST) === false) {
				if (empty($_POST['subject']) === true) {
					$errors[] = 'A message subject is required.';
				}
				if (empty($_POST['body']) === true) {
					$errors[] = 'A body message is required.';
				}
				if (empty($errors) === false) {
					echo output_errors($errors);
				} else {
					email_users($_POST['subject'], $_POST['body']);
					exit();
				}
			}
		?>
			<h2 class="email_users_headers">Email all users...</h2>
			<form action="" method="post" id="email_users">
				<input type="text" name="subject" id="email_users_subject" placeholder="subject... *">
				<textarea name="body" id="email_users_body" placeholder="enter your message... *" cols="30" rows="5" maxlength="3220"></textarea>
				<input type="submit" value="send" id="send_email">
			</form>
<?php
		}
include('includes/footer.php');  
?>