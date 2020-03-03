<?php
	include("../logic/controlclicks.php");
	include("../logic/config.php");
	
	if($_SESSION['useremail'] !== 'chalesaguma@ymail.com'){
		header("location: ../index.php");
		}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>keribu Admin</title>
	<link rel="shortcut icon" href="../images/icon box.png" type="image/png" />
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
	<link href="../css/sells.css" rel="stylesheet">
    <!-- Bootstrap Core CSS RTL-->
    
    <!-- Custom CSS -->
    <link href="../records/css/sb-admin.css" rel="stylesheet">
    <link href="../records/css/sb-admin-rtl.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js? sensor=false"></script>
<script type="text/javascript">
var marker;
var infowindow;

function initialize() {
  var latlng = new google.maps.LatLng(0.313611,32.581111);
  var options = {
    zoom: 13,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById("map-canvas"), options);
  var html = "<table id='windowload' style='padding: 5px;'>" +
             "<tr><td>Name:</td> <td><input type='text' id='name' style='border-radius: 4px; margin-bottom: 2px;'/> </td> </tr>" +
             "<tr><td>Address:</td> <td><input type='text' id='address' style='border-radius: 4px; margin-bottom: 2px;'/></td> </tr>" +
			 "<tr><td>Nearest Town:</td> <td><input type='text' id='town' style='border-radius: 4px; margin-bottom: 2px;'/></td> </tr>" +
			 "<tr><td>District:</td> <td><input type='text' id='district' style='border-radius: 4px; margin-bottom: 2px;'/></td> </tr>" +
             "<tr><td>Accomodation Type:</td> <td><select id='type' style='border-radius: 4px; margin-bottom: 2px;'>" +
             "<option value='hostel' SELECTED>hostel</option>" +
             "<option value='rentals'>rental</option>" +
             "</select> </td></tr>" +
             "<tr><td></td><td><input type='button' value='Save & Close' onclick='saveData()' style='border: 1px solid #fff; background: #033; color: #fff; border-radius: 4px;'/></td></tr>";
			 
infowindow = new google.maps.InfoWindow({
 content: html
});

google.maps.event.addListener(map, "click", function(event) {
    marker = new google.maps.Marker({
      position: event.latLng,
      map: map
    });
    google.maps.event.addListener(marker, "click", function() {
      infowindow.open(map, marker);
    });
});
}

function saveData() {
  var name = escape(document.getElementById("name").value);
  var address = escape(document.getElementById("address").value);
  var town = escape(document.getElementById("town").value);
  var district = escape(document.getElementById("district").value);
  var type = document.getElementById("type").value;
  var latlng = marker.getPosition();

  var url = "../logic/savelocation.php?name=" + name + "&address=" + address + "&town=" + town + "&district=" + district +
            "&type=" + type + "&lat=" + latlng.lat() + "&lng=" + latlng.lng();
  downloadUrl(url, function(data, responseCode) {
    if (responseCode == 200 && data.length <= 1) {
      infowindow.close();
      document.getElementById("message").innerHTML = "Location added.";
    }
  });
}

function downloadUrl(url, callback) {
  var request = window.ActiveXObject ?
      new ActiveXObject('Microsoft.XMLHTTP') :
      new XMLHttpRequest;

  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      request.onreadystatechange = doNothing;
      callback(request.responseText, request.status);
    }
  };

  request.open('GET', url, true);
  request.send(null);
}

function doNothing() {}
</script>
</head>

<body style="margin:0px; padding:0px;" onload="initialize()">

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php"><img src="../images/logo_second.png" class="logo"/></a> 
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                 <?php
		if(isset($_SESSION['user_ID'])){
					$notificationsicon = "select * from notifications where notified_mail = '".$_SESSION['useremail']."' and status='unseen'";
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
					
					$notifications = "select * from notifications where notified_mail = '".$_SESSION['useremail']."' order by notification_date desc LIMIT 0, 5";
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
										<p class='small text-muted'><i class='fa fa-clock-o'></i>".date("l jS  F, Y", strtotime($fetchnotification['notification_date']))."</p>
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
                
                <li><a href="?click=advertiseroom">Advertise Room/s</a></li>
                <li class="dropdown">
                     <?php 
					  if(!isset($_SESSION['user_ID'])){
					 	echo " <a href='?click=login'><span class='glyphicon glyphicon-user'></span> My Account</a> ";
						
					  }else{
						echo "<a href='' class='dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-user'></span> Hi ".$_SESSION['fname']." <b class='caret'></b></a>";
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
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="admin.php"><i class="fa fa-fw fa-comments"></i> View Comments n Requests</a>
                    </li>
                    <li>
                        <a href="charts.html"><i class="fa fa-fw fa-bar-chart-o"></i>Manage Listings</a>
                    </li>
                    <li class="active">
                        <a href="loc.php"><i class="fa fa-fw fa-map-marker"></i> Record NEW Location</a>
                    </li>
                    <li>
                        <a href="forms.html"><i class="fa fa-fw fa-edit"></i>Managa Clients</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Record A New Location On Map
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-map-marker"></i> Address Geocoding
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
					<div class="container">
                        <div class="row" style="margin-top: 0px;">
                            <label class="register web">Get The Articulate Location Of The Hostel We Need To Record</label></div>
                        </div>
                        
                        <div class="row" style="padding-bottom: 0px;">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="head1">
                                    <label><span class='glyphicon glyphicon-ok'></span>Tip</label>
                                </div>
                            </div>
                            <div class="row">
                                <p>Find The Location And Click At The Point To Record Information About In A Small Popup Information Window And Click The Save Button To Save Your Information Into Our Database</p>
                            </div>
                            <div class="done"></div>
                        </div>
                        </div>
                        
                        <div class="row google">
                            <div class="col-md-12">
                            	<div id="map-canvas" style="width: auto; height: 400px"></div>
                            	<div id="message"></div>
                        	</div>
                        </div>
                
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../records/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../records/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->

</body>

</html>
