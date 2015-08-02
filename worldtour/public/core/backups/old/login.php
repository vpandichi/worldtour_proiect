<?php 
	session_start();
	error_reporting(E_ALL & ~E_NOTICE);
	include_once("db_connection.php"); 
	
	if($_POST['register']) {

		if($_POST['username'] && $_POST['email'] && $_POST['password'] && $_POST['country'] && $_POST['squestion'] && $_POST['sanswer']) { // pentru a rula comenzile de mai jos, toate acesta campuri sunt necesare si nu pot fi lasate necompletate

			$username = mysqli_real_escape_string($dbCon, $_POST['username']); // folosim real escape string pentru a elimina vulnerabilitatea la caractere speciale (ex /)
			$email = mysqli_real_escape_string($dbCon, $_POST['email']);
			$country = $_POST['country']; // nu e nevoie de real escape string deoarece utilizatorul are o lista predefinita de optiuni
			$squestion = mysqli_real_escape_string($dbCon, $_POST['squestion']);
			$sanswer = mysqli_real_escape_string($dbCon, $_POST['sanswer']);
			
			$inputPassword = mysqli_real_escape_string($dbCon, $_POST['password']);
			$options = ['cost' => 9,]; // comanda folosita pentru a codifica parola, un cost mai mare va necesita o putere de calcul mai mare a calculatorului care incearca sa descifreze codificarea
			$hashedPassword = password_hash($inputPassword, PASSWORD_BCRYPT, $options); //PASSWORD_BCRYPT foloseste algoritmul blowfish
		
			$sqlcheck = "SELECT * FROM users WHERE username = '$username'"; // dorim sa verificam daca userul exista in baza noastra de date pentru a evita duplicatele
			$query = mysqli_query($dbCon, $sqlcheck); // stocam interogarea intr-o variabila pentru a o putea folosi in mysqli_fetch_array deoarece aceasta metoda accepta doar 1 singur parametru
			$check = mysqli_fetch_array($query);

			if ($check != 0) {
				die("<h3>Username already exists! Try $username" . rand(0, 99) . " instead. <a href='login.php'>go back to registration page</a></h3>");
			} // daca userul exista, nu il vom crea. evitam duplicatele

			if (!ctype_alnum($username)) {
				die("<h3>Special characters such as spaces, #, @, ! etc. are not allowed. <a href='login.php'>go back to registration page</a></h3>");
			} // daca numele de utilizator contine simboluri sau caractere interzise nu-i vom permite inregistrarea in baza de date din motive de securitate

			if(strlen($username) > 32) {
				die("<h3>username must be less than 32 characters! <a href='login.php'>go back to registration page</a></h3>");
			} // daca numele de utilizator are mai mult de 32 de caracter vom refuza inregistrarea 

			if(strlen($inputPassword) < 5) {
				die("<h3>Password must be more than 5 characters! <a href='login.php'>go back to registration page</a></h3>");
			}

			$sqlinsert = "INSERT INTO users (username, email, password, country, squestion, sanswer) 
			              VALUES ('$username', '$email', '$hashedPassword', '$country', '$squestion', '$sanswer')"; // adaugam userul in baza de date
			mysqli_query($dbCon, $sqlinsert); // adaugam userul in baza de date daca a trecut de verificarile anterioare

			die("<h3 class='loregheaders'>Your account has been created. <br><a href='/sites/worldtour/public/users.php'>Go to the users area to create a blog post</a> or <a href='/sites/worldtour/public/index.php'>go back to the main page</a></h3>");
		}
	}

	// begin login script

	if($_POST['login']) {
		if($_POST['username'] && $_POST['password']) {
			
			$username = mysqli_real_escape_string($dbCon, $_POST['username']);
			$inputPassword = mysqli_real_escape_string($dbCon, $_POST['password']);
			$sql = "SELECT * FROM users WHERE username = '$username'";
			$result = mysqli_query($dbCon, $sql);
			$row = $result->fetch_array(MYSQLI_BOTH);

			if(password_verify($inputPassword, $row['password'])) {
				if(password_verify($inputPassword, $row['password']) && $username == "superuser") {
					session_start();
					$_SESSION['id'] = $row['id'];
					$_SESSION['username'] = $username;
					header('Location: admin.php');
				} else {
					session_start();
					$_SESSION['id'] = $row['id'];
					$_SESSION['username'] = $username;
					header('Location: user.php');
				}
			}

			$query = mysqli_query($dbCon, $sql);
			$user = mysqli_fetch_array($query);

			if($user == 0 || $user['password'] != $password) {
				die("<h3 class='denied'>username and/or password incorrect. <br><a href='/sites/worldtour/public/login.php'>go back to the login page.</a></h3>");
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>worldtour | login</title>
	<link rel="stylesheet" href="/sites/worldtour/public/styles/login.css">
</head>
<body>
	<div id="body_wrap">
		<nav id="nav">
			<ul>
				<li><a href="recom.php">recommendations</a></li>
				<li><a href="blog.php">blog</a></li>
				<li><a href="index.php#contact">contact</a></li>
				<li><a href="login.php">log in</a></li>
				<li><a href="index.php">back to main page</a></li>
				<li><a href="/sites/worldtour/ro/public/login.php">ro</a></li>
			</ul>
			<div id="logo"><a href="index.php"><img src="/sites/worldtour/public/img/provisory-logo.gif"></a></div>
		</nav>
		<div id="login_box">
			<h1 class="loreg">Log in</h1>
				<form action='login.php' method='post' id='contact_form'>
					<input type='text' name='username' placeholder='username... *' id='email' maxlength='60'><br>
					<input type='password' name='password' placeholder='password... *' id='password' maxlength='30'><br>
					<input type='submit' name='login' class='button' value='log in' id='login' >
					<input type='reset' name='reset' class='button' value='cancel' id='cancel'>
				</form>
		</div>
		<div id="register_box">
			<h1 class="loreg">Register to post articles</h1>
			<form action="" method="post" id="contact_form">
				<input type="text" name="username" placeholder="username... *" id="username" maxlength="60"><br>
				<input type="text" name="email" placeholder="email... *" id="email" maxlength="60"><br>
				<input type="password" name="password" placeholder="password... *" id="password" maxlength="30"><br>
				<input type="password" name="verify_password" placeholder="password check... *" id="password2" maxlength="30"><br>
				<select name="country" id="country">
					<option value="DEF">select country... * </option>
					<option value="AF">Afghanistan</option>
					<option value="AX">Åland Islands</option>
					<option value="AL">Albania</option>
					<option value="DZ">Algeria</option>
					<option value="AS">American Samoa</option>
					<option value="AD">Andorra</option>
					<option value="AO">Angola</option>
					<option value="AI">Anguilla</option>
					<option value="AQ">Antarctica</option>
					<option value="AG">Antigua and Barbuda</option>
					<option value="AR">Argentina</option>
					<option value="AM">Armenia</option>
					<option value="AW">Aruba</option>
					<option value="AU">Australia</option>
					<option value="AT">Austria</option>
					<option value="AZ">Azerbaijan</option>
					<option value="BS">Bahamas</option>
					<option value="BH">Bahrain</option>
					<option value="BD">Bangladesh</option>
					<option value="BB">Barbados</option>
					<option value="BY">Belarus</option>
					<option value="BE">Belgium</option>
					<option value="BZ">Belize</option>
					<option value="BJ">Benin</option>
					<option value="BM">Bermuda</option>
					<option value="BT">Bhutan</option>
					<option value="BO">Bolivia, Plurinational State of</option>
					<option value="BQ">Bonaire, Sint Eustatius and Saba</option>
					<option value="BA">Bosnia and Herzegovina</option>
					<option value="BW">Botswana</option>
					<option value="BV">Bouvet Island</option>
					<option value="BR">Brazil</option>
					<option value="IO">British Indian Ocean Territory</option>
					<option value="BN">Brunei Darussalam</option>
					<option value="BG">Bulgaria</option>
					<option value="BF">Burkina Faso</option>
					<option value="BI">Burundi</option>
					<option value="KH">Cambodia</option>
					<option value="CM">Cameroon</option>
					<option value="CA">Canada</option>
					<option value="CV">Cape Verde</option>
					<option value="KY">Cayman Islands</option>
					<option value="CF">Central African Republic</option>
					<option value="TD">Chad</option>
					<option value="CL">Chile</option>
					<option value="CN">China</option>
					<option value="CX">Christmas Island</option>
					<option value="CC">Cocos (Keeling) Islands</option>
					<option value="CO">Colombia</option>
					<option value="KM">Comoros</option>
					<option value="CG">Congo</option>
					<option value="CD">Congo, the Democratic Republic of the</option>
					<option value="CK">Cook Islands</option>
					<option value="CR">Costa Rica</option>
					<option value="CI">Côte d'Ivoire</option>
					<option value="HR">Croatia</option>
					<option value="CU">Cuba</option>
					<option value="CW">Curaçao</option>
					<option value="CY">Cyprus</option>
					<option value="CZ">Czech Republic</option>
					<option value="DK">Denmark</option>
					<option value="DJ">Djibouti</option>
					<option value="DM">Dominica</option>
					<option value="DO">Dominican Republic</option>
					<option value="EC">Ecuador</option>
					<option value="EG">Egypt</option>
					<option value="SV">El Salvador</option>
					<option value="GQ">Equatorial Guinea</option>
					<option value="ER">Eritrea</option>
					<option value="EE">Estonia</option>
					<option value="ET">Ethiopia</option>
					<option value="FK">Falkland Islands (Malvinas)</option>
					<option value="FO">Faroe Islands</option>
					<option value="FJ">Fiji</option>
					<option value="FI">Finland</option>
					<option value="FR">France</option>
					<option value="GF">French Guiana</option>
					<option value="PF">French Polynesia</option>
					<option value="TF">French Southern Territories</option>
					<option value="GA">Gabon</option>
					<option value="GM">Gambia</option>
					<option value="GE">Georgia</option>
					<option value="DE">Germany</option>
					<option value="GH">Ghana</option>
					<option value="GI">Gibraltar</option>
					<option value="GR">Greece</option>
					<option value="GL">Greenland</option>
					<option value="GD">Grenada</option>
					<option value="GP">Guadeloupe</option>
					<option value="GU">Guam</option>
					<option value="GT">Guatemala</option>
					<option value="GG">Guernsey</option>
					<option value="GN">Guinea</option>
					<option value="GW">Guinea-Bissau</option>
					<option value="GY">Guyana</option>
					<option value="HT">Haiti</option>
					<option value="HM">Heard Island and McDonald Islands</option>
					<option value="VA">Holy See (Vatican City State)</option>
					<option value="HN">Honduras</option>
					<option value="HK">Hong Kong</option>
					<option value="HU">Hungary</option>
					<option value="IS">Iceland</option>
					<option value="IN">India</option>
					<option value="ID">Indonesia</option>
					<option value="IR">Iran, Islamic Republic of</option>
					<option value="IQ">Iraq</option>
					<option value="IE">Ireland</option>
					<option value="IM">Isle of Man</option>
					<option value="IL">Israel</option>
					<option value="IT">Italy</option>
					<option value="JM">Jamaica</option>
					<option value="JP">Japan</option>
					<option value="JE">Jersey</option>
					<option value="JO">Jordan</option>
					<option value="KZ">Kazakhstan</option>
					<option value="KE">Kenya</option>
					<option value="KI">Kiribati</option>
					<option value="KP">Korea, Democratic People's Republic of</option>
					<option value="KR">Korea, Republic of</option>
					<option value="KW">Kuwait</option>
					<option value="KG">Kyrgyzstan</option>
					<option value="LA">Lao People's Democratic Republic</option>
					<option value="LV">Latvia</option>
					<option value="LB">Lebanon</option>
					<option value="LS">Lesotho</option>
					<option value="LR">Liberia</option>
					<option value="LY">Libya</option>
					<option value="LI">Liechtenstein</option>
					<option value="LT">Lithuania</option>
					<option value="LU">Luxembourg</option>
					<option value="MO">Macao</option>
					<option value="MK">Macedonia, the former Yugoslav Republic of</option>
					<option value="MG">Madagascar</option>
					<option value="MW">Malawi</option>
					<option value="MY">Malaysia</option>
					<option value="MV">Maldives</option>
					<option value="ML">Mali</option>
					<option value="MT">Malta</option>
					<option value="MH">Marshall Islands</option>
					<option value="MQ">Martinique</option>
					<option value="MR">Mauritania</option>
					<option value="MU">Mauritius</option>
					<option value="YT">Mayotte</option>
					<option value="MX">Mexico</option>
					<option value="FM">Micronesia, Federated States of</option>
					<option value="MD">Moldova, Republic of</option>
					<option value="MC">Monaco</option>
					<option value="MN">Mongolia</option>
					<option value="ME">Montenegro</option>
					<option value="MS">Montserrat</option>
					<option value="MA">Morocco</option>
					<option value="MZ">Mozambique</option>
					<option value="MM">Myanmar</option>
					<option value="NA">Namibia</option>
					<option value="NR">Nauru</option>
					<option value="NP">Nepal</option>
					<option value="NL">Netherlands</option>
					<option value="NC">New Caledonia</option>
					<option value="NZ">New Zealand</option>
					<option value="NI">Nicaragua</option>
					<option value="NE">Niger</option>
					<option value="NG">Nigeria</option>
					<option value="NU">Niue</option>
					<option value="NF">Norfolk Island</option>
					<option value="MP">Northern Mariana Islands</option>
					<option value="NO">Norway</option>
					<option value="OM">Oman</option>
					<option value="PK">Pakistan</option>
					<option value="PW">Palau</option>
					<option value="PS">Palestinian Territory, Occupied</option>
					<option value="PA">Panama</option>
					<option value="PG">Papua New Guinea</option>
					<option value="PY">Paraguay</option>
					<option value="PE">Peru</option>
					<option value="PH">Philippines</option>
					<option value="PN">Pitcairn</option>
					<option value="PL">Poland</option>
					<option value="PT">Portugal</option>
					<option value="PR">Puerto Rico</option>
					<option value="QA">Qatar</option>
					<option value="RE">Réunion</option>
					<option value="RO">Romania</option>
					<option value="RU">Russian Federation</option>
					<option value="RW">Rwanda</option>
					<option value="BL">Saint Barthélemy</option>
					<option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
					<option value="KN">Saint Kitts and Nevis</option>
					<option value="LC">Saint Lucia</option>
					<option value="MF">Saint Martin (French part)</option>
					<option value="PM">Saint Pierre and Miquelon</option>
					<option value="VC">Saint Vincent and the Grenadines</option>
					<option value="WS">Samoa</option>
					<option value="SM">San Marino</option>
					<option value="ST">Sao Tome and Principe</option>
					<option value="SA">Saudi Arabia</option>
					<option value="SN">Senegal</option>
					<option value="RS">Serbia</option>
					<option value="SC">Seychelles</option>
					<option value="SL">Sierra Leone</option>
					<option value="SG">Singapore</option>
					<option value="SX">Sint Maarten (Dutch part)</option>
					<option value="SK">Slovakia</option>
					<option value="SI">Slovenia</option>
					<option value="SB">Solomon Islands</option>
					<option value="SO">Somalia</option>
					<option value="ZA">South Africa</option>
					<option value="GS">South Georgia and the South Sandwich Islands</option>
					<option value="SS">South Sudan</option>
					<option value="ES">Spain</option>
					<option value="LK">Sri Lanka</option>
					<option value="SD">Sudan</option>
					<option value="SR">Suriname</option>
					<option value="SJ">Svalbard and Jan Mayen</option>
					<option value="SZ">Swaziland</option>
					<option value="SE">Sweden</option>
					<option value="CH">Switzerland</option>
					<option value="SY">Syrian Arab Republic</option>
					<option value="TW">Taiwan, Province of China</option>
					<option value="TJ">Tajikistan</option>
					<option value="TZ">Tanzania, United Republic of</option>
					<option value="TH">Thailand</option>
					<option value="TL">Timor-Leste</option>
					<option value="TG">Togo</option>
					<option value="TK">Tokelau</option>
					<option value="TO">Tonga</option>
					<option value="TT">Trinidad and Tobago</option>
					<option value="TN">Tunisia</option>
					<option value="TR">Turkey</option>
					<option value="TM">Turkmenistan</option>
					<option value="TC">Turks and Caicos Islands</option>
					<option value="TV">Tuvalu</option>
					<option value="UG">Uganda</option>
					<option value="UA">Ukraine</option>
					<option value="AE">United Arab Emirates</option>
					<option value="GB">United Kingdom</option>
					<option value="US">United States</option>
					<option value="UM">United States Minor Outlying Islands</option>
					<option value="UY">Uruguay</option>
					<option value="UZ">Uzbekistan</option>
					<option value="VU">Vanuatu</option>
					<option value="VE">Venezuela, Bolivarian Republic of</option>
					<option value="VN">Viet Nam</option>
					<option value="VG">Virgin Islands, British</option>
					<option value="VI">Virgin Islands, U.S.</option>
					<option value="WF">Wallis and Futuna</option>
					<option value="EH">Western Sahara</option>
					<option value="YE">Yemen</option>
					<option value="ZM">Zambia</option>
					<option value="ZW">Zimbabwe</option>
				</select>
				<input type="text" name="squestion" id="squestion" placeholder="secret question... *">
				<input type="text" name="sanswer" id="sanswer" placeholder="secret answer... *"><br>
				<input type="submit" name="register" class="button" value="register" id="register">
				<input type="reset" class="button" value="clear all" id="clear">
			</form>
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
</body>
</html>