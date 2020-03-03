<?php
session_start();
include('config.php');

	$usermail = $_SESSION['email'];
	
	$remove = "update notifications set status = 'seen' where notified_mail = '$usermail' and status = 'unseen'";
	$removequery = mysql_query($remove);
	
	if($removequery){
		echo json_encode('success');
	}
	mysql_close($connect);
?>
