<?php  

include('core/init.php');
logged_in_redirect(); // daca se incearca accesarea directa a acestei pagini vom folosi functia logged_in_redirect pentru a redirectiona userul catre pagina principala

if (empty($_POST) === false) { // daca form-ul este trimis, ne asiguram ca acesta este completat
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (empty($username) === true || empty($password) === true) { // daca campurile ce contin parola sau numele de utilizator nu sunt completate, nu vom permite logarea, nu rulam codul de mai jos
		$errors[] = 'Username and/or password fields must not be left blank'; // $errors este o variabila pe care o folosim sa stocam  si sa afisam erorile generate de utilizatori 
	} else if (user_exists($username) === false) { // daca numele de utilizator nu exista, redam eroarea de mai jos
		$errors[] = 'Username does not exist! Please register before logging in.';
	} else if (user_active($username) === false) { // daca utilizatorul nu a confirmat contul prin email, nu il vom lasa sa se logheze
		$errors[] = 'You haven\'t activated your account yet';
	} else {
		if (strlen($password) > 32) {
			$errors[] = 'Password too long'; 
		}
		$login = login($username, $password); // 
		if ($login === false) {
			$errors[] = 'Username/password incorrect';
		} else {
			$_SESSION['user_id'] = $login;
			header("Location: login.php");
			exit;
		}
	}
} else {
	$errors[] = 'No data received';
}

include('includes/header.php');

if (empty($errors) === false) {
?>
	<h2 class="wetried">We tried to log you in, but...</h2>
<?php  
	echo output_errors($errors);
}
	include('includes/footer.php');
?>
