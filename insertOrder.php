<?php
date_default_timezone_set('Asia/Kolkata');

include 'connect.php';

$vCustomerName = $_POST['vCustomerName'];
$vProductName = $_POST['vProductName'];
$iPrice = $_POST['iPrice'];
$iUnit = $_POST['iUnit'];
$iDiscount = $_POST['iDiscount'];
$iQty = $_POST['iQty'];
$iNetAmount = $_POST['iNetAmount'];
$iTotalAmount = $_POST['iTotalAmount'];
$dCreatedDate = date("Y-m-d H:i:s");


$sql = "INSERT INTO `user_order` (vCustomerName,vProductName,iPrice,iUnit,iDiscount,iQty,iNetAmount,iTotalAmount,dCreatedDate) values('$vCustomerName','$vProductName','$iPrice','$iUnit','$iDiscount','$iQty','$iNetAmount','$iTotalAmount','$dCreatedDate')";

$result_query = mysqli_query($myCon, $sql);

if ($result_query) {
    $response['status'] = 'success';
    $response['message'] = 'Order Placed successfully!!!';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Something went wrong!!!';
}

$jsonResponse = json_encode($response);

// Output the JSON response
echo $jsonResponse;
exit;
