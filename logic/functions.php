<?php
	include('config.php');
	
	function _collect_relative_images($roomadvertid){
		$i = 0;
			$command = mysql_query("SELECT * FROM image WHERE roomAdvertID = '$roomAdvertid'");
			if(($collect = mysql_num_rows($command)) > 0){
				while($fetch_images = mysql_fetch_assoc($command)){
					$room_images[$i] = $fetch_images['image'];
					$i++;
				}
			}
			print_r($room_images);
		return $room_images;
	}
?>