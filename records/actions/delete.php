<?php
include("../../logic/config.php");
	$roomAdvertID = trim($_GET['roomAdvertID']);
	
	//DELETE FROM OTHER_SPECS TABEL
	$other_specs = mysql_query("DELETE FROM other_specs WHERE roomAdvertID='".$roomAdvertID."'");

	//DELETE FROM MARKERS
	$markers = mysql_query("DELETE FROM markers WHERE roomAdvertID ='$roomAdvertID'");
	
	$hostelid = mysql_query("select hostelID FROM roomAdvert WHERE roomAdvertID = '$roomAdvertID';");
	while($fetch = mysql_fetch_array($hostelid)){
	
	$hostelID = $fetch['hostelID'];}
	//DELETE FROM ROOMADVERT, HOSTEL TABLEs
	$query = mysql_query("DELETE FROM roomadvert WHERE roomAdvertID ='$roomAdvertID'");

	mysql_query("delete  from hostel where hostelID = '$hostelID'");
	header("location: ../listings.php");
	
	mysql_close($connect);
?>