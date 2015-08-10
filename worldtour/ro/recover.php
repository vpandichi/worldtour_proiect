<?php  
	include('core/init.php');
	logged_in_redirect();
	include('includes/header.php');
?>

<h1 class="recover_info">Recupereaza-ti contul...</h1>

<?php 
	if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
?>
	<p id="recovery_p_error">Te rugam sa-ti verifici email-ul.</p>
<?php  
	} else {
		$mode_allowed = array('username', 'password'); //folosim aceasta variabila pentru a ne asigura ca exista date transmise prin $_GET sau $_POST
		if (isset($_GET['mode']) === true && in_array($_GET['mode'], $mode_allowed) === true) {
			if (isset($_POST['email']) === true && empty($_POST['email']) === false) {
				if (email_exists($_POST['email']) === true) {
					recover($_GET['mode'], $_POST['email']);
					header('Location: recover.php?success');
					exit();
				} else {
					echo "<p id='recovery_p_error'>Adresa de email nu exista!</p>";
				}
			}
		?>

		<form action="" method="post" id="recovery_form">
			<input type="text" name="email" id="rec_email" placeholder="adresa email... *">
			<input type="submit" name="recover" id="recover" value="trimite">
		</form>

<?php  
		} else {
			header('Location: index.php');
			exit();
		}
	}
?>

<?php include('includes/footer.php');  ?>