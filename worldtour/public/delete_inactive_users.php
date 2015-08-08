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
	echo '<h3 class="delete_success">User deleted successfully!</h3>';
	echo '<a href="admin.php" class="email_success_a">Go back to the admin page</a>';
	} else {
		if (empty($_POST) === false) {
			if (user_exists($_POST['username']) === false) {
				$errors[] = 'Username does not exist';
			} else if (user_active($_POST['username']) === true) {
				$errors[] = 'That user is active';
			}
		} 
		if (empty($_POST) === false && empty($errors) === true) {
			delete_inactive_user($_POST['username']);
			header('Location: delete_users.php?success');
			exit();
		} else if (empty($errors) === false) {
			echo output_errors($errors);
		}
	?>	
		<h2 class="email_users_headers">Inactive users...</h2>
		<div class="active_users">
			<table id="usertable" width="600">
				<tr class="odd">
					<th>username</th>
					<th>first name</th>
					<th>email</th>
				</tr>
				<?php display_inactive_users(); ?>
			</table>
		</div>
		<div class="user_d_form">
			<h2 class="updateacc_headers">Delete user...</h2>
			<form action="" method="post" id="updateacc">
				<input type="text" id="lname" name="username" placeholder="username... *">
				<input type="submit" id="submit" name="delete" value="delete">
			</form>
		</div>
	<?php 
	}
	include('includes/footer.php'); 
	?>