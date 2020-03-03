<?php
	include("../logic/config.php");
	
	//create an array to hold the values
	
	$query = mysql_query("select * from markers_loc where 1");
	
	if(($row = mysql_num_rows($query))>0){
		$searchvalues = array ();
	
		while(($fetch = mysql_fetch_array($query))){
			/*
			*the array  $characters increments the position of the inner array every after assigning the individual indexes
			*/			
		$searchvalues[] = $fetch["address"];
			}
			
		echo json_encode($searchvalues);
	}else{
		echo 'No Results';
	}
	mysql_close($con);
?>
