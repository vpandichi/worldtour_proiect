<?php 
	error_reporting(E_ALL & ~E_NOTICE); 
	session_start();

	if ($_SESSION['username']) {
		$username = ucfirst($_SESSION['username']);
	
		if ($_POST['post']) {
			$title = $_POST['title'];
			$content = $_POST['content'];

			if ($title != null && $content != null) {
				include_once("db_connection.php");
				$sql = "INSERT INTO blog (title, content)
						VALUE ('$title', '$content')";
				mysqli_query($dbCon, $sql);
				echo "<h1 class='beposted'>Blog entry posted</h1>";
				session_destroy();
			} else {
				echo "<h1 class='beposted'>Please fill in the title and content fields!</h1>";
			}
		} 
	} else {
		header("Location: login.php");
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin page</title>
	<link rel="stylesheet" href="/sites/worldtour/public/styles/admin.css">
</head>
<body>
	<div id="wraper">
		<nav id="nav">
			<ul>
				<li><a href="recom.php">recommendations</a></li>
				<li><a href="login.php">log out</a></li>
				<li><a href="index.php">back to main page</a></li>
				<li><a href="/sites/worldtour/ro/public/admin.php">ro</a></li>
			</ul>
		<div id="logo"><a href="index.php"><img src="/sites/worldtour/public/img/provisory-logo.gif"></a></div>
		<div id="crcontent">
			<h1 class="headers">Welcome, <?php echo $username; ?>!</h1>
			<h3 class="subheaders">Post Article</h1>
			<form action="admin.php" method="post">
				<input type="text" name="title" id="title" placeholder="title... *"><br>
				<textarea name="content" id="content" cols="30" rows="10" placeholder="content... *"></textarea><br>
				<input type="submit" name="post" value="post entry" id="submit">
			</form>
			<br>
			<a href="/sites/worldtour/public/blog.php" id="view">view blog</a>
		</div>
	</div>
</body>
</html>