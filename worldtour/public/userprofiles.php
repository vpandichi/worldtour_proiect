<?php 
	include('core/init.php'); 

	if (isset($_GET['username']) === true && empty($_GET['username']) === false) {
		$username = $_GET['username'];
		if (user_exists($username) === true) {
			$user_id = get_user_id($username);
			$profile_data = user_data($user_id, 'first_name', 'last_name', 'email');
		?>
			<h3><?php echo $profile_data['first_name']; ?>'s profile</h3>
		<?php
		} else {
			echo 'Sorry, that user does not exist!';
		}
	} else {
		header('Location: index.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to worldtour! Your free touristic guide based on real experiences.</title>
	<link rel="stylesheet" href="/sites/worldtour/public/styles/login.css">
</head>

<!-- <body>
	<div id="body_wrap">
		<nav id="nav">
			<ul>
				<li><a href="recom.php">recommendations</a></li>
				<li><a href="blog.php">blog</a></li>
				<li><a href="index.php#contact">contact</a></li>
				<li><a href='includes/logout.php'>log out</a></li>
				<li><a href='login.php'>profile settings</a></li>
				<li><a href="/sites/worldtour/ro/public/login.php">ro</a></li>
			</ul>
			<div id="logo"><a href="index.php"><img src="/sites/worldtour/public/img/provisory-logo.gif"></a></div>
		</nav> -->

<?php include('includes/footer.php');  ?>
