<?php  

function email_users($subject, $body) {
    include('core/db/db_connection.php');
    $sql = "SELECT email, first_name FROM `_users` WHERE allow_email = 1";
    $query = mysqli_query($dbCon, $sql);
    while (($row = mysqli_fetch_assoc($query)) !== false) { // daca sunt utilizatori care au bifat optiunea de a primi mail-uri -->
        email($row['email'], $subject, "Hello ". $row['first_name'] . ", <br><br>" . $body . "<br><br>-worldtour team");
        header('Location: email_users.php?success');
    }
}

function contact_me($subject, $body) {
	$send_to = 'vladz0r9@yahoo.com'; 
	$username = htmlentities($_POST['contact_name']);
	$email = htmlentities($_POST['email']);
	$body = 'From: ' . $username . '<br>Email: ' . $email . '<br><br>' . $body;
	email($send_to, $subject, $body);
}

function display_users() { // reda un tabel cu utilizatorii activi din baza de date
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

function display_inactive_users() { // reda un tabel cu utilizatorii inactivi din baza de date
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

function delete_user($username) { // sterge un utilizator activ din baza de date
	include('core/db/db_connection.php');
	$sql = "DELETE FROM `_users` WHERE `username` = '$username' AND active = 1";
	mysqli_query($dbCon, $sql);
}

function delete_inactive_user($username) { // sterge un utilizator inactiv din baza de date
	include('core/db/db_connection.php');
	$sql = "DELETE FROM `_users` WHERE `username` = '$username' AND active = 0";
	mysqli_query($dbCon, $sql);
}

function recover($mode, $email) { // recupereaza numele de utilizator sau parola - $mode poate lua valoarea de 'username' sau 'password'
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
		$generated_password = substr(md5(rand(777, 7777)), 0, 7); // generam o parola random de 7 caractere pe care o criptam cu md5
		change_password($user_data['user_id'], $generated_password);
		update_user($user_data['user_id'], array('pwd_recovery' => '1')); // folosim un 'flag' asupra contului pentru a forta utilizatorul sa-si schimbe parola generata de noi prima oara cand se logheaza
		email($email, 'Password recovery', "
				Hello " . $user_data['first_name'] . ", <br><br>
				Your new password is " . $generated_password."<br><br>
				Kindly note that this is a temporary password and you are required to change it on your first log in. <br><br>
				-worldtour team
			");
	}
}

function activate($email, $email_code) { // activeaza contul utilizatorului
	include('core/db/db_connection.php');
	$email = mysqli_real_escape_string($dbCon, $email);
	$email_code = mysqli_real_escape_string($dbCon, $email_code);
	$sql = "SELECT COUNT(user_id) FROM `_users` WHERE email = '$email' AND email_code = '$email_code'";
	$query = mysqli_query($dbCon, $sql);

	if (mysqli_result($query, 0) == 1) { // daca link-ul primit pe email a fost accesat -->
		$update_sql = "UPDATE `_users` SET active = 1 WHERE email = '$email'";
		mysqli_query($dbCon, $update_sql);
		return true;
	} else {
		return false;
	}
}

function change_password($user_id, $password) { // permite utilizatorului posibilitatea de a schimba parola  
	include('core/db/db_connection.php');
	$user_id = (int)$user_id; // chiar daca nu este o valoare introdusa de utilizator, vrem sa ne asigurandu-ne ca variabila user_id contine doar numere intregi
	$password = md5($password); 
	$sql = "UPDATE `_users` SET `password` = '$password', `pwd_recovery` = 0 WHERE `user_id` = $user_id";
	$query = mysqli_query($dbCon, $sql);
}

function logged_in_redirect() { // daca userul incearca sa acceseze o pagina irelevanta dupa ce s-a logat (ex: pagina de inregistrare) - il vom redirectiona 
	if (logged_in() === true)
	header('Location: index.php');
} 

function not_logged_in_redirect() { // redirectionam utilizatorii care nu sunt logati si incearca sa acceseze pagini la care nu au acces
	if (logged_in() !== true) {
		header('Location: index.php');
	}
}

function register_user($register_data) { // adaugam userul in baza de date
	include('core/db/db_connection.php');
	array_walk($register_data, 'array_sanitize'); // aplica functia array_sanitize() fiecarui element din multime
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

		"http://localhost/sites/worldtour/en/activate.php?email=" . $register_data['email'] . "&email_code=".$register_data['email_code']." <br><br>

		-worldtour team
	
		");
}

function admin_add_user($register_data) { // adaugam userul in baza de date
	include('core/db/db_connection.php');
	array_walk($register_data, 'array_sanitize'); // aplica functia array_sanitize() fiecarui element din multime
	$register_data['password'] = md5($register_data['password']);
	$fields = '`' . implode('`, `', array_keys($register_data)) . '`'; // pregatim interogarea adaugand `` fiecarui cap de tabel
	$data = '\'' . implode('\', \'', $register_data) . '\''; // pregatim interogarea adaugand '' variabilelor care contin informatii precum numele de utilizator, parola, email, etc.
	$sql = "INSERT INTO `_users` ($fields) VALUES ($data)";
	$query = mysqli_query($dbCon, $sql);
}

function update_user($user_id, $update_data) { 
	include('core/db/db_connection.php');
	array_walk($update_data, 'array_sanitize');
	$update = array();
	foreach ($update_data as $field => $data) {
		$update[] = '`' . $field . '` = \'' . $data . '\''; // structuram interogarea pentru a o folosi in baza de date
	}
	$sql = "UPDATE `_users` SET " . implode(', ', $update) . " WHERE `user_id` = " . $user_id; // converts the $update array into a string format
	// print_r($sql);
	// die();
	$query = mysqli_query($dbCon, $sql);
}

function user_data($user_id) {
	$data = array();
	$user_id = (int)$user_id;

	$func_num_args = func_num_args(); // returneaza numarul de parametri ai unei functii
	$func_get_args = func_get_args(); // returneaza o multime care cuprinde lista de argumente a unei functii

	if ($func_num_args > 1) { // daca avem cel putin 1 parametru -->
		include('core/db/db_connection.php');
		unset($func_get_args[0]); // $func_get_args[0] va returna user_id pe care il avem deja in variabila $user_id, de aceea folosim unset pentru a omite acest paramentru
		$fields = '`' . implode('`, `', $func_get_args) . '`'; // dorim pregatirea argumentelor pentru a fi introduse ulterior intr-o interogare
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

function email_exists($email) { // verificam daca adresa de email a utilizatorului exista in baza de date
	include('core/db/db_connection.php');
	$email = sanitize($email);
	$sql = "SELECT COUNT(user_id) FROM `_users` WHERE email = '$email'";
	$query = mysqli_query($dbCon, $sql);
	return (mysqli_result($query, 0) == 1) ? true : false;
}

function id_exists($user_id) { // verificam daca exista numarul unic de identificare al utilizatorului
	include('core/db/db_connection.php');
	$user_id = (int)$user_id;
	$sql = "SELECT COUNT(user_id) FROM `_users` WHERE user_id = '$user_id'";
	$query = mysqli_query($dbCon, $sql);
	return (mysqli_result($query, 0) == 1) ? true : false;
}

function user_active($username) { // verificam daca un utilizator este activ (si-a validat contul prin email)
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

function get_article_id($username) { 
	include('core/db/db_connection.php');
	$username = sanitize($username);
	$sql = "SELECT content_id FROM `blog` WHERE content_id = '$content_id'";
	$query = mysqli_query($dbCon, $sql);
	return (mysqli_result($query, 0, 'content_id'));
}

function get_comment_id($comment_id) { 
	include('core/db/db_connection.php');
	$comment_id = sanitize($username);
	$sql = "SELECT comment_id FROM `article_comments` WHERE comment_id = '$comment_id'";
	$query = mysqli_query($dbCon, $sql);
	return (mysqli_result($query, 0, 'comment_id'));
}

function get_user_id_from_email($email) { 
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

function superuser($user_id, $type) { // pentru administratori
	include('core/db/db_connection.php');
	$user_id = (int)$user_id;
	$type = (int)$type;
	$sql = "SELECT COUNT(user_id) FROM `_users` WHERE user_id = '$user_id' AND type = '$type'";
	$query = mysqli_query($dbCon, $sql);
	return (mysqli_result($query, 0) == 1) ? true : false;
}

function post_article($title, $content) { // posteaza un articol pe site
	global $user_data;
	include('core/db/db_connection.php');
	$title = mysqli_real_escape_string($dbCon, $title);
	$content = mysqli_real_escape_string($dbCon, $content);
	$username = $user_data['username'];
	$date = date('l jS \of F Y h:i:s A');
	$sql = "INSERT INTO `blog` (`title`, `content`, `posted_by`, `date`) VALUES ('$title', '$content', '$username', '$date')";
	mysqli_query($dbCon, $sql);
}

function get_articles() {
	include('core/db/db_connection.php');
    $sql = "SELECT blog.content_id, blog.title, blog.content, blog.posted_by, blog.date, article_comments.comments, article_comments.comment_by
            FROM blog LEFT OUTER JOIN article_comments
            ON blog.content_id = article_comments.blog_id
            WHERE blog.content != ''
            ORDER BY blog.content_id DESC";
    $result = mysqli_query($dbCon, $sql); 
    $rows = array(); // initialize in case the query matched no rows
    while($row = mysqli_fetch_assoc($result)){ 
        $rows[] = $row;
    }
    return $rows;
}

function comment_form($id){
	global $user_data;
	if (logged_in() === true) {
		return <<<EOT
	    <form method='post' action='' class='comments_form'>
		    <input type='text' name='username' placeholder='your name... *' id='name' value='{$user_data['username']}'>
		    <textarea name='comments' id='textarea' placeholder='your comment... *' cols='30' rows='6'></textarea>
		    <input type='hidden' name='blog_id' value='$id'>
		    <input type='submit' name='submit' id='post' value='post'>
	    </form>
	    <hr class='artline'>
EOT;
	}
}

function list_articles($rows) {
    if(empty($rows)){
        return "There are no Articles to display";
    }
    
    $previous_blog_id = 0;
    $content = '';

    foreach($rows as $row) {
        if ($previous_blog_id != $row['content_id']) { // the blog id changed
            if($previous_blog_id != 0){ // not the first section, close out the previous section
                $content .= comment_form($previous_blog_id); 
            }
            // start a new blog section
            $content .= "<h5 class='posted_by'>Posted by {$row['posted_by']} on {$row['date']}</h5>
		                <h1 class='content_headers'>{$row['title']}</h1>
		                <article>{$row['content']}</article>
		                <hr class='artline'>";
            $previous_blog_id = $row['content_id'];
        }
        if (!empty($row['comment_by']) && !empty($row['comments'])) {
             $content .= "<div class='commented_by'>Posted by: {$row['comment_by']} </div>
                   <div class='comments'>Comments: {$row['comments']}</div>
                   <hr class='artline2'>";
        }
    }
    
    if($previous_blog_id != 0){ 
        $content .= comment_form($previous_blog_id); 
    }

    return $content;
}

function insert_comments($comments, $comment_by, $blog_id) {
    include('core/db/db_connection.php');
    $comment_by = sanitize($comment_by);
    $comments = sanitize($comments);
    $sql = "INSERT INTO article_comments (comments, comment_by, blog_id)
            VALUES ('$comments', '$comment_by', '$blog_id')";
    mysqli_query($dbCon, $sql);
}

function generate_captcha($num1, $num2) { // genereaza un numar la intamplare
	$num1 = (int)$num1;
	$num2 = (int)$num2;
	$rand_num_1 = mt_rand($num1, $num2);
	$rand_num_2 = mt_rand($num1, $num2);
	$result = $rand_num_1 + $rand_num_2;
	return $result;
} 

function create_captcha() { // creaza formularul de captcha
	$num1 = generate_captcha(1, 20);
	$num2 = generate_captcha(1, 20);
	echo  $num1 . ' + ' . $num2 . ' = ';
	echo '<input type="text" name="captcha_results" size="2">';
	echo '<input type="hidden" name=\'num1\' value=' . $num1 . '; ?>';
	echo '<input type="hidden" name=\'num2\' value=' . $num2 . '; ?>';
}

// function change_profile_image($user_id, $file_temp, $file_ext) {
//     include('core/db/db_connection.php');
// 	$file_path = 'img/profiles/' . substr(md5(time()), 0, 10) . '.' . $file_ext; // take current time, encrypt it then change it to a 10 character figure
// 	move_uploaded_file($file_temp, $file_path);
// 	$sql = "UPDATE `_users` SET profile = '" . $file_path . "' WHERE user_id = " . (int)$user_id;
// 	mysqli_query($dbCon, $sql);
// }

?>