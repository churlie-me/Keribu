$(document).ready(function() {
    $('.upload1').change(function(){
				var image = document.getElementById("image_load1");
				var fileInput = document.getElementById("uploadBtn1");
			
				var fileUrl = window.URL.createObjectURL(fileInput.files[0]);
				
				image.src = fileUrl;
				
	});
	 $('.upload2').change(function(){
				var image = document.getElementById("image_load2");
				var fileInput = document.getElementById("uploadBtn2");
			
				var fileUrl = window.URL.createObjectURL(fileInput.files[0]);
				
				image.src = fileUrl;
				
	});
	$('.upload3').change(function(){
				var image = document.getElementById("image_load3");
				var fileInput = document.getElementById("uploadBtn3");
			
				var fileUrl = window.URL.createObjectURL(fileInput.files[0]);
				
				image.src = fileUrl;
				
	});
	$('.upload4').change(function(){

				var image = document.getElementById("image_load4");
				var fileInput = document.getElementById("uploadBtn4");
			
				var fileUrl = window.URL.createObjectURL(fileInput.files[0]);
				/*$.post('../advertise/validation.php', {'name': fileInput.files[0]}, function(data){
			if(data != 'success'){
				$('#img-error').html(data);
			}
			});*/
				image.src = fileUrl;
				
	});
});

function unfilledText() {
    document.getElementById("postadvert").onsubmit = function () {
        if (document.getElementById("title").value == "" || document.getElementById('wash').value == "" || document.getElementById("type").value == "" || document.getElementById("rooms").value == "" || document.getElementById('price').value == "" || document.getElementById('pxconditions').value == "" || document.getElementById("name").value == "" || document.getElementById("status").value == "" || document.getElementById('trans').value == "" || document.getElementById("region").value == "" || document.getElementById("town").value == "" || document.getElementById('address').value == '' || document.getElementById("condition").value == "") {
            document.getElementById("errorMessage").style.color = "red";
            document.getElementById("errorMessage").innerHTML = "Please Complete The Empty Fields or unselected Options";
            return false;
        } else {
            document.getElementById("errorMessage").innerHTML = "";
            return true;
        }
    };
}

function preparePage() {
    document.getElementById("specifications").onclick = function () {
        if (document.getElementById("specifications").checked) {
            document.getElementById("tourselection").style.display = "block";
        } else {
            document.getElementById("tourselection").style.display = "none";
        }
        };
        document.getElementById("tourselection").style.display = "none";
}

	function warnuser(){
		if(document.close()){
			alert("Do you Want To Leave This Page Because Once Closed, The Data You've been inputting will not be saved");
			}
		}
window.onload = function () {
    unfilledText();
    preparePage();
	warnuser();
};