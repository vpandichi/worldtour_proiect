<?php 
error_reporting(0);
not_logged_in_redirect();
?>
<h2 class="loggedin">Salut, <?php echo $user_data['first_name']; ?> !</h2>
<h4 class="cando">Iata cateva lucruri pe care le poti face...</h4>
<div class="inner">
	<ul>
		<li><a href="changepw.php">schimba parola</a></li>
		<li><a href="<?php echo $user_data['username']; ?>">vizualizare profil</a></li>
		<li><a href="profile.php">actualizare profil</a></li>
		<li><a href="post_article.php">posteaza pe blog</a></li>
		<?php 
			if (superuser($user_data['user_id'], 1) === true) {
        		echo '<li><a href="admin.php">pagina admin</a></li>';
   			 } 
   		?>
	</ul>
</div>
<h4 class="ausers">Utilizatori activi...</h4>
<div class="usercount">
	<?php  
		$user_count =  user_count();
		$suffix = ($user_count != 1) ? 'i' : '';
	?> <!-- daca avem doar 1 utilizator iregistrat vom genera cuvintele utilizator/inregistrat. Daca avem mai mult de un utilizator inregistrat, vom genera cuvintele utilizatori/inregistrati. -->
	Momentan avem <?php echo $user_count; ?> utilizator<?php echo $suffix;?> inregistrat<?php echo $suffix;?>.
</div>