<?php
	session_start();
	$propertytype = trim($_POST['propertytype']);
	$title = trim($_POST['title']);
	$_SESSION['propertytype'] = $propertytype;
	$_SESSION['title'] = $title;
	
	if(isset($propertytype)){
	if($propertytype == 'Hostel Room'){
	header("Location: ../advertise/detaillisting.php");
	}else if($propertytype == 'Rental'){
		header("Location: ../advertise/rentaldetails.php");
	}
	}
?>