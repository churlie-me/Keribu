<?php
	include('../logic/sessioncontrol.php');
	if(isset($_SESSION['click'])){
		unset($_SESSION['click']);
		}
		
	if(!isset($_SESSION['logged_in'])){
			header("Location: ../index.php");
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/bootstrap.css" rel="stylesheet" />
<link href="../css/sells.css" rel="stylesheet" />
<link href="../css/hostel.css" rel="stylesheet" />
<!--<script src="../js/startsell.js" type="text/javascript" language="javascript"></script>-->
<title>keribu > sell</title>
<link rel="shortcut icon" href="../images/icon box.png" type="image/png" />
</head>

<body class="override">
    <div class="container">
        <div class="row">
        	<a href="../index.php"><label class="web"><img src="../images/logo_second.png" /></label></a>
        </div>
        <div class="row">
        	<label class="register what">Specify what you are dealing</label></div>
        </div>
        <div class="row">
        	<hr id="hr" />
        </div>
        
        <div class="row">
            <div class="post">
                <div class="head1">
                	<label>Give Us Your Title And Specification</label>
                </div>
                
                <div class=" limit content1">
                	<div class="row">
                    	<div class="col-sm-9 take">
                        	<div class="row">
                    			<label class="accampodation">Please Select The Category In Which Your Property Falls</label>
                    		</div>
                            <div class="row">
                            	<form id="startsell" name="advert" action="../logic/redirected.php"  method="post" role="form">
                    				<div class="col-lg-10 take">
                                    
                                    	<div class="row reign ad select-style">
                                            <select class="room-control" id="propertytype" name="propertytype" onchange="selectroomtype(this.value)">
                                            	<<option value="">Choose Room Type</option>
                                                <option value="Hostel Room">Hostel Room</option>
                                                <option value="Rental">Rental</option>
                                            </select>
                                             
                                        </div>
                                        <p id="pty"></p>
                                        <div class="row reign">
                                        <span>Title :</span>
                                            <input type="text" class="room-control" id="title" name="title" placeholder="you can add a few words to your title after selecting the room type below">
                                            <span id="tyto"></span>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="col-lg-2 posta">
                                    	<div class="row"><div>&nbsp;</div></div>
                                        <div class="row">
                                    		<input type="submit" class="btn btn-default sell" value='Continue' id="Submit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                    			<label><h4>Hint :</h4>It must either be a hostel room or a rental</label>
                    		</div>
                        </div>
                        <div class="col-sm-3">
                            <div class="row">
                                <div class="head1">
                                    <label><span class='glyphicon glyphicon-ok'></span>Tip</label>
                                </div>
                            </div>
                            <div class="row">
                            	<p>Add Some Content To Your Title Upon Selecting Among The Options Displayed To Make It Uniquely Visible From Others </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row freespace">
        	<div class="col-sm-2"><a href="#">Aboutkeribu</a></div>
            <div class="col-sm-2"><a href="../conditions/privacypolicy.html">Privacy Policy</a></div>
            <div class="col-sm-2"><a href="../contact/contact.php">Contact Us</a></div>
            <div class="col-sm-2"><a href="#">FAQs</a></div>
            <div class="col-sm-2"><a href="../conditions/tos.php">Terms Of Service</a></div>
            <div class="col-sm-2"><a href="#">Help Us Deliver Better</a></div>
        </div>
        <div class=" row">
            <div class="outter">
                <div class="copyright">
                    <h5>©2014 Travon Media Group® All Rights Reserved <a href="#">User Agreement</a> and <a href="#">Cookies</a></h5>
                </div>
            </div>
        </div>

        <script src="../js/jquery-1.11.2.js" type="text/javascript"></script>
        <script src="../js/startsell.js" type="text/javascript"></script>
        <script type="text/javascript">
			function selectroomtype(str){
				var value = str;
				document.getElementById('title').value = value;
				console.log(document.getElementById('title').value);
				}
		</script>
</body>
</html>