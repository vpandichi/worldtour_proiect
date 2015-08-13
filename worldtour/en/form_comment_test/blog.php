<?php 
	include('core/init.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>worldtour | stories</title>
	<link rel="stylesheet" href="styles/blog.css">
</head>
<body>
	<div id="body_wrap">
		<nav id="nav">
			<ul>
				<li><a href="recom.php">recommendations</a></li>
				<?php 
					if (logged_in() === true) {
						echo "<li><a href='includes/logout.php'>log out</a></li>";
						echo "<li><a href='login.php'>profile settings</a></li>";
					} else {
						echo "<li><a href='login.php'>log in</a></li>";
					}
				?>	
				<li><a href="../ro/blog.php">ro</a></li>
			</ul>
			<div id="logo"><a href="index.php"><img src="img/provisory-logo.gif"></a></div>
		</nav>
		<div id="page_wrapper">
			<div id="page_content">
				<div id="google_translate_element"></div>
				<?php 
					echo list_articles();
					if (logged_in() === true) {
						if (isset($_GET['success']) === true && empty($_GET['success']) === true) { // empty($_get['success']) previne introducerea de caractere in url dupa cuvantul 'success'. ex: change_pw.php?success=jasljd
							echo '<h3 class="contact_success">Your message has been successfully sent.</h3>';
						} else {
							if (empty($_POST) === false) {
								$required_fields = array('username', 'comment');
								foreach ($_POST as $key => $value) {
									if (empty($value) && in_array($key, $required_fields) === true) {	
										$errors[] = 'Fields marked with an asterisk are required';
										break 1; // breaks to foreach (if 1 error is found, we can't do anything else so there's no point for checking further)
									} 
								}
								if (strlen($_POST['username']) > 30) {
									$errors[] = 'username must be less than 30 characters long';
								}
								if (empty($_POST['captcha_results']) === true) {
									$errors[] = 'Please enter captcha.';
								} else if ($_POST['captcha_results'] != $_POST['num1'] + $_POST['num2']) {
									$errors[] = "Incorrect captcha.";
								}
							} 
							if (empty($_POST) === false && empty($errors) === true) {
								insert_article_comments(1, $_POST['username'], $_POST['comment']);
								header('Location: blog.php?success');
								exit();
							} else if (empty($errors) === false) {
								echo "<div id='contact_errors'>". output_errors($errors) ."</div>";
							}
					?>
					<form method='post' action='' class='comments_form'>
						<input type='text' name='username' placeholder='your name... *' id='name'>
						<textarea name='comment' id='textarea' placeholder='your comment... *' cols='30' rows='6'></textarea>
						<div class="captcha_num"><?php create_captcha(); ?></div>
					 	<input type='submit' name='submit' id='post' value='post'>
					</form>
				<?php 
						} 
					} 
				?>
			</div>
		</div>
		<div id="footer_wrap">
			<footer id="footer">
				<div id="recent_stories">
					<h1>Recent stories</h1>
					<p>We decided to visit Italy in September and because the best place to describe the culture of this country is Sicily, we started to look for a place to stay and for plane tickets. <a href="blog.php">[Read more...]</a></p>
				</div>
				<div id="featured_location">
					<h1>Featured location</h1>
					<p>What do Goethe, Alexander Dumas, Johannes Brahms, Gustav Klimt, D.H. Lawrence, Richard Wagner, Oscar Wilde, Truman Capote, John Steinbeck, Ingmar Bergmann, Francis Ford Coppola, Leonard Bergman, Marlene Dietrich, Greta Garbo, Federico Fellini, Cary Grant, Gregory Peck, Elisabeth Taylor and Woody Allen have in common? <a href="recom.php">[Read more...]</a></p>
				</div>
				<div class="social">
					<h1>Connect with us</h1>
					<a href="https://www.facebook.com/vlad.pandichi"><img src="img/facebook.png" alt="facebook"></a>
					<a href="https://www.twitter.com"><img src="img/twitter.png" alt="twitter"></a>
					<a href="https://plus.google.com/"><img src="img/gplus.png" alt="google plus"></a>
					<a href="https://youtube.com"><img src="img/youtube.png" alt="youtube"></a>
				</div>
			</footer>
		</div>
	</div>
	<script type="text/javascript">
		function googleTranslateElementInit() {
  			new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'af,ar,az,be,bg,bn,bs,ca,ceb,cs,cy,da,de,el,en,eo,es,et,eu,fa,fi,fr,ga,gl,gu,ha,hi,hmn,hr,ht,hu,hy,id,ig,is,it,iw,ja,jv,ka,kk,km,kn,ko,la,lo,lt,lv,mg,mi,mk,ml,mn,mr,ms,mt,my,nl,no,ny,pa,pl,pt,ru,si,sk,sl,so,sq,sr,su,sv,sw,ta,te,tg,th,tl,tr,uk,ur,uz,vi,yi,yo,zh-CN,zh-TW,zu', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
		}
	</script>
	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>