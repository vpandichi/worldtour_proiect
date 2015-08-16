<?php  

include('core/init.php');
logged_in_redirect(); // daca se incearca accesarea directa a acestei pagini vom folosi functia logged_in_redirect pentru a redirectiona userul catre pagina principala

if (empty($_POST) === false) { // daca formularul este trimis, ne asiguram ca acesta este completat
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (empty($username) === true || empty($password) === true) { // daca campurile ce contin parola sau numele de utilizator nu sunt completate, nu vom permite logarea, nu rulam codul de mai jos
		$errors[] = 'Campul care contine utilizatorul/parola nu trebuie sa fie nul'; // $errors este o variabila pe care o folosim sa stocam  si sa afisam erorile generate de utilizatori 
	} else if (user_exists($username) === false) { // daca numele de utilizator nu exista, redam eroarea de mai jos
		$errors[] = 'Utilizatorul nu exista. Te rugam sa te inregistrezi inainte de a te loga.';
	} else if (user_active($username) === false) { // daca utilizatorul nu a confirmat contul prin email, nu il vom lasa sa se logheze
		$errors[] = 'Inca nu ti-ai activat contul. <br> Te rugam sa-ti verifici adresa de mail pentru link-ul de activare.';
	} else {
		if (strlen($password) > 32) {
			$errors[] = 'Parola nu trebuie sa fie mai mare de 32 de caractere'; 
		}
		$login = login($username, $password); // 
		if ($login === false) {
			$errors[] = 'Utilizatorul sau parola au fost introduse gresit.';
		} else {
			$_SESSION['user_id'] = $login;
			header("Location: login.php");
			exit;
		}
	}
} else {
	$errors[] = 'Nicio informatie primita.';
}

include('includes/header.php');

if (empty($errors) === false) {
?>
	<h2 class="wetried">Am incercat sa te logam, dar...</h2>
	<h4 class="forgotten">Ti-ai uitat <a href="recover.php?mode=username" class="forgotten_u">numele de utilizator</a> sau <a href="recover.php?mode=password" class="forgotten_p">parola</a> ?</h4>
<?php  
	echo output_errors($errors);
}
	include('includes/footer.php');
?>
