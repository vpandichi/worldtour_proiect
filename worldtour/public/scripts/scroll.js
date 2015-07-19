function yScroll() {
	var video = document.getElementById('bgvideo');
	var logo = document.getElementById('logo');
	var dynamic_logo = document.getElementById('dynamic_logo');
	var dynamicSlider = document.getElementById('dynamic_video');
	var nav = document.getElementById('nav');
	var ypos = window.pageYOffset; // keeps track of the scrollbar's position
	var navNode1 = nav.childNodes[1]; // getting a hold of the li elements in the navigation parent - first child is a #text node, do not use
	var boat = document.getElementById('boat');
	
	// console.log(ypos);

	switch (ypos < 5) {
		case true: 
			dynamicSlider.innerHTML = '<video autoplay loop muted><source src="/sites/worldtour/public/img/dynamic_video2.mp4" type="video/mp4"></video>';
			break;
		case false: break;
	}

	switch (ypos > 1) {
		case true:
			logo.style.display = "none"; // remove the landing page logo
			dynamic_logo.innerHTML = "<img src='/sites/worldtour/public/img/provisory-logo.gif'>";
			nav.style.marginTop = "-0.3%";
			nav.style.padding = "32px";
			nav.style.backgroundColor = "#fff";
			nav.style.position = "fixed";
			nav.style.width = "96%";
			nav.style.borderBottom = "2px solid #67b700";

			// dynamically generated styles for the new layout once the scroll event gets triggered
			navNode1.childNodes[1].firstChild.style.color = "#235fa5";
			navNode1.childNodes[3].firstChild.style.color = "#235fa5";
			navNode1.childNodes[5].firstChild.style.color = "#235fa5";
			navNode1.childNodes[7].firstChild.style.color = "#235fa5";
			navNode1.childNodes[9].firstChild.style.color = "#235fa5";
			navNode1.childNodes[11].firstChild.style.color = "#235fa5";

		    navNode1.childNodes[1].firstChild.onmouseover = function() {
		    	navNode1.childNodes[1].firstChild.style.transition = "0.5s";
		   	 	navNode1.childNodes[1].firstChild.style.color = "#70be12";
		    	navNode1.childNodes[1].firstChild.style.borderTop = "3.5px solid #70be12";
		    }

			navNode1.childNodes[3].firstChild.onmouseover = function() {
				navNode1.childNodes[3].firstChild.style.transition = "0.5s";
				navNode1.childNodes[3].firstChild.style.color = "#70be12";
				navNode1.childNodes[3].firstChild.style.borderTop = "3.5px solid #70be12";
			}

			navNode1.childNodes[5].firstChild.onmouseover = function() {
				navNode1.childNodes[5].firstChild.style.transition = "0.5s";
				navNode1.childNodes[5].firstChild.style.color = "#70be12";
				navNode1.childNodes[5].firstChild.style.borderTop = "3.5px solid #70be12";
			}

			navNode1.childNodes[7].firstChild.onmouseover = function() {
				navNode1.childNodes[7].firstChild.style.transition = "0.5s";
				navNode1.childNodes[7].firstChild.style.color = "#70be12";
				navNode1.childNodes[7].firstChild.style.borderTop = "3.5px solid #70be12";
			}

			navNode1.childNodes[9].firstChild.onmouseover = function() {
				navNode1.childNodes[9].firstChild.style.transition = "0.5s";
				navNode1.childNodes[9].firstChild.style.color = "#70be12";
				navNode1.childNodes[9].firstChild.style.borderTop = "3.5px solid #70be12";
			}
			
			navNode1.childNodes[11].firstChild.onmouseover = function() {
				navNode1.childNodes[11].firstChild.style.transition = "0.5s";
				navNode1.childNodes[11].firstChild.style.color = "#70be12";
				navNode1.childNodes[11].firstChild.style.borderTop = "3.5px solid #70be12";
			}
			
			navNode1.childNodes[1].firstChild.onmouseleave = function() {
				navNode1.childNodes[1].firstChild.style.color = "#235fa5";
				navNode1.childNodes[1].firstChild.style.borderTop = "none";
			}
			
			navNode1.childNodes[3].firstChild.onmouseleave = function() {
				navNode1.childNodes[3].firstChild.style.color = "#235fa5";
				navNode1.childNodes[3].firstChild.style.borderTop = "none";
			}
			
			navNode1.childNodes[5].firstChild.onmouseleave = function() {
				navNode1.childNodes[5].firstChild.style.color = "#235fa5";
				navNode1.childNodes[5].firstChild.style.borderTop = "none";
			}
			
			navNode1.childNodes[7].firstChild.onmouseleave = function() {
				navNode1.childNodes[7].firstChild.style.color = "#235fa5";
				navNode1.childNodes[7].firstChild.style.borderTop = "none";
			}
			
			navNode1.childNodes[9].firstChild.onmouseleave = function() {
				navNode1.childNodes[9].firstChild.style.color = "#235fa5";
				navNode1.childNodes[9].firstChild.style.borderTop = "none";
			}
			
			navNode1.childNodes[11].firstChild.onmouseleave = function() {
				navNode1.childNodes[11].firstChild.style.color = "#235fa5";
				navNode1.childNodes[11].firstChild.style.borderTop = "none";
			} // the onmouseover and onmouse leave functions are responsible for the navigation effects after layout transition (dynamically generated)
		  
			video.style.display = "none"; 
		    // page_wrapper.style.opacity = "0.5"; - implement a fade-in effect later
		    break;
		case false: break; // also need to add back the lpage styles so when this is false it will go back to the landing page
	} // end of main switch statement

	switch (ypos > 5 && ypos < 700) {
		case true: 
			boat.style.visibility = "visible";
			boat.style.paddingLeft = ypos + 1 + "px";
			break;
		case false:
			boat.style.visibility = "hidden"; 
			break;	
	}
}

window.addEventListener("scroll", yScroll);
