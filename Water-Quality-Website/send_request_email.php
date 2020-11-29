<?php
include ('./config.php');

$data = array(
    'fullname' => $_POST['fullname'],
    'email' => $_POST['email'],
    'username' => $_POST['username'],
    'password' => $_POST['password']
);

$msg = "New registration needs your approval.<br>"
.$_POST['fullname']."<br>"
.$_POST['email']."<br>"
.$_POST['username']."<br>"
.$_POST['message']."<br><br>"
."<a href='".$host."register_user.php?".http_build_query($data)."'>Click here to approve</a><br>";

// headers
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

// use wordwrap() for lines no longer than 70 characters
$msg = wordwrap($msg,80);
echo $host."register_user.php?".http_build_query($data).PHP_EOL;

// send email
if($send_email) {
    mail($admin_email,"Water Quality System User Registration",$msg,$headers);
    echo "Email sent";
}
else {
    echo "Email not being sent: Send Email option? ".(int)$send_email;
}
?>