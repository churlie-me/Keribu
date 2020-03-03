<?php
	include("../logic/controlclicks.php");
	include("../logic/config.php");
	
	if($_SESSION['useremail'] !== 'chalesaguma@ymail.com'){
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

    <title>keribu Admin</title>
	<link rel="shortcut icon" href="../images/icon box.png" type="image/png" />
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet">
    <!-- Bootstrap Core CSS RTL-->
    
    <!-- Custom CSS -->
    <link href="../records/css/sb-admin.css" rel="stylesheet">
    <link href="../records/css/sb-admin-rtl.css" rel="stylesheet">
	<link href="../css/admin.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="../records/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

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
            <ul class="nav navbar-right top-nav">
                 <?php
		if(isset($_SESSION['user_ID'])){
					$notificationsicon = "select * from notifications where notified_mail = '".$_SESSION['useremail']."' and status='unseen'";
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
					
					$notifications = "select * from notifications where notified_mail = '".$_SESSION['useremail']."' order by notification_date desc LIMIT 0, 5";
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
                
               <li><a href="?click=advertiseroom"><button class="btn btn-default advertbtn">+ Add Free Room Advertisement</button></a></li>
                <li class="dropdown">
                     <?php 
					  if(!isset($_SESSION['user_ID'])){
					 	echo " <a href='?click=login'><span class='glyphicon glyphicon-user'></span> My Account</a> ";
						
					  }else{
						echo "<a href='' class='dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-user'></span> Hi ".$_SESSION['fname']." <b class='caret'></b></a>";
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
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="admin.php"><i class="fa fa-fw fa-comments"></i> View Comments n Requests</a>
                    </li>
                    <li>
                        <a href="charts.html"><i class="fa fa-fw fa-table"></i>Manage Listings</a>
                    </li>
                    <li>
                        <a href="loc.php"><i class="fa fa-fw fa-map-marker"></i> Record NEW Location</a>
                    </li>
                    <li>
                        <a href="forms.html"><i class="fa fa-fw fa-edit"></i>Manage Clients</a>
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
                            Comments <small>Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-comments"></i> Comments From USERS
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

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
						
						
						
					$requests = mysql_query("select * from requests where 1 order by time desc limit $starting_index, $max_records_per_page");
					
					if(($request_rows = mysql_num_rows($requests)) > 0){
						while($requests_fetch = mysql_fetch_assoc($requests)){?>
							<a href="loc.php" class="nohover">
                            <div class="row">
                            	<div class='media'>
                                    <div class='media-body'>
                                        <h5 class='media-heading' style='color:#FF8000;'>
                                        <strong>
                                        	<div class="row">
                                                <div><?php echo $requests_fetch['request_title']; ?></div>
                                            </div>
                                        </strong>
                                        </h5>
                                        <div class="row">
                                        <p class='wrapcontent'><?php echo $requests_fetch['request'];?></p>
                                        <p class='small text-muted'><i class='fa fa-clock-o'></i> <?php echo date("l jS  F, Y", strtotime($requests_fetch['time']))?></p>
                                        </div>
                                    </div>
                                </div>
                            </div></a>
						<?php }
					}
				
				?>
                   
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../records/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../records/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../records/js/plugins/morris/raphael.min.js"></script>
    <script src="../records/js/plugins/morris/morris.min.js"></script>
    <script src="../records/js/plugins/morris/morris-data.js"></script>

</body>

</html>
