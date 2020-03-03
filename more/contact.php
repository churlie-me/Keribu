<?php session_start(); 
require("../logic/controlclicks.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/bootstrap.css" rel="stylesheet" />
<link href="../css/hostel.css" rel="stylesheet" />
<link href="../css/main.css" rel="stylesheet" />
<link href="../css/sells.css" rel="stylesheet" />
<script src="js/check.js" language="javascript" type="text/javascript"></script>
<title>accampodation > contactus</title>
</head>
<body class="override">
    <span class="">
<nav class="navbar navbar-default" role="navigation"> 
	<div class="navbar-header"> 
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse"> 
            <span class="sr-only">Toggle navigation</span> 
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
        </button> 
        <a class="navbar-brand" href="../index.php">accampodation</a> 
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
    <div class="row">
        <div class="post" style="width: 80%; alignment-adjust: central; margin-left: 130px;">
            <div class="head1" >
                <label>You Can Reach Out To Us</label>
            </div>
            <div class="row">
                <div class="col-xs-5">
                    
                </div>
                <div class="col-xs-7">
                    <p><label class="accampodation">Contact : </label>+256784357765/ +256752323562</p>
                    <p><label class="accampodation">Email : </label>accampodation@gmail.com</p>
                    <p>You Can Also Send Us A Message And We'll Reply To You Shortly</p>
                </div>
            </div>
        </div>
     </div>
     <div class="row">
            <div class="post">
                <div class="head1">
                	<label>Send Us Your Message/Opinion</label>
                </div>
                <div class=" limit2 content1">
                	<div class="row">
                    	<div class="col-sm-9 take">
                        	<div class="row">
                            	<form id="startsell" name="advert" action="../logic/webmessage.php"  method="post" role="form">
                                        <div class="row">
                                        	<label class="register"> Title</label>
                                            <input type="text" class="room-control" id="title" name="title" placeholder="Enter a reasonable title after selecting from the options below">
                                        </div>
                                        
                                        <div class="row">
                                        	<label class="register"> email</label>
                                            <input type="text" class="room-control" id="email" name="email">
                                        </div>
                                        <div class="row">
                                        	<label for="name" class="register">Message</label>
                                   			<textarea class="text-control" rows="15"  cols="500" id="message" width="50%" name="message"></textarea>
                                        </div>
                                   		<div>&nbsp;</div>
                                    		<input type="submit" class="btn btn-default" value='Send' id="send">
                                            <input type="submit" class="btn btn-default" value='Clear' id="send" style="margin-left: 10px;">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
     <div class="row freespace">
        	<div class="col-sm-2"><a href="#">Aboutaccampodation</a></div><div class="col-sm-2"><a href="#">Privacy Policy</a></div><div class="col-sm-2"><a href="#">Contact Us</a></div><div class="col-sm-2"><a href="#">FAQs</a></div><div class="col-sm-2"><a href="#">Terms Of Trade</a></div><div class="col-sm-2"><a href="#">Help Us Deliver Better</a></div>
     </div>
     <div class=" row">
        <div class="outter">
            <div class="copyright">
                <h5>©2014 Travon Incooporated® All Rights Reserved <a href="#">User Agreement</a> and <a href="#">Cookies</a></h5>
            </div>
        </div>
     </div>
</nav> 
</body>
</html>