<?php  

function email_users($subject, $body) {
    include('core/db/db_connection.php');
    $sql = "SELECT email, first_name FROM `_users` WHERE allow_email = 1";
    $query = mysqli_query($dbCon, $sql);
    while (($row = mysqli_fetch_assoc($query)) !== false) {
        email($row['email'], $subject, "Hello ". $row['first_name'] . ", <br><br>" . $body);
        header('Location: email_users.php?success');
    }
}

// function change_profile_image($user_id, $file_temp, $file_ext) {
//     include('core/db/db_connection.php');
// 	$file_path = 'img/profiles/' . substr(md5(time()), 0, 10) . '.' . $file_ext; // take current time, encrypt it then change it to a 10 character figure
// 	move_uploaded_file($file_temp, $file_path);
// 	$sql = "UPDATE `_users` SET profile = '" . $file_path . "' WHERE user_id = " . (int)$user_id;
// 	mysqli_query($dbCon, $sql);
// }

function display_users() {
    include('core/db/db_connection.php');
	$sql = "SELECT user_id, username, first_name, email FROM `_users` WHERE active = 1";
	$query = mysqli_query($dbCon, $sql);
	while($user = mysqli_fetch_assoc($query)) {
    	echo "<tr class='even'>";
    	echo "<td>" . $user['username'] . "</td>";
    	echo "<td>" . $user['first_name'] . "</td>";
    	echo "<td>" . $user['email'] . "</td>";
    	echo "</tr>";
	}
}

function display_inactive_users() {
    include('core/db/db_connection.php');
	$sql = "SELECT user_id, username, first_name, email FROM `_users` WHERE active = 0";
	$query = mysqli_query($dbCon, $sql);
	while($user = mysqli_fetch_assoc($query)) {
    	echo "<tr class='even'>";
    	echo "<td>" . $user['username'] . "</td>";
    	echo "<td>" . $user['first_name'] . "</td>";
    	echo "<td>" . $user['email'] . "</td>";
    	echo "</tr>";
	}
}

function delete_user($username) { 
	include('core/db/db_connection.php');
	$sql = "DELETE FROM `_users` WHERE `username` = '$username' AND active = 1";
	mysqli_query($dbCon, $sql);
}

function delete_inactive_user($username) { 
	include('core/db/db_connection.php');
	$sql = "DELETE FROM `_users` WHERE `username` = '$username' AND active = 0";
	mysqli_query($dbCon, $sql);
}

