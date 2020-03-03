<?php
include("../logic/controlclicks.php");
include("../logic/config.php");
if(!isset($_SESSION['logged_in'])){
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

    <title>listings> update listing</title>
    <link rel="shortcut icon" href="../images/icon box.png" type="image/png" />
    <link href="css/list.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
	<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirm Deletion</h4>
      </div>
      <div class="modal-body">
        Are You Sure You Want To DELETE this Item?
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary confirmdelete" id="delete" data-dismiss="modal">Delete</button>
        <button type="button" class="btn btn-default cancel" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<body>
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
            <ul class="nav navbar-right top-nav ">
            
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
                    <ul class='dropdown-menu alert-dropdown' id="dropmens">
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
                
                <li><a href="?click=advertiseroom"><button class="btn btn-default profile_advertbtn">+ Add Free Room Advertisement</button></a></li>
                <li class="dropdown">
                     <?php 
					  if(!isset($_SESSION['logged_in'])){
					 	echo " <a href='?click=login'><span class='glyphicon glyphicon-user'></span> My Account</a> ";
						
					  }else{
						echo "<a href='' class='dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-user'></span> Hi ".$_SESSION['fName']." <b class='caret'></b></a>";
						echo "<ul class='dropdown-menu' id='dropmens'>
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
                        <a href="profile.php"><i class="fa fa-fw"><span class="glyphicon glyphicon-user"></span></i> Profile</a>
                    </li>
                    <li>
                        <a href="notifications.php"><i class="fa fa-fw fa-desktop"></i>Notifications</a>
                    </li>
                    <li class="active">
                        <a href="listings.php"><i class="fa fa-fw fa-table"></i> Sold Out Listings</a>
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
                            Update Listing
                        </h1>
                        
                    </div>
                </div>
                
                <!--**********************dynamic content*************************-->
    <div class="row">
     <div class="col-md-1">
     </div>
     <div class="col-md-10">
<?php 
	include("../logic/config.php");
	
	$usermail = $_SESSION['client_ID'];
	$roomAdvertID = $_REQUEST['roomAdvertID'];
	$specs = array();
	$otherspecs = mysql_query("select * from other_specs where roomAdvertID = '$roomAdvertID'");
	if(($specsrows = mysql_num_rows($otherspecs)) > 0){
		while($fetchspecs = mysql_fetch_array($otherspecs)){
			$specs[] = $fetchspecs['other_specs'];
		
		}
	}
	
	$string = "SELECT * FROM roomadvert INNER JOIN hostel ON roomAdvert.hostelID = hostel.hostelID WHERE roomAdvertID = '$roomAdvertID'";
	$query = mysql_query($string);
	if(($rows = mysql_num_rows($query)) > 0){
		while($fetch = mysql_fetch_array($query)){
			$array = $fetch['title'];
			$roomType = $fetch['roomType'];
			$transport = $fetch['transport'];
			$wash = $fetch['washRooms'];
			$type = $fetch['roomStatus'];
			$pxcondition = $fetch['priceCondition'];
			$status = $fetch['status'];
			$region = $fetch['Region'];
			
			if($roomType == 'Hostel Room'){
		?>
    <div class="row" style="margin: 0px -50px;">
        <form  id="postadvert" name="advert" action="../logic/updatelisting.php"  method="post" role="form" enctype="multipart/form-data">
            <div class="row">
                <div class="posted">
                    <div class="head1">
                        <label>Title</label>
                    </div>
                    <div class="limit1 content1">
                    <div class="row reign">
                    	<div class="col-sm-9 take">
                        	<div class="form-group reign">
                            	<input type="text" class="room-control" id="title" name="title" value="<?php echo $fetch['title']; ?>">
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="post">
                    <div class="head1">
                        <label>Room Specifications</label>
                    </div>
                    <div class=" limit2 content1">
                        <div class="row">
                            <div class="col-sm-9 take">
                                <div class="form-group reign">
                                    <div class="row">
                                        <label for="rooms" class="register">Wash-Rooms</label> 
                                    </div>
                                    <div class="row">  
                                        <select class="room-control" id="wash" name="wash">
                                        	<option value="">Select washrooms</option>
                                            <option value="Self-Contained">Self-Contained</option>
                                            <option value="Basic">Basic</option>
                                        </select>  
                                    </div>  
                        		</div>
                                <div class="form-group reign">
                                    <div class="row">
                                        <label for="rooms" class="register">Room Type</label> 
                                    </div>
                                    <div class="row">  
                                        <select class="room-control" id="type" name="roomtype">
                                        	<option value="">Select no. Occupants</option>
                                            <option value="Single">Single</option>
                                            <option value="Double(2 Persons)">Double(2 Persons)</option>
                                            <option value="Tri(3 Persons)">Tri(3 Persons)</option>
                                            <option value="Quad(4 Persons)">Quad(4 Persons)</option>
                                        </select>  
                                    </div>  
                                </div>
                                <div class="form-group reign"> 
                                    <label for="rooms" class="register">No. Of Rooms Available</label>       
                                    <input type="text" class="room-control" id="rooms"  name="rooms" value="<?php echo $fetch['rms_available'] ?>"> 
                                </div>
                                <div class="form-group reign"> 
                                    <label for="rooms" class="register">Price</label>       
                                    <input type="text" class="room-control" id="price"  name="price" value="<?php echo $fetch['price'] ?>"> 
                                </div>
                                <div class="form-group reign">
                                    <div class="row">
                                        <label for="pxconditions" class="register">Price Conditions</label> 
                                    </div>
                                    <div class="row reign">  
                                    <select class="room-control" id="pxconditions" name="pxconditions">
                                    	<option value="">Select Price Conditions</option>
                                        <option value="Negotiable">Negotiable</option>
                                        <option value="Strict">Strict(Non-negotiable)</option>
                                    </select>  
                                    </div>  
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="head1">
                                        <label><span class='glyphicon glyphicon-ok'></span>Tip</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <p>Help us know the kind of situation the room could be in, So the buyer gets to know What He's about to acquire</p>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="post">
                    <div class="head1">
                        <label>Hostel Specifications</label>
                    </div>
                    <div class=" limit2 content1">
                        <div class="row">
                            <div class="col-sm-9 take">
                                <div class="form-group reign"> 
                                    <label for="hostel" class="register">Hostel Name</label>       
                                    <input type="text" class="room-control" id="name"  placeholder="Enter Hostel Name" name="name" value="<?php echo $fetch['hName']?>">    
                                </div>
                                <div class="form-group reign">
                                    <div class="row">
                                        <label for="rooms" class="register">Status</label> 
                                    </div>
                                    <div class="row">  
                                        <select class="room-control" id="status" name="status">
                                        	<option value="">Choose Hostel Status</option>
                                            <option value="Mixed">Mixed</option>
                                            <option value="Single">Single</option>
                                        </select>  
                                    </div>  
                        		</div>
                                <div class="form-group reign"> 
                                    <label for="name" class="register">Transport</label>       
                                    <select class="room-control" id="trans" name="transport">
                                    	<option value="">Choose tranport means</option>
                                        <option value="Shuttle">Shuttle</option>
                                        <option value="Personal">Private Transport</option>
										
                                    </select>    
                        		</div>
                                <div class="form-group reign"> 
                                    <label for="loc" class="register">Location/ Region</label>       
                                    <select class="room-control" id="region" name="region">
                                        <option value="">Select Region</option>
                                        <option value="Arua">Arua</option>
                                        <option value="Busia">Busia</option>
                                        <option value="Entebbe">Entebbe</option>
                                        <option value="Fort Portal">Fort Portal</option>
                                        <option value="Gulu">Gulu</option>
                                        <option value="Iganga">Iganga</option>
                                        <option value="Jinja">Jinja</option>
                                        <option value="Kabale">Kabala</option>
                                        <option value="Kabamba">Kabamba</option>
                                        <option value="Kabwohe">Kabwohe</option>
                                        <option value="Kagadi">Kagadi</option>
                                        <option value="Kampala">Kampala</option>
                                        <option value="Kimaka">Kimaka</option>
                                        <option value="Kiryadongo">Kiryadongo</option>
                                        <option value="Kisoro">Kisoro</option>
                                        <option value="Kumi">Kumi</option>
                                        <option value="Lira">Lira</option>
                                        <option value="Lugazi">Lugazi</option>
                                        <option value="Luweero">Luweero</option>
                                        <option value="Masaka">Masaka</option>
                                        <option value="Mbale">Mbale</option>
                                        <option value="Mbarara">Mbarara</option>
                                        <option value="Mpigi">Mpigi</option>
                                        <option value="Mukono">Mukono</option>
                                        <option value="Soroti">Soroti</option>
                                        <option value="Wakiso">Wakiso</option>
                                    </select>
                                </div>
                                <div class="form-group reign"> 
                                    <label for="loc" class="register">City/town</label>       
                                    <input type="text" class="room-control" id="town" value="<?php echo $fetch['town']; ?>" placeholder="e.g Makerere, Mengo, Nakawa etc" name="town">
                                </div>
                                <div class="form-group reign"> 
                                    <label for="loc" class="register">Exact address (if any)</label>       
                                    <input type="text" class="room-control" id="address"  name="address" placeholder="e.g Kikoni, Kauga, Wandegeya, Katanga etc" value="<?php echo $fetch['address']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="head1">
                                        <label><span class='glyphicon glyphicon-ok'></span>Tip</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <p>Help us know the kind of situation the room could be in, So the buyer gets to know What He's about to acquire</p>
                                    <div>&nbsp;</div>
                                    <div>&nbsp;</div>
                                    <div>&nbsp;</div>
                                    <p>For Sub-town, enter the exact location of the hostel, this makes it easier to locate the hostel using google Maps</p>
                                   
                                    <br />
                                    The Campus Within which the hostel is in bounds
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="post">
                    <div class="head1">
                        <label class="register">Other Specifications</label>
                    </div>
                    <div class=" limit2 content1" id="tourselection">
                        <div class="row">
                        	<div class="col-sm-9 take">
                                <div >
                                    <div class="checkbox">
                                        <div class="row">
                                            <div class="col-sm-4 ">
                                                <label >
                                                  <input type="checkbox" name="balcony" value="Balcony"> Balcony
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="view" value="Amazing View"> Amazing View
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="neighbourhood" value="Quiet Neighbourhood"> Quiet Neighbourhood
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="security" value="Tight Security"> Tight Security
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="tarmac" value="tarmac"> tarmac  
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="fence" value="Fenced"> Fenced
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="conditioner" value="air condition"> air conditioner
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="cable" value="tv-cable">tv-cable  
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="internet" value="Internet Access"> Internet Access
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="restaurant" value="Restaurant"> Restaurant
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="floor" value="Tiled Floor"> Tiled Floor  
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="generator" value="Standby-Gnerator"> Standby-Gnerator
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="pool" value="Swimming Pool"> Swimming Pool
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="parking" value="Parking"> Parking  
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="wardrobes" value="Built in wardrobes"> Built in wardrobes
                                                </label>
                                            </div>
                                        </div>
                                     </div>
                                 </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="head1">
                                        <label><span class='glyphicon glyphicon-ok'></span>Tip</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <p>Please Select Specifications Or Services Provided At The Hostel</p>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="post">
                    <div class="head1">
                        <label>Room Condition</label>
                    </div>
                    <div class=" limit2 content1">
                        <div class="row">
                            <div class="col-sm-9 take">
                                <div class="form-group">
                                    <label for="name" class="register">Room Condition</label>
                                    <textarea class="text-control" rows="15"  cols="500" id="condition" width="100%" name="condition"><?php echo $fetch['roomCondition']?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="head1">
                                        <label><span class='glyphicon glyphicon-ok'></span>Tip</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <p>Help us know the kind of situation the room could be in, So the buyer gets to know What He's about to acquire</p>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="post">
            	<p><span id="errorMessage"></span></p>
                <input type="submit" class="btn btn-default sell" value="Post Room">
            </div>
            </div>           
        </form>
   </div>
            
        <?php
			}else{
				?>
                <div class="row" style="margin: 0px -50px;">
        <form  id="postadvert" name="advert" action="#"  method="post" role="form" enctype="multipart/form-data">
            <div class="row">
                <div class="posted">
                    <div class="head1">
                        <label>Title</label>
                    </div>
                    <div class="limit1 content1">
                    <div class="row reign">
                    	<div class="col-sm-9 take">
                        	<div class="form-group reign">
                            	<input type="text" class="room-control" id="title" name="title" value="<?php echo $fetch['title']; ?>">
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="post">
                    <div class="head1">
                        <label>Room Specifications</label>
                    </div>
                    <div class=" limit2 content1">
                        <div class="row">
                            <div class="col-sm-9 take">
                                <div class="form-group reign">
                                    <div class="row">
                                        <label for="rooms" class="register">Wash-Rooms</label> 
                                    </div>
                                    <div class="row">  
                                        <select class="room-control" id="wash" name="wash">
                                        	<option value="">Select washrooms</option>
                                            <option value="Self-Contained">Self-Contained</option>
                                            <option value="Basic">Basic</option>
                                        </select>  
                                    </div>  
                        		</div>
                                <div class="form-group reign">
                                    <div class="row">
                                        <label for="rooms" class="register">Room Type</label> 
                                    </div>
                                    <div class="row">  
                                        <select class="room-control" id="type" name="roomtype">
                                        	<option value="">Select no. Occupants</option>
                                            <option value="Single">Single</option>
                                            <option value="Double(2 Persons)">Double(2 Persons)</option>
                                            <option value="Tri(3 Persons)">Tri(3 Persons)</option>
                                            <option value="Quad(4 Persons)">Quad(4 Persons)</option>

                                        </select>  
                                    </div>  
                                </div>
                                <div class="form-group reign"> 
                                    <label for="rooms" class="register">No. Of Rooms Available</label>       
                                    <input type="text" class="room-control" id="rooms"  name="rooms" value="<?php echo $fetch['rms_available'] ?>"> 
                                </div>
                                <div class="form-group reign"> 
                                    <label for="rooms" class="register">Price</label>       
                                    <input type="text" class="room-control" id="price"  name="price" value="<?php echo $fetch['price'] ?>"> 
                                </div>
                                <div class="form-group reign">
                                    <div class="row">
                                        <label for="pxconditions" class="register">Price Conditions</label> 
                                    </div>
                                    <div class="row reign">  
                                    <select class="room-control" id="pxconditions" name="pxconditions">
                                    	<option value="">Select Price Conditions</option>
                                        <option value="Negotiable">Negotiable</option>
                                        <option value="Strict">Strict(Non-negotiable)</option>
                                    </select>  
                                    </div>  
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="head1">
                                        <label><span class='glyphicon glyphicon-ok'></span>Tip</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <p>Help us know the kind of situation the room could be in, So the buyer gets to know What He's about to acquire</p>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="post">
                    <div class="head1">
                        <label>Hostel Specifications</label>
                    </div>
                    <div class=" limit2 content1">
                        <div class="row">
                            <div class="col-sm-9 take">
                               
                                <div class="form-group reign"> 
                                    <label for="name" class="register">Transport</label>       
                                    <select class="room-control" id="trans" name="transport">
                                    	<option value="">Choose tranport means</option>
                                        <option value="Shuttle">Shuttle</option>
                                        <option value="Personal">Private Transport</option>
										
                                    </select>    
                        		</div>
                                <div class="form-group reign"> 
                                    <label for="loc" class="register">Location/ Region</label>       
                                    <select class="room-control" id="region" name="region">
                                        <option value="">Select Region</option>
                                        <option value="Arua">Arua</option>
                                        <option value="Busia">Busia</option>
                                        <option value="Entebbe">Entebbe</option>
                                        <option value="Fort Portal">Fort Portal</option>
                                        <option value="Gulu">Gulu</option>
                                        <option value="Iganga">Iganga</option>
                                        <option value="Jinja">Jinja</option>
                                        <option value="Kabale">Kabala</option>
                                        <option value="Kabamba">Kabamba</option>
                                        <option value="Kabwohe">Kabwohe</option>
                                        <option value="Kagadi">Kagadi</option>
                                        <option value="Kampala">Kampala</option>
                                        <option value="Kimaka">Kimaka</option>
                                        <option value="Kiryadongo">Kiryadongo</option>
                                        <option value="Kisoro">Kisoro</option>
                                        <option value="Kumi">Kumi</option>
                                        <option value="Lira">Lira</option>
                                        <option value="Lugazi">Lugazi</option>
                                        <option value="Luweero">Luweero</option>
                                        <option value="Masaka">Masaka</option>
                                        <option value="Mbale">Mbale</option>
                                        <option value="Mbarara">Mbarara</option>
                                        <option value="Mpigi">Mpigi</option>
                                        <option value="Mukono">Mukono</option>
                                        <option value="Soroti">Soroti</option>
                                        <option value="Wakiso">Wakiso</option>
                                    </select>
                                </div>
                                <div class="form-group reign"> 
                                    <label for="loc" class="register">City/town</label>       
                                    <input type="text" class="room-control" id="town" value="<?php echo $fetch['town']; ?>" placeholder="e.g Makerere, Mengo, Nakawa etc" name="town">
                                </div>
                                <div class="form-group reign"> 
                                    <label for="loc" class="register">Exact address (if any)</label>       
                                    <input type="text" class="room-control" id="address"  name="address" placeholder="e.g Kikoni, Kauga, Wandegeya, Katanga etc" value="<?php echo $fetch['address']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="head1">
                                        <label><span class='glyphicon glyphicon-ok'></span>Tip</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <p>Help us know the kind of situation the room could be in, So the buyer gets to know What He's about to acquire</p>
                                    <div>&nbsp;</div>
                                    <div>&nbsp;</div>
                                    <div>&nbsp;</div>
                                    <p>For Sub-town, enter the exact location of the hostel, this makes it easier to locate the hostel using google Maps</p>
                                   
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="post">
                    <div class="head1">
                        <label class="register">Other Specifications </label>
                    </div>
                    <div class=" limit2 content1" id="tourselection">
                        <div class="row">
                        	<div class="col-sm-9 take">
                                <div >
                                    <div class="checkbox">
                                        <div class="row">
                                            <div class="col-sm-4 ">
                                                <label >
                                                  <input type="checkbox" name="balcony" value="Balcony"> Balcony
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="view" value="Amazing View"> Amazing View
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="neighbourhood" value="Quiet Neighbourhood"> Quiet Neighbourhood
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="security" value="Tight Security"> Tight Security
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="tarmac" value="tarmac"> tarmac  
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="fence" value="Fenced"> Fenced
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="conditioner" value="air condition"> air conditioner
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="cable" value="tv-cable">tv-cable  
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="internet" value="Internet Access"> Internet Access
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="restaurant" value="Restaurant"> Restaurant
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="floor" value="Tiled Floor"> Tiled Floor  
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="generator" value="Standby-Gnerator"> Standby-Gnerator
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="pool" value="Swimming Pool"> Swimming Pool
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="parking" value="Parking"> Parking  
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                  <input type="checkbox" name="wardrobes" value="Built in wardrobes"> Built in wardrobes
                                                </label>
                                            </div>
                                        </div>
                                     </div>
                                 </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="head1">
                                        <label><span class='glyphicon glyphicon-ok'></span>Tip</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <p>Please Select Specifications Or Services Provided At The Hostel</p>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="post">
                    <div class="head1">
                        <label>Room Condition</label>
                    </div>
                    <div class=" limit2 content1">
                        <div class="row">
                            <div class="col-sm-9 take">
                                <div class="form-group">
                                    <label for="name" class="register">Room Condition</label>
                                    <textarea class="text-control" rows="15"  cols="500" id="condition" width="100%" name="condition"><?php echo $fetch['roomCondition']?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="head1">
                                        <label><span class='glyphicon glyphicon-ok'></span>Tip</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <p>Help us know the kind of situation the room could be in, So the buyer gets to know What He's about to acquire</p>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
           
            <div class="row">
            <div class="post">
            	<p><span id="errorMessage"></span></p>
                <input type="submit" class="btn btn-default"  id="rentalsell" value="Post Room">
            </div>
            </div>           
        </form>
   </div>
                <?php
			}
		}
	}
	mysql_close($connect);
?>
</div>
<div class="col-md-1">
</div>
</div>
<!-------**************************************************************************************************-------->
                

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<script>
		$(document).ready(function(){
			console.log("u got done and now here!!");
			var washrooms = <?php echo json_encode($wash); ?>;
			var type = <?php echo json_encode($type); ?>;
			var status = <?php echo json_encode($status); ?>;
			var pxcondition = <?php echo json_encode($pxcondition); ?>;
			var region = <?php echo json_encode($region); ?>;
			var transport = <?php echo json_encode($transport); ?>;
			var specs = [];
			specs = <?php echo json_encode($specs); ?>
			
			console.log(specs);
			$("#trans option").each(function(){
				if($(this).val()==transport){ // EDITED THIS LINE
					$(this).attr("selected","selected");    
				}
			});
			
			$("#region option").each(function(){
				if($(this).val()==region){ // EDITED THIS LINE
					$(this).attr("selected","selected");    
				}
			});
			
			$("#status option").each(function(){
				if($(this).val()==status){ // EDITED THIS LINE
					$(this).attr("selected","selected");    
				}
			});
			
			$("#type option").each(function(){
				if($(this).val()==type){ // EDITED THIS LINE
					$(this).attr("selected","selected");    
				}
			});
			
			$("#wash option").each(function(){
				if($(this).val()==washrooms){ // EDITED THIS LINE
					$(this).attr("selected","selected");    
				}
			});
			
			$("#pxconditions option").each(function(){
				if($(this).val()==pxcondition){ // EDITED THIS LINE
					$(this).attr("selected","selected");    
				}
			});
			
			for(var i=0; i < specs.length; i++){
			$('.checkbox input').each(function() {
                if($(this).val()==specs[i]){ // EDITED THIS LINE
					$(this).attr("checked","checked");    
				}
            });
			}
		});
	</script>
    <script src="js/listings.js" type="text/javascript"></script>
</body>

</html>