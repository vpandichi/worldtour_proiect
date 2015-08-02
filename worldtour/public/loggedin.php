<?php error_reporting(E_ALL & ~E_NOTICE); ?>
<h2 class="loggedin">Hello, <?php echo $user_data['first_name']; ?> !</h2>
<h4 class="cando">Here are some things you can do...</h4>
<div class="inner">
	<ul><li><a href="changepw.php">change password</a></li></ul>
</div>
<h4 class="ausers">Active users...</h4>
<div class="usercount">
	<?php  
		$user_count =  user_count();
		$suffix = ($user_count != 1) ? 's' : '';
	?> <!-- daca avem doar 1 user iregistrat vom genera cuvantul user. Daca avem mai mult de un user inregistrat pe site, vom genera cuvantul users. -->
	We currently have <?php echo $user_count; ?> registered user<?php echo $suffix;?>.
</div>