<?php

include 'connect.php';

if (isset($_POST['addProduct'])) {

    $vProductName = $_POST['vProductName'];
    $iPrice = $_POST['iPrice'];
    $iUnit = $_POST['iUnit'];

    $sql = "INSERT INTO `product_master` (vProductName,iPrice,iUnit) values('$vProductName','$iPrice','$iUnit')";

    $result_query = mysqli_query($myCon, $sql);

    if ($result_query) {
        echo "<script>window.alert('Product Added.')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid col-md-6">
        <h3 class="text-center mt-2 formTitle">Add Product</h3>
        <form class="m-3" method="post" id="form" enctype="multipart/form-data">
            <div class="form-outline mb-3">
                <label class="form-label" for="name">Product Name <span>*</span></label>
                <input type="text" name="vProductName" id="vProductName" class="form-control" autocomplete="off" onkeypress="return onlyAlpha(event)" required>
            </div>
            <div class="form-outline mb-3">
                <label class="form-label" for="email">Price <span>*</span></label>
                <input type="text" name="iPrice" id="iPrice" class="form-control" autocomplete="off" required>
            </div>
            <div class="form-outline mb-3">
                <label class="form-label" for="email">Unit <span>*</span></label>
                <input type="text" name="iUnit" id="iUnit" class="form-control" autocomplete="off" required>
            </div>
            <div class="form-outline mb-3">
                <input type="submit" id="addProduct" name="addProduct" value="    Add Product    " class="bg-primary text-white border-0 p-1">
            </div>
        </form>
    </div>
</body>
<script>
    function onlyAlpha(event) {
        var char = event.which;
        if (char > 31 && char != 32 && (char < 65 || char > 90) && (char < 97 || char > 122)) {
            return false;
        }
    }
</script>

</html>