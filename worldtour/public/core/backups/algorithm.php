<?php  
include_once("db_connection.php");

$logged = false;

if($_COOKIE['c_user'] && $_COOKIE['c_salt']) {
	$cuser = mysqli_real_escape_string($dbCon, $_COOKIE['c_user']);
	$csalt = mysqli_real_escape_string($dbCon, $_COOKIE['c_salt']);

	$sql = "SELECT * FROM users WHERE salt = '$csalt'";
	$query = mysqli_query($dbCon, $sql);
	$user = mysqli_fetch_array($query);

	if($user != 0) {
		if(hash('sha512', $user['username']) == $cuser) {
			$logged = true;
		}
	}
}

?>