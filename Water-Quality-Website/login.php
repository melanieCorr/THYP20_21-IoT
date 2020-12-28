<?php
include ('./config.php');

session_start();

if(!isset($_SESSION['loginId'])) {
    $con = mysqli_connect('localhost',$username,$password) 
    or die('Cannot connect to the DB');

    mysqli_select_db($con, $database_name);
	$result = mysqli_query($con,"SELECT username, password FROM user");
	$response = "invalid";
	if($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	if($row["username"] == $_POST['loginId'] && $row["password"] == $_POST['loginPassword']) {
	        	$_SESSION['loginId'] = $_POST['loginId'];
				$response = "success";
				break;
			}
	    }
	}
	echo $response;
	mysqli_close($con);
	
}
else {
	unset($_SESSION['loginId']);
	// session_destroy();
}
?>