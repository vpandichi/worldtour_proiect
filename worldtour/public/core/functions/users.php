<?php  

function user_exists($username) {
	include('core/db/db_connection.php');
	$username = sanitize($username);
	$sql = "SELECT COUNT(user_id) FROM `_users` WHERE username = '$username'";
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

function get_user_id($username) {
	include('core/db/db_connection.php');
	$username = sanitize($username);
	$sql = "SELECT user_id FROM `_users` WHERE username = '$username'";
	$query = mysqli_query($dbCon, $sql);
	return (mysqli_result($query, 0, 'user_id'));
}

function login($username, $password) {
	include('core/db/db_connection.php');
	$sql = "SELECT COUNT(user_id) FROM `_users` WHERE username = '$username' AND password = '$password'";
	$query = mysqli_query($dbCon, $sql);
	$user_id = get_user_id($username);
	$username = sanitize($username);
	$password = md5($password);
	return (mysqli_result($query, 0) == 1) ? $user_id : false;
}

?>