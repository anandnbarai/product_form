<?php

$myCon = mysqli_connect("localhost", "root", "", "product");

if ($myCon) {
    // echo "Success";
} else {
    echo "Failed";
}
