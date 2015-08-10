<?php 
	$connect_error = 'Ne pare rau, dar aceasta pagina este indisponibila monenta.';
	$dbCon = mysqli_connect("localhost", "root", "", "worldtour") or die(mysqli_error($connect_error));
?>