<?php 
	include("../logic/controlclicks.php");
	if(isset($_SESSION['roomAdvert'])){
		unset($_SESSION['roomAdvert']);
	}
	if(isset($_GET['roomAdvertID']))
		$roomadvertid = $_GET['roomAdvertID'];
	else
		header('location: ../index.php');
	
		//set roomAdvertID for purposes of recomendation
		$_SESSION['recomending_roomid'] = $roomadvertid;
		include("../logic/config.php");

	$string = "SELECT * FROM roomadvert inner join hostel on roomadvert.hostelID = hostel.hostelID where roomAdvertID = '$roomadvertid'";
	$query = mysql_query($string);
	
	if(($num = mysql_num_rows($query)) > 0){
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
		$userid = $fetch['client_ID'];		
		$hostelname = $fetch['hName'];
		$status = $fetch['status'];
		$transport = $fetch['transport'];
		$region = $fetch['Region'];//district
		$town = $fetch['town'];//nearby town
		$address = $fetch['address'];//actual address

	//retrieving sellers  identity
	$query = mysql_query("select * from client inner join contact on client.client_ID = contact.client_ID where client.client_ID ='$userid'");
	while($fetch = mysql_fetch_array($query)){
		$fname = $fetch["fName"];
		$lname = $fetch['lName'];
		$contact = $fetch['contact'];
		$mail = $fetch['email'];
	}
		}
		
		$marker = mysql_query("select lat, lng from markers where roomAdvertID = $roomadvertid");
		if(($rowmakers = mysql_num_rows($marker)) > 0){
			while($fetchmarker = mysql_fetch_array($marker)){
				$lat = $fetchmarker['lat'];
				$lng = $fetchmarker['lng'];
				}
		}else{
			$lat = 0.313611;
			$lng = 32.581111;
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../css/bootstrap.css" rel="stylesheet" />
<link href="../css/display.css" rel="stylesheet" />
<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href="../css/main.css" rel="stylesheet" />
<link href="../css/hostel.css" rel="stylesheet" />
<link href="../css/view.css" rel="stylesheet" />
<link href="../css/flickity.css" rel="stylesheet" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<link rel="shortcut icon" href="../images/icon box.png" type="image/png" />
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
<script src="../js/jquery-1.11.2.js" type="text/javascript"></script>
<script src="../js/flickity.pkgd.min.js"></script>
<!----------------fancy-bbox application------------------------------>
	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="../fancyapps/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    
	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="../fancyapps/source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="../fancyapps/source/jquery.fancybox.css?v=2.1.5" media="screen" />
    
	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="../fancyapps/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="../fancyapps/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    
	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="../fancyapps/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="../fancyapps/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	<script type="text/javascript" src="../fancyapps/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

		
		});
	</script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>

<!----------------------------------------------------------------------------->
    <script type="text/javascript">
    //<![CDATA[

    var customIcons = {
      restaurant: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
      },
      bar: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png'
      }
    };
		var lat = <?php echo json_encode($lat)?>;
		var lng = <?php echo json_encode($lng)?>;
		var roomid = <?php echo json_encode($roomadvertid)?>;
		
    function load() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(lat, lng),
        zoom: 13,
        mapTypeId: 'roadmap'
      });
      var infoWindow = new google.maps.InfoWindow;

      // Change this depending on the name of your PHP file
      downloadUrl("mapsloc.php?roomAdvertID="+roomid, function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("name");
          var address = markers[i].getAttribute("address");
          var type = markers[i].getAttribute("type");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html = "<b>" + name + "</b> <br/>" + address;
          var icon = customIcons[type] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon
          });
          bindInfoWindow(marker, map, infoWindow, html);
        }
      });
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}

    //]]>

  </script>
</head>

<body onload="load()">
<!--facebook sdk-->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1541302149487185',
      xfbml      : true,
      version    : 'v2.2'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<div class="body1">
