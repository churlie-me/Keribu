<?php
	include("config.php");
	
	$query = mysql_query("select * from roomadvert inner join hostel on roomadvert.hostelID = hostel.hostelID ORDER BY advertDate DESC LIMIT 0, 6");
	
	$row = mysql_num_rows($query);
	
	if($row > 0){
	while($fetch = mysql_fetch_array($query)){
		echo "<a href='view/display.php?roomAdvertID=".$fetch['roomAdvertID']."'>
			<div class='col-sm-4 img-responsive'>
			<div class='image-box img-responsive'>
				<img src='".$fetch['mainimage']."' class='image img-responsive' alt='Image Loading....'>
				<span class='img-responsive'>";
						 echo " <p class='glyphicon glyphicon-map-marker' style='padding: 0px; padding-left: 0px; margin: 0px; margin-bottom: 0px; text-align: left'>".$fetch['address'].", ".$fetch['town'].", ".$fetch['Region']."</p>";echo "<p><div class=' img-responsive' style='padding: 0px; margin: 0px; margin-bottom: -33px;'>Shs  ".number_format($fetch['price'])."</div><div class='img-responsive' style='padding: 0px; text-align: right; margin-bottom: -5px;'>";
						 //determining the number of wash rooms
					if($fetch['washRooms'] == 'Self-Contained'){
						$wash = 1;
				echo "<img src='images/icons/samll/bath.png'>".$wash;
					}
					if($fetch['roomStatus'] == 'Single'){
						$room = 1;
				 		echo " <img src='images/icons/samll/bed.png'> ".$room;
					}else if($fetch['roomStatus'] == 'Double(2 Persons)'){
						$room = 2;
						echo " <img src='images/icons/samll/bed.png'> ".$room;
						}else if($fetch['roomStatus'] == 'Tri(3 Persons)'){
							$room = 3;
							echo " <img src='images/icons/samll/bed.png'> ".$room;
							}else if($fetch['roomStatus'] == 'Quad(4 Persons)'){
								$room = 4;
								echo " <img src='images/icons/samll/bed.png'> ".$room;
							}
						 
						 echo "</div></p></span>
			</div>
			</div></a>";
		}
		}
?>