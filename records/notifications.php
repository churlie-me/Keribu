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

    <title>listings>sold out</title>
    <link rel="shortcut icon" href="../images/icon box.png" type="image/png" />
    <link href="css/list.css" rel="stylesheet">
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
      <div class="modal-header" style="background: #033; color: #FFF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#FFF;"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirm Deletion</h4>
      </div>
      <div class="modal-body" style=" color: #033; text-align: center">
        Are You Sure You Want To DELETE this Item?
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary confirmdelete" id="confirmdelete" data-dismiss="modal">Delete</button>
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
                        <a href="profile.php"><i class="fa fa-fw"><span class='glyphicon glyphicon-user'></span> </i> Profile</a>
                    </li>
                    <li class="active">
                        <a href="notifications.php"><i class="fa fa-fw fa-desktop"></i> Notification</a>
                    </li>
                    <li>
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
                            Notifications
                        </h1>
                        
                    </div>
                </div>
                
                <!--**********************dynamic content*************************-->
    <div class="row">
     <div class="col-md-1">
     </div>
     <div class="col-md-10 diaplay">
      
<?php 
	$usermail = $_SESSION['client_ID'];
	$getnotification = mysql_query("select * from notifications where notified_mail = '".$_SESSION['email']."' order by notification_date desc");
						$getnotificationrows = mysql_num_rows($getnotification);
						if($getnotificationrows > 0)
		while($fetchnotification = mysql_fetch_array($getnotification)){
		?>
        <table class="table table-striped">
        <thead> <tr></tr> </thead> 
        <tbody> 
            <tr> <td>
            	<div class='media'>
                    <div class='media-body'>
                        <h5 class='media-heading' style='color:#FF8000;'<strong>Recomendation</strong>
                        </h5>
                        <p class='wrapcontent'><?php echo $fetchnotification['notification'];?></p>
                        <p class='small text-muted'><i class='fa fa-clock-o'></i> Yesterday at <?php echo $fetchnotification['notification_date']; ?></p>
                    </div>
                </div>
            </td> </tr>
        </tbody> 
        </table>
     <?php
		}else{
			echo "<table class='table table-striped'>
        <thead> <tr></tr> </thead> 
        <tbody> 
            <tr> <td>
            	<div class='media' style='background: red; color: white;'>
                    <div class='media-body'>
                        <p class='wrapcontent'>No New Notifications Found So Far</p>
                    </div>
                </div>
            </td> </tr>
        </tbody> 
        </table>";
		}
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
    <script src="js/list.jquery.js" type="text/javascript"></script>

</body>

</html>