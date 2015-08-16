<?php  
	include('core/init.php');
	logged_in_redirect();
	include('includes/header.php');
?>

<h1 class="recover_info">Recover your information...</h1>

<?php 
	if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
?>
	<p id="recovery_p_error">Please check your email address.</p>
<?php  
	} else {
		$mode_allowed = array('username', 'password'); //folosim aceasta variabila pentru a ne asigura ca exista date transmise prin $_GET sau $_POST
		if (isset($_GET['mode']) === true && in_array($_GET['mode'], $mode_allowed) === true) {
			if (isset($_POST['email']) === true && empty($_POST['email']) === false) {
				if (email_exists($_POST['email']) === true) {
					recover($_GET['mode'], $_POST['email']); // modul poate fi numele de utilizator sau parola
					header('Location: recover.php?success');
					exit();
				} else {
					echo "<p id='recovery_p_error'>That email address does not exist!</p>";
				}
			}
		?>

		<form action="" method="post" id="recovery_form">
			<input type="text" name="email" id="rec_email" placeholder="email address... *">
			<input type="submit" name="recover" id="recover" value="recover">
		</form>

<?php  
		} else {
			header('Location: index.php');
			exit();
		}
	}
?>

<?php include('includes/footer.php');  ?>