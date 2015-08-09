# worldtour_proiect
1. Created provisory landing page
2. Ammended landing page and created javascript event listeners on scroll to dynamically change the display of the page
3. Fixed navigation and video bugs when being dynamically generated, added navigation effects
4. Fixed logo bug
5. Switched from a slideshow based landing page to a video based lpage, also changed the dynamic page's slideshow to a video. Modified lpage nav color. Added a banner below the actual page content starts.
6. Switched from if statements to switch statements as these are better fitted for my needs. Improved color scheme, removed red banner, changed to a blue gradient that fits the theme, created about me content. Added dynamic image in the banner area that changes position as you scroll. Changed scrollbar CSS for chrome.
7. Fixed boat bug overlapping navigation (needed z-index property)
8. Fixed major page bug - when clicking on the about link on the landing page it would scroll to the relevant content but wouldn't load the dynamic styles as it would normally when scrolling (needed to remove the && ypos < 7 condition as this caused the switch statement to always be false, therefore not firing the dynamic styles)
9. Designed about me area and added content, designed recommendations area and added content, designed contact form, designed footer area
10. Created provisory footer content
11. Amended footer style and content. Created design of recommendations page, added provisory content.
12. 90% of recommendations page completed, created design and added content. Added read more / view less buttons.
13. Finished recommendations page, created content for stories page, amended footer area for all pages.
14. Worked on the stories page's design, 60% done, (focused on login page)  - created login page, design and content.
15. Created the ro version of the website - 90% done.
16. Finished the ro version of the website, added translation for every language on the stories/articles page, improved css code.
17. Added scroll effects
18. Created admin page, added blog posts database
19. Fixed admin page bug, created registration page.
20. Created login page for db users. Stuck on password encryption. Cannot read encrypted passwords after the user has registered. Cannot log in user as the hash/salt changes at every attempt and it will never match the one on the database. Need to work out a solution tomorrow.
21. Managed to find a provisory solution which seems to work - password_hash and password_verify seem to solve the issue, further testing required.
22. Fixed admin page bug where unauthorised access was allowed to unauthenticated users. Created various validation rules
23. Admin page broke again... managed to find a temporary fix, though very sloppy code. Separated admin area from user area, added various rules and minor improvements.
24. AFTER HAVING MANY ISSUES WITH THE LOGIN/REGISTER PAGE WHICH WILL TAKE TOO MUCH TIME TO FIGURE OUT (ALREADY SPENT 3 DAYS ON IT) I HAVE DECIDED TO REORGANIZE THE WHOLE STRUCTURE OF THE WEBSITE AND SEPARATE THE LOGIN PAGE FROM THE REGISTRATION PAGE. ALSO, HAVING A VERY MESSY SYNTAX I HAVE DECIDED TO REWRITE EVERYTHING THAT IS PHP RELATED, FROM SCRATCH.
25. Rewrote login system and registration page, now adding features for logged in users such as change password.
25. Created login system and registration page, adding change password feature. Code is getting big, need to start commenting it out 
26. Created mailing system from localhost using PHPMailer. Now users can activate their account after registering if they follow the email containing the activation link.
27. Created htaccess file, profile settings page and provisory user profile page
28. Created the possibility to recover lost passwords and forgotten usernames via email. I have decided not to focus on the user's profile at this moment as there is a lot of DB functionality left to cover.
29. Created admin account page and database. Added user flags against accounts so we can change privileges. Started working on a mass email feature
30. Finished the mass email feature for admins
31. Added more admin page functionality (delete active/inactive users), recoded blog page which is now fetching data from the database more efficiently
32. Created the possibility to post blog articles for registered users. Created simple math captcha functions to implement with forms.
33. Implemented captcha where necessary, coded contact form.

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

TO DO FOR TOMORROW 19/07: - design the about page text - ok
                          - create the recommendations page, design and content - ok 
                          - design contact form - ok
                          - design footeer and add footer content - x
                          
TO DO FOR TOMORROW 20/07: - finish the footer area - ok 
                          - design the recommendations page and content - partially ok, only provisory content atm
                          - design the stories page and content, add content - x
                          - design the log in page -x 

TO DO FOR TOMORROW 21/07: - finish the recommendations page - 90%
                          - design the stories page, content and style - x

TO DO FOR TOMORROW 22/07: - finish the recommendations page - ok
                          - design the stories page, content and style - content only

TO DO FOR TOMORROW 23/07: - finish the design of the stories page - 60%
                          - create the log in page - ok
                          - create the ro version of the website - x
                          
TO DO FOR TOMORROW 24/07: - finish the design of the stories page - x
                          - clear html/css code, make it reusable, remove duplicates - x
                          - create the ro version of the website - 90% done
                          - work on scroll javascript effects - x

TO DO FOR TOMORROW 25/07: - finish the design of the stories page - x (we'll leave it for later)
                          - finish the ro version of the website - ok
                          - work on javascript scroll effects - x 
                          - improve code - ok
                          
TO DO FOR TOMORROW 26/07: - work on javascript scroll effects - ok
                          - create database - created blog database

TO DO FOR TOMORROW 27/07: - create registration page - ok
                          - fix admin page bug - ok
                          
TO DO FOR TOMORROW 28/07: - improve login page, allow users to log in (not only admin log in) -x
                          - improve registration page - x
                          - add user management to the admin page -x 

TO DO FOR TOMORROW 29/07: - fix password encryption and login bug - ok

TO DO FOR TOMORROW 30/07: - improve the login system - ok
                          - fix admin page bug .. again.. - ok - needed to destroy the session to avoid allowing access to unauthorised users (if they directly entered the file path in the url, skipping the log in)
                          - create a separate user area - x
                          
TO DO FOR TOMORROW 31/07: - create a separate user area - ok
                          - create an admin area - ok
                          - create user management for admin area - x
                          - recode everything for the ro version of the site - created the login page
                          
TO DO FOR TOMORROW 01/08: - recode everything for the ro version - x 
                          - create user management for admin area - x
                          - improve ro/user area - fix post bug - x
                          - style everything that's being dynamically generated on the page with PHP - x
                          - think of a way to add the a "posted by" feature on the blog page - x

TO DO FOR TOMORROW 02/08: - finish recoding the login page - ok
                          - recode the registration page - ok
                          - fix loggedin page pug - ok
                          
TO DO FOR TOMORROW 03/08: - create the possibility to email users - ok
                          - create the possibility to activate accounts by email - ok
                          
TO DO FOR TOMORROW 04/08: - create profile settings page - ok
                          - create users profile page - 50%

TO DO FOR TOMORROW 05/08: - fix vanity bug - ok
                          - finish the users profile page - x
                          - create the posibility to recover forgotten usernames - ok 
                          - create the posibility to recover forgotten passwords - ok
                          - create the admin account - x
                          
TO DO FOR TOMORROW 06/08: - create the admin account - ok

TO DO FOR TOMORROW 07/08: - finish mass email feature - ok
                          - admin account features (delete users, etc) - x
                        
TO DO FOR TOMORROW 08/08: - work on user profile page - added upload picture functionality but there are a lot of bugs, will put it on hold for now
                          - work on admin account features - ok
                          - make everything work with the /ro version of the website - x
                          
TO DO FOR TOMORROW 09/08: - see if I can add a picture option for user-posted articles - not a priority
                          - implement captcha on admin page for the form used to email users  - ok
                          - implement article comments - x
                          - recode everything for the ro page
                    
                          