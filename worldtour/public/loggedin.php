<?php 
error_reporting(0);
not_logged_in_redirect();
?>
<h2 class="loggedin">Hello, <?php echo $user_data['first_name']; ?> !</h2>
<h4 class="cando">Here are some things you can do...</h4>
<div class="inner">
	<ul>
		<li><a href="changepw.php">change password</a></li>
		<li><a href="<?php echo $user_data['username']; ?>">view profile</a></li>
		<li><a href="profile.php">update profile</a></li>
		<?php 
			if (superuser($user_data['user_id'], 1) === true) {
        		echo '<li><a href="admin.php">admin page</a></li>';
   			 } 
   		?>
	</ul>
</div>
<h4 class="ausers">Active users...</h4>
<div class="usercount">
	<?php  
		$user_count =  user_count();
		$suffix = ($user_count != 1) ? 's' : '';
	?> <!-- daca avem doar 1 user iregistrat vom genera cuvantul user. Daca avem mai mult de un user inregistrat pe site, vom genera cuvantul users. -->
	We currently have <?php echo $user_count; ?> registered user<?php echo $suffix;?>.
</div>