<?php 
	error_reporting(E_ALL & ~E_NOTICE); 
	session_start();

	if ($_SESSION['username']) {
		$username = ucfirst($_SESSION['username']);
	
		if ($_POST['post']) {
			$title = $_POST['title'];
			$content = $_POST['content'];

			if ($title != null && $content != null && strlen($title) < 62) {
				include_once("db_connection.php");
				$sql = "INSERT INTO blog (title, content)
						VALUE ('$title', '$content')";
				mysqli_query($dbCon, $sql);
				session_destroy();
			} 

			if (strlen($title) > 62) {
				echo "<h1 class='beposted'>Title must not be more than 62 characters!</h1>";
			} elseif ($title == null && $content == null || $title == null && $content != null || $title != null && $content == null) {
				echo "<h1 class='beposted'>Please fill in the title and content fields!</h1>";
			} else {
			 	echo "<h1 class='beposted'>Blog entry posted. </h1>";
			}
		} 
	} else {
		header("Location: login.php");
		exit;
	}

	if ($_POST['delete']) {
		include_once("db_connection.php");
		$username = $_POST['username'];
		$sql = "DELETE FROM users WHERE username = '$username'";
		$activeusr = "SELECT * FROM users WHERE username = '$username'";
		$result = mysqli_query($dbCon, $sql);
		echo "<h1 class='deleted'>User deleted!</h1>";
		mysqli_close($dbCon);
	}


	// include_once("db_connection.php");
	// $sql = "SELECT id, username, email, country FROM users";
	// $userData = mysqli_query($dbCon, $sql);
	// echo "<table class='dbdata'>
	// 	  <tr>
	// 	  <th>ID</th>
	// 	  <th>username</th>
	// 	  <th>email</th>
	// 	  <th>country</th>
	// 	  </tr>";
	// while ($record = mysqli_fetch_array($userData)) {
	// 	echo "<th>
	// 		  <td>" . $record['id'] . "</td>";
	//  	echo "<th>
	//  		  <td>" . $record['username'] . "</td>";
	//  	echo "<th>
	//  		  <td>" . $record['email'] . "</td>";
	//  	echo "<th>
	//  		  <td>" . $record['country'] . "</td>";
	// }
	// echo "</table>";
	// mysqli_close($dbCon);
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
			<form action="" method="post">
				<input type="text" name="title" id="title" placeholder="title... *"><br>
				<textarea name="content" id="content" cols="30" rows="10" placeholder="content... *"></textarea><br>
				<input type="submit" name="post" value="post entry" id="submit">
			</form>
			<h3 class="subheaders" id="mu">Manage Users</h1>
			<form action="" method="post" id="delete">
				<input type="text" name="username" placeholder="delete user...*" id="title">
				<input type="submit" name="delete" value="delete user" id="submit">
			</form>
			<br>
			<a href="/sites/worldtour/public/blog.php" id="view">view blog</a>
		</div>
	</div>
</body>
</html>