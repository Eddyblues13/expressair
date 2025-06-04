$(function(){
	var u, target_id;
	function url(u){
		return u;
	}
	$(document).on("submit", "#track", function(e,u){
		e.preventDefault();
		u = "../user/server/api/exchange/track/server_side.php";
		target_id = $("#track_content");

		$.post(url(u), $(this).serialize(), function(data, status) {
			if(data == "") {
				target_id.html("<div class='alert alert-warning'>No data entered</div>");
			}
			else {
				target_id.html(data);
			}
		});
	})
		
	

})