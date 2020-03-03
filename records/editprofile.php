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

    <title><?php echo $_SESSION['fName'];?></title>
	<link rel="shortcut icon" href="../images/icon box.png" type="image/png" />
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                    <li class="active">
                        <a href="profile.php"><i class="fa fa-fw"><span class='glyphicon glyphicon-user'></span> </i> Profile</a>
                    </li>
                    <li>
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
                           Edit Profile
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa"><span class="glyphicon glyphicon-user"></span></i> User Profile
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i> You Can Add An Extra Number, So Clients Can Have Options Incase they need to reach out to you!!
                        </div>
                    </div>
                </div>
                <!-- /.row -->
					<?php 
						include("../logic/config.php");
						$contact = array();
						$query = mysql_query("SELECT * FROM client WHERE client_ID = '".$_SESSION['client_ID']."'");
					
						$profile = mysql_num_rows($query);
						
						while($fetch = mysql_fetch_array($query)){
							$fname = $fetch['fName'];
							$lname = $fetch['lName'];
							$uname = $fetch['uName'];
							$profilepic = $fetch['profileImage'];
							$mail = $fetch['email'];
							$password = $fetch['password'];
							$datejoined = $fetch['acc_date'];
						}
						
						$phoneno = mysql_query("SELECT * FROM contact WHERE client_ID = '".$_SESSION['client_ID']."'");
						while($phonecollect = mysql_fetch_array($phoneno)){
						$contact = array($phonecollect['contact']);
						}
						mysql_close($connect);
					?>
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <div class="regshape">
            <div class="row">
                <p class="register">Make A few changes where necessary</p>
                <form id="registerform" name="registerform" action="../logic/editprofile.php" method="post"  class="form-horizontal" role="form">
					<div id="forsignup">&nbsp;</div>    
					<div class="form-group">       
						<label for="firstname" class="col-sm-4 control-label">First Name</label> 
						<div class="col-sm-8">          
							<input type="text" class="form-control" id="fname" name="fname" value="<?php echo $fname;?>">  
						</div>
					</div>    
					<div class="form-group">
						<label for="lastname" class="col-sm-4 control-label">Last Name</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="lname" name="lname" value="<?php  echo $lname; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="mail" class="col-sm-4 control-label">E-mail</label>
						<div class="col-sm-8">
							<input type="mail" class="form-control" id="email" name="email" value="<?php echo $mail;?>">
						</div>
					</div>
                    <?php
					
						for($i=0; $i < count($contact); $i++){
					echo "<div class='form-group contact'>
						<label for='contact' class='col-sm-4 control-label'>Contact</label>
						<div class='col-sm-6'>
							<input type='text' class='form-control' id='contact' name='contact' value='".$contact[$i]."'></div>";}?>
							<div class='col-sm-2' style='padding-left: 5px;'><button type='button' id='add' class='btn btn-default'><span class='glyphicon glyphicon-plus-sign'>Add</button>
						</div>
					</div>
					
					<div class="form-group">
						<label for="username" class="col-sm-4 control-label">Username</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="uname" name="uname" value="<?php echo $uname;?>">
						</div>
					</div>
					<div class="form-group">
						<label for="pass" class="col-sm-4 control-label">Password</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" id="pass" name="pass" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="conpass" class="col-sm-4 control-label">Confirm Password</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" id="conpass">
						</div>
					</div>
                    
                    <p id="errorMessage"></p>
					<div class="form-group">
					<div class="col-sm-9">
                    </div>
                    <div class="col-sm-3">
                    <button type="submit" name="Submit" id="Submit" class="btn btn-default" style="background-color: #F60; color:#FFF;">Update</button>
					</div>
					</div> 
				</form>  
            </div>
        </div>
    </div>
    <div class="col-sm-3"></div>
</div>
                                	
                <!-- /.row -->

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

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/editprofile.js" type="text/javascript"></script>
    <script type="text/javascript">
		$(document).ready(function() {
            $('#add').click(function() {
                console.log("Am inside");
            });
        });
	</script>
</body>

</html>