function recover($mode, $email) {
	include('core/db/db_connection.php');
	$mode = sanitize($mode);
	$email = sanitize($email);

	$user_data = user_data(get_user_id_from_email($email), 'user_id', 'first_name', 'username');

	if ($mode == 'username') {
		email($email, 'Your username', "
				Hello " . $user_data['first_name'] . ", <br><br>
				Your username is " . $user_data['username'] ." <br><br>
				-worldtour team
			");
	} else if ($mode == 'password') {
		$generated_password = substr(md5(rand(777, 7777)), 0, 7); 
		change_password($user_data['user_id'], $generated_password);
		update_user($user_data['user_id'], array('pwd_recovery' => '1'));
		email($email, 'Password recovery', "
				Hello " . $user_data['first_name'] . ", <br><br>
				Your new password is " . $generated_password."<br><br>
				Kindly note that this is a temporary password and you are required to change it on your first log in. <br><br>
				-worldtour team
			");
	}
}

function activate($email, $email_code) {
	include('core/db/db_connection.php');
	$email = mysqli_real_escape_string($dbCon, $email);
	$email_code = mysqli_real_escape_string($dbCon, $email_code);
	$sql = "SELECT COUNT(user_id) FROM `_users` WHERE email = '$email' AND email_code = '$email_code'";
	$query = mysqli_query($dbCon, $sql);

	if (mysqli_result($query, 0) == 1) {
		$update_sql = "UPDATE `_users` SET active = 1 WHERE email = '$email'";
		mysqli_query($dbCon, $update_sql);
		return true;
	} else {
		return false;
	}
}

function change_password($user_id, $password) { // 
	include('core/db/db_connection.php');
	$user_id = (int)$user_id; // chiar daca nu este direct input, vom lua o masura de precautie asigurandu-ne ca variabila user_id poate contine doar numere intregi
	$password = md5($password); 
	$sql = "UPDATE `_users` SET `password` = '$password', `pwd_recovery` = 0 WHERE `user_id` = $user_id";
	$query = mysqli_query($dbCon, $sql); // interogam baza de date
}

function logged_in_redirect() { // daca userul incearca sa acceseze o pagina irelevanta dupa ce s-a logat (ex: pagina de inregistrare) - il vom redirectiona 
	if (logged_in() === true)
	header('Location: index.php');
} 

function not_logged_in_redirect() { 
	if (logged_in() !== true) {
		header('Location: index.php');
	}
}

function register_user($register_data) { // adaugam userul in baza de date
	include('core/db/db_connection.php');
	array_walk($register_data, 'array_sanitize');
	$register_data['password'] = md5($register_data['password']);
	$fields = '`' . implode('`, `', array_keys($register_data)) . '`'; // pregatim interogarea adaugand `` fiecarui cap de tabel
	$data = '\'' . implode('\', \'', $register_data) . '\''; // pregatim interogarea adaugand '' variabilelor care contin informatii precum numele de utilizator, parola, email, etc.
	$sql = "INSERT INTO `_users` ($fields) VALUES ($data)";
	// echo $sql; testing the query
	// die();
	$query = mysqli_query($dbCon, $sql);
	email($register_data['email'], 'Activate your account', "
		Hello " . $register_data['first_name'] . ",<br><br>

		Please follow the below link to activate your account and be allowed access to post articles, and much more: <br><br>". 

		"http://localhost/sites/worldtour/public/activate.php?email=" . $register_data['email'] . "&email_code=".$register_data['email_code']." <br><br>

		-worldtour team
	
		");
}

function update_user($user_id, $update_data) { 
	include('core/db/db_connection.php');
	array_walk($update_data, 'array_sanitize');
	$update = array();
	foreach ($update_data as $field => $data) {
		$update[] = '`' . $field . '` = \'' . $data . '\'';
	}
	$sql = "UPDATE `_users` SET " . implode(', ', $update) . " WHERE `user_id` = " . $user_id;
	// print_r($sql);
	// die();
	$query = mysqli_query($dbCon, $sql);
}

function user_data($user_id) {
	$data = array();
	$user_id = (int)$user_id;

	$func_num_args = func_num_args();
	$func_get_args = func_get_args();

	if ($func_num_args > 1) {
		include('core/db/db_connection.php');
		unset($func_get_args[0]);
		$fields = '`' . implode('`, `', $func_get_args) . '`';
		$sql = "SELECT $fields FROM `_users` WHERE user_id = $user_id";
		$data = mysqli_query($dbCon, $sql);
		$fetch_data = mysqli_fetch_assoc($data);
		// print_r($fetch_data);
		return $fetch_data;
	}
}

function logged_in() { // verificam daca userul este logat
	return (isset($_SESSION['user_id'])) ? true : false;
} 

function user_exists($username) { // verificam daca exista userul in baza de date
	include('core/db/db_connection.php');
	$username = sanitize($username);
	$sql = "SELECT COUNT(user_id) FROM `_users` WHERE username = '$username'";
	$query = mysqli_query($dbCon, $sql);
	return (mysqli_result($query, 0) == 1) ? true : false;
}

function email_exists($email) {
	include('core/db/db_connection.php');
	$email = sanitize($email);
	$sql = "SELECT COUNT(user_id) FROM `_users` WHERE email = '$email'";
	$query = mysqli_query($dbCon, $sql);
	return (mysqli_result($query, 0) == 1) ? true : false;
}

function id_exists($user_id) {
	include('core/db/db_connection.php');
	$user_id = (int)$user_id;
	$sql = "SELECT COUNT(user_id) FROM `_users` WHERE user_id = '$user_id'";
	$query = mysqli_query($dbCon, $sql);
	return (mysqli_result($query, 0) == 1) ? true : false;
}

function user_active($username) {
	include('core/db/db_connection.php');
	$username = sanitize($username);
	$sql = "SELECT COUNT(user_id) FROM `_users` WHERE username = '$username' AND active = 1";
	$query = mysqli_query($dbCon, $sql);
	return (mysqli_result($query, 0) == 1) ? true : false;
}

function get_user_id($username) { //
	include('core/db/db_connection.php');
	$username = sanitize($username);
	$sql = "SELECT user_id FROM `_users` WHERE username = '$username'";
	$query = mysqli_query($dbCon, $sql);
	return (mysqli_result($query, 0, 'user_id'));
}

function get_user_id_from_email($email) { //
	include('core/db/db_connection.php');
	$email = sanitize($email);
	$sql = "SELECT user_id FROM `_users` WHERE email = '$email'";
	$query = mysqli_query($dbCon, $sql);
	return (mysqli_result($query, 0, 'user_id'));
}

function login($username, $password) { 
	include('core/db/db_connection.php');
	$user_id = get_user_id($username);
	$username = sanitize($username);
	$password = md5($password); 
	$sql = "SELECT COUNT(user_id) FROM `_users` WHERE username = '$username' AND password = '$password'";
	$query = mysqli_query($dbCon, $sql);
	return (mysqli_result($query, 0) == 1) ? $user_id : false;
}

function superuser($user_id, $type) {
	include('core/db/db_connection.php');
	$user_id = (int)$user_id;
	$type = (int)$type;
	$sql = "SELECT COUNT(user_id) FROM `_users` WHERE user_id = '$user_id' AND type = '$type'";
	$query = mysqli_query($dbCon, $sql);
	return (mysqli_result($query, 0) == 1) ? true : false;
}

function post_article($title, $content) {
	include('core/db/db_connection.php');
	$title = mysqli_real_escape_string($dbCon, $subject);
	$content = mysqli_real_escape_string($dbCon, $content);
	$sql = "INSERT INTO `blog` (title, content) VALUE ('$title', '$content')";
}

function list_articles() {
	include('core/db/db_connection.php');
	$sql = "SELECT * FROM blog ORDER BY id DESC";
	$result = mysqli_query($dbCon, $sql);
	while ($row = mysqli_fetch_array($result)) {
		echo 
			"<h1 class='content_headers'>" . $title = $row['title'] . "</h1>" . 
			"<article>" . $content = $row['content'] . "</article>" .
			"<hr class='artline'>";
	}
}

?>