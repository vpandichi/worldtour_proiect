function yScroll() {
	var video = document.getElementById('bgvideo');
	var logo = document.getElementById('logo');
	var dynamic_logo = document.getElementById('dynamic_logo');
	var dynamicSlider = document.getElementById('dynamic_video');
	var nav = document.getElementById('nav');
	var ypos = window.pageYOffset; // keeps track of the scrollbar's position
	var navNode1 = nav.childNodes[1]; // getting a hold of the li elements in the navigation parent - first child is a #text node, do not use

	if (ypos > 1 && ypos < 7) {
		logo.style.display = "none"; // remove the landing page logo
		dynamic_logo.innerHTML = "<img src='/sites/worldtour/public/img/provisory-logo.gif'>";
		nav.style.marginTop = "0%";
		nav.style.backgroundColor = "#fff";
		nav.style.position = "fixed";
		nav.style.width = "96%";
		nav.style.borderBottom = "2px solid #f00"; // need to change color once I have the color scheme selected - these are all test colors atm

		// dynamically generated styles for the new layout once the scroll event gets triggered
		navNode1.childNodes[1].firstChild.style.color = "#001801";
		navNode1.childNodes[3].firstChild.style.color = "#001801";
		navNode1.childNodes[5].firstChild.style.color = "#001801";
		navNode1.childNodes[7].firstChild.style.color = "#001801";
		navNode1.childNodes[9].firstChild.style.color = "#001801";
		navNode1.childNodes[11].firstChild.style.color = "#001801";

		navNode1.childNodes[1].firstChild.onmouseover = function() {
			navNode1.childNodes[1].firstChild.style.transition = "0.5s";
			navNode1.childNodes[1].firstChild.style.color = "#f00";
			navNode1.childNodes[1].firstChild.style.borderTop = "3.5px solid #f00";
		}

		navNode1.childNodes[3].firstChild.onmouseover = function() {
			navNode1.childNodes[3].firstChild.style.transition = "0.5s";
			navNode1.childNodes[3].firstChild.style.color = "#f00";
			navNode1.childNodes[3].firstChild.style.borderTop = "3.5px solid #f00";
		}

		navNode1.childNodes[5].firstChild.onmouseover = function() {
			navNode1.childNodes[5].firstChild.style.transition = "0.5s";
			navNode1.childNodes[5].firstChild.style.color = "#f00";
			navNode1.childNodes[5].firstChild.style.borderTop = "3.5px solid #f00";
		}

		navNode1.childNodes[7].firstChild.onmouseover = function() {
			navNode1.childNodes[7].firstChild.style.transition = "0.5s";
			navNode1.childNodes[7].firstChild.style.color = "#f00";
			navNode1.childNodes[7].firstChild.style.borderTop = "3.5px solid #f00";
		}

		navNode1.childNodes[9].firstChild.onmouseover = function() {
			navNode1.childNodes[9].firstChild.style.transition = "0.5s";
			navNode1.childNodes[9].firstChild.style.color = "#f00";
			navNode1.childNodes[9].firstChild.style.borderTop = "3.5px solid #f00";
		}

		navNode1.childNodes[11].firstChild.onmouseover = function() {
			navNode1.childNodes[11].firstChild.style.transition = "0.5s";
			navNode1.childNodes[11].firstChild.style.color = "#f00";
			navNode1.childNodes[11].firstChild.style.borderTop = "3.5px solid #f00";
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
		} // the onmouseover and onmouse leave functions are responsible for the navigation effects after layout transition (dynamically generated)
		  // end navigation styles
		video.style.visibility = "hidden"; // making the landing page video not visible after we trigger the scroll event
		dynamicSlider.innerHTML = '<video autoplay loop muted><source src="/sites/worldtour/public/img/dynamic_slideshow.mp4" type="video/mp4"></video>';
	} else {
		// return landing page
	}
}

window.addEventListener("scroll", yScroll);