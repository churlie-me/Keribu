<?php
	include("../logic/controlclicks.php");
	require("../logic/config.php");
	$hostelname = $_GET['hostelName'];
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/bootstrap.css" rel="stylesheet" />
<link href="../css/hostel.css" rel="stylesheet" />
<link href="../css/main.css" rel="stylesheet" />
<link href="../css/divtag.css" rel="stylesheet" />
<link href="../css/sells.css" rel="stylesheet" />
<link href="../css/display.css" rel="stylesheet" />
<link href="../css/animate.css" rel="stylesheet" />
<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<title>keribu > hostelz</title>
<link rel="shortcut icon" href="../images/icon box.png" type="image/png" />
</head>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #033; color: #FFF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#FFF;"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">REQUEST RESULT</h4>
      </div>
      <div class="modal-body" style=" color: #033; text-align: center">
       Thank You For Your Concern, We will comply to your request shortly
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>
<body onload="load()">
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
		<div class="space">&nbsp;</div>
        <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
		<div class="row">
        	<form action="hostelzloc.php" method="get" name="hostelsearch">
        	<div class="input-group"> 
            	<input type="text" class="form-control" name ="hostelName" placeholder="enter Hostel Name e.g Nana Hostels" id="hostel_tags"> 
                <span class="input-group-btn"> 
                	<button class="btn btn-default" type="submit" style="background: #FF8000; color: #fff;"> <span class="glyphicon glyphicon-search"></span> Go </button> 
                </span> 
            </div>
            </form>
        </div>
<?php
	$query = mysql_query("select * from hosteldetails where hostelName like '%$hostelname%'");
	
	if(($row = mysql_num_rows($query)) > 0){
		while($fetch = mysql_fetch_assoc($query)){
			$hostelid = $fetch["hostelDet_ID"];
			$lat = $fetch["lat"];
			$lng = $fetch["lng"];
			echo "<div class='row display fill'>
						<p><label class id='hostel_header'>".$fetch['hostelName']."</label></p>
						<p><label>Address :	</label>	".$fetch['address'].",	".$fetch['nearbyTown'].",	".$fetch['district']."</p>
					</div>";
		}
?>
        <div class="row" style="margin-bottom: 50px;">
            <div class="display gap fill">
                <div class="row head">
                    <label class="accampodation">Location On Map</label>
                </div>
                <div class="row">
                    <div class="mapcontainer">
                        <div id="map" style="width: auto; height: 450px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
	}else{
		?>
        <div class="row">
            <div class='display gap fill'>
            	<div class='no_results' id="no_Results">No Hostel Found With Such A Name</div>
            </div>
        </div>
        
        <div class="row gap" style="margin-top: 50px; margin-bottom: 70px;">
        	<div class="headercontent register">
                Are You Failing To See The Hostel?
            </div>
        	<div class='display fill'>
            	<div class="row" style="text-align: center;">
                	<label class="accampodation">Give Us The Hostel's Name And We Will Have It Added To The Map</label>
                </div>
                <div>&nbsp;</div>
                <div style="padding: 5px 20px;">
                <div class="row">
                <div class="head1">
                	<label><span class='glyphicon glyphicon-ok'></span>Tip</label>
                </div>
            </div>
            <div class="row">
            	<p> <strong class="register">(Optional)</strong> Indicate The Location You Might Be Knowing Of The Existing Hostel, Because This Helps Us Locate The It Easily</p>
            </div>
            </div>
                <div class="row">
                	<form action="#" role="form" class="form-horizontal">
                    <div class="form-group"> 
                        <label for="lastname" class="col-sm-3 control-label">Email </label> 
                        <div class="col-sm-9"> 
                            <input type="text" class="form-control" id="email" placeholder="Enter email"> 
                        </div> 
                    </div>
                    <div class="form-group"> 
                        <label for="lastname" class="col-sm-3 control-label">Hostel Name</label> 
                        <div class="col-sm-9"> 
                            <input type="text" class="form-control" name= "hname" id="hname" placeholder=""> 
                        </div> 
                    </div>
                    <div class="form-group" style=""> 
                        <label for="lastname" class="col-sm-3 control-label">Address</label> 
                        <div class="col-sm-9"> 
                            <input type="text" class="form-control" name="add" id="add" placeholder=""> 
                        </div> 
                    </div>
                    <p id="errortext"></p>
                        <div class="col-sm-3 control-label"></div><div class="col-sm-9">
                       	<button input="submit" class="btn btn-default" id="sendrequest" style="color: #fff; background: #033;"> Submit </button></div>
                    </form>
                </div>
            </div>
        </div>
	<?php }
	?>
        </div>
        <div class="col-sm-3"></div>
        </div>
             <hr class="horizontal_rule">
        <div class="row">
        	<div class="col-sm-2"><a href="#">About keribu</a></div>
            <div class="col-sm-2"><a href="../conditions/privacypolicy.html">Privacy Policy</a></div>
            <div class="col-sm-2"><a href="../contact/contact.php">Contact Us</a></div>
            <div class="col-sm-2"><a href="#">FAQs</a></div>
            <div class="col-sm-2"><a href="../conditions/tos.php">Terms Of Service</a></div>
            <div class="col-sm-2"><a href="#">Help Us Deliver Better</a></div>
        </div>
<div class=" row">
	<div class="outter">
        <div class="copyright">
            <h5>©2014 travon Inc® All Rights Reserved <a href="#">User Agreement</a> and <a href="#">Cookies</a></h5>
        </div>
    </div>
</div>
    </div>
</div>
<script src="../js/jquery-1.11.2.js" type="text/javascript"></script>
<script src="../js/bootstrap.js" type="text/javascript"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
	<script type="text/javascript">
		 $(function() {
	  var notifications = <?php echo json_encode($newnotifications);?>;
	  
		if(notifications != null){
			console.log(notifications);
			$('#notifications').addClass("notification");
			$('#notifications').attr("data-count", notifications);
			var title = $('title').text();
			var titletext = title + "	("+ (notifications) +")";
			$("title").text(titletext);
		}
	  var availableTags = [];
	 $('#tags').on('focus', function(){
		//console.log('am inside');
		 $.ajax({
		  url: 'logic/live.php',
		  type: 'GET',
		  dataType:"json",
		  success: function(data){
			  if(data == 'No Results'){
				  console.log(data);
				  }else{
					  availableTags = data;
						console.log(availableTags[1]);
						 $( "#tags" ).autocomplete({
							  source: availableTags
							});
				  }
		  },
		  error: function(){
			  console.log('Something is wrong');
		  }
		  });
		  
		 });
	

	$('#notifications a').focus(function() {
		//$('#notifications').addClass("dropdown-menu");
		//$('#notifications').addClass("alert-dropdown");
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
			//$("title").text(titletext);
			$("title").text(title);
			return false;
    });
  });
	</script>
    <script type="text/javascript">
    //<![CDATA[
	var hostel_ID = <?php echo json_encode($hostelid); ?>;
		console.log(hostel_ID);
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
		console.log("hostelloc.php?hostel_ID="+hostel_ID);
    function load() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(lat, lng),
        zoom: 13,
        mapTypeId: 'roadmap'
      });
      var infoWindow = new google.maps.InfoWindow;
      // Change this depending on the name of your PHP file
      downloadUrl("hostelloc.php?hostel_ID="+hostel_ID, function(data) {
		  
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
  <script src="../js/loc.js" type="text/javascript"></script>
  <script>
  $(document).ready(function(){
	  $('#hostel_header').addClass('animated rotateIn');
	  $('#no_Results').addClass('animated rubberBand')
	  });
  </script>
</body>
</html>