<?php  
	include('core/init.php');
	not_logged_in_redirect();
	admin_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>worldtour | stergere utilizatori inactivi</title>
	<link rel="stylesheet" href="styles/login.css">
</head>
<body>
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
	echo '<h3 class="delete_success">Utilizatorul a fost sters cu succes!</h3>';
	echo '<a href="admin.php" class="email_success_a">Inapoi la pagina de admin</a>';
	} else {
		if (empty($_POST) === false) {
			if (user_exists($_POST['username']) === false) {
				$errors[] = 'Utilizatorul nu exista.';
			} else if (user_active($_POST['username']) === true) {
				$errors[] = 'Acel utilizator este activ.';
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
		<h2 class="active_users_headers">Utilizatori inactivi...</h2>
		<div class="active_users">
			<table id="usertable" width="600">
				<tr class="odd">
					<th>utilizator</th>
					<th>nume</th>
					<th>email</th>
				</tr>
				<?php display_inactive_users(); ?>
			</table>
		</div>
		<div class="user_d_form">
			<h2 class="updateacc_headers">Sterge utilizator...</h2>
			<form action="" method="post" id="updateacc">
				<input type="text" id="lname" name="username" placeholder="nume utilizator... *">
				<input type="submit" id="submit" name="delete" value="sterge">
			</form>
		</div>
	<?php 
	}
	include('includes/footer.php'); 
	?>