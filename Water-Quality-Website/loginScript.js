function logout() {
	$.ajax({
		type: "post",
		url: "login.php"
		});
}

$(function(){

	$("#loginBtn").click(function(){
		if($(this).html() == "Login") {
			$(".login_div").show();
			$(".black_bg").show();
		}
		else {
			if(confirm("Are you sure?")) {
				logout();
				location.reload();
			}
		}
	});

	$("#registerBtn").click(function(){
		$(".login_div").hide();
		$(".register_div").show();
	});

	$("input#settingsBtn").click(function(){
		$(".settings_div").show();
		$(".black_bg").show();
	});

	$(".black_bg").click(function(){
		$(".register_div").hide();
		$(".login_div").hide();
		$(".settings_div").hide();
		$(".black_bg").hide();
	});
});