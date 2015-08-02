<?php  

function array_sanitize(&$item) {
    include('core/db/db_connection.php');
    $item = mysqli_real_escape_string($dbCon, $item);
}

function sanitize($data) {
	include('core/db/db_connection.php');
	return mysqli_real_escape_string($dbCon, $data);
}

function mysqli_result($res,$row=0,$col=0) { 
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

function output_errors($errors) {
    $output = array();
    foreach($errors as $error) {
        $output[] = '<li>' . $error . '</li>';
    } // luam fiecare eroare, o plasam intr-o lista dupa care returnam output-ul
    return '<ul class="error_list reg_errors">' . implode('', $output) . '</ul>'; // implode will take an array and transform it into a string
}

function user_count() {
    include('core/db/db_connection.php');
    $sql = "SELECT COUNT(user_id) FROM `_users` WHERE active = 1";
    $data = mysqli_query($dbCon, $sql);
    return mysqli_result($data, 0);
}

?>