<?php
 session_start();
 header('Cache-control: private');
 
	//include("keyset.php");
	//include("../view/display.php");
	if(isset($_REQUEST['roomAdvertID'])){
	$roomAdvertID = $_REQUEST['roomAdvertID'];
	}
	if(isset($_REQUEST['click'])){
	$click = $_REQUEST['click'];
	switch($click){
		case'advertiseroom':
			$user_id = trim($_SESSION['client_ID']);
			if(empty($user_id)){
				$_SESSION['click'] = 'advertiseroom';
				header("Location: http://localhost/keribu.ug/login/index.php");
				exit;
			}
			if(!empty($user_id)){
				header("Location: http://localhost/keribu.ug/advertise/startsell.php");
					exit;
			}
		break;
		
		case 'login':
			header("Location: http://localhost/keribu.ug/login/index.php");
		break;
		
		case 'logout':
			header("Location: http://localhost/keribu.ug/login/logout.php");
		break;
		
		case 'deleteadvert':
			header("location: records/actions/delete.php?roomAdvertID=".$roomAdvertID);
			break;		
	}
	}
	if(isset($_REQUEST['token'])){
	$token = $_REQUEST['token'];
	switch($token){
		case 'profile':
			header("Location: http://localhost/keribu.ug/records/profile.php");
			break;
		case 'soldlist':
			header("Location: http://localhost/keribu.ug/records/listings.php");
			break;
		case 'notifications':
			header("Location: http://localhost/keribu.ug/records/notifications.php");
			break;
	}
	}

?>