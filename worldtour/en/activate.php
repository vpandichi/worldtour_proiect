<?php  
	include('core/init.php'); 
	logged_in_redirect();

	if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
	?>
		<h4 class="activated_scsfly">Your account has been activated successfully. Please <a href="login.php">log in</a></h4>
	<?php  
	} else if (isset($_GET['email'], $_GET['email_code']) === true) {
		$email = trim($_GET['email']);
		$email_code = trim($_GET['email_code']);

		if (email_exists($email) === false) {
			$errors[] = 'We couldn\'t find that email address.';
		} else if (activate($email, $email_code) === false) {
			$errors[] = 'We had problems activating your account.';
		}

		if (empty($errors) === false) {
			echo output_errors($errors);
		} else {
			header('Location: activate.php?success');
			exit();
		}
	} else {
		header ('Location: index.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to worldtour! Your free touristic guide based on real experiences.</title>
	<link rel="stylesheet" href="styles/login.css">
</head>
<body>
	<div id="body_wrap">
		<nav id="nav">
			<ul>
				<li><a href="recom.php">recommendations</a></li>
				<li><a href="blog.php">blog</a></li>
				<li><a href="index.php#contact">contact</a></li>
				<li><a href='login.php'>log in</a></li>
				<li><a href="/sites/worldtour/ro/public/login.php">ro</a></li>
			</ul>
			<div id="logo"><a href="index.php"><img src="img/provisory-logo.gif"></a></div>
		</nav>
<?php include 'includes/footer.php'; ?>