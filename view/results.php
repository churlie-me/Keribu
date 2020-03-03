<?php

	$roomadvertid = $_GET["roomAdvertID"];
	//$roomadvertid = 1;
	include("../logic/config.php");

	$string = "SELECT * FROM roomadvert inner join hostel on roomadvert.hostelID = hostel.hostelID where roomAdvertID = '$roomadvertid'";
	$query = mysql_query($string);
	
	while($fetch = mysql_fetch_array($query)){
		$title = $fetch['title'];
		$available = $fetch['rms_available'];
		$wash = $fetch["washRooms"];
		$roomstatus = $fetch["roomStatus"];
		$price = $fetch['price'];
		$pxcondition = $fetch['priceCondition'];
		$roomcondition = $fetch['roomCondition'];
		$image = $fetch['mainimage'];
		$date = $fetch['advertDate'];
		$mail = $fetch['email'];		
		$hostelname = $fetch['hName'];
		$status = $fetch['status'];
		$transport = $fetch['transport'];
		$region = $fetch['Region'];
		$town = $fetch['town'];
		$address = $fetch['address'];

	//retrieving sellers  identity
	$query = mysql_query("select * from client inner join contact on client.email = contact.email where client.email ='$mail'");
	while($fetch = mysql_fetch_array($query)){
		$fname = $fetch["fName"];
		$lname = $fetch['lName'];
		$contact = $fetch['contact'];
		
	}
		}
		mysql_close($con);
?>