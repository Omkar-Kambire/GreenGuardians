<?php
 
define('RAZORPAY_KEY', '<YOUR_API_KEY>"');
define('RAZORPAY_SECRET', '<YOUR_API_SECRET>');

$conn =mysqli_connect('localhost','root','root','greenguardians');
if(!$conn){
    die(mysqli_error($conn));
}
?>