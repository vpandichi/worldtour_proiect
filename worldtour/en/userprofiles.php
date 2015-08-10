<?php 
	include('core/init.php'); 

	if (isset($_GET['username']) === true && empty($_GET['username']) === false) {
		$username = $_GET['username'];
		if (user_exists($username) === true) {
			$user_id = get_user_id($username);
			$profile_data = user_data($user_id, 'first_name', 'last_name', 'email');
		?>
			<h3><?php echo $profile_data['first_name']; ?>'s profile</h3>
		<?php
		} else {
			echo 'Sorry, that user does not exist!';
		}
	} else {
		header('Location: index.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to worldtour! Your free touristic guide based on real experiences.</title>
	<link rel="stylesheet" href="styles/profiles.css">
</head>

<!-- <body>
	<div id="body_wrap">
		<nav id="nav">
			<ul>
				<li><a href="recom.php">recommendations</a></li>
				<li><a href="blog.php">blog</a></li>
				<li><a href="index.php#contact">contact</a></li>
				<li><a href='includes/logout.php'>log out</a></li>
				<li><a href='login.php'>profile settings</a></li>
				<li><a href="/sites/worldtour/ro/public/login.php">ro</a></li>
			</ul>
			<div id="logo"><a href="index.php"><img src="/sites/worldtour/public/img/provisory-logo.gif"></a></div>
		</nav> -->
<!-- <div class="profile">
	<?php 
		// if (isset($_FILES['profile']) === true) {
		// 	if (empty($_FILES['profile']['name']) === true) {
		// 		$errors[] = "Please choose a file";
		// 	} else {
		// 		$allowed = array('jpg', 'jpeg', 'gif', 'png');

		// 		$file_name = $_FILES['profile']['name'];
		// 		$file_ext = strtolower(end(explode('.', $file_name))); // takes the last element of the array
		// 		$file_temp = $_FILES['profile']['tmp_name'];

		// 		if (in_array($file_ext, $allowed) === true) {
		// 			change_profile_image($session_user_id, $file_temp, $file_ext);
		// 		} else {
		// 			$errors[] = "Incorrect file type. We only allow jpg/jpeg/gif or png formats.";
		// 		}
		// 	} 
		// } 
		// if (empty($user_data['profile']) === false) {
		// 	echo '<img src="', $user_data['profile'], '" alt="">';
		// } 
	?>
	<h4 class="updateacc_profile_pic">Update your profile picture...</h4>
	<form action="" method="post" enctype="multipart/form-data" id="upload_img_form">
		<input type="file" name="profile" id="profile_pic_select">
		<input type="submit" id="upload_pic" value="upload">
	</form>
</div> -->
<?php include('includes/footer.php');  ?>
