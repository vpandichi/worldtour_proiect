<?php 
include('core/init.php');
include('includes/header.php'); 
?>
<div id="login_box">
	<h1 class="loreg">Log in</h1>
	<form action='process_login.php' method='post' id='contact_form'>
		<input type='text' name='username' placeholder='username... *' id='email' maxlength='60'><br>
		<input type='password' name='password' placeholder='password... *' id='password' maxlength='33'><br>
		<input type='submit' name='login' class='button' value='log in' id='login' >
		<input type='reset' name='reset' class='button' value='cancel' id='cancel'>
	</form>
</div>

<aside class="login_aside">
	<?php 
	if (logged_in() === true) {
			include 'includes/loggedin.php';
		} else {
			// include 'login2.php';
		} 
	?>
</aside>

<?php include('includes/footer.php'); ?>