<div class="body2">
<span class="">
<nav class="navbar navbar-default" role="navigation"> 
	<div class="navbar-header"> 
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse"> 
            <span class="sr-only">Toggle navigation</span> 
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
        </button> 
        <a class="navbar-brand" href="../index.php"><img src="../images/logo_second.png" class="logo"/></a> 
    </div> 
    <div class="collapse navbar-collapse" id="example-navbar-collapse"> 
        <ul class="nav navbar-nav">
    <?php
		if(isset($_SESSION['logged_in'])){
					$notificationsicon = "select * from notifications where notified_mail = '".$_SESSION['email']."' and status='unseen'";
					$query_notification = mysql_query($notificationsicon);
					$notificationfirst = mysql_num_rows($query_notification);
					
					if($notificationfirst > 0){
						$newnotifications = $notificationfirst;
					}
	?>
        <li class='dropdown' data-count='' id='notifications'>
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class='fa fa-bell'></i></a>
                    <ul class='dropdown-menu alert-dropdown'>
        	<?php
					
					$notifications = "select * from notifications where notified_mail = '".$_SESSION['email']."' order by notification_date desc LIMIT 0, 5";
					$allnotifications = mysql_query($notifications);
					
					if(($rownotification = mysql_num_rows($allnotifications)) > 0){
						while($fetchnotification = mysql_fetch_array($allnotifications)){
						
						echo "<li class='message-preview'>	
							 <a href='".$fetchnotification['link']."'>
							<div class='media'>
                                    <div class='media-body'>
                                        <h5 class='media-heading' style='color:#FF8000;'<strong>".$fetchnotification['notificationtitle']."</strong>
                                        </h5>
                                        <p class='wrapcontent'>".$fetchnotification['notification']."</p>
										<p class='small text-muted'><i class='fa fa-clock-o'></i> ".date("l jS  F, Y", strtotime($fetchnotification['notification_date']))."</p>
                                    </div>
                                </div>
								</a></li>";
							}
						}else{
							echo "<li>No New Notifications</li>";
						}
					echo "<li class='divider'></li>
                        <li>
                            <a href='?token=notifications'>View All</a>
                        </li>
                    </ul>
                </li>";
				}
			?>
                          
        	<li><a href="?click=advertiseroom"><button class="btn btn-default advertbtn">+ Add Free Room Advertisement</button></a></li>
            <!--<li><a href=""><span class='glyphicon glyphicon-envelope'></span></a></li>-->
            <li class="dropdown"> 
                <?php 
					  if(!isset($_SESSION['logged_in'])){
					 	echo " <a href='?click=login'><span class='glyphicon glyphicon-user'></span> My Account</a> ";
						
					  }else{
						echo "<a href='' class='dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-user'></span> Hi ".$_SESSION['fName']." <b class='caret'></b></a>";
						echo "<ul class='dropdown-menu'>
								<li>
									<a href='?token=profile'><i class='fa fa-fw fa-user'></i> Profile</a>
								</li>
								<li>
									<a href='?token=soldlist'><i class='fa fa-fw fa-dollar'></i> Sold Out List</a>
								</li>
								<li class='divider'></li>
								<li>
									<a href='?click=logout'><i class='fa fa-fw fa-power-off'></i> Log Out</a>
								</li>
                            </ul>";
					  }
					  ?>
            </li> 
        </ul> 
    </div> 
</nav>
</span>

<div>&nbsp;</div>
<div class="row">
<div class="col-md-1">
</div>
<div class="col-md-7">

<div class="row">
<div class="display">
<div class="gallery js-flickity"
  data-flickity-options='{ "imagesLoaded": true, "percentPosition": false }'>
<?php 
	$img = mysql_query("select * from image where roomAdvertID = ".$_REQUEST['roomAdvertID']."");
	if(!$img)
	echo "never worked";
	if(($img_row = mysql_num_rows($img)) > 0){
	while($img_collection = mysql_fetch_assoc($img)){
		echo "<a class='fancybox-buttons's data-fancybox-group='button' href='".$img_collection['image']."'>";
		echo "<img src='".$img_collection['image']."' class='img-rounded img-responsive img-display'></img>";
		echo "</a>";
		}	
	}
?>
</div>
<div>&nbsp;</div>
<label class="accampodation" style="font-size: 1.4em;"><?php echo $title; ?></label>
<div class="row head">
<p>General Information</p>
</div>
<label class="demo">Rooms Available :</label><p><?php echo $available;?></p>

