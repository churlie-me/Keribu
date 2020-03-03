<?php
include("../logic/sessioncontrol.php");
include("results.php");
require("../logic/controlclicks.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/bootstrap.css" rel="stylesheet" />
<!--<link href="../css/bootstrap-theme.css" rel="stylesheet" />
<link href="../css/bootstrap.min.css" rel="stylesheet" />-->
<link href="../css/hostel.css" rel="stylesheet" />
<link href="../css/sells.css" rel="stylesheet" />
<link href="../css/view.css" rel="stylesheet" />
<link href="../css/main.css" rel="stylesheet" />
<link href="../css/bootstrap.css" rel="stylesheet" />
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script src="../js/google-maps.js" type="text/javascript"></script>
<title>accampodation > details</title>
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
        <a class="navbar-brand" href="index.php">accampodation</a> 
    </div> 
    
    <div class="collapse navbar-collapse" id="example-navbar-collapse"> 
        <ul class="nav navbar-nav"> 
        	<li><a href="?click=advertiseroom">Advertise Room</a></li>
            <li><a href=""><span class='glyphicon glyphicon-envelope'></span></a></li> 
        </ul> 
    </div> 
</nav>
</span>
<div class="body1">
	<div class="body2">
    	<div>&nbsp;</div>
    	<div class="row">
        	<div class="col-sm-4">
                <div class=" content1 demo">
                	<?php echo"<img src=".$image." class='img-polaroid'>"; ?>
                </div>
            </div>
            <div class="col-sm-8">
            	<div class="row" style="padding-left: 20px; margin-bottom: -10px; margin-top: 10px;"><label class="accampodation"><?php echo $title; ?></label></div>
                <div class="row"><hr /></div>
                <div class="row" style="padding-left: 20px;">
                	<label>No. Rooms Available</label> <?php echo $available; ?>
                </div>
                <div class="row" style="margin-top: 0px;">
                	<div class="col-md-8">
                    	<div class="row div price">
                        	<?php echo"<label class='accampodation'>Payment</label>
                            <p><label>Price :</label> Shs ".$price."</p>
                            <p><label>Price Condition :</label> ".$pxcondition."</p>"; ?>
                        </div>
                    	<div class="row div recomend">
                            <label class="register">Optional. 	You Can Recommend This Room To A Friend</label>
                            <form action="../logic/reccomend.php" method="post" role="form">
                            <div class="row">
                                <input type="text" class="room-control" id="mail" name="mail" placeholder="Enter Email Of Person To Be Recomended">
                            </div>
                            <div>&nbsp;</div>
                            <div class="row">
                                <input type="submit" class="btn btn-default" value='Recomend' id="post">
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4">
                    <div class="row div size">
                    	<div class="row head">
                        	<label>Agent Information</label>
                    	</div>
                        <div class="row">
                         <?php   echo"<p><label>Name :</label> ".$fname."	".$lname."</p>
                            <p><label>Telephone : </label> ".$contact."</p>
                            <p><label>Email :</label> ".$mail."</p>"; ?>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
        <!---*************************************************************************************************************-->
            <div class="row">
                <div class="col-md-8">
                <div class="row">
					<div class="head1">
                    	<label>Description</label>
                    </div>
                </div>
                <div class="content1 contentspace">
                	<div>
                    	<p><label class="labeltitle">Wash Rooms  :	</label><?php echo $wash; ?></p>
                    </div>
                    <div>
                    	<p><label class="labeltitle">Room Status  :		</label> <?php echo $roomstatus; ?></p>
                    </div>
                    <div>
                    	<p><label class="labeltitle">Hostel Name  :		</label> <?php echo $hostelname; ?></p>
                    </div>
                    <div>
                    	<p><label class="labeltitle">Hostel Status  :	</label> <?php echo $status; ?></p>
                    </div>
                    <div>
                    	<p><label class="labeltitle">Transport  :	</label> <?php echo $transport; ?></p>
                    </div>
                    <div>
                    	<p><label class="labeltitle">Address  :		</label><?php echo $address; ?></p>
                    </div>
                    <div>
                    	<p><label class="labeltitle">Town  :		</label> <?php echo $town; ?></p>
                    </div>
                    <div>
                    	<p><label class="labeltitle">Region  :		</label> <?php echo $region; ?></p>
                    </div>
                    
                </div>
                </div>
                <div class="col-md-4">
                	<div class="head1">
                    	<label>Ask About Property</label>
                    </div>
                    <div class="content1 contentspace">
                    	<form action="ask.php" method="post">
                        	<div class="form-group mapping">
                            	<label for="contact" class="register">Contact</label>
                            	<input type="text" class="room-control" id="contact" name="contact" placeholder="e.g +256782******"/>
                            </div>
                            <div class="form-group mapping">
                            	<label for="mail" class="register">email</label>
                            	<input type="text" class="room-control" id="mail" name="mail"  placeholder="e.g accampodation@co.ug" value ="<?php if(isset($_SESSION['email'])) echo $_SESSION['email']; ?>"/>
                            </div>
                            <div class="form-group mapping">
                            		<label for="qtn" class="register">Your Question</label>
                                    <textarea class="text-control" rows="8"  id="question" width="100%" name="qtn"></textarea>
                            </div>
                            <input type="submit" class="btn btn-default" value='Question' id="qn">
                        </form>
                    </div>
                </div>
            </div>
            <!--******************************Google Maps View of the location***************************************-->
            <div class="row">
                <div class="col-md-9 div tame">
                <div class="row">
					<div class="head">
                    	<label>Location On Google Maps</label>
                    </div>
                </div>
                <div class="row">
                	<div id="map-canvas">
                    </div>
                </div>
                </div>
                <div class="col-md-3">
                &nbsp;
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-9 div tame">
                <div class="row">
					<div class="head">
                    	<label>Room Condition</label>
                    </div>
                </div>
                <div class="row">
                	<span><?php echo $roomcondition; ?></span>
                </div>
                </div>
                <div class="col-md-3">
                &nbsp;
                </div>
            </div>
	</div>
</div> 

	<div class=" row">
            <div class="outter view">
                <div class="copyright">
                    <h5>©2014 Travon Incooporated® All Rights Reserved <a href="#">User Agreement</a> and <a href="#">Cookies</a></h5>
                </div>
            </div>
        </div>
        <script src="../js/jquery-1.11.2.min.js" type="text/javascript"></script>
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>