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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

</head>
<body>
	<nav id="topnav">
		<ul id="menu">
			<li style="float: left"><a href="./home.php">Water Quality Monitoring System</a></li>
			<li style="float: right"><a id="loginBtn" href="javascript:void(0)"><?php if($isLoggedOn) echo "Logout"; else echo "Login"; ?></a></li>
			<li style="float: right"><a href="./about-us.php">A propos</a></li>
			<li class="selected" style="float: right"><a href="./home.php">Accueil</a></li>
		</ul>	
	</nav>
               <!-- affichage resultat -->
	<div ng-app="myApp" ng-controller="customersCtrl" class="main_div">
		<?php if($isLoggedOn) echo "<span style='float:left; font-size:15px; color:blue;font-weight:bold;'>Connecté(e) en tant que ".$_SESSION['loginId']."</span><br>"; ?>
		<h3>État de la qualité de l'eau</h3>
		<?php if($isLoggedOn) echo '<table id="average"><tr><td>Température moyenne:</td><td style="color:blue;font-weight:bold;">{{average[0].temperature}}</td></tr>'
			.'<tr><td>Turbidité moyenne:</td><td style="color:blue;font-weight:bold;">{{average[0].turbidity}}</td></tr>'
			.'<tr><td>pH Moyen:</td><td style="color:blue;font-weight:bold;">{{average[0].ph}}</td></tr></table>'
			.'<div style="text-align:  center;">
				   <input id="settingsBtn" type="button" class="btn btn-success" value="Paramètres"/>
				    <button class="btn btn-warning"><a href="charts.php" target="_blank" style="text-decoration:none;color:black">Statistiques</a></button></div>'
			.'<table id="status_table">'
			.'<tr>
			    <th>Heure</th>
			    <th>Température (&#176C)</th>
			    <th>Turbidité (%)</th>
			    <th>pH Valeur</th>
				</tr>
			<tr ng-repeat="x in reading">
			    <td>{{x.time}}</td>
			    <td>{{x.temperature}}</td>
			    <td>{{x.turbidity}}</td>
			    <td>{{x.ph}}</td>
		  	</tr>
		</table>';
		else echo "<h4 style='text-align: center'>** Veuillez-vous connecter pour visualiser les données **</h4>";
		?>
	</div>
	           <!-- pop up login -->
	<div class="login_div" style="display: none;">
		<h3 style="margin-top: 0px">Se connecter</h3>
		<br>
		<div class="login_field">
			<form id="login_form" method="post" action="login.php">
				<table>
					<tr><td>login</td><td><input type="text" name="loginId" size="15"/></td></tr>
					<tr><td>Password</td><td><input type="password" name="loginPassword" size="15"/></td></tr>
				</table>
				<input  type="submit" class="btn btn-success" value="Se connecter"/><br>
				<span style="font-size: smaller;"><a id="registerBtn" href="javascript:void(0)" >S'inscrire</a></span><br><br>
			</form>
		</div>
	</div>
		       <!-- pop up enregistrer-->
	<div class="register_div" style="display: none;">
		<h3 style="margin-top: 0px">S'inscrire</h3>
		<br>
		<div class="register_field">
			<form id="register_form" method="post" action="register_user.php">
				<table>
					<tr><td>Nom</td><td class="required"><input type="text" name="fullname" size="30" /></td></tr>
					<tr><td>Email</td><td class="required"><input type="email" name="email" size="22" /></td></tr>
					<tr><td>Login</td><td class="required"><input type="text" name="username" size="15" /></td></tr>
					<tr><td>Mot de passe</td><td class="required"><input type="password" name="password" size="15" /></td></tr>
				</table><br>
				<input type="submit" value="Inscription" class="btn btn-success"/>
			</form>
		</div>
	</div>
                <!-- partie settings -->
	<div class="settings_div" style="display: none; text-align: center; font-size: smaller;">
		<h3 style="margin-top: 0px">Paramètres</h3>
		<br>
		<div class="settings_field">
			<form id="settings_form" method="post">
				<input type="checkbox" name="sendEmailCB" <?php if($_SESSION['isWarningEmail']=="true") echo "checked";?> value="yes"/> Envoyez-moi des e-mails d'avertissement<br><br>
				Définir les valeurs d'avertissement des données:<br>
				<label style="width:80px;display: inline-block;" >Température:</label><input type="number" name="temp_limit" placeholder="Température" min=0 <?php if(array_key_exists('temp_limit', $_SESSION)) echo "value=".$_SESSION['temp_limit'];?> style="width: 90px; text-align: center;" /><br>
				<label style="width:80px;display: inline-block;">Turpidité:</label><input type="number" name="turb_limit" placeholder="Turbidité" min=0 <?php if(array_key_exists('turb_limit', $_SESSION)) echo "value=".$_SESSION['turb_limit'];?> style="width: 90px; text-align: center;" /><br>
				<label style="width:80px;display: inline-block;">pH:</label><input type="number" name="ph_limit" placeholder="pH" min=0 <?php if(array_key_exists('ph_limit', $_SESSION)) echo "value=".$_SESSION['ph_limit'];?> style="width: 90px; text-align: center;" /><br>
				<span style="font-size: x-small;"><i>* 
                                   Laisser vide pour annuler les valeurs</i></span><br><br>
				<input id="submit-settings" type="button" value="Enregistrer" class="btn btn-success"/>
			</form>
		</div>
	</div>
	<div class="black_bg" style="display: none;"></div>
	
	<footer>
		<p style="text-align: center;">Copyright &copy 2021<br>Water Quality Monitoring System Paris8</p>
	</footer>
	

	
</body>
</html>
