<?php
// Include database connection
include("connect.php");

$action = $_REQUEST['action'];
if ($action == "getRateUnits") {
    $iProductId = $_REQUEST['iProductId'];
    // echo $vProductName;

    $sql = "SELECT * FROM product_master WHERE iProductId = '$iProductId'";
    $row = mysqli_query($myCon, $sql);
    $fetchData = mysqli_fetch_array($row);

    $iUnit = $fetchData['iUnit'];
    $iPrice = $fetchData['iPrice'];
    // echo "Unit : " . $iUnit . " Price :" . $iPrice;
    
    $jsonData = json_encode([
        'iUnit' => $iUnit,
        'iPrice' => $iPrice
    ]);

    echo $jsonData;
}
