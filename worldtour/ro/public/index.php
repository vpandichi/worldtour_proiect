<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bine ati venit pe worldtour! Ghidul tau turistic online - recomandari si articole bazate pe experiente reale.</title>
	<link rel="stylesheet" href="/sites/worldtour/ro/public/styles/main.css">
</head>
<body>
	<div id="body_wrap">
		<div id="lpage">
			<div id="logo"><img src="/sites/worldtour/ro/public/img/provisory-logo.gif" alt="worldtour"></div>
			<video autoplay loop muted class="bgvideo" id="bgvideo">
				<source src="/sites/worldtour/ro/public/img/lpage_video.mp4" type="video/mp4">
			</video>
			<nav id="nav">
				<ul>
					<li><a href="#about">despre mine</a></li>
					<li><a href="#recommendations">recomandari</a></li>
					<li><a href="/sites/worldtour/ro/public/stories.php">articole</a></li>
					<li><a href="#contact">contact</a></li>
					<li><a href="/sites/worldtour/ro/public/login.php">logare</a></li>
					<li><a href="/sites/worldtour/public/index.php">en</a></li>
				</ul>
				<div id="dynamic_logo"></div>
			</nav>
		</div>
		<div id="dynamic_video"></div> 
		<div id="above_wraper"><img src="/sites/worldtour/ro/public/img/boat.png" id="boat"></div>
		<div id="page_wrapper">
			<div id="page_content">
				<!-- <script type="text/javascript">for (var i = 0; i < 50; i++) {document.write("dummy content" + ' ' + i + "<br/>")};</script> -->
				<div id="about_content">
					<h1 id="about">Despre mine</h1>
					<article>
						<img src="/sites/worldtour/ro/public/img/aboutme.jpg" alt="">
							Salut! Numele meu este Vlad, am 23 de ani si sunt pasionat de calatorii si turism.
							Neavand prea multa experienta in trecut, cand am inceput sa calatoresc acum doi ani,
							adeseori m-am gasit in ipostaza de a incerca sa aflu cat mai multe despre locul in care vreau sa ajung.
							Atractii turistice, unde sa te cazezi, unde sa mananci, cat te va costa, unde sa mergi si unde nu - intrebari pe care le avem cu totii in momentul in care ne planificam viitoarea calatorie. 
							La prima vedere, aceste intrebari par simple si cu siguranta vei gasi un raspuns dupa cateva ore de cautare. Adeseori informatiile pe care le cauti nu se regasesc intr-un singur loc, acest lucru conducand la ore bune petrecute in fata calculatorului pentru ati aduna materialul necesar. Date fiind aceste lucruri, am decis ca este timpul sa creez un website, o comunitate unde toate intrebarile tale au un raspuns
							bazat pe experientele reale ale oamenilor care au fost acolo; fie ca planuiesti o calatorie in Italia, Grecia, sau oriunde altundeva pe glob. <br/>
						<a href="/sites/worldtour/ro/public/stories.php">Imparte cu noi</a> aventurile tale din calatorii si ajuta-ne sa imbunatatim experienta utilizatorilor nostri din intreaga lume !
					</article>
					<h1 id="recommendations">Recomandari</h1>
					<div id="box1">
						<span class="location"><h4>Sicilia</h4></span>
						<a href="/sites/worldtour/ro/public/recom.php" class="view_more">Mai mult</a>
					</div>
					<div id="box2">
						<span class="location"><h4>Iasi</h4></span>
						<a href="/sites/worldtour/ro/public/recom.php" class="view_more">Mai mult</a>
					</div>
					<div id="box3">
						<span class="location" id="last"><h4>Castelul Bran</h4></span>
						<a href="/sites/worldtour/ro/public/recom.php" class="view_more">Mai mult</a>
					</div>
					<h1 id="contact">Contacteaza-ma</h1>
					<p>Ai o sugestie care ar putea imbunatati website-ul? Ai descoperit o eroare pe care vrei s-o raportezi? Oportunitati de afaceri?<br/> Super! Completeaza campurile de mai jos si te voi contacta cat de repede pot!</p>
					<form action="submit.php" id="contact_form">
							<input type="text" name="name" placeholder="nume... *" id="name" maxlength="30">
							<input type="text" name="email" placeholder="adresa email... *" id="email" maxlength="30">
							<textarea name="comments" placeholder="mesajul tau... *" id="textarea" maxlength="3220"></textarea><br/>
							<input type="submit" class="button" value="trimite!" id="submit">
							<input type="reset" class="button" value="sterge tot" id="clear">
					</form>
				</div>
			</div>
		</div>
		<div id="footer_wrap">
			<footer id="footer">
				<div id="recom">
					<h1>Locatii populare</h1>
					<ul>
						<li><a href="/sites/worldtour/ro/public/recom.php" id="#">Italy</a></li>
						<li><a href="/sites/worldtour/ro/public/recom.php" id="#">Romania</a></li>
						<li><a href="/sites/worldtour/ro/public/recom.php" id="#">Iceland</a></li>
						<li><a href="/sites/worldtour/ro/public/recom.php" id="#">Iceland</a></li>
						<li><a href="/sites/worldtour/ro/public/recom.php" id="#">Iceland</a></li>
						<li><a href="/sites/worldtour/ro/public/recom.php" id="#">Iceland</a></li>
						<li><a href="/sites/worldtour/ro/public/recom.php" id="#">Iceland</a></li>
					</ul>
				</div>
				<div id="recent_stories">
					<h1>Articole recente</h1>
					<p>Ne-am hotarat sa vizitam Italia in luna septembrie si pentru ca cel mai bun loc care descrie cultura acestei tari e Sicilia, am inceput sa cautam cazare si bilete de avion. <a href="/sites/worldtour/ro/public/stories.php">[Mai mult...]</a></p>
				</div>
				<div id="featured_location">
					<h1>Locatia lunii</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea sequi, magnam ipsa deleniti illo totam eum tempore, veniam suscipit! Eligendi, perspiciatis accusamus quisquam harum nesciunt dolor cumque, minima est ex. <a href="recom.php">[Mai mult...]</a></p>
				</div>
				<div class="social">
					<a href="https://www.facebook.com/vlad.pandichi"><img src="/sites/worldtour/ro/public/img/facebook.png" alt="facebook"></a>
					<a href="https://www.twitter.com"><img src="/sites/worldtour/ro/public/img/twitter.png" alt="twitter"></a>
					<a href="https://plus.google.com/"><img src="/sites/worldtour/ro/public/img/gplus.png" alt="google plus"></a>
					<a href="https://youtube.com"><img src="/sites/worldtour/ro/public/img/youtube.png" alt="youtube"></a>
				</div>
			</footer>
		</div>
	</div>
	<script type="text/javascript" src="/sites/worldtour/ro/public/scripts/scroll.js"></script>
</body>
</html>