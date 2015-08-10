<?php  
	include('core/init.php');
	not_logged_in_redirect();
	admin_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>worldtour | admin</title>
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
	<h2 class="admin">Bun venit pe pagina de admin...</h2>
	<div class="inner">
		<ul>
			<li><a href="email_users.php">email utilizatori activi</a></li>
			<li><a href="add_user.php">adaugare utilizator</a></li>
			<li><a href="delete_users.php">sterge utilizatori activi</a></li>
			<li><a href="delete_inactive_users.php">sterge utilizatori inactivi</a></li>
		</ul>
	</div>
<?php include('includes/footer.php');  ?>