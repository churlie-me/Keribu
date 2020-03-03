<?php
	include("sessioncontrol.php");
	include("config.php");

	$email = mysql_real_escape_string(trim($_POST['email']));
	$fname= mysql_real_escape_string(trim($_POST['fname']));
	$lname = mysql_real_escape_string(trim($_POST['lname']));
	$contact = mysql_real_escape_string(trim($_POST['contact']));
	$uname = mysql_real_escape_string(trim($_POST['uname']));
	$password = mysql_real_escape_string(sha1(trim($_POST['pass'])));//encryption of passwords
	$image = trim('http://keribu.ug/images/userphotos/default.jpg');

			$query = mysql_query("UPDATE client SET email = '$email', fName = '$fname', lName = '$lname', uName = '$uname', password = '$password' WHERE client_ID = '".$_SESSION['client_ID']."'", $connect);
			if($query){
				mysql_query("insert into contact values(null, '$contact', '".$_SESSION['client_ID']."')");
				
				$_SESSION['email'] = $email;
				$_SESSION['fName'] = $fname;
								
				header("Location: ../records/profile.php");
				
			}else{
			echo "Submmission Error";
			}
			
	mysql_close($con);

?>