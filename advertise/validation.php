<?php
	$userfile = $_REQUEST['name'];
	     
		// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES[$userfile]["tmp_name"]);
			if($check == false) {
				echo $userfile."Not an image.";
				//file format
			/*}else if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpeg" && $imageFileType != "JPEG" && $imageFileType != "gif" && $imageFileType != "GIF"){
				echo "Not Image Form";*/
		//Limit Size Of Image
	}else if($_FILES[$userfile]["size"] > 800000){
			echo "Image is too big";
		}else{
			echo "success";	
		}
?>