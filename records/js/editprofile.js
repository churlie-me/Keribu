// JavaScript Document
$(document).ready(function(){ //newly added 
$('#Submit').click(function() {
    	var emailVal = $('#email').val(); // assuming this is a input text field
		var firstname = $('#fname').val();
		var lastname = $('#lname').val();
		var username = $('#uname').val();
		var contact = $('#contact').val();
		var password = $('#pass').val();
		var conpass = $('#conpass').val();
		
		document.getElementById("errorMessage").style.color = "red";
        document.getElementById("errorMessage").style.textAlign = "right";
		
		if(firstname == '' || lastname == '' || username == '' || emailVal == '' || contact == '' || password == '' || conpass == ''){
				$('#errorMessage').text("Please Complete The Empty Fields"); 
				return false;
		}else if(password.length < 8){
				$('#errorMessage').text("Password should have 8 or more characters"); 
				return false;
		}else if(password != conpass) {
				$('#errorMessage').text("Password Mismatch");
				return false;
				}else{
					
					$.post('actions/email.php', {'email' : emailVal}, function(data) {
						//alert('welcome back');
        			if(data=='email exists'){
						$('#errorMessage').text("An Account Using This Email Already Exists");
						document.getElementById('email').style.borderColor = '#F30';
						document.getElementById('email').style.backgroundColor = '#FF9B9B';
						return false;
					}else{
						//alert('missing something');
						$('#registerform').submit();
		}
    });
				}
});
});