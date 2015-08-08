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

		<h2 class="email_users_headers">Post Article</h1>
		<form action="" method="post" id="post_blog_entry">
			<input type="text" name="title" id="title" placeholder="title... *"><br>
			<textarea name="content" id="content" cols="30" rows="5" placeholder="content... *"></textarea><br>
			<input type="submit" name="publish" value="post entry" id="publish">
		</form>

<?php include('includes/footer.php'); ?>