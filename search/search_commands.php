<?php
		//depending on the selected options made by the user, we make selectiong of wat query is to be executed
						if(isset($region) && isset($price) && isset($_REQUEST['roomtype']) && $_REQUEST['roomtype'] !='' && isset($_REQUEST['room']) && isset($_REQUEST['bathroom']) && $_REQUEST['status'] != ''){
							//echo "all are set";
							$query_string = "SELECT * FROM roomadvert INNER JOIN hostel ON roomadvert.hostelID = hostel.hostelID WHERE (Region = '$region' OR town = '$region' OR address = '$region') and price <= $price and roomType = '".$_GET['room']."' and roomStatus = '".$_GET['roomtype']."' and status = '".$_GET['status']."' and washRooms = '".$_GET['bathroom']."' ORDER BY advertDate DESC LIMIT $starting_index, $max_records_per_page";
							
							$pagination_links = "SELECT * FROM roomadvert INNER JOIN hostel ON roomadvert.hostelID = hostel.hostelID WHERE (Region = '$region' OR town = '$region' OR address = '$region') and price <= $price and roomType = '".$_GET['room']."' and roomStatus = '".$_GET['roomtype']."' and status = '".$_GET['status']."' and washRooms ='".$_GET['bathroom']."' ORDER BY advertDate DESC";
							
							$nextpage = "search.php?region=$region&price=$price&room=".$_GET['room']."&roomtype=".$_GET['roomtype']."&status=".$_GET['status']."&washRooms=".$_GET['bathroom']."";
					
						//working articulatly*********************************************************************/
						}else if(isset($region) && isset($price) && isset($_REQUEST['roomtype']) && $_REQUEST['roomtype'] != '' && isset($_REQUEST['room']) && isset($_REQUEST['bathroom']) && $_REQUEST['status'] == ''){
							//echo "status not set";
							$query_string = "SELECT * FROM roomadvert INNER JOIN hostel ON roomadvert.hostelID = hostel.hostelID WHERE (Region = '$region' OR town = '$region' OR address = '$region') and price <= $price and roomType = '".$_GET['room']."' and roomStatus = '".$_GET['roomtype']."' and washRooms = '".$_GET['bathroom']."' ORDER BY advertDate DESC LIMIT $starting_index, $max_records_per_page";
							
							$pagination_links = "SELECT * FROM roomadvert INNER JOIN hostel ON roomadvert.hostelID = hostel.hostelID WHERE (Region = '$region' OR town = '$region' OR address = '$region') and price <= $price and roomType = '".$_GET['room']."' and roomStatus = '".$_GET['roomtype']."' and washRooms ='".$_GET['bathroom']."' ORDER BY advertDate DESC";
							
							$nextpage = "search.php?region=$region&price=$price&room=".$_GET['room']."&roomtype=".$_GET['roomtype']."&status=".$_GET['status']."&washRooms=".$_GET['bathroom']."";
							
						//working articulatly****************************************************************************/
						}else if(isset($region) && isset($price) && isset($_REQUEST['roomtype']) && $_REQUEST['roomtype']=='' && isset($_REQUEST['room']) && isset($_REQUEST['bathroom']) && $_REQUEST['status'] == ''){
							//echo "roomtype and status are not set";
							
							$query_string = "SELECT * FROM roomadvert INNER JOIN hostel ON roomadvert.hostelID = hostel.hostelID WHERE (Region = '$region' OR town = '$region' OR address = '$region') and price <= $price and roomType = '".$_GET['room']."' and washRooms = '".$_GET['bathroom']."' ORDER BY advertDate DESC LIMIT $starting_index, $max_records_per_page";
							$pagination_links = "SELECT * FROM roomadvert INNER JOIN hostel ON roomadvert.hostelID = hostel.hostelID WHERE (Region = '$region' OR town = '$region' OR address = '$region') and price <= $price and roomType = '".$_GET['room']."' and washRooms ='".$_GET['bathroom']."' ORDER BY advertDate DESC";
							$nextpage = "search.php?region=$region&price=$price&room=".$_GET['room']."&washRooms=".$_GET['bathroom']."";
							
						}else if(isset($region) && isset($price) && isset($_REQUEST['roomtype']) && $_REQUEST['roomtype']=='' && isset($_REQUEST['room']) && isset($_REQUEST['bathroom']) && $_REQUEST['status'] != ''){
							//echo "roomtype not set";
							$query_string = "SELECT * FROM roomadvert INNER JOIN hostel ON roomadvert.hostelID = hostel.hostelID WHERE (Region = '$region' OR town = '$region' OR address = '$region') and price <= $price and roomType = '".$_GET['room']."' and status = '".$_GET['status']."' and washRooms = '".$_GET['bathroom']."' ORDER BY advertDate DESC LIMIT $starting_index, $max_records_per_page";
							
							$pagination_links = "SELECT * FROM roomadvert INNER JOIN hostel ON roomadvert.hostelID = hostel.hostelID WHERE (Region = '$region' OR town = '$region' OR address = '$region') and price <= $price and roomType = '".$_GET['room']."' and status = '".$_GET['status']."' and washRooms ='".$_GET['bathroom']."' ORDER BY advertDate DESC";
							
							$nextpage = "search.php?region=$region&price=$price&room=".$_GET['room']."&status=".$_GET['status']."&washRooms=".$_GET['bathroom']."";
						}else if(isset($region) && isset($price) && isset($_REQUEST['room']) && $_REQUEST['roomtype'] != ''){
							//echo "all set from index page";
							$query_string = "SELECT * FROM roomadvert INNER JOIN hostel ON roomadvert.hostelID = hostel.hostelID WHERE (Region = '$region' OR town = '$region' OR address = '$region') and price <= $price and roomType = '".$_GET['room']."' and roomStatus = '".$_GET['roomtype']."' ORDER BY advertDate DESC LIMIT $starting_index, $max_records_per_page";
						
						$pagination_links = "SELECT * FROM roomadvert INNER JOIN hostel ON roomadvert.hostelID = hostel.hostelID WHERE (Region = '$region' OR town = '$region' OR address = '$region') and price <= $price and roomType = '".$_GET['room']."' and roomStatus = '".$_GET['roomtype']."' ORDER BY advertDate DESC";
						
						$nextpage = "search.php?region=$region&price=$price&room=".$_GET['room']."&roomStatus = '".$_GET['roomtype']."'";
						}else if($region !='' && $price!= '' && isset($_REQUEST['room']) && $_REQUEST['room'] != '' && $_REQUEST['roomtype'] == ''){
							//echo "roomtype not set from index";
						$query_string = "SELECT * FROM roomadvert INNER JOIN hostel ON roomadvert.hostelID = hostel.hostelID WHERE (Region = '$region' OR town = '$region' OR address = '$region') and price <= $price and roomType = '".$_GET['room']."' ORDER BY advertDate DESC LIMIT $starting_index, $max_records_per_page";
						
						$pagination_links = "SELECT * FROM roomadvert INNER JOIN hostel ON roomadvert.hostelID = hostel.hostelID WHERE (Region = '$region' OR town = '$region' OR address = '$region') and price <= $price and roomType = '".$_GET['room']."' ORDER BY advertDate DESC";
						
						$nextpage = "search.php?region=$region&price=$price&room=".$_GET['room'];
						
						//works perfect***********************************************************************************/
						}else{
							//echo "nothing left";
						$query_string = "SELECT * FROM roomadvert INNER JOIN hostel ON roomadvert.hostelID = hostel.hostelID WHERE (Region = '$region' OR town = '$region' OR address = '$region') and price <= $price ORDER BY advertDate DESC LIMIT $starting_index, $max_records_per_page ";
						
						$pagination_links = "SELECT * FROM roomadvert INNER JOIN hostel ON roomadvert.hostelID = hostel.hostelID WHERE (Region = '$region' OR town = '$region' OR address = '$region') and price <= $price ORDER BY advertDate DESC";
						
						$nextpage = "search.php?region=$region&price=$price";
						}
?>