// JavaScript Document
$.fn.deleteitem = function(){
	return this.each(function(){
			$(this).click(function(){
				var id = $(this).attr('id');
				var linq = $(this).attr('href');
				
				if(id == 'deleteitem'){
					$('#myModal').modal('show');
					document.getElementById('confirmdelete').onclick = function(){
					console.log(id);
					console.log(linq);
					window.location = linq;
					}
					return false;
				}
				else if(id == 'update'){
					console.log("gotta update");
					console.log(id);
					console.log(linq);
					window.location = linq;
					return false;
				}
				});
		});
	}