<h5 class="demo">Price :</h5>	<p><?php echo "Shs	". $price; ?></p>
<h5 class="demo">Price Condition	:</h5>	<p><?php echo $pxcondition; ?></p>
<div>&nbsp;</div>
<div class="row">
<div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>
</div>
</div>
</div>
<div class="row">
	<div class="display gap">
    	<div class="row head">
        	<label class="accampodation">Property Details</label>
        </div>
        <div class="row">            
            <table class="table table-hover"> 
            <tbody> 
            <tr><td><label class="labeltitle">Wash Rooms  :</label></td> <td><p><?php echo $wash; ?></p></td> </tr> 
            <tr> <td><label class="labeltitle">Room Status  :</label></td> <td><p> <?php echo $roomstatus; ?></p></td> </tr> 
            <?php if(isset($hostelname) && isset($status)){
            echo "<tr> <td><label class='labeltitle'>Hostel Name  : </label></td> <td>". $hostelname."</td> </tr>";
            echo "<tr> <td><label class='labeltitle'>Hostel Status  :	</label></td> <td>". $status."</td> </tr>";
            }
            ?>
            <tr> <td><label class="labeltitle">Transport  :	</label></td> <td><?php echo $transport; ?></td> </tr>
            <tr> <td><label class="labeltitle">Address  :		</label></td> <td><p class="address"><?php echo $address; ?></p></td> </tr>
            <tr> <td><label class="labeltitle">Town  :		</label></td> <td><p class="town"><?php echo $town; ?></p></td> </tr>
            <tr> <td><label class="labeltitle">Region  :		</label></td> <td><p class="region"><?php echo $region; ?></p></td> </tr> 
            </tbody> 
            </table>
        </div>
        <div class="row head">
        	<label class="accampodation">Other Specifications/ Facilities</label>
        </div>
        <div class="row">
        <table class="table table-striped"> 
        <thead></thead> 
        <tbody> 
       <?php 
	   $query = mysql_query("SELECT * FROM other_specs WHERE roomAdvertID = $roomadvertid");
	   if(($rows = mysql_num_rows($query)) > 0){
			while($fetch = mysql_fetch_array($query)){
				echo "<tr> <td>".$fetch['other_specs']."</td></tr> ";
			}
	   }
        ?>
        </tbody> 
        </table>
        </div>
        <div class="row head">
        	<label class="accampodation">Condition</label>
        </div>
        <div class="row mapcontainer" style="padding: 10px;">
        	<p><?php echo $roomcondition; ?></p>
        </div>
    </div>
</div>
<div class="row">
	<div class="display gap">
    	<div class="row head">
        	<label class="accampodation">Location On Map</label>
        </div>
        <div class="row">
        	<div class="mapcontainer">
    			<div id="map" style="width: auto; height: 450px"></div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="col-md-3">
	<div class="display">
    <div class="row head">
    	<label class="accampodation">Agent Information</label>
    </div>
    
    <div class="row">
		<?php   echo"<p><label>Name :</label> ".$fname."	".$lname."</p>
        <p><label>Telephone : </label> ".$contact."</p>"?>
        <p><label>Email :</label><span class='agentmail'><?php echo $mail; ?></span></p>
    </div>
    <div>&nbsp;</div>
    <!--<div class="mapcontainer">-->
    	<div class="row head">
        	<label class="register">Ask About Room</label>
        </div>
        <!--<div class="container-below">-->
        	<form action="" method="post" role="form">
            	<p class="report" id="report"></p>
                <div class="form-group mapping">
                    <input type="text" class="demo-call contact" id="contact" name="contact" placeholder="Contact e.g +2567********"/>
                </div>
                <div class="form-group mapping">
                    <input type="text" class="demo-call mail" id="mail" name="mail"  placeholder="Your email e.g *******@gmail.com" value ="<?php if(isset($_SESSION['useremail'])) echo $_SESSION['useremail']; ?>"/>
                </div>	
                <div class="form-group mapping">
                        <label for="qtn" class="demo">Your Question</label>
                        <textarea rows="8" class="demo-text qn" id="question" name="qtn" placeholder="<?php echo "Hi ".$fname.", I would like to get more information regarding this room/s at ".$address.", ".$town.", ".$region; ?>"></textarea>
                </div>
                <button type="submit" class="btn btn-default questionbtn" id="qn"><span class="glyphicon glyphicon-circle-arrow-up"></span>  Send</button>
            </form>
           <!-- </div>
    	<!--</div>-->
    <div>&nbsp;</div>
    <div class="row head">
    	<label class="register">Recommend Room</label>
    </div>
    <div class="row">
		<form action="#" role="form">
        	<p id="recomending_error"></p>
            <div class="form-group mapping">
                <input type="text" class="demo-call sender_mail" id="mail" name="mail"  placeholder="your email e.g *******@gmail.com"/>
            </div>
        	<div class="form-group mapping">
                <input type="text" class="demo-call reco_mail" id="mail" name="mail"  placeholder="enter email e.g *******@gmail.com"/>
            </div>
            <button type="submit" class="btn btn-default recommendbtn" id="qn"><span class="glyphicon glyphicon-thumbs-up"></span> Recommend</button>
        </form>
    </div>
    </div>
