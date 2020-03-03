<?php
session_start();
include("config.php");

	if(isset($_POST['recipientmail'])){
	$recomail = $_POST['recipientmail'];
	}
	if(isset($_POST['region'])){
	$region = $_POST['region'];
	}
	if(isset($_POST['town'])){
	$town = $_POST['town'];
	}
	if(isset($_POST['address'])){
	$address = $_POST['address'];
	}
	if(isset($_POST['sendermail'])){
		$recomendermail = $_POST['sendermail'];
	}
	
	
	/*' : recomail,
				'sendermail': sendermail,
				'region': region,
				'town': town,
				'address': address*/
	$roomid = $_SESSION['recomending_roomid'];
	//date and time of recomendation
	$dt = new DateTime();
	$date = $dt->format('Y-m-d H:i:s');
	$title = "recommendation";
	
	$link = "http://keribu.ug/view/display.php?roomAdvertID=".$roomid."";
	$notification = mysql_real_escape_string("You've Been Recommended A Room at $address, $town, $region");
	$subject = "Receomendation On Acquisition Of A Room Posted On <a href='www.accampodation.co.ug'>accampodation.co.ug</a>";
	$message = "You Have Been Recomended A Room By	".$recomendermail." From accampodation.co.ug. <a href='$link'>Click To Check The Room Out</a>";
	$headers = "From: ".$recomendermail."\r\n".
				'ReplyTo: '.$recomendermail.'';
					
	//send notification if recipient mail is a user of accampodation
	$checkexistence = mysql_query("select * from client where email = '$recomail'");
	
	if(($checkrows = mysql_num_rows($checkexistence)) > 0){
	$query = mysql_query("insert into notifications values(null,'$title', '$notification', '$link', '$recomail', '$date', 'unseen')");
	if($query){
		echo 'success';
	}else{
		echo "failed";
	}
	}
	
		//sending the room recomending email
	$recomendingmail = mail($recomail, $subject, $message, $headers);

	mysql_close($connect);
?>