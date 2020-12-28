<?php
include ('./config.php');
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
      #submit-login span {
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
			<li class="selected" style="float: right"><a href="./about-us.php">À propos</a></li>
			<li style="float: right"><a href="./home.php">Accueil</a></li>
		</ul>	
	</nav>

	<div ng-app="myApp" class="main_div">
		<?php if($isLoggedOn) echo "<span style='float:left; font-size:small'>Logged in as ".$_SESSION['loginId']."</span><br>"; ?>
		<h3>À propos</h3>
		<p style="padding: 0px 30px;">Le système de surveillance de la qualité de l'eau est un système basé sur arduino pour collecter des données sur la qualité de l'eau en temps réel et afficher les données à l'utilisateur autorisé. Il fait partie du projet de deuxieme année en M2THYP à l'Université Paris8.</p>
	    <img src="logoParis8" style="width:130px; height:130px; margin-left:300px;">
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
				<span style="font-size: smaller;"><a id="registerBtn" href="javascript:void(0)">S'inscrire</a></span><br><br>
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
					<tr><td>Message</td><td><textarea name="message" cols="30" placeholder="message(optional)"></textarea></td></tr>
				</table><br>
				<input id="submit-login" type="button" value="Envoyer"/>
			</form>
		</div>
	</div>
	<div class="black_bg" style="display: none;"></div>
	<footer style="margin-top:160px;">
		<p style="text-align: center;">Copyright &copy 2020<br>Water Quality Monitoring System</p>
	</footer>
</body>
</html>
