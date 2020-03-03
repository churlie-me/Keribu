<?php
	session_start();
	if(!isset($_SESSION['roomAdvert'])){
		header("location: startsell.php");
	}
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/bootstrap.css" rel="stylesheet" />
<link href="../css/sells.css" rel="stylesheet" />
<link href="../css/hostel.css" rel="stylesheet" />
<title>keribu > Finalise..</title>
<link rel="shortcut icon" href="../images/icon box.png" type="image/png" />
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
  var html = "<table>" +
             "<tr><td>Name:</td> <td><input type='text' id='name'/> </td> </tr>" +
             "<tr><td>Address:</td> <td><input type='text' id='address'/></td> </tr>" +
             "<tr><td>Room Type:</td> <td><select id='type'>" +
             "<option value='hostel' SELECTED>hostel</option>" +
             "<option value='rental'>rental</option>" +
             "</select> </td></tr>" +
             "<tr><td></td><td><input type='button' value='Save & Close' onclick='saveData()'/></td></tr>";
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
  var type = document.getElementById("type").value;
  var latlng = marker.getPosition();

  var url = "../logic/mapslocation.php?name=" + name + "&address=" + address +
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
<div class="container">
    <div class="row">
        <a href="../index.php"><label class="web"><img src="../images/logo_second.png"/></label></a>
    </div>
    <div class="row">
        <label class="register web">Give Us The Exact Location Of The Property You're Selling</label></div>
    </div>
    <div class="row google">
    	<div class="col-md-8">
        <div id="map-canvas" style="width: auto; height: 400px"></div>
        <div id="message"></div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="head1">
                	<label><span class='glyphicon glyphicon-ok'></span>Tip</label>
                </div>
            </div>
            <div class="row">
            	<p>Find The Location And Click At The Point To Record Information About In A Small Popup Information Window And Click The Save Button To Save Your Information Into Our Database</p>
            </div>
            <div class="done"></div>
            <div class="row">
            	<button class="btn btn-default finalise" >Finish</button>
            </div>
        </div>
    </div>
    <div class="row freespace">
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
                <h5>©2014 Travon Media Group® All Rights Reserved <a href="#">User Agreement</a> and <a href="#">Cookies</a></h5>
            </div>
        </div>
    </div>
    <script src="../js/jquery-1.11.2.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.js" type="text/javascript"></script>

    <script type="text/javascript">
		var roomid = <?php echo json_encode($_SESSION['roomAdvert']);?>;
			$('.finalise').click(function(){
				window.location = "../view/display.php?roomAdvertID="+roomid;
			});
	</script>
    
</body>
</html>
