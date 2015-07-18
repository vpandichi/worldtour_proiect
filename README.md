# worldtour_proiect
1. Created provisory landing page
2. Ammended landing page and created javascript event listeners on scroll to dynamically change the display of the page
3. Fixed navigation and video bugs when being dynamically generated, added navigation effects
4. Fixed logo bug
5. Switched from a slideshow based landing page to a video based lpage, also changed the dynamic page's slideshow to a video. Modified lpage nav color. Added a banner below the actual page content starts.
6. Switched from if statements to switch statements as these are better fitted for my needs. Improved color scheme, removed red banner, changed to a blue gradient that fits the theme, created about me content. Added dynamic image in the banner area that changes position as you scroll. Changed scrollbar CSS for chrome.
7. Fixed boat bug overlapping navigation (needed z-index property)
8. Fixed major page bug - when clicking on the about link on the landing page it would scroll to the relevant content but wouldn't load the dynamic styles as it would normally when scrolling (needed to remove the && ypos < 7 condition as this caused the switch statement to always be false, therefore not firing the dynamic styles)

TO DO FOR TOMORROW 16/07: - fix logo not displaying on the nav bar after being dynamically generated; (might be a problem with the HTML positioning of the divs) - ok
                          - pick a def. color scheme - current red/green - debugging colors; - x
                          - create the about us page - x

TO DO FOR TOMORROW 17/07: - fix slider bug. The navigation becomes inactive when the video/image is behind it - it probably has to do with the fact that it has a position of static. Need to investigate. 
                          - fixed (it was the image covering the nav buttons, needed to adjust height/margin-top)
                          - pick a color scheme as I've only been using colors for testing until now - partially ok, needs adjustments
                          - pick a navigation color scheme for the landing page - only test colors 'til now - ok, needs small adjustments
                          - create content for the about page - x
                          
TO DO FOR TOMORROW 18/07: - improve color scheme - ok (decided upon blue/green and if needed yellow)
                          - create content for the about page - ok (created about me content)
                          - design the about page wraper - ok - this is going to be white (will consider changing this to light blue, not needed now)
                          - design the page layout wraper - ok - this is going to be a blue gradient with a width of 100%
                          