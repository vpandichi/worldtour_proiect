<?php  
	include('core/init.php'); 
	logged_in_redirect();

	if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
	?>
		<h2 class="activated_scsfly">Contul tau a fost activat cu succes. Te rugam sa te <a href="login.php">loghezi</a></h2>
	<?php  
	} else if (isset($_GET['email'], $_GET['email_code']) === true) {
		$email = trim($_GET['email']);
		$email_code = trim($_GET['email_code']);

		if (email_exists($email) === false) {
			$errors[] = 'Ne pare rau, nu am reusit sa gasim aceasta adresa de email';
		} else if (activate($email, $email_code) === false) {
			$errors[] = 'Din pacate nu am reusit sa va activam contul';
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
	<title>worldtour | activare cont</title>
	<link rel="stylesheet" href="styles/login.css">
</head>
<body>
	<div id="body_wrap">
		<nav id="nav">
			<ul>
				<li><a href="recom.php">recomandari</a></li>
				<li><a href="blog.php">blog</a></li>
				<li><a href="index.php#contact">contact</a></li>
				<li><a href='login.php'>logare</a></li>
				<li><a href="../en/index.php">en</a></li>
			</ul>
			<div id="logo"><a href="index.php"><img src="img/provisory-logo.gif"></a></div>
		</nav>
<?php include 'includes/footer.php'; ?>