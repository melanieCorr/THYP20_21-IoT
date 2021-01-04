<?php
include ('./config.php');

session_start();
if (array_key_exists('loginId', $_SESSION)) {
    $con = mysqli_connect('localhost',$username,$password) 
    or die('Cannot connect to the DB');

    mysqli_select_db($con, $database_name);

	$myArray = array();
	$result = mysqli_query($con,"SELECT * FROM sensors ORDER BY time DESC LIMIT 12");
	if($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	            $myArray[] = $row;
	    }
	    echo json_encode($myArray);
	}

	mysqli_close($con);
}
?>