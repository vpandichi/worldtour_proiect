<?php  

function change_password($user_id, $password) { // 
	include('core/db/db_connection.php');
	$user_id = (int)$user_id; // chiar daca nu este direct input, vom lua o masura de precautie asigurandu-ne ca variabila user_id poate contine doar numere intregi
	$password = md5($password); 
	$sql = "UPDATE `_users` SET `password` = '$password' WHERE `user_id` = $user_id";
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

function register_user($register_data) { // inregistram userul in baza de date
	include('core/db/db_connection.php');
	array_walk($register_data, 'array_sanitize');
	$register_data['password'] = md5($register_data['password']);
	$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
	$data = '\'' . implode('\', \'', $register_data) . '\'';
	$sql = "INSERT INTO `_users` ($fields) VALUES ($data)";
	// echo $sql; testing the query
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
		$sql = "SELECT $fields FROM `_users` where user_id = $user_id";
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

function login($username, $password) { 
	include('core/db/db_connection.php');
	$user_id = get_user_id($username);
	$username = sanitize($username);
	$password = md5($password); 
	$sql = "SELECT COUNT(user_id) FROM `_users` WHERE username = '$username' AND password = '$password'";
	$query = mysqli_query($dbCon, $sql);
	return (mysqli_result($query, 0) == 1) ? $user_id : false;
}

?>