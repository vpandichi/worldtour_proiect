<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to worldtour! Your free touristic guide based on real stories.</title>
	<link rel="stylesheet" href="/sites/worldtour/public/styles/main.css">
</head>
<body>
	<div id="wrapper">
		<div id="lpage">
			<div id="logo"><img src="/sites/worldtour/public/img/provisory-logo.gif" alt="worldtour"></div>
			<video autoplay loop muted class="bgvideo" id="bgvideo">
				<source src="/sites/worldtour/public/img/slideshow.mp4" type="video/mp4">
			</video>
			<nav id="nav">
				<ul>
					<li><a href="#about">about</a></li>
					<li><a href="#recommendations">recommendations</a></li>
					<li><a href="#stories">stories</a></li>
					<li><a href="contact.php">contact</a></li>
					<li><a href="login.php">log in</a></li>
					<li><a href="lang.php">ro</a></li>
				</ul>
				<div id="dynamic_logo"></div>
			</nav>
		</div>
		<div id="dynamic_video"></div> 
		<div id="page_wrapper">
			<div id="page_content">
				<script type="text/javascript">for (var i = 0; i < 50; i++) {document.write("Dummy content" + i + "<br/>" )}</script>
				<a href="#about">Test</a>
			</div>
		</div>
		<div id="footer_wrap">
			<footer id="footer"></footer>
		</div>
	</div>
	<script type="text/javascript" src="/sites/worldtour/public/scripts/scroll.js"></script>
</body>
</html>