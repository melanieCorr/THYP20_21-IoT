<?php
$isLoggedOn = false;
session_start();
if (array_key_exists('loginId', $_SESSION)) {
	$isLoggedOn = true;
}
if (!array_key_exists('isWarningEmail', $_SESSION)) {
	$_SESSION['isWarningEmail'] = "false";
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
	<script src="./data.angular.js"></script>
	<link rel="icon" href="favicon.png">
	<link rel="stylesheet" href="styles.css">
	<link href="https://fonts.googleapis.com/css?family=Varela+Round|Khula|Roboto" rel="stylesheet">
	<style>
      #submit-login {
      display: inline-block;
      background-color: green;
      border-radius: 5px;
      border: 4px double #cccccc;
      color: #eeeeee;
      text-align: center;
      font-size: 18px;
      padding: 5px;
      width: 150px;
      transition: all 0.5s;
      cursor: pointer;
      margin: 3px;
      }
      #submit-login  span {
      cursor: pointer;
      display: inline-block;
      position: relative;
      transition: 0.5s;
      }
      #submit-login  span:after {
      content: '\00bb';
      position: absolute;
      opacity: 0;
      top: 0;
      right: -20px;
      transition: 0.5s;
      }
      button:hover {
      background-color: #f7c2f9;
      }
      button:hover span {
      padding-right: 25px;
      }
      button:hover span:after {
      opacity: 1;
      right: 0;
      }
    </style>
</head>
<body>
	<nav id="topnav">
		<ul id="menu">
			<li style="float: left"><a href="./home.php">Water Quality Monitoring System</a></li>
			<li style="float: right"><a id="loginBtn" href="javascript:void(0)"><?php if($isLoggedOn) echo "Logout"; else echo "Login"; ?></a></li>
			<li style="float: right"><a href="./about-us.php">À propos</a></li>
			<li class="selected" style="float: right"><a href="./home.php">Acceuil</a></li>
		</ul>	
	</nav>

	<div ng-app="myApp" ng-controller="customersCtrl" class="main_div">
		<?php if($isLoggedOn) echo "<span style='float:left; font-size:small'>Logged in as ".$_SESSION['loginId']."</span><br>"; ?>
		<h3>État de la qualité de l'eau</h3>
		<?php if($isLoggedOn) echo '<table id="average"><tr><td>Average temperature:</td><td>{{average[0].temperature}}</td></tr>'
			.'<tr><td>Average turbidity:</td><td>{{average[0].turbidity}}</td></tr>'
			.'<tr><td>Average pH:</td><td>{{average[0].ph}}</td></tr></table>'
			.'<div style="text-align:  center;"><input id="settingsBtn" type="button" value="Settings"/></div>'
			.'<table id="status_table">'
			.'<tr>
			    <th>Time</th>
			    <th>Temperature (&#176C)</th>
			    <th>Turbidity (%)</th>
			    <th>pH Value</th>
				</tr>
			<tr ng-repeat="x in sensorss">
			    <td>{{x.time}}</td>
			    <td>{{x.temperature}}</td>
			    <td>{{x.turbidity}}</td>
			    <td>{{x.ph}}</td>
		  	</tr>
		</table>';
		else echo "<h4 style='text-align: center'>** Veuillez-vous connecter pour visualiser les données **</h4>";
		?>
	</div>
	<div class="login_div" style="display: none;">
		<h3 style="margin-top: 0px">Se connecter</h3>
		<br>
		<div class="login_field">
			<form id="login_form" method="post">
				<table>
					<tr><td>login</td><td><input type="text" name="loginId" size="15"/></td></tr>
					<tr><td>Password</td><td><input type="password" name="loginPassword" size="15"/></td></tr>
				</table>
				<input id="submit-login" type="button" value="Se connecter"/><br>
				<span style="font-size: smaller;"><a id="registerBtn" href="javascript:void(0)" >S'inscrire</a></span><br><br>
			</form>
		</div>
	</div>
		
	<div class="register_div" style="display: none;">
		<h3 style="margin-top: 0px">S'inscrire</h3>
		<br>
		<div class="register_field">
			<span style="font-size: smaller;">Envoyer un mail a l'administrateur</span><br>
			<form id="register_form" method="post">
			<!-- <form action="./register_user.php" id="register_form" method="get"> -->
				<table>
					<tr><td>Nom</td><td class="required"><input type="text" name="fullname" size="30" /></td></tr>
					<tr><td>Email</td><td class="required"><input type="email" name="email" size="22" /></td></tr>
					<tr><td>Login</td><td class="required"><input type="text" name="username" size="15" /></td></tr>
					<tr><td>Password</td><td class="required"><input type="password" name="password" size="15" /></td></tr>
					<tr><td>Message</td><td><textarea name="message" cols="30" placeholder="message (optional)"></textarea></td></tr>
				</table><br>
				<input id="submit-login" type="button" value="Envoyer"/>
			</form>
		</div>
	</div>

	<div class="settings_div" style="display: none; text-align: center; font-size: smaller;">
		<h3 style="margin-top: 0px">Parametres</h3>
		<br>
		<div class="settings_field">
			<form id="settings_form" method="post">
				<input type="checkbox" name="sendEmailCB" <?php if($_SESSION['isWarningEmail']=="true") echo "checked";?> value="yes"/> Send me warning emails<br><br>
				Set data warning values:<br>
				<input type="number" name="temp_limit" placeholder="Temperature" min=0 <?php if(array_key_exists('temp_limit', $_SESSION)) echo "value=".$_SESSION['temp_limit'];?> style="width: 90px; text-align: center;" /><br>
				<input type="number" name="turb_limit" placeholder="Turbidity" min=0 <?php if(array_key_exists('turb_limit', $_SESSION)) echo "value=".$_SESSION['turb_limit'];?> style="width: 90px; text-align: center;" /><br>
				<input type="number" name="ph_limit" placeholder="pH" min=0 <?php if(array_key_exists('ph_limit', $_SESSION)) echo "value=".$_SESSION['ph_limit'];?> style="width: 90px; text-align: center;" /><br>
				<span style="font-size: x-small;"><i>* Leave blank to unset values</i></span><br><br>
				<input id="submit-settings" type="button" value="Save"/>
			</form>
		</div>
	</div>
	<div class="black_bg" style="display: none;"></div>
	<footer>
		<p style="text-align: center;margin-top:350px; ">Copyright &copy 2020<br>Water Quality Monitoring System</p>
	</footer>
</body>
</html>
