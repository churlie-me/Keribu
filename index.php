<?php 
	include("logic/controlclicks.php");
	include("logic/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
<link href="css/bootstrap.css" rel="stylesheet" />
<link href="css/hostel.css" rel="stylesheet" />
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/main.css" rel="stylesheet" />
<link href="css/searchengine.css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<title> Rooms For Sale</title>
<link rel="shortcut icon" href="images/icon box.png" type="image/png" />
  <meta charset="utf-8">
  
</head>
<body>
<!--
<nav class="topbar navbar-reset">
<div class="row"> 
<div class="col-sm-4"> 
<a href="#">Post</a> | <a href="#">Tour Around</a> | <a href="#">faqs</a>
</div> 
<div class="col-sm-5" style="text-align: center; text-wrap: suppress">
Are you  stranded yet gotta visit a friend?
</div>
<div class="col-sm-3 navbar-right" style="margin: 0px;"> 
<form role="form"> 
<div class="form-group"> <input type="text" class="form-control" placeholder="search hostel location" style="height: 20px;"></div>
</form> 
</div> 
</nav>
-->
<span class="">
<nav class="navbar navbar-default" role="navigation"> 
	<div class="navbar-header"> 
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse"> 
            <span class="sr-only">Toggle navigation</span> 
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
        </button> 
        <a class="navbar-brand" href=""><img src="images/logo_second.png" class="logo"/></a> 
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
						  if(isset($_SESSION['fName'])){
						echo "<a href='' class='dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-user'></span> Hi ".$_SESSION['fName']." <b class='caret'></b></a>";
						  }else{
							  echo "<a href='' class='dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-user'></span> Hi ".$_SESSION['uName']." <b class='caret'></b></a>";
						  }
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
<?php

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
    <div class="banner">
    	<div class="row">
       <div class="col-sm-1"></div>
       <div class="col-sm-10">
       		<div class="searchcontainer">
            	<div class="row">
                	<span class="searchfonts">ROOM SEARCH</span>
                </div>
            	<div class="row">
                    <form  role="form" action="search/">
                    	<div class="col-sm-4">
                            <div class="input-group img-responsive">
                                <span class="input-group-addon register">Location</span> 
                                <input type="text" id="tags" class="form-control" name="region" placeholder="e.g Kikoni, Nkumba, Nkozi"> 
                            </div>
                        </div>
                        <div class="col-sm-2">
                        	<div class="form-group select-style"> 
                                <select class="form-control" name="room"> 
                                    <option value="Hostel Room">Hostel</option> 
                                    <option value="Rental">Rental</option> 
                                </select> 
                            </div>
                        </div>
                        <div class="col-sm-2">
                        	<div class="form-group select-style"> 
                                <select class="form-control" name="roomtype"> 
                                    <option value="">Room Type</option> 
                                    <option value="Single">Single</option> 
                                    <option value="Double(2 Persons)">Double(2 Occupants)</option>
                                    <option value="Tri(3 Persons)">Tri(3 Occupants)</option>
                                    <option value="Quad(4 Persons)">Quad(4 Occupants)</option> 
                                </select> 
                            </div>
                        </div>
                        <div class="col-sm-3">
                        	<div class="form-group select-style"> 
                                <select class="form-control" name="price"> 
                                	<option value="">Max Price</option>
                                    <option value="300000">Shs 300000</option>
                                    <option value="500000">Shs 500000</option>
                                    <option value="1000000">Shs 1000000</option>
                                    <option value="1500000">Shs 1500000</option>
                                    <option value="2000000">Shs 2000000</option>
                                </select> 
                            </div>
                        </div>
                        <div class="col-sm-1">
                        <div class="form-group">
                        <button type="submit" value="" class="btn btn-default find">Search</button></div>
                        </div>
                    </form>
                </div>
                <div class="row">
                	<div class="col-sm-10"></div>
                	<span class="accamp"><a href="search/">Advanced Search</a></span></div>
            </div>
       </div>
       <div class="col-sm-1"></div>
       </div>
    </div>

<div class="body1">
<div class="body2">
<!------------------------------------------display some results for home page view---------------------------------->
<div class="">&nbsp;</div>
<div class="row">
<div class="col-sm-1"></div>
<div class="col-sm-2"><div></div></div>
<div class="col-sm-9">
<?php
	include("logic/configuration.php");
?>
</div>

</div>
</div>
<!------------------------------------------------------------------------------------------------------------------->
<div class="row advmaking">
<div class="col-sm-1"></div>
<div class="col-sm-10">
<div class="col-sm-4">
<div class="row">
	<img src="images/imports/cash.png" class="img-responsive" style=" display:block;
    margin:auto;" />
</div>
<div class="row format">
		<span class="register">Let's Help You Save</span>
	<p>Let's Save You From Spending on Advertisement Around Any Campus</p>
        <p>Save Your Strength</p>
		<p>Save Your Money On Transport Moving From Hostel To Hostel</p>
		<p>Save YourSelf From Stress, 
		looking around for accamodation</p>
		<p>We're here to solve your issues</p>
        <a href="#" class="accampodation">Read More...</a>
		
</div>
</div>
<div class="col-sm-4">
<div class="row">
	<img src="images/imports/devices.png" class="img-responsive" style=" display:block;
    margin:auto;"/>
</div>

<div class="row format">
		<span class="register">Search Locations, Hostels, And Rentals</span>
	<p>Are you looking for a particular location around any campus?</p>
        <p>Worry no more, with  accampodation, you can locate a hostel or any place by making use of google maps </p>
        <a href="#" class="accampodation">Read More...</a>
</div>
</div>

<div class="col-sm-4">
	<div class="row">
		<img src="images/imports/security.png" class="img-responsive" style=" display:block;
    margin:auto;"/>
	</div>
    
	<div class="row format">
		<span class="register">Protection For Your Information</span>
	<p>Worry Not About Security, Cuz We Safe Guard All Our Customers' Information And No Third Party Can Acess It Without Your Permission</p>
        <p></p>
        <a href="conditions/privacypolicy.html" class="accampodation">Read More...</a>
</div>
</div>
</div>
<div class="col-sm-1"></div>
</div>
<div class="row">
	<div class="maps">
    	<div class="col-sm-7">
        	<span class="looking"><p>Tired Of Walking Around, Looking For A Hostel You Can't Find?</p><p> Let's Help You Find It</p></span>
        </div>
        <div class="col-sm-5">
        	<form action="hostelz/hostelzloc.php" method="get" name="hostelsearch">
        	<div class="input-group"> 
            	<input type="text" class="form-control" name ="hostelName" placeholder="enter Hostel Name e.g Nana Hostels" id="hostel_tags"> 
                <span class="input-group-btn"> 
                	<button class="btn btn-default" type="submit" style="background: #FF8000; color: #fff;"> <span class="glyphicon glyphicon-search"></span> Go </button> 
                </span> 
            </div>
            </form>
        </div>
    </div>
</div>
<!--*************************************************************************************************************-->
<div class="container">
    <div class="row locs">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <div class="col-sm-3">
            <ul class="local-link">
                <label><h4>Kampala</h4></label>
                <li><a href="search/search.php?region=Makerere">Makerere</a></li>
                <li><a href="search/search.php?region=Kikoni">Kikoni</a></li>
                <li><a href="search/search.php?region=Mulago">Mulago</a></li>
                <li><a href="search/search.php?region=LDC">LDC</a></li>
                <li><a href="search/search.php?region=Nakulabye">Nakulabye</a></li>
                <li><a href="search/search.php?region=Kavule">Kavule</a></li>
                <li><a href="search/search.php?region=Kikumi Kikumi">Kikumi Kikumi</a></li>
                <li><a href="search/search.php?region=Nakawa">Nakawa</a></li>
                <li><a href="search/search.php?region=Banda">Banda</a></li>
                <li><a href="search/search.php?region=Kibuli">Kibuli</a></li>
                <li><a href="search/search.php?region=Mengo">Mengo</a></li>
                <li><a href="search/search.php?region=Rubaga">Rubaga</a></li>
                <li><a href="search/search.php?region=Bugolobi">Bugolobi</a></li>
            </ul>
        </div>
        <div class="col-sm-3">
            <ul class="local-link">
                <label><h4>Mukono</h4></label>
                <li><a href="search/search.php?region=Wandegeya">Wandegeya</a></li>
                <li><a href="search/search.php?region=Kauga">Kauga</a></li>
                <li><a href="search/search.php?region=Bugujju">Bugujju</a></li>
                <li><a href="search/search.php?region=Mukono Town">Mokono Town</a></li>
                <li><a href="search/search.php?region=Nabuti">Nabuti</a></li>
                <label><h4>Jinja</h4></label>
                <li><a href="search/search.php?region=Jinja">Jinja Town</a></li>
            </ul>
        </div>
        <div class="col-sm-3">
            <ul class="local-link">
                <label><h4>Mabarara</h4></label>
                <li><a href="search/search.php?region=Kamukuzi">Kamukuzi</a></li>
                <li><a href="search/search.php?region=Kakyeka">Kakyeka</a></li>
                <li><a href="search/search.php?region=Kiyanja">Kiyanja</a></li>
                <li><a href="search/search.php?region=Mbarara">Mbarara</a></li>
                <li><a href="search/search.php?region=Kabwohe">Kabwohe</a></li>
                <label><h4>Masaka</h4></label>
                <li><a href="search/search.php?region=Masaka Town">Masaka Town</a></li>
                <li><a href="search/search.php?region=Nkozi">Nkozi</a></li>
                <label><h4>Entebbe</h4></label>
                <li><a href="search/search.php?region=Entebbe Town">Entebbe Town</a></li>
                <li><a href="search/search.php?region=Nkumba">Nkumba</a></li>
                <li><a href="search/search.php?region=Abaita Ababiri">Abayita Ababiri</a></li>
                <li><a href="search/search.php?region=Lyamutundwe">Lyamutundwe</a></li>
                <li><a href="search/search.php?region=Mpala">Mpala</a></li>
                <li><a href="search/search.php?region=Kitala">Kitala</a></li>
            </ul>
        </div>
        <div class="col-sm-3">
            <ul class="local-link">
                <label><h4>Busia</h4></label>
                <li><a href="#">Busitema Trading Center</a></li>
                <li><a href="#">Shyaule</a></li>
                <label><h4>Gulu</h4></label>
                <li><a href="search/search.php?region=Gulu">Gulu Town</a></li>
                <li><a href="search/search.php?region=Lacor">Lacor</a></li>
            </ul>
        </div>
        </div>
    </div>
</div>
<!------social networking communnity----->
<div class="outter">
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
    	<div class="col-sm-6">
        	<div class="col-sm-6">
        	<ul class="local-link socialworks">
            	<label class="accampodation"><h4>SITE</h4></label>
            	<li><a href="more/about-us.html">About uS</a></li>
                <li><a href="conditions/tos.php">Terms Of Service</a></li>
                <li><a href="conditions/privacypolicy.html">Privacy Policy</a></li>
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
        <div class="col-sm-6">
        	<a class="social-icons" href="https://facebook.com/keribu"><img src="images/Standard-Circle/32x32-Circle-56-FB.png"/></a>
			<a class="social-icons" href="https://twitter.com/YOUR-PROFILE"><img src="images/Standard-Circle/32x32-Circle-64-TW.png" /></a>
            <a class="social-icons" href="https://plus.google.com/YOUR-PROFILE"><img src="images/Standard-Circle/32x32-Circle-79-GP.png"/></a>
            <a class="social-icons" href="http://www.linkedin.com/in/YOUR-PROFILE"><img src="images/Standard-Circle/32x32-Circle-55-LI.png"/></a>
            <a class="social-icons" href="http://pinterest.com/YOUR-PROFILE"><img src="images/Standard-Circle/32x32-Circle-75-P.png"/></a>
            <a class="social-icons" href="http://www.youtube.com/user/YOUR-PROFILE"><img src="images/Standard-Circle/32x32-Circle-81-YT.png"/></a>
            <a class="social-icons" href="http://yourdomain.com/YOUR-RSS-FEED"><img src="images/Standard-Circle/32x32-Circle-93-RSS.png"/></a>
        </div>
    </div>
    <div class="col-sm-1"></div>
</div>
<hr class="horizontal_rule"/>
<div class=" row">
        <div class="copyright">
            <h5>©2014 travon Inc® All Rights Reserved <a href="#">User Agreement</a> and <a href="#">Cookies</a></h5>
        </div>
    </div>
</div>

<!------------------------------------------>
</div>
</div>
<script src="js/jquery-1.11.2.js" type="text/javascript"></script>
<script src="js/bootstrap.js"  type="text/javascript"></script>
<!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script>
  $(function() {
	  var notifications = <?php echo json_encode($newnotifications);?>;
		if(notifications != null){
			console.log(notifications);
			$('#notifications').addClass("notification");
			$('#notifications').attr("data-count", notifications);
			var titletext = "Rooms For Sale (" + (notifications) + ")";
			$("title").text(titletext);
		}
	  var availableTags = [];
	 $('#tags').on('focus', function(){
		//console.log('am inside');
		 $.ajax({
		  url: 'logic/live.php',
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
			url : 'logic/removenotification.php',
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
			
			var titletext = "Rooms For Sale";
			$("title").text(titletext);
			return false;
    });
  });
  </script>
<!--<script src="js/search.js" type="text/javascript"></script>
<script type="text/javascript">
	$('.search').searchresults();
</script>-->
</body>
</html>