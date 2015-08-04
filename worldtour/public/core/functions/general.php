<?php  

function array_sanitize(&$item) {
    include('core/db/db_connection.php');
    $item = mysqli_real_escape_string($dbCon, $item);
}

function sanitize($data) { // din motive de securitate dorim sa extragem si izolam caracterele speciale precum / - functia mysqli_real_escape_string adauga automat \ fiecarui caracter special
	include('core/db/db_connection.php');
	return mysqli_real_escape_string($dbCon, $data);
}

function mysqli_result($res,$row=0,$col=0) { // aceasta functie face acelasi lucru ca mysql_result, dorim folosirea acestei functii deoarece mysql_result nu va mai fi folosit in versiunile viitoare 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0) {
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])) {
            return $resrow[$col];
        }
    }
    return false;
}

function output_errors($errors) { // aceasta functie returneaza erorile pe care le salvam in $errors 
    $output = array();
    foreach($errors as $error) {
        $output[] = '<li>' . $error . '</li>';
    } // luam fiecare eroare, o plasam intr-o lista dupa care returnam rezultatul
    return '<ul class="error_list reg_errors chpw_errors actv_errors profile_errors">' . implode('', $output) . '</ul>'; // implode will take an array and transform it into a string
}

function user_count() { // pentru a arata cati utilizatori inregistrati avem pe site
    include('core/db/db_connection.php');
    $sql = "SELECT COUNT(user_id) FROM `_users` WHERE active = 1";
    $data = mysqli_query($dbCon, $sql);
    return mysqli_result($data, 0);
}

function email($user, $subject, $body) {
    require 'phpmailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.mail.yahoo.com';                  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = '@yahoo.com';               // SMTP username
    $mail->Password = '#%!';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->From = '@yahoo.com';
    $mail->FromName = 'noreply@worldtour.com';
    $mail->addAddress($user);                                // Add a recipient
    $mail->addAddress('');                                // Name is optional
    $mail->addReplyTo('', '');
    $mail->addCC('');
    $mail->addBCC('');

    $mail->addAttachment('');                             // Add attachments
    $mail->addAttachment('');                             // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = $body;

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
}

?>