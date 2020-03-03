// JavaScript Document
	$(document).ready(function() {
        $('#rentalsell').click(function(){
				if($('#rooms').val() == '' || $('#title').val() == '' || $('#wash').val() == '' || $('#type').val() == '' || $('#price').val() == '' || $('#pxconditions').val() == '' || $('#trans').val() == '' || $('#region').val() == '' || $('#town').val() == '' || $('#address').val() == '' || $('#condition').val() == ''){
					 $("#errorMessage").style("color", "red");
            		$("#errorMessage").text("Please Complete The Empty Fields or unselected Options");
				return false;
				}
			});
    });
/*

 $(".sell").click(function () {
        if ($("#title").val() == "" || $('#wash').val() == "" || $("#type").val() == "" || $("#rooms").val() == "" || $('#price').val() == "" || $('#pxconditions').val() == "" || $('#trans').val() == "" || $("#region").val() == "" || $("#town").val() == "" || $('#address').val() == '' || $("#condition").val() == "") {
            $("errorMessage").style("color", "red");
            $("#errorMessage").html("Please Complete The Empty Fields or unselected Options");
            return false;
        } else {
            document.getElementById("errorMessage").innerHTML = "";
            return true;
        }
    });

*/