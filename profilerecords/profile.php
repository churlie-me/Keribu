<?php 
	session_start();
	require("collectinformation.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../css/bootstrap.css" rel="stylesheet" />
<link href="../css/profile.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Profile</title>
</head>

<body>

<span class="">
<nav class="navbar navbar-default" role="navigation"> 
	<div class="navbar-header"> 
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse"> 
            <span class="sr-only">Toggle navigation</span> 
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
        </button> 
        <a class="navbar-brand" href="index.php">accampodation</a> 
    </div> 
    
    <div class="collapse navbar-collapse" id="example-navbar-collapse"> 
        <ul class="nav navbar-nav"> 
        	<li><a href="?click=advertiseroom">Advertise Room</a></li>
            <li><a href=""><span class='glyphicon glyphicon-envelope'></span></a></li>
            <li class="dropdown"> 
                <?php 
					  if(!isset($_SESSION['email'])){
					 	echo " <a href='?click=login'><span class='glyphicon glyphicon-user'></span> My Account</a> ";
						
					  }else{
						echo "<a href='' class='dropdown-toggle' data-toggle='dropdown'><img class='profile' src=".$_SESSION['avatar']." alt=".$_SESSION['fname']."> Hi ".$_SESSION['fname']." <b class='caret'></b></a>";
						echo "<ul class='dropdown-menu'>
                        	<li><a href='#'>News Feeds</a></li>
                     		<li><a href='#'>Watch List</a></li>
                            <li><a href='#'>Profile</a></li>
                            <li><a href='#'>Recomendations</a></li>
                            <li><a href='?click=logout'>Logout</a></li>
                            </ul>";
					  }
					  ?>
            </li> 
        </ul> 
    </div> 
</nav>
</span>
<div class="body2">
	<div>&nbsp;</div>
	<div class="row">
    	<div class="col-md-3">
    	<img src="" class="img-thumbnail img-profile" />
        <input type="button" name="profileupload" class="profile" />
        </div>
        <div class="col-md-9">
        </div>
    </div>
</div>
<script src="../js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="../js/bootstrap.js" type="text/javascript"></script>
</body>
</html>