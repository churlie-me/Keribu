<?php
	ob_start();
 	session_start();
 
	if(isset($_SESSION['title']) && isset($_SESSION['propertytype'])){
	$roomtype = $_SESSION['propertytype'];
	}
	include("config.php");
	
	//sellers identity
	$sellerID = $_SESSION['client_ID'];
	//for room specifications
	$title = mysql_real_escape_string(trim($_POST['title']));
	$washrooms = mysql_real_escape_string(trim($_POST['wash']));
	$roomStatus = mysql_real_escape_string(trim($_POST['roomtype']));
	$roomno = mysql_real_escape_string(trim($_POST['rooms']));
	$price = mysql_real_escape_string(trim($_POST['price']));
	$pxcond = mysql_real_escape_string(trim($_POST['pxconditions']));
	
	//hostel specifications	
	$hostelname = mysql_real_escape_string(trim($_POST['name']));
	$status = trim($_POST['status']);
	$transport = trim($_POST['transport']);
	$region = mysql_real_escape_string(trim($_POST['region']));
	$town = mysql_real_escape_string(trim($_POST['town']));
	$address = trim($_POST['address']);
	
	//condition description
	$desc = mysql_real_escape_string(trim($_POST['condition']));
	//for uploading pictures
	$pic = mysql_real_escape_string(trim($_POST['snap']));
	$pic1 = mysql_real_escape_string(trim($_POST['snap1']));
	$pic2 = mysql_real_escape_string(trim($_POST['snap2']));
	$pic3 = mysql_real_escape_string(trim($_POST['snap3']));
	
	//setting
	$image1 = basename($_FILES["snap"]["name"]);
	$image2 = basename($_FILES["snap1"]["name"]);
	$image3 = basename($_FILES["snap2"]["name"]);
	$image4 = basename($_FILES["snap3"]["name"]);
	$arrayimages = array();
	$images = array();
	$a = 0;
	if($image1 != ''){
		$arrayimages[$a] = $image1;
		$images[$a] = "snap";
		$a++;
		}
	if($image2 != ''){
		$arrayimages[$a] = $image2;
		$images[$a] = "snap1";
		$a++;
		}
	if($image3 != ''){
		$arrayimages[$a] = $image3;
		$images[$a] = "snap2";
		$a++;
		}
	if($image4 != ''){
		$arrayimages[$a] = $image4;
		$images[$a] = "snap3";
		$a++;
		}
		
	//enter hostel specifications
	if(isset($_POST['name']) && isset($_POST['status']))
	$command = "INSERT INTO hostel VALUES(null, '$hostelname', '$status', '$transport', '$region' , '$town', '$address')";
	else
	$command = "INSERT INTO hostel VALUES(null, null, null, '$transport', '$region' , '$town', '$address')";
	
	
	$query = mysql_query($command);
	if(!$query){ 
	echo "Did not insert the data";
	}
	
	
	//pick the id of the row at the bottom
	$lastid = mysql_query("SELECT MAX(hostelID) AS id FROM hostel");
	$fetch = (mysql_fetch_array($lastid));
	$hostelID = $fetch['id'];
		
	//enter room specifications
	$image_url = "http://keribu.ug/images/roomimage.jpg";
	$dt = new DateTime();
	$date = $dt->format('Y-m-d H:i:s');
	
	//echo $title. $roomtype .$roomno .$washrooms. $roomStatus. $price. $pxcond. $desc. $image_url. $date. $sellerID. $hostelID;
	//insert into roomAdvert
	if(!mysql_query("INSERT INTO roomadvert VALUES(null, '$title', '$roomtype','$roomno', '$washrooms', '$roomStatus', '$price', '$pxcond', '$desc',  '$image_url', '$date', '$sellerID', '$hostelID', '')")){ 
		echo "Did not insert the data into roomAdvert";
		}
	
	//get the roomAdvertid
	$retrive1 = mysql_query("SELECT * FROM roomadvert WHERE hostelID = '$hostelID'");
	if(($rows = mysql_num_rows($retrive1)) > 0){
		while($fetch = mysql_fetch_array($retrive1)){
		$roomAdvertID = $fetch['roomAdvertID'];
		}
		}
		// set roomadvertid session for inserting into the markers table
		$_SESSION['roomAdvert'] = $roomAdvertID;
		
		//storing other specifications*****************************************************************************************************/
		
			$specs = array();
			$i = 0;
			if(isset($_POST['balcony'])){
                $specs[$i] = $_POST['balcony'];
				$i++;
			}
			if(isset($_POST['view'])){
                $specs[$i] =  $_POST['view'];
				$i++;
			}
			
			if(isset($_POST['neighbourhood'])){
                $specs[$i] =  $_POST['neighbourhood'];
				$i++;
			}
			
			if(isset($_POST['security'])){
                $specs[$i] = $_POST['security'];
				
				$i++;
			}
			
			if(isset($_POST['tarmac'])){
               $specs[$i] = $_POST['tarmac'];
				$i++;
			}
			
			if(isset($_POST['fence'])){
                $specs[$i] =  $_POST['fence'];
				$i++;
			}
			
			if(isset($_POST['conditioner'])){
                $specs[$i] = $_POST['conditioner'];
				$i++;
			}
			
			if(isset($_POST['cable'])){
                $specs[$i] = $_POST['cable'];
				$i++;
			}
			
			if(isset($_POST['internet'])){
                $specs[$i] = $_POST['internet'];
				$i++;
			}
                                           
            if(isset($_POST['restaurant'])){
                $specs[$i] = $_POST['restaurant'];
				$i++;
			}
			
			if(isset($_POST['floor'])){
                $specs[$i] = $_POST['floor'];
				$i++;
			}
				
			if(isset($_POST['generator'])){
                $specs[$i] = $_POST['generator'];
				$i++;
			}
			
			if(isset($_POST['pool'])){
                $specs[$i] = $_POST['pool'];
				$i++;
			}
			
			if(isset($_POST['parking'])){
                $specs[$i] = $_POST['parking'];
				$i++;
			}
			
			if(isset($_POST['wardrobes'])){
                $specs[$i] = $_POST['wardrobes'];   
				$i++;
			}
                                     
			for($i = 0; $i < count($specs); $i++) {     
		 mysql_query("INSERT INTO other_specs VALUES(null, '$specs[$i]', '$roomAdvertID')");
			}
