var target = document.getElementById('article');
var hidden_article = document.getElementById('hidden_article');
var vless = hidden_article.childNodes[1];
var rmore = target.childNodes[3];

vless.onclick = function() {
	hidden_article.style.display = "none";
	rmore.style.display = "inline";
}

rmore.onclick = function() {
	hidden_article.style.display = "inline";
	rmore.style.display = "none";
}

var target1 = document.getElementById('article1');
var hidden_article1 = document.getElementById('hidden_article1');
var vless1 = hidden_article1.childNodes[7];
var rmore1 = target1.childNodes[3];

vless1.onclick = function() {
	hidden_article1.style.display = "none";
	rmore1.style.display = "inline";
}

rmore1.onclick = function() {
	hidden_article1.style.display = "inline";
	rmore1.style.display = "none";
}

var target2 = document.getElementById('article2');
var hidden_article2 = document.getElementById('hidden_article2');
var vless2 = hidden_article2.childNodes[7];
var rmore2 = target2.childNodes[3];

vless2.onclick = function() {
	hidden_article2.style.display = "none";
	rmore2.style.display = "inline";
}

rmore2.onclick = function() {
	hidden_article2.style.display = "inline";
	rmore2.style.display = "none";
}

var scrollY = 0;
var distance = 185;
var speed = 50;

function autoScrollTo(el) {
	var currentY = window.pageYOffset;
	var targetY = document.getElementById(el).offsetTop;
	var bodyHeight = document.body.offsetHeight;
	var yPos = currentY + window.innerHeight;
	var animator = setTimeout('autoScrollTo(\''+el+'\')', speed);
	if (yPos > bodyHeight) {
		clearTimeout(animator);
	} else {
		if (currentY < targetY-distance) {
			scrollY = currentY + distance;
			window.scroll(0, scrollY);
		} else {
			clearTimeout(animator);
		}
	}
}



