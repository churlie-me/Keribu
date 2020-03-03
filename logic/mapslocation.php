<?php
	session_start();

// Gets data from URL parameters

$name = $_GET['name'];
$address = $_GET['address'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$type = $_GET['type'];
$roomid = $_SESSION['roomAdvert'];

// Opens a connection to a MySQL server
include("config.php");

// Insert new row with user data
$query = sprintf("INSERT INTO markers " .
     " (id, name, address, lat, lng, type, roomAdvertID ) " .
     " VALUES (NULL, '%s', '%s', '%s', '%s', '%s', '%d');",
     mysql_real_escape_string($name),
     mysql_real_escape_string($address),
     mysql_real_escape_string($lat),
     mysql_real_escape_string($lng),
     mysql_real_escape_string($type),
	 mysql_real_escape_string($roomid));

$result = mysql_query($query);

if (!$result) {
  die('Invalid query: ' . mysql_error());
}
?>
