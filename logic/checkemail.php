<?php
	include("config.php");
	
	$email = mysql_real_escape_string(trim($_POST['email']));

	$query = "SELECT * FROM client WHERE email = '$email'";
	
	$execute = mysql_query($query);
	
	if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i", $email)){
		   echo 'Please enter a valid Email address';
	}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	  $msg = 'Please enter a valid Email address';
	} 
	else if(($row = mysql_num_rows($execute)) > 0){
		$msg = 'email exists';
	}else{
		$msg = 'no email of this kind exists';
	}
	echo $msg;
	mysql_close($con);
?>