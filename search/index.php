<?php
	include("../logic/controlclicks.php");
	if(isset($_REQUEST['region']))
	if($_REQUEST['region'] == ''){
	$region = "Kampala";
	}else{
	$region = $_REQUEST['region'];
	}
	else
		$region = "Kampala";
	
	if(isset($_REQUEST['price']))
	if($_REQUEST['price'] == ''){
	$price = "10000000";
	}else{
	$price = $_REQUEST['price'];
	}	
	else
	$price = "10000000";
	require('../logic/config.php');
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="canonical" href="http://alexcican.com/post/single-post">
<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="../css/searchengine.css" rel="stylesheet" />
<link href="../css/bootstrap.css" rel="stylesheet" />
<link href="../css/hostel.css" rel="stylesheet" />
<link href="../css/animate.css" rel="stylesheet" />
<link href="../css/main.css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

<title>keribu > Search</title>
<link rel="shortcut icon" href="../images/icon box.png" type="image/png" />
</head>

<body>
<span class="">
<nav class="navbar navbar-default" role="navigation"> 
	<div class="navbar-header"> 
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse"> 
            <span class="sr-only">Toggle navigation</span> 
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
        </button> 
        <a class="navbar-brand" href="../"><img src="../images/logo_second.png" class="logo"/></a> 
    </div> 
    <div class="collapse navbar-collapse" id="example-navbar-collapse"> 
        <ul class="nav navbar-nav">
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
                    <ul class='dropdown-menu alert-dropdown'>
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
										<p class='small text-muted'><i class='fa fa-clock-o'></i> ".date("l jS  F, Y", strtotime($fetchnotification['notification_date']))."</p>
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
                          
        	<li><a href="?click=advertiseroom"><button class="btn btn-default advertbtn">+ Add Free Room Advertisement</button></a></li>
            <!--<li><a href=""><span class='glyphicon glyphicon-envelope'></span></a></li>-->
            <li class="dropdown"> 
                <?php 
					  if(!isset($_SESSION['logged_in'])){
					 	echo " <a href='?click=login'><span class='glyphicon glyphicon-user'></span> My Account</a> ";
						
					  }else{
						echo "<a href='' class='dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-user'></span> Hi ".$_SESSION['fName']." <b class='caret'></b></a>";
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
    </div> 
</nav>
</span>
<div class="body1">
	<div class="body2">
    <div class="row searchspace"></div>
    	<div class="row">
        	<div class="col-sm-3">
                <div class="advancedengine">
                	<div class="row header">
                    	Refine Your Search
                    </div>
                    <div class="row advancedsearch">
                	<form action="" method="get" role="form">
                        	<div class="row">
                            	<div class="col-sm-12 foo">
                                	<div class="input-group img-responsive">
                                        <span class="input-group-addon register"><span class="glyphicon glyphicon-map-marker"></span></span> 
                                        <input type="text" id="tags" class="form-control region" name="region" placeholder="e.g Kikoni, Nkumba, Nkozi"> 
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-sm-12 foo">
                                <select class="search-control roomtype" name="roomtype" data-title="Room Type" data-placeholder="true" title="Room Type">
                                    <!--<option value="">Room Type</option>-->
                                     <option value="">Room Type</option> 
                                    <option value="Single">Single</option> 
                                    <option value="Double(2 Persons)">Double(2 Occupants)</option>
                                    <option value="Tri(3 Persons)">Tri(3 Occupants)</option>
                                    <option value="Quad(4 Persons)">Quad(4 Occupants)</option> 
                                </select>
                            </div>
                        </div>
                        <div class="row">
                        	<div class="col-sm-12 foo"> 
                                <select class="search-control room" name="room"> 
                                    <option value="Hostel Room">Hostel</option> 
                                    <option value="Rental">Rental</option> 
                                </select> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 foo">
                                <select class="search-control bath" name="bathroom">
                                    <option value="Self-Contained">Self-Contained</option>
                                    <option value="Basic">Basic</option>
                                </select>
                            </div>
                        </div>
                        <div class="row hostel_sex">
                            <div class="col-sm-12 foo">
                                <select class="search-control status" name="status">
                                		<option value="">--Select Sex--</option>
                                        <option value="Mixed">Mixed</option>
                                        <option value="Single">Single</option>
                                 </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 foo">
                                <select class="search-control" name="price" id="price">
                                    <option value="">Max Price</option>
                                    <option value="300000">Shs 300000</option>
                                    <option value="500000">Shs 500000</option>
                                    <option value="1000000">Shs 1000000</option>
                                    <option value="1500000">Shs 1500000</option>
                                    <option value="2000000">Shs 2000000</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 foo">
                            <button type="submit" name="search" class="search-control" style="background-color: #f7780b; color:#FFF;"><span class="glyphicon glyphicon-search"></span> Search</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <!-------------------------------for search results----------------------------->
            
           <div class="col-sm-6" style="padding-left: 0px; padding-right: 0px;">
           	<div class="row">
			   <?php					
			   		//defining the maximum results to be displayed on a page
					$max_records_per_page = 10;
					
					//the page a user needs to acces, if none we set it to page 1
					if(isset($_GET['page'])){
						$page = $_GET['page'];
						}else{
							$page = 1;
						}
						//defining the starting index of a page
						$starting_index = ($page - 1) * $max_records_per_page;
						
						//************************depending on the users quest, we display the corresponding results
						include("search_commands.php");					
						
					$query = mysql_query($query_string);
					
					if(!$query)
						die("failed query ".mysql_error());
					
					if(($row = mysql_num_rows($query))>0){
						
						while($fetch = mysql_fetch_array($query)){
						
						echo "<div class='col-sm-12 searchbox img-responsive' style='padding-left: 3px;'>
									<div class='row'>
											<div class='col-sm-5 img-responsive'>
											<a href='../view/display.php?roomAdvertID=".$fetch['roomAdvertID']."&title=".trim($fetch['title'])."' class='hovereffect'>
												<img src='".$fetch['mainimage']."' class='img-rounded img-responsive searchimage' alt='Image Loading....'></a>
												
											</div>
											<div class='col-sm-7 hovereffect'>
											<label class='accampodation'>".$fetch['title']."</label>
											<p class='labeled'><span class='glyphicon glyphicon-map-marker'></span>		".$fetch['address'].", ".$fetch['town'].", ".$fetch['Region']."</p>
											<p><img src='../images/icons/samll/bath.png' img-responsive> ".$fetch['washRooms']."</p>
											<p><img src='../images/icons/samll/bed21.png'> ".$fetch['roomStatus']."</p>
											<p><img src='../images/icons/samll/dollar.png'> Shs ".number_format($fetch['price'])."</p>
											<hr class='separation'/>
											<div class='row' style='text-align: right; margin-top: 2px; margin-right: 0px; margin-bottom: 2px;'><a href='../view/display.php?roomAdvertID=".$fetch['roomAdvertID']."&title=".trim($fetch['title'])."' class='btn btn-default register'><span class='glyphicon glyphicon-eye-open'></span> View Details</a></div>
											</div>
										</div>
										</div>
									";
						//print_r($output);
						//echo json_encode($output);
						}
						
					}else{
						$error = 'No Results Were Found Matching Your Search';
					  echo "
								<div class='searcherror'>
										<label><h4><p>".$error."</p></h4></label>
								</div>";
					}
                ?>
                </div>
                <div class="row" style="text-align: right;">
                	 <?php
			//calculate the totla number of results found in the database related to the current search
			$rows = mysql_num_rows(mysql_query($pagination_links));
			//maximmum number of pages per given search made
				$num_pages = ceil($rows/$max_records_per_page);
				
				$num_pagination_links = 10;//set the limit of pagination links you need be displayed on your search page
				$start = (($page - $num_pagination_links) > 0)? ($page - $num_pagination_links) : 1;
				$end = (($page + $num_pagination_links) < $num_pages)? ($page + $num_pagination_links) : $num_pages;
				
				if(!isset($error) && $num_pages > 1){
				
				//echo "<ul class='pagination'><li><a href='search.php?roomstatus=Single&region=$region&price=$price&page=1'>&laquo;</a></li>";
				
				//for the previous button
				if($num_pages > 1){
						//if($page <= $num_pages){
							if($page > 1)
							$previous = $page - 1;
							else
							$previous = 1;
							
						echo "<ul class='pagination'>";
						
						if($page == 1){
						echo "<li class='disabled'><a href='$nextpage&page=".$previous."'>&laquo;</a></li>";
						}else{
							echo "<li><a href='$nextpage&page=".$previous."'>&laquo;</a></li>";
						}
						//}
				}
				//echo $page;
				
				//looping the pages when they're more than what we expect to display to the user
				//check the number of pages remaining after loding a given page
				$check = $num_pages - $page;
				
				for($current_page = $start; $current_page <= $end; $current_page++){
					if($current_page == $page){
						$state = "active";
					}else{
						$state = "";	
					}
					echo "<li class='".$state."'><a href='$nextpage&page=".$current_page."'>".$current_page."</a></li>";
					
					}
					
					if($num_pages > 1){
						
							if($page != $num_pages)
							$next = $page + 1;
							else
							$next = $num_pages;
							
							if($page == $num_pages)
								$state = "disabled";
							else
							$state = "";
						echo "<li class='$state'><a href='$nextpage&page=".$next."'>&raquo;</a></li></ul>";
						
					}
				}
					
        ?>
                </div>
            </div>
            
            <!--*****************end of search results****************************-->
            <div class="col-sm-3">
            	<div class="row" style="padding-left: 30px;">
                    <b><label class="register" style="line-height: 2em; font-size: 18px;">ADVERTISE WITH US</label></b>
                    <p class="accampodation">Do you need to advertise on this page?</p>
                    <p class="accampodation"><label>Call Us on :</label> +256784357765</p>
                    <p class="accampodation"><label>OR</label></p>
                    <p class="accampodation"><label>Email Us on :</label>keribu@gmail.ug</p>	
                </div>
                <div class="row">
                	<?php
						$select = mysql_query("SELECT * FROM roomadvert INNER JOIN hostel ON roomadvert.hostelID = hostel.hostelID where rating = 'rated' limit 0, 2");
						while($collect = mysql_fetch_assoc($select)){
							echo "<div class='row'>
										<div class='img-responsive'>
											<img src='".$collect['mainimage']."' class='image img-responsive' alt='Image Loading....' style='height: 190px; width: 310px;;'>
											<span class='img-responsive'>";
													 echo " <p class='glyphicon glyphicon-map-marker'>".$collect['address'].", ".$collect['town'].", ".$collect['Region']."</p>";echo "<p><div class=' img-responsive'>Shs  ".number_format($collect['price'])."</div><div class='img-responsive'>";
													 //determining the number of wash rooms
												if($collect['washRooms'] == 'Self-Contained'){
													$wash = 1;
											echo "<img src='../images/icons/samll/bath.png'>".$wash;
												}
												if($collect['roomStatus'] == 'Single'){
													$room = 1;
													echo " <img src='../images/icons/samll/bed.png'> ".$room;
												}else if($collect['roomStatus'] == 'Double(2 Persons)'){
													$room = 2;
													echo " <img src='../images/icons/samll/bed.png'> ".$room;
													}else if($collect['roomStatus'] == 'Tri(3 Persons)'){
														$room = 3;
														echo " <img src='../images/icons/samll/bed.png'> ".$room;
														}else if($collect['roomStatus'] == 'Quad(4 Persons)'){
															$room = 4;
															echo " <img src='../images/icons/samll/bed.png'> ".$room;
														}
													 
													 echo "	<a href='../view/display.php?roomAdvertID=".$collect['roomAdvertID']."' class='btn btn-default' style='margin-left: 50px; background: #033; color: #fff;'><span class='glyphicon glyphicon-eye-open'></span> View Details</a></p></div></span>
										</div>
										</div>";
							}
					?>
                </div>
            </div>
        </div>
        
<div class="outter">
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
    	<div class="col-md-6">
        	<div class="col-sm-6">
        	<ul class="local-link socialworks">
            	<label class="accampodation"><h4>SITE</h4></label>
            	<li><a href="#">About uS</a></li>
                <li><a href="../conditions/tos.php">Terms Of Service</a></li>
                <li><a href="../conditions/privacypolicy.html">Privacy Policy</a></li>
                <li><a href="#">Copy Rights</a></li>
                <li><a href="#">Blog</a></li>
            </ul>
            </div>
            <div class="col-sm-6">
            	<ul class="local-link socialworks">
                <label class="accampodation"><h4>MORE</h4></label>
            	<li><a href="#">Advertise With Us</a></li>
                <li><a href="#">Terms Of Service</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Site Tourage</a></li>
                <li><a href="#">Benefits</a></li>
            </ul>
            </div>
        </div>
        <div class="col-md-6">
        	<a class="social-icons" href="https://facebook.com/keribu"><img src="../images/Standard-Circle/32x32-Circle-56-FB.png"/></a>
			<a class="social-icons" href="https://twitter.com/YOUR-PROFILE"><img src="../images/Standard-Circle/32x32-Circle-64-TW.png" /></a>
            <a class="social-icons" href="https://plus.google.com/YOUR-PROFILE"><img src="../images/Standard-Circle/32x32-Circle-79-GP.png"/></a>
            <a class="social-icons" href="http://www.linkedin.com/in/YOUR-PROFILE"><img src="../images/Standard-Circle/32x32-Circle-55-LI.png"/></a>
            <a class="social-icons" href="http://pinterest.com/YOUR-PROFILE"><img src="../images/Standard-Circle/32x32-Circle-75-P.png"/></a>
            <a class="social-icons" href="http://www.youtube.com/user/YOUR-PROFILE"><img src="../images/Standard-Circle/32x32-Circle-81-YT.png"/></a>
            <a class="social-icons" href="http://yourdomain.com/YOUR-RSS-FEED"><img src="../images/Standard-Circle/32x32-Circle-93-RSS.png"/></a>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>
<hr class="horizontal_rule"/>
<div class=" row">
        <div class="copyright">
            <h5>©2014 travon Inc® All Rights Reserved <a href="#">User Agreement</a> and <a href="#">Cookies</a></h5>
        </div>
    </div>
</div>
        
</div>
</div>
<script src="../js/jquery-1.11.2.js" type="text/javascript"></script>
<script src="../js/bootstrap.js" type="text/javascript"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript">
	$(function() {
	  var notifications = <?php echo json_encode($newnotifications);?>;
		if(notifications != null){
			console.log(notifications);
			$('#notifications').addClass("notification");
			$('#notifications').attr("data-count", notifications);
		}
		
		//display users' selected options
		var region = <?php echo json_encode($region); ?>;
		var room = <?php echo json_encode($_REQUEST['room']);?>;
		var roomtype = <?php echo json_encode($_REQUEST['roomtype']);?>;
		var price = <?php echo json_encode($price);?>;
		var bath = <?php echo json_encode($_REQUEST['bathroom']);?>;
		var hostelstatus = <?php echo json_encode($_REQUEST['status']);?>
		//set the value of the region in case its been set
		console.log(region);
		console.log(price);
		console.log(room);
		console.log(roomtype);
		console.log(bath);
		console.log(hostelstatus);
		
		if(room == 'Rental'){
			$('.hostel_sex').hide();
			$('.hostel_sex select').removeAttr('name');
		}
		
		if(region != null){
			$('.region').css("background", "#F8F7D3");
		$('.region').val(region);
		}
		$('.room').change(function(){
			if($('.room').val() == 'Rental'){
				$('.hostel_sex').hide();
				$('.hostel_sex select').removeAttr('name');
			}else{
				$('.hostel_sex').show();
				$('.hostel_sex select').attr("name", "status")
			}
			});
		
		$("#price option").each(function(){
				if($(this).val()==price){ // EDITED THIS LINE
					$(this).attr("selected","selected");    
				}
			});
			
			$(".room option").each(function(){
				if($(this).val()==room){ // EDITED THIS LINE
					$(this).attr("selected","selected");    
				}
			});
			
			$(".roomtype option").each(function(){
				if($(this).val()==roomtype){ // EDITED THIS LINE
					$(this).attr("selected","selected");    
				}
			});
			
			$(".bath option").each(function(){
				if($(this).val()==bath){ // EDITED THIS LINE
					$(this).attr("selected","selected");    
				}
			});
			
			$(".status option").each(function(){
				if($(this).val()==hostelstatus){ // EDITED THIS LINE
					$(this).attr("selected","selected");    
				}
			});
	  var availableTags = [];
	 $('#tags').on('focus', function(){
		//console.log('am inside');
		 $.ajax({
		  url: '../logic/live.php',
		  type: 'GET',
		  dataType:"json",
		  success: function(data){
			  if(data == 'No Results'){
				  console.log(data);
				  }else{
					  availableTags = data;
						console.log(availableTags[1]);
						 $( "#tags" ).autocomplete({
							  source: availableTags
							});
				  }
		  },
		  error: function(){
			  console.log('Something is wrong');
		  }
		  });
		  
		 });
	

	$('#notifications a').focus(function() {
		//$('#notifications').addClass("dropdown-menu");
		//$('#notifications').addClass("alert-dropdown");
        $.ajax({
			url : '../logic/removenotification.php',
			type: 'GET',
			dataType:"json",
			data: {},
			success: function(data){
				if(data == 'success'){
					$('.navbar li').removeClass('notification');
				}
				},
			error: function(){
				console.log('something is wrong with this function');
				}
			});
			return false;
    });
	$('.searcherror').addClass('animated rubberBand');
  });
</script>
</body>
</html>