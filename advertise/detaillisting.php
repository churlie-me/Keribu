<?php 
	include("../logic/sessioncontrol.php");
	if(!isset($_SESSION['title']) && !isset($_SESSION['propertytype'])){
		header("Location: startsell.php");
		}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/bootstrap.css" rel="stylesheet" />
<link href="../css/sells.css" rel="stylesheet" />
<link href="../css/hostel.css" rel="stylesheet" />
<title>keribu > details</title>
<link rel="shortcut icon" href="../images/icon box.png" type="image/png" />
</head>

<body class="override">
	<div class="container">
    	<div class="row">
        	<a href="../index.php"><label class="web"><img src="../images/logo_second.png"/></label></a>
        </div>
        <div class="row">
        	<label class="register what">give us details about what you're dealing</label></div>
        </div>
        <div class="row">
        <form  id="postadvert" name="advert" action="../logic/advertise.php"  method="post" role="form" enctype="multipart/form-data">
            <div class="row">
                <div class="posted">
                    <div class="head1">
                        <label>Title</label>
                    </div>
                    <div class="limit1 content1">
                    <div class="row reign">
                    	<div class="col-sm-9 take">
                        	<div class="form-group reign">
                            	<input type="text" class="room-control" id="title" name="title" value="<?php echo $_SESSION['title']; ?>">
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
                                    <div class="row ad select-style">  
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
                                    <div class="row  ad select-style">  
                                        <select class="room-control" id="type" name="roomtype">
                                        	<option value="">Select no. Occupants</option>
                                            <option value="Single">Single</option>
                                            <option value="Double(2 Persons)">Double(2 Occupants)</option>
                                            <option value="Tri(3 Persons)">Tri(3 Occupants)</option>
                                            <option value="Quad(4 Persons)">Quad(4 Occupants)</option>
                                        </select>  
                                    </div>  
                                </div>
                                <div class="form-group reign"> 
                                    <label for="rooms" class="register">No. Of Rooms Available</label>       
                                    <input type="text" class="room-control" id="rooms"  name="rooms"> 
                                </div>
                                <div class="form-group reign"> 
                                    <label for="rooms" class="register">Price</label>       
                                    <input type="text" class="room-control" id="price"  name="price"> 
                                </div>
                                <div class="form-group reign">
                                    <div class="row">
                                        <label for="pxconditions" class="register">Price Conditions</label> 
                                    </div>
                                    <div class="row reign ad select-style">  
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
                                    <input type="text" class="room-control" id="name"  placeholder="Enter Hostel Name" name="name">    
                                </div>
                                <div class="form-group reign">
                                    <div class="row">
                                        <label for="rooms" class="register">Status</label> 
                                    </div>
                                    <div class="row ad select-style">  
                                        <select class="room-control" id="status" name="status">
                                        	<option value="">Choose Hostel Status</option>
                                            <option value="Mixed">Mixed</option>
                                            <option value="Single">Single</option>
                                        </select>  
                                    </div>  
                        		</div>
                                <div class="form-group reign ">
                                	<div class="row"> 
                                    <label for="name" class="register">Transport</label>
                                    </div>
                                    <div class="row ad select-style">       
                                    <select class="room-control" id="trans" name="transport">
                                    	<option value="">Choose tranport means</option>
                                        <option value="Shuttle">Shuttle</option>
                                        <option value="Personal">Private Transport</option>
                                    </select>    
                                    </div>
                        		</div>
                                <div class="form-group reign"> 
                                <div class="row">
                                    <label for="loc" class="register">Location/ Region</label>   
                                    </div>
                                    <div class="row ad select-style">    
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
                                </div>
                                <div class="form-group reign"> 
                                    <label for="loc" class="register">City/town</label>       
                                    <input type="text" class="room-control" id="town"  placeholder="e.g Makerere, Mengo, Nakawa etc" name="town">
                                </div>
                                <div class="form-group reign"> 
                                    <label for="loc" class="register">Exact address (if any)</label>       
                                    <input type="text" class="room-control" id="address"  name="address" placeholder="e.g Kikoni, Kauga, Wandegeya, Katanga etc">
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
                        <label class="register">Other Specifications <input type="checkbox" id="specifications"></label>(Please Check This BoX For More Specifications)
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
                                    <textarea class="text-control" rows="15"  cols="500" id="condition" width="100%" name="condition"></textarea>
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
                        <label>Upload Pictures</label>
                    </div>
                    <div class=" limit2 content1">
                    
                    <!-------------------------------------------------------------------------------------------->
                        <div class="row">
                            <div class="col-sm-9 take">
                                <div class="form-group col-sm-3"> 
                                 
                                   <div class="row">
                                        <img class="img-thumbnail img-responsive img" id="image_load1"/>
                                    </div>
                                    <div class="row">
                                        <div class="fileUpload btn btn-primary">
                                            <span><span class="glyphicon glyphicon-camera"></span> Upload</span>
                                            <input id="uploadBtn1" type="file" class="upload  upload1" name="snap1" value="Upload"/>
                                        </div>
                                    </div> 
                                    
                                </div>
                                <div class="form-group col-sm-3">
                                    <div class="row">
                                        <img class="img-thumbnail img-responsive img" id="image_load2" />
                                    </div>
                                    <div class="row">
                                        <div class="fileUpload btn btn-primary">
                                            <span><span class="glyphicon glyphicon-camera"></span> Upload</span>
                                            <input id="uploadBtn2" type="file" class="upload upload2" name="snap2" value="Upload"/>
                                        </div>
                                    </div> 
                                </div>
                                <div class="form-group col-sm-3">
                                    <div class="row">
                                        <img class="img-thumbnail img-responsive img" id="image_load3" />
                                    </div>
                                    <div class="row">
                                        <div class="fileUpload btn btn-primary">
                                            <span><span class="glyphicon glyphicon-camera"></span>  Upload</span>
                                            <input id="uploadBtn3" type="file" class="upload upload3" name="snap3" value="Upload"/>
                                        </div>
                                    </div> 
                                </div>
                                <div class="form-group col-sm-3">
                                    <div class="row">
                                        <img class="img-thumbnail img-responsive img" id="image_load4" />
                                    </div>
                                    <div class="row">
                                        <div class="fileUpload btn btn-primary">
                                            <span><span class="glyphicon glyphicon-camera"></span>  Upload</span>
                                            <input id="uploadBtn4" type="file" class="upload upload4" name="snap4" value="Upload"/>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                   <!-------------------------------------------------------------------------------------------->         
                            
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="head1">
                                        <label><span class='glyphicon glyphicon-ok'></span>Tip</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <p>Uploading Pictures Portraying The Appearance Of The Room Helps The User Know What The Room Looks Like Before Buying. You can upload upto 4 images</p>
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
        <div class=" row">
            <div class="outter">
                <div class="copyright">
                    <h5>©2014 travon Inc® All Rights Reserved <a href="#">User Agreement</a> and <a href="#">Cookies</a></h5>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/jquery-1.11.2.js" type="text/javascript"></script>
    <script src="../js/bootstrap.js" type="text/javascript"></script>
    <script src="../js/behave.js" type="text/javascript"></script>
</body>
</html>