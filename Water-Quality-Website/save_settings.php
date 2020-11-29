<?php
session_start();

if (array_key_exists('loginId', $_SESSION)) {
	if(array_key_exists('sendEmailCB',$_POST)) {
		$_SESSION['isWarningEmail'] = "true";
	}
	else {
		$_SESSION['isWarningEmail'] = "false";
	}

	if("" != trim($_POST['temp_limit'])){
		$_SESSION['temp_limit'] = $_POST['temp_limit'];
	}
	if("" != trim($_POST['turb_limit'])){
		$_SESSION['turb_limit'] = $_POST['turb_limit'];
	}
	if("" != trim($_POST['ph_limit'])){
		$_SESSION['ph_limit'] = $_POST['ph_limit'];
	}
	echo $_SESSION['isWarningEmail'].", ".$_SESSION['temp_limit'].", ".$_SESSION['turb_limit'].", ".$_SESSION['ph_limit'];
}
?>