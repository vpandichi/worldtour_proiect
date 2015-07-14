function yScroll() {
	var video = document.getElementById('bgvideo');
	var logo = document.getElementById('logo');
	var dynamicSlider = document.getElementById('dynamic');
	var nav = document.getElementById('nav');
	var ypos = window.pageYOffset; // inregistreaza in timp real pozitia barei de scroll
	var navNode1 = nav.childNodes[1];

	if (ypos > 1) {
		logo.innerHTML = "<img src='/sites/worldtour/public/img/insertanotherimage!'>";

		nav.style.marginTop = "-4%";
		nav.style.backgroundColor = "#fff";

		//stiluri event-listeners navigatie -->
		navNode1.childNodes[1].firstChild.style.color = "#001801";
		navNode1.childNodes[3].firstChild.style.color = "#001801";
		navNode1.childNodes[5].firstChild.style.color = "#001801";
		navNode1.childNodes[7].firstChild.style.color = "#001801";
		navNode1.childNodes[9].firstChild.style.color = "#001801";
		navNode1.childNodes[11].firstChild.style.color = "#001801";

		navNode1.childNodes[1].firstChild.onmouseover = function() {
			navNode1.childNodes[1].firstChild.style.color = "#f00";
			navNode1.childNodes[1].firstChild.style.borderTop = "3px solid #f00";
		}

		navNode1.childNodes[3].firstChild.onmouseover = function() {
			navNode1.childNodes[3].firstChild.style.color = "#f00";
			navNode1.childNodes[3].firstChild.style.borderTop = "3px solid #f00";
		}

		navNode1.childNodes[5].firstChild.onmouseover = function() {
			navNode1.childNodes[5].firstChild.style.color = "#f00";
			navNode1.childNodes[5].firstChild.style.borderTop = "3px solid #f00";
		}

		navNode1.childNodes[7].firstChild.onmouseover = function() {
			navNode1.childNodes[7].firstChild.style.color = "#f00";
			navNode1.childNodes[7].firstChild.style.borderTop = "3px solid #f00";
		}

		navNode1.childNodes[9].firstChild.onmouseover = function() {
			navNode1.childNodes[9].firstChild.style.color = "#f00";
			navNode1.childNodes[9].firstChild.style.borderTop = "3px solid #f00";
		}

		navNode1.childNodes[11].firstChild.onmouseover = function() {
			navNode1.childNodes[11].firstChild.style.color = "#f00";
			navNode1.childNodes[11].firstChild.style.borderTop = "3px solid #f00";
		}

		navNode1.childNodes[1].firstChild.onmouseleave = function() {
			navNode1.childNodes[1].firstChild.style.color = "#001801";
			navNode1.childNodes[1].firstChild.style.borderTop = "none";
		}

		navNode1.childNodes[3].firstChild.onmouseleave = function() {
			navNode1.childNodes[3].firstChild.style.color = "#001801";
			navNode1.childNodes[3].firstChild.style.borderTop = "none";
		}

		navNode1.childNodes[5].firstChild.onmouseleave = function() {
			navNode1.childNodes[5].firstChild.style.color = "#001801";
			navNode1.childNodes[5].firstChild.style.borderTop = "none";
		}

		navNode1.childNodes[7].firstChild.onmouseleave = function() {
			navNode1.childNodes[7].firstChild.style.color = "#001801";
			navNode1.childNodes[7].firstChild.style.borderTop = "none";
		}

		navNode1.childNodes[9].firstChild.onmouseleave = function() {
			navNode1.childNodes[9].firstChild.style.color = "#001801";
			navNode1.childNodes[9].firstChild.style.borderTop = "none";
		}

		navNode1.childNodes[11].firstChild.onmouseleave = function() {
			navNode1.childNodes[11].firstChild.style.color = "#001801";
			navNode1.childNodes[11].firstChild.style.borderTop = "none";
		}

		video.style.display = "none";
		dynamicSlider.innerHTML = '<video autoplay loop muted><source src="/sites/worldtour/public/img/dynamic_slideshow.mp4" type="video/mp4"></video>';
	} 
}

window.addEventListener("scroll", yScroll);