<?php
	session_start();
	$userid = $_SESSION['email'];
	include("../logic/config.php");
	
	/*************************************************user profile data*********************************************/
	
	$query = mysql_query("SELECT * FROM client INNER JOIN contact ON client.email = contact.email");
	if(($row = mysql_num_rows($query)) > 0){
		while($fetch = mysql_fetch_array($query)){
			$email = $fetch['email'];
			$fname = $fetch['fName'];
			$lname = $fetch['lName'];
			$uname = $fetch['uName'];
			$profileimage = $fetch['profileImage'];
			$pass = $fetch['password'];
			$contact = $fetch['contact'];
		}
	}
	
	/*************************************************user listings******************************************************************/
		$query = mysql_query("SELECT * FROM roomadvert WHERE email = '$userid'");
		$rowadvert = mysql_num_rows($query);
		
	/*****************************************user recommendations *********************************************************/
		$query = mysql_query("SELECT * FROM recommend where recomended_email ='$userid'");
		$rowrecommend = mysql_num_rows($query);

	mysql_close($con);
?>