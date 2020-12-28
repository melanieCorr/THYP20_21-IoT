$(function(){
	$("#submit-register").click(function() {

		if($("input[name='fullname']").val() !== "" && $("input[name='email']").val() !== "" && $("input[name='username']").val() !== "" && $("input[name='password']").val() !== "")
			$.ajax({
				type: "post",
				url: "send_request_email.php",
				data: $("#register_form").serialize(),
				success: function(response) {
					console.log(response)
					if(response.includes('Email not being sent'))
						alert("Request email is not send. Please check your config");
					else
						alert("Message has been sent");
				}
			}).done(function() {
				location.reload();
			});
		else
			alert("Please fill in required input");
	});

	$("#submit-login").click(function() {
		alert("hi maroua");
		$.ajax({
			type: "post",
			url: "login.php",
			data: $("#login_form").serialize(),
			success: function(response) {
				if (response === "invalid") {
					alert("Invalid username/password. Please try again");
					$("input[name='loginPassword']").val("");
					console.log(response)
				}
				else if (response === "success") {
					location.reload();
				}
				else {
					alert("ERREUR !!!!!");
				}
        	}
		});
	});

	$("#submit-settings").click(function() {

		$.ajax({
			type: "post",
			url: "save_settings.php",
			data: $("#settings_form").serialize(),
			success: function(response) {
				console.log(response)
			}
		}).done(function() {
			alert("Settings saved");
			location.reload();
		});
	});
});