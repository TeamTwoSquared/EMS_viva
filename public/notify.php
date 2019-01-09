<?php

	$servername="localhost";
    	$username="admin_ems";
    	$password="ccs709-1";
    	$databasename="admin_ems";

//create connection
$connection = mysqli_connect($servername, $username, $password,$databasename)  or die("Unable to connect");
 
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$merchant_id         = $_POST['merchant_id'];
$order_id             = $_POST['order_id'];
$payhere_amount     = $_POST['payhere_amount'];
$payhere_currency    = $_POST['payhere_currency'];
$status_code         = $_POST['status_code'];
$md5sig                = $_POST['md5sig'];

$query = "SELECT value FROM settings WHERE property = 'merchant_secret'";
$result = mysqli_query($connection,$query);
$row = mysqli_fetch_row($result);

$merchant_secret = $row[0]; // Replace with your Merchant Secret (Can be found on your PayHere account's Settings page)

$local_md5sig = strtoupper (md5 ( $merchant_id . $order_id . $payhere_amount . $payhere_currency . $status_code . strtoupper(md5($merchant_secret)) ) );
if (($local_md5sig === $md5sig) AND ($status_code == 2) ){//success

		date_default_timezone_set('Asia/Colombo');
		$my_date = date("Y/m/d");;
		$sql = "UPDATE ads SET isapprove = 1, last_payment_date = '$my_date' WHERE ad_id = '$order_id'";
		$result = mysqli_query($connection,$sql);
		die();

}
else{

	$sql = "UPDATE ads SET isapprove = 3 WHERE ad_id = '$order_id'";
	$result = mysqli_query($connection,$sql);
	die();
}
?>