<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link href="../css/bootstrap.css" rel="stylesheet">
  <title>jQuery UI Autocomplete - Default functionality</title>
 	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
	  var availableTags = [];
	 $('#tags').on('focus', function(){
		 $.ajax({
		  url: 'live.php',
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
	
  });
  </script>
</head>
<body>
 
<!--<div class="ui-widget">-->
<form action="search/search.php" role="form">
			<div class="col-sm-4">
        	<div class="input-group">
        	<span class="input-group-addon register">Location</span> 
          	<input id="tags" class="form-control" name="region" placeholder="e.g Kikoni, Nkumba, Nkozi">
          	</div>
    		</div>
                        <div class="col-md-2">
                        	<div class="form-group"> 
                                <select class="form-control" name="room"> 
                                    <option value="Hostel">Hostel</option> 
                                    <option value="Rental">Rental</option> 
                                </select> 
                            </div>
                        </div>
                        <div class="col-sm-2">
                        	<div class="form-group"> 
                                <select class="form-control" name="roomtype"> 
                                    <option value="">Room Type</option> 
                                    <option value="Single">Single</option> 
                                    <option value="Double">Double</option>
                                    <option value="Tri">Tri</option>  
                                    <option value="Quad">Quad</option> 
                                </select> 
                            </div>
                        </div>
                        <div class="col-sm-3">
                        	<div class="form-group"> 
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
<!--</div>-->
	<input type="submit" value="search">
 </form>
 
</body>
</html>