</div>

</div>

<div class="outter">
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
    	<div class="col-md-6">
        	<div class="col-sm-6">
        	<ul class="local-link socialworks">
            	<label class="accampodation"><h4>SITE</h4></label>
            	<li><a href="#">About uS</a></li>
                <li><a href="#">Terms Of Service</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Copy Rights</a></li>
                <li><a href="#">Blog</a></li>
            </ul>
            </div>
            <div class="col-sm-6">
            	<ul class="local-link socialworks">
                <label class="accampodation"><h4>MORE</h4></label>
            	<li><a href="#">Advertise With Us</a></li>
                <li><a href="#">Terms Of Service</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Site Tourage</a></li>
                <li><a href="#">Benefits</a></li>
            </ul>
            </div>
        </div>
        <div class="col-md-6">
        	<a class="social-icons" href="https://facebook.com/YOUR-PROFILE"><img src="../images/Standard-Circle/32x32-Circle-56-FB.png"/></a>
			<a class="social-icons" href="https://twitter.com/YOUR-PROFILE"><img src="../images/Standard-Circle/32x32-Circle-64-TW.png" /></a>
            <a class="social-icons" href="https://plus.google.com/YOUR-PROFILE"><img src="../images/Standard-Circle/32x32-Circle-79-GP.png"/></a>
            <a class="social-icons" href="http://www.linkedin.com/in/YOUR-PROFILE"><img src="../images/Standard-Circle/32x32-Circle-55-LI.png"/></a>
            <a class="social-icons" href="http://pinterest.com/YOUR-PROFILE"><img src="../images/Standard-Circle/32x32-Circle-75-P.png"/></a>
            <a class="social-icons" href="http://www.youtube.com/user/YOUR-PROFILE"><img src="../images/Standard-Circle/32x32-Circle-81-YT.png"/></a>
            <a class="social-icons" href="http://yourdomain.com/YOUR-RSS-FEED"><img src="../images/Standard-Circle/32x32-Circle-93-RSS.png"/></a>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>
<hr class="horizontal_rule"/>
<div class=" row">
        <div class="copyright">
            <h5>©2014 travon Inc® All Rights Reserved <a href="#">User Agreement</a> and <a href="#">Cookies</a></h5>
        </div>
    </div>
</div>

</div>
</div>
</div>
<script src="../js/bootstrap.js" type="text/javascript"></script>
<script src="../js/display.js" type="text/javascript"></script>
<script type="text/javascript">
	$('#notifications a').hover(function() {
        $.ajax({
			url : '../logic/removenotification.php',
			type: 'GET',
			dataType:"json",
			data: {},
			success: function(data){
				if(data == 'success'){
					$('.navbar li').removeClass('notification');
				}
				},
			error: function(){
				console.log('something is wrong with this function');
				}
			});
			return false;
    });
</script>
</body>
</html>