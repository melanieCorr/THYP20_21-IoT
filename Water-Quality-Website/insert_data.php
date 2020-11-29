<?php
include ('./config.php');

date_default_timezone_set('Asia/Kuala_Lumpur');
$dt = new DateTime();
// echo $dt->format('H:i:s');

$con = mysqli_connect('localhost',$username,$password) 
or die('Cannot connect to the DB');

mysqli_select_db($con, $database_name);

mysqli_query($con,"INSERT INTO sensors (time,temperature,turbidity,ph)
  VALUES ('".$dt->format('H:i:s')."','".$_GET['temperature']."','".$_GET['turbidity']."','".$_GET['ph']."')");

mysqli_close($con);
echo "Successfully insert new data";

?>