<?php
include ('./config.php');


session_start();
if (array_key_exists('loginId', $_SESSION)) {
    $con = mysqli_connect('localhost',$username,$password) 
    or die('Cannot connect to the DB');

    mysqli_select_db($con, $database_name);

	$myArray = array();
	$result = mysqli_query($con,"SELECT ROUND(AVG(temperature)) AS temperature,ROUND(AVG(turbidity)) AS turbidity,ROUND(AVG(ph),1) AS ph FROM (SELECT * FROM sensors ORDER BY time DESC LIMIT 12) AS T");
	$myArray[] = $result->fetch_assoc();

	$email = array();
	$result2 = mysqli_query($con,"SELECT email FROM user WHERE username = '".$_SESSION['loginId']."';");
	$email[] = $result2->fetch_assoc();
	
	mysqli_close($con);
	echo json_encode($myArray);

	// if($myArray[0]["temperature"] >= $_SESSION["temp_limit"] 
	// && $myArray[0]["turbidity"] >= $_SESSION["turb_limit"] && $myArray[0]["ph"] <= $_SESSION["ph_limit"]) {
	// 	// $message = "Dangerous level:\nTemperature: ".$myArray[0]["temperature"]."\n"
	// 	// ."\nTurbidity: ".$myArray[0]["turbidity"]."\n"
	// 	// ."\npH: ".$myArray[0]["ph"]."\n\n";
	// 	// mail($email[0]['email'], "Water Quality Warning", $message);
	// 	echo "<script>
	// 	     console.log('normalement un message doit etre envoyé');
	// 	</script>"
	// }

}
?>