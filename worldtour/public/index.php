<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to worldtour! Your free touristic guide based on real experiences.</title>
	<link rel="stylesheet" href="/sites/worldtour/public/styles/main.css">
</head>
<body>
	<div id="body_wrap">
		<div id="lpage">
			<div id="logo"><img src="/sites/worldtour/public/img/provisory-logo.gif" alt="worldtour"></div>
			<video autoplay loop muted class="bgvideo" id="bgvideo">
				<source src="/sites/worldtour/public/img/lpage_video.mp4" type="video/mp4">
			</video>
			<nav id="nav">
				<ul>
					<li><a href="#" onclick="return false;" onmousedown="autoScrollTo('about');">about</a></li>
					<li><a href="#" onclick="return false;" onmousedown="autoScrollTo('recommendations');">recommendations</a></li>
					<li><a href="blog.php">blog</a></li>
					<li><a href="#" onclick="return false;" onmousedown="autoScrollTo('contact');">contact</a></li>
					<li><a href="login.php">log in</a></li>
					<li><a href="/sites/worldtour/ro/public/index.php">ro</a></li>
				</ul>
				<div id="dynamic_logo"></div>
			</nav>
		</div>
		<div id="dynamic_video"></div> 
		<div id="above_wraper"><img src="/sites/worldtour/public/img/boat.png" id="boat"></div>
		<div id="page_wrapper">
			<div id="page_content">
				<!-- <script type="text/javascript">for (var i = 0; i < 50; i++) {document.write("dummy content" + ' ' + i + "<br/>")};</script> -->
				<div id="about_content">
					<h1 id="about">About me</h1>
					<article>
						<img src="/sites/worldtour/public/img/aboutme.jpg" alt="">
							Hello! My name is Vlad, I am 23 years old, and I absolutely love travelling!
							Not having any travelling experience before, when I first started to travel 2 years ago 
							I was trying to find out as much as I can about the chosen location. 
							Whether touristic attractions, places to stay, where to eat, how much would it cost, where to go and where not to – these are questions we’re all asking ourselves when trying to plan our next trip. 
							Having a hard time finding all the information I needed in a single place, I have decided it’s time to build a community where all your questions have an answer, 
							based on user reviews from people who have been there themselves - be it Greece, Italy, or anywhere else on the globe.<br/>
						<a href="/sites/worldtour/public/blog.php">Share your traveling stories</a> with us and help improve the experience of our users worldwide! Knowledge is power. 
					</article>
					<h1 id="recommendations">Recommendations</h1>
					<div id="box1">
						<span class="location"><h4>Sicily</h4></span>
						<a href="/sites/worldtour/public/recom.php" class="view_more">View more</a>
					</div>
					<div id="box2">
						<span class="location"><h4>Iasi</h4></span>
						<a href="/sites/worldtour/public/recom.php" class="view_more">View more</a>
					</div>
					<div id="box3">
						<span class="location" id="last"><h4>Bran Castle</h4></span>
						<a href="/sites/worldtour/public/recom.php" class="view_more">View more</a>
					</div>
					<h1 id="contact">Contact me</h1>
					<p>Got any suggestions for improving the website? Have you spotted a bug that you want to report? Do you have a business inquiry?<br/> Great! Fill in the below form and I'll contact you as soon as I can !</p>
					<form action="" id="contact_form">
							<input type="text" name="name" placeholder="name... *" id="name" maxlength="30">
							<input type="text" name="email" placeholder="email... *" id="email" maxlength="30">
							<textarea name="comments" placeholder="your message... *" id="textarea" maxlength="3220"></textarea><br/>
							<input type="submit" class="button" value="Send!" id="submit">
							<input type="reset" class="button" value="Clear form" id="clear">
					</form>
				</div>
			</div>
		</div>
		<div id="footer_wrap">
			<footer id="footer">
				<div id="recom">
					<h1>Popular destinations</h1>
					<ul>
						<li><a href="/sites/worldtour/public/recom.php" id="#">Italy</a></li>
						<li><a href="/sites/worldtour/public/recom.php" id="#">Romania</a></li>
						<li><a href="/sites/worldtour/public/recom.php" id="#">Iceland</a></li>
						<li><a href="/sites/worldtour/public/recom.php" id="#">Iceland</a></li>
						<li><a href="/sites/worldtour/public/recom.php" id="#">Iceland</a></li>
						<li><a href="/sites/worldtour/public/recom.php" id="#">Iceland</a></li>
						<li><a href="/sites/worldtour/public/recom.php" id="#">Iceland</a></li>
					</ul>
				</div>
				<div id="recent_stories">
					<h1>Recent stories</h1>
					<p>We decided to visit Italy in September and because the best place to describe the culture of this country is Sicily, we started to look for a place to stay and for plane tickets. <a href="/sites/worldtour/public/blog.php">[Read more...]</a></p>
				</div>
				<div id="featured_location">
					<h1>Featured location</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea sequi, magnam ipsa deleniti illo totam eum tempore, veniam suscipit! Eligendi, perspiciatis accusamus quisquam harum nesciunt dolor cumque, minima est ex. <a href="recom.php">[Read more...]</a></p>
				</div>
				<div class="social">
					<a href="https://www.facebook.com/vlad.pandichi"><img src="/sites/worldtour/public/img/facebook.png" alt="facebook"></a>
					<a href="https://www.twitter.com"><img src="/sites/worldtour/public/img/twitter.png" alt="twitter"></a>
					<a href="https://plus.google.com/"><img src="/sites/worldtour/public/img/gplus.png" alt="google plus"></a>
					<a href="https://youtube.com"><img src="/sites/worldtour/public/img/youtube.png" alt="youtube"></a>
				</div>
			</footer>
		</div>
	</div>
	<script type="text/javascript" src="/sites/worldtour/public/scripts/scroll.js"></script>
</body>
</html>