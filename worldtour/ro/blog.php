<?php 
	include('core/init.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>worldtour | blog</title>
	<link rel="stylesheet" href="styles/blog.css">
</head>
<body>
	<div id="body_wrap">
		<nav id="nav">
			<ul>
				<li><a href="recom.php">recomandari</a></li>
				<?php 
					if (logged_in() === true) {
						echo "<li><a href='includes/logout.php'>delogare</a></li>";
						echo "<li><a href='login.php'>setari profil</a></li>";
					} else {
						echo "<li><a href='login.php'>logare</a></li>";
						echo "<li><a href='register.php'>inregistrare</a></li>";
					}
				?>	
				<li><a href="../en/blog.php">en</a></li>
			</ul>
			<div id="logo"><a href="index.php"><img src="img/provisory-logo.gif"></a></div>
		</nav>
		<div id="page_wrapper">
			<div id="page_content">
				<div id="google_translate_element"></div>
				<?php 
					echo list_articles(get_articles($dbCon));
					if (logged_in() === true) {
						if (empty($_POST) === false) {
							$required_fields = array('comments', 'username');
							foreach ($_POST as $key => $value) {
								if (empty($value) && in_array($key, $required_fields) === true) {	
									$errors[] = 'Campurile marcate cu * sunt obligatorii';
									break 1;
								}
							} 
							if ($_POST['username'] != $user_data['username']) {
								$errors[] = 'Nu poti posta sub un alt nume de utilizator';
							}
							if (empty($_POST['captcha_results']) === true) {
								$errors[] = 'Te rugam sa introduci captcha.';
							} else if ($_POST['captcha_results'] != $_POST['num1'] + $_POST['num2']) {
								$errors[] = "Raspunsul la captcha este incorect.";
							}
						} 
						if (empty($_POST) === false && empty($errors) === true) {
								insert_comments($_POST['comments'], $_POST['username'], $_POST['blog_id']);
						} else if (empty($errors) === false) {
							echo "<div id='blog_comment_errors'>" . output_errors($errors) . "</div>";
						}
					}
				?>
			</div>
		</div>
		<div id="footer_wrap">
			<footer id="footer">
				<div id="recent_stories">
					<h1>Postari recente</h1>
					<p>Ne-am hotarat sa vizitam Italia in luna septembrie si pentru ca cel mai bun loc care descrie cultura acestei tari e Sicilia, am inceput sa cautam cazare si bilete de avion. <a href="/sites/worldtour/ro/public/blog.php">[Citeste mai mult...]</a></p>
				</div>
				<div id="featured_location">
					<h1>Cea mai populara locatie de luna aceasta</h1>
					<p>Ce au in comun Goethe, Alexander Dumas, Johannes Brahms, Gustav Klimt, D.H. Lawrence, Richard Wagner, Oscar Wilde, Truman Capote, John Steinbeck, Ingmar Bergmann, Francis Ford Coppola, Leonard Bergman, Marlene Dietrich, Greta Garbo, Federico Fellini, Cary Grant, Gregory Peck, Elisabeth Taylor and Woody Allen? <a href="recom.php">[Citeste mai mult...]</a></p>
				</div>
				<div class="social">
					<h1>Fii la curent cu ultimele noutati</h1>
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
  			new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'af,ar,az,be,bg,bn,bs,ca,ceb,cs,cy,da,de,el,en,eo,es,et,eu,fa,fi,fr,ga,gl,gu,ha,hi,hmn,hr,ht,hu,hy,id,ig,is,it,iw,ja,jv,ka,kk,km,kn,ko,la,lo,lt,lv,mg,mi,mk,ml,mn,mr,ms,mt,my,nl,no,ny,pa,pl,pt,ru,ro,si,sk,sl,so,sq,sr,su,sv,sw,ta,te,tg,th,tl,tr,uk,ur,uz,vi,yi,yo,zh-CN,zh-TW,zu', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
		}
	</script>
	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>