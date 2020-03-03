<?php
include("../../logic/sessioncontrol.php");
include("../../logic/config.php");

$useremail = trim($_SESSION['email']);
	$currentmail = trim($_GET['email']);
	$query = mysql_query("select email from client where client_ID != '".$_SESSION['client_ID']."'");
	
	if(($mailing = mysql_num_rows($query)) > 0){
		while($collect = mysql_fetch_array($query)){
	 	if($collect['email'] == $currentmail){
			echo 'email exists';
		}
		}
	}
		mysql_close($connect);
?>