/******************************************************************************************************************************************/

		//Create Folder For Uploading Images If It Doesnot Exist
	$target_dir = "../images/userphotos/".$_SESSION['client_ID']."/";
	if(!is_dir($target_dir)){
		mkdir($target_dir);
	}
	
	$idtarget_dir = "../images/userphotos/".$_SESSION['client_ID']."/".$roomAdvertID."/";

	if(!is_dir($idtarget_dir)){
		mkdir($idtarget_dir);
	}
	
	
		//Uploading And Inserting Images
	//uploading***********************************************************************************
	
	for($array = 0; $array < count($arrayimages); $array++){
			upload($idtarget_dir, $images[$array]);
			$image_url = "http://keribu.ug/images/userphotos/".$_SESSION['client_ID']."/".$roomAdvertID."/".$arrayimages[$array];
			if($array == 0){
				mysql_query("UPDATE roomadvert SET mainimage = '$image_url' WHERE roomAdvertID = '$roomAdvertID'");
		}
			mysql_query("INSERT INTO image VALUES(null, '$image_url', '$roomAdvertID')");
		}

	header('location: location.php');
	
	mysql_close($connect);
?>

<?php 
	function upload($target_dir, $userfile){
		$target_file = $target_dir . basename($_FILES[$userfile]["name"]);

		
			move_uploaded_file($_FILES[$userfile]["tmp_name"], $target_file);
				//echo "File done uploading".basename($_FILES[$userfile]["name"])."<br/>";	
	}
	if($_FILES[$userfile]["size"] > 800000){
			compress_image($target_file, $target_file, 40);
		}
?>
<?php
	function compress_image($source_url, $destination_url, $quality) {
	$info = getimagesize($source_url);
 
	if ($info['mime'] == 'image/jpeg'){ 
		$image = imagecreatefromjpeg($source_url);
		//save it
		imagejpeg($image, $source_url, $quality);
	}elseif ($info['mime'] == 'image/gif'){
		 $image = imagecreatefromgif($source_url);
		 //save it
		imagegif($image, $source_url, $quality);
	}elseif ($info['mime'] == 'image/png'){
		 $image = imagecreatefrompng($source_url);
		 //save it
		imagepng($image, $source_url, $quality);
	}
 
	//save it
	imagejpeg($image, $destination_url, $quality);
 
	//return destination file url
	//return $destination_url;
}

?>