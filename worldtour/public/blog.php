<?php error_reporting(E_ALL & ~E_NOTICE); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>worldtour | stories</title>
	<link rel="stylesheet" href="/sites/worldtour/public/styles/blog.css">
</head>
<body>
	<div id="body_wrap">
		<nav id="nav">
			<ul>
				<li><a href="recom.php">recommendations</a></li>
				<li><a href="index.php#contact">contact</a></li>
				<li><a href="login.php">log in</a></li>
				<li><a href="index.php">back to main page</a></li>
				<li><a href="/sites/worldtour/ro/public/blog.php">ro</a></li>
			</ul>
			<div id="logo"><a href="index.php"><img src="/sites/worldtour/public/img/provisory-logo.gif"></a></div>
		</nav>
		<div id="page_wrapper">
			<div id="page_content">
				<div id="google_translate_element"></div>
				<?php 
					include_once("db_connection.php");

					$sql = "SELECT * FROM blog ORDER BY id DESC";
					$result = mysqli_query($dbCon, $sql);

					while($row = mysqli_fetch_array($result)) {
						$title = $row['title'];
						$subtitle = $row['subtitle'];
						$content = $row['content'];
				?>
					<h1 class="headers"><?php echo $title; ?> <br> <small><?php echo $subtitle; ?></small></h1>
					<article><?php echo $content; ?></article>
					<hr class="artline">
				<?php  
					}
				?>
			</div>
		</div>
		<div id="footer_wrap">
			<footer id="footer">
				<div id="recent_stories">
					<h1>Recent stories</h1>
					<p>We decided to visit Italy in September and because the best place to describe the culture of this country is Sicily, we started to look for a place to stay and for plane tickets. <a href="/sites/worldtour/public/blog.php">[Read more...]</a></p>
				</div>
				<div id="featured_location">
					<h1>Featured location</h1>
					<p>What do Goethe, Alexander Dumas, Johannes Brahms, Gustav Klimt, D.H. Lawrence, Richard Wagner, Oscar Wilde, Truman Capote, John Steinbeck, Ingmar Bergmann, Francis Ford Coppola, Leonard Bergman, Marlene Dietrich, Greta Garbo, Federico Fellini, Cary Grant, Gregory Peck, Elisabeth Taylor and Woody Allen have in common? <a href="recom.php">[Read more...]</a></p>
				</div>
				<div class="social">
					<h1>Connect with us</h1>
					<a href="https://www.facebook.com/vlad.pandichi"><img src="/sites/worldtour/public/img/facebook.png" alt="facebook"></a>
					<a href="https://www.twitter.com"><img src="/sites/worldtour/public/img/twitter.png" alt="twitter"></a>
					<a href="https://plus.google.com/"><img src="/sites/worldtour/public/img/gplus.png" alt="google plus"></a>
					<a href="https://youtube.com"><img src="/sites/worldtour/public/img/youtube.png" alt="youtube"></a>
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