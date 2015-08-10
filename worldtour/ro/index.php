<?php
include('core/init.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to worldtour! Your free touristic guide based on real experiences.</title>
	<link rel="stylesheet" href="styles/main.css">
</head>
<body>
	<div id="body_wrap">
		<div id="lpage">
			<div id="logo"><img src="img/provisory-logo.gif" alt="worldtour"></div>
			<video autoplay loop muted class="bgvideo" id="bgvideo">
				<source src="img/lpage_video.mp4" type="video/mp4">
			</video>
			<nav id="nav">
				<ul>
					<li><a href="#" onclick="return false;" onmousedown="autoScrollTo('about');">despre mine</a></li>
					<li><a href="#" onclick="return false;" onmousedown="autoScrollTo('recommendations');">recomandari</a></li>
					<li><a href="blog.php">blog</a></li>
					<li><a href="#" onclick="return false;" onmousedown="autoScrollTo('contact');">contact</a></li>
					<?php 
						if (logged_in() === true) {
							echo "<li><a href='includes/logout.php'>delogare</a></li>";
							echo "<li><a href='login.php'>setari profil</a></li>";
						} else {
							echo "<li><a href='login.php'>logare</a></li>";
							echo "<li><a href='register.php'>inregistrare</a></li>";
						}
					?>	
					<li><a href="../en/index.php">en</a></li>
				</ul>
				<div id="dynamic_logo"></div>
			</nav>
		</div>
		<div id="dynamic_video"></div> 
		<div id="above_wraper"><img src="img/boat.png" id="boat"></div>
		<div id="page_wrapper">
			<div id="page_content">
				<!-- <script type="text/javascript">for (var i = 0; i < 50; i++) {document.write("dummy content" + ' ' + i + "<br/>")};</script> -->
				<div id="about_content">
					<h1 id="about">Despre mine</h1>
					<article>
						<img src="img/aboutme.jpg" alt="">
							Salut! Numele meu este Vlad, am 23 de ani si sunt pasionat de calatorii si turism.
							Neavand prea multa experienta in trecut, cand am inceput sa calatoresc acum doi ani,
							adeseori m-am gasit in ipostaza de a incerca sa aflu cat mai multe despre locul in care vreau sa ajung.
							Atractii turistice, unde sa te cazezi, unde sa mananci, cat te va costa, unde sa mergi si unde nu - intrebari pe care le avem cu totii in momentul in care ne planificam viitoarea calatorie. 
							La prima vedere, aceste intrebari par simple si cu siguranta vei gasi un raspuns dupa cateva ore de cautare. Adeseori informatiile pe care le cauti nu se regasesc intr-un singur loc, acest lucru conducand la ore bune petrecute in fata calculatorului pentru ati aduna materialul necesar. Date fiind aceste lucruri, am decis ca este timpul sa creez un website, o comunitate unde toate intrebarile tale au un raspuns
							bazat pe experientele reale ale oamenilor care au fost acolo; fie ca planuiesti o calatorie in Italia, Grecia, sau oriunde altundeva pe glob. <br/>
						<a href="blog.php">Imparte cu noi</a> aventurile tale din calatorii si ajuta-ne sa imbunatatim experienta utilizatorilor nostri din intreaga lume !
					</article>
					<h1 id="recommendations">Recomandari</h1>
					<div id="box1">
						<span class="location"><h4>Sicilia</h4></span>
						<a href="recom.php" class="view_more">Mai mult</a>
					</div>
					<div id="box2">
						<span class="location"><h4>Iasi</h4></span>
						<a href="recom.php" class="view_more">Mai mult</a>
					</div>
					<div id="box3">
						<span class="location" id="last"><h4>Castelul Bran</h4></span>
						<a href="recom.php" class="view_more">Mai mult</a>
					</div>
					
					<?php
					if (isset($_GET['success']) === true && empty($_GET['success']) === true) { // empty($_get['success']) previne introducerea de caractere in url dupa cuvantul 'success'. ex: change_pw.php?success=jasljd
						echo '<h3 class="contact_success">Mesajul tau a fost trimis cu succes</h3>';
					} else {
						if (empty($_POST) === false) {
							$required_fields = array('contact_name', 'email', 'contact_subject', 'body');
							foreach ($_POST as $key => $value) {
								if (empty($value) && in_array($key, $required_fields) === true) {	
									$errors[] = 'Campurile marcate cu * sunt obligatorii.';
									break 1; // breaks to foreach (if 1 error is found, we can't do anything else so there's no point for checking further)
								} 
							}
							if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
								$errors[] = 'Adresa de email introdusa nu este corecta.';
							} else if (strlen($_POST['email']) < 14) {
								$errors[] = 'Adresele de email trebuie sa aiba cel putin 14 caractere.';
							}
							if (strlen($_POST['contact_subject']) > 40) {
								$errors[] = 'Subiectul mesajului nu trebuie sa depaseasca 40 de caractere.';
							}
							if (empty($_POST['captcha_results']) === true) {
								$errors[] = 'Te rugam sa introduci captcha.';
							} else if ($_POST['captcha_results'] != $_POST['num1'] + $_POST['num2']) {
								$errors[] = "Raspunsul la captcha este incorect.";
							}
						} 
						if (empty($_POST) === false && empty($errors) === true) {
							contact_me($_POST['contact_subject'], $_POST['body']);
							header('Location: index.php?success');
							exit();
						} else if (empty($errors) === false) {
							echo "<div id='contact_errors'>". output_errors($errors) ."</div>";
						}
					?>
						<h1 id="contact">Contacteaza-ma</h1>
						<p>Ai o sugestie care ar putea imbunatati website-ul? Ai descoperit o eroare pe care vrei s-o raportezi? Oportunitati de afaceri?<br/> Super! Completeaza campurile de mai jos si te voi contacta cat de repede pot!</p>
						<form action="" method="post" id="contact_form">
							<input type="text" name="contact_name" placeholder="nume... *" id="name" maxlength="30">
							<input type="text" name="email" placeholder="email... *" id="email" maxlength="30">
							<input type="text" name="contact_subject" placeholder="subiect... *" id="contact_subject">
							<textarea name="body" placeholder="mesajul tau... *" id="textarea" maxlength="3220"></textarea><br/>
							<div id="contact_captcha"><?php create_captcha(); ?></div>
							<input type="submit" class="button" value="trimite" id="submit">
							<input type="reset" class="button" value="anuleaza" id="clear">
						</form>
			<?php   } ?>
				</div>
			</div>
		</div>
		<div id="footer_wrap">
			<footer id="footer">
				<div id="recom">
					<h1>Destinatii de vacanta populare</h1>
					<ul>
						<li><a href="recom.php" id="#">Italia</a></li>
						<li><a href="recom.php" id="#">Romania</a></li>
						<li><a href="recom.php" id="#">Alta</a></li>
						<li><a href="recom.php" id="#">Alta</a></li>
						<li><a href="recom.php" id="#">Alta</a></li>
						<li><a href="recom.php" id="#">Alta</a></li>
						<li><a href="recom.php" id="#">Alta</a></li>
					</ul>
				</div>
				<div id="recent_stories">
					<h1>Postari recente</h1>
					<p>Ne-am hotarat sa vizitam Italia in luna septembrie si pentru ca cel mai bun loc care descrie cultura acestei tari e Sicilia, am inceput sa cautam cazare si bilete de avion. <a href="/sites/worldtour/ro/public/blog.php">[Mai mult...]</a></p>
				</div>
				<div id="featured_location">
					<h1>Cea mai populara destinatie</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea sequi, magnam ipsa deleniti illo totam eum tempore, veniam suscipit! Eligendi, perspiciatis accusamus quisquam harum nesciunt dolor cumque, minima est ex. <a href="recom.php">[Mai mult...]</a></p>
				</div>
				<div class="social">
					<a href="https://www.facebook.com/vlad.pandichi"><img src="img/facebook.png" alt="facebook"></a>
					<a href="https://www.twitter.com"><img src="img/twitter.png" alt="twitter"></a>
					<a href="https://plus.google.com/"><img src="img/gplus.png" alt="google plus"></a>
					<a href="https://youtube.com"><img src="img/youtube.png" alt="youtube"></a>
				</div>
			</footer>
		</div>
	</div>
	<script type="text/javascript" src="scripts/scroll.js"></script>
</body>
</html>