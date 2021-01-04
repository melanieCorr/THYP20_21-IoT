<?php
$isLoggedOn = false;
session_start();
if (array_key_exists('loginId', $_SESSION)) {
	$isLoggedOn = true;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Water Quality Monitoring System</title>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	<script src="./jquery.min.js"></script>
	<script src="./loginScript.js"></script>
	<script src="./submitScript.js"></script>
	<link rel="icon" href="favicon.png">
	<link rel="stylesheet" href="styles.css">
	<link href="https://fonts.googleapis.com/css?family=Varela+Round|Khula|Roboto" rel="stylesheet">
</head>
<body>
	<nav id="topnav">
		<ul id="menu">
			<li style="float: left"><a href="./home.php">Water Quality Monitoring System</a></li>
			<li style="float: right"><a id="loginBtn" href="javascript:void(0)"><?php if($isLoggedOn) echo "Logout"; else echo "Login"; ?></a></li>
			<li style="float: right"><a href="./about-us.php">About Us</a></li>
			<li class="selected" style="float: right"><a href="./contact-us.php">Contact Us</a></li>
			<li style="float: right"><a href="./home.php">Home</a></li>
		</ul>	
	</nav>

	<div ng-app="myApp" class="main_div">
		<?php if($isLoggedOn) echo "<span style='float:left; font-size:small'>Logged in as ".$_SESSION['loginId']."</span><br>"; ?>
		<h3>Contact Us</h3>
		<form id="contact_form" method="post">
			<table id="tableForm">
				<tr><td><input type="text" name="contact_name" placeholder="Name" size="30"></td></tr>
				<tr><td><input type="text" name="contact_email" placeholder="Email" size="30"></td></tr>
				<tr><td><textarea name="contact_message" rows="5" cols="30" placeholder="Your Message"></textarea></td></tr>
			</table>
			<input id="submit-contact-us" type="button" value="Submit"/>
			<button type="reset" value="Reset" form="contact_form">Clear</button>
		</form>
	<br>
	</div>
	<div class="login_div" style="display: none;">
		<h3 style="margin-top: 0px">Login</h3>
		<br>
		<div class="login_field">
			<form id="login_form" method="post">
				<table>
					<tr><td>User ID</td><td><input type="text" name="loginId" size="15"/></td></tr>
					<tr><td>Password</td><td><input type="password" name="loginPassword" size="15"/></td></tr>
				</table>
				<span style="font-size: smaller;">For login problems, please <a href="./contact-us.php">contact us</a>.</span><br><br>
				<input id="submit-login" type="button" value="Login"/><br>
				<span style="font-size: smaller;"><a id="registerBtn" href="javascript:void(0)">Register new ID</a></span><br><br>
			</form>
		</div>
	</div>
		
	<div class="register_div" style="display: none;">
		<h3 style="margin-top: 0px">Register</h3>
		<br>
		<div class="register_field">
			<span style="font-size: smaller;">Send request email to administrator</span><br>
			<form id="register_form" method="post">
			<!-- <form action="./register_user.php" id="register_form" method="get"> -->
				<table>
					<tr><td>Full Name</td><td class="required"><input type="text" name="fullname" size="30" /></td></tr>
					<tr><td>Email</td><td class="required"><input type="email" name="email" size="22" /></td></tr>
					<tr><td>User ID</td><td class="required"><input type="text" name="username" size="15" /></td></tr>
					<tr><td>Password</td><td class="required"><input type="password" name="password" size="15" /></td></tr>
					<tr><td>Message</td><td><textarea name="message" cols="30" placeholder="Insert your message to admin (optional)"></textarea></td></tr>
				</table><br>
				<input id="submit-register" type="button" value="Send Request"/>
			</form>
		</div>
	</div>
	<div class="black_bg" style="display: none;"></div>
	<footer>
		<p style="text-align: center;">Copyright &copy 2021<br>Water Quality Monitoring System Paris8</p>
	</footer>
</body>
</html>
