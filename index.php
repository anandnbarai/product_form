<?php

include('connect.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <style>
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        a {
            text-decoration: none !important;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-3">
        <button type="submit" name="view" class="bg-primary text-white border-0 p-1"><a href="addProduct.php">&nbsp;&nbsp;&nbsp;Add Product&nbsp;&nbsp;&nbsp;</a></button>
    </div>
    <h2 class="text-center">Customer & Order Details Form</h2>
    <!-- Add Data Form -->
    <form method="post" class="mt-3">
        <div class="container">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Customer Name :</label>
                <input type="text" name="vCustomerName" id="vCustomerName" class="form-control" placeholder="Enter Customer Name" autocomplete="off" required>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product Name :</label>
                <select class="form-control required" name="vProductName" id="vProductName">
                    <option value="">Select Product</option>
                    <!-- public function mf_createcombo($query, $opt_value, $disp_value, $selected = "", $firstval = "-Select-") -->
                    <?php

                    $sql = "SELECT * FROM `product_master`";

                    $row = mysqli_query($myCon, $sql);
                    // Create an array to store the product names

                    while ($result = mysqli_fetch_assoc($row)) {
                        $iProductId = $result['iProductId'];
                        $vProductName = $result['vProductName'];
                        echo "<option value='$iProductId'>$vProductName</option>";
                    }

                    ?>
                </select>
            </div>
            <div class="form-outline mb-4 w-50 m-auto" id="Price">
                <label for="product_title" class="form-label">Price :</label>
                <input type="text" id="iPrice" name="iPrice" class="form-control" value="" autocomplete="off" readonly>
            </div>
            <div class="form-outline mb-4 w-50 m-auto" id="Unit">
                <label for="product_title" class="form-label">Unit :</label>
                <input type="text" name="iUnit" id="iUnit" class="form-control" autocomplete="off" readonly>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Discount (%) :</label>
                <input type="number" name="iDiscount" id="iDiscount" class="form-control" placeholder="Enter Discount" autocomplete="off" required>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Quantity :</label>
                <input type="number" name="iQty" id="iQty" class="form-control" placeholder="Enter Quantity" autocomplete="off" required>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Net Amount :</label>
                <input type="text" name="iNetAmount" id="iNetAmount" placeholder="Price – Disc Of Price" class="form-control" autocomplete="off" readonly>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Total Amount :</label>
                <input type="text" name="iTotalAmount" id="iTotalAmount" class="form-control" placeholder="Net Amount * Quantity" autocomplete="off" readonly>
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="button" name="AddData" id="addData" class="bg-primary text-white border-0 p-1" value="    Add    ">
            </div>
        </div>
    </form>

    <div class="container table">
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Net Amount</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="tableBody">
            </tbody>
        </table>
    </div>

    <div class="form-outline mb-4 w-50 m-auto">
        <input type="button" name="insertData" id="insertData" class="bg-primary text-white border-0 p-1" value="    Submit    ">
    </div>
</body>

</html>

<script>
    $(document).ready(function() {

        //function to fetch and store value of unit and price 
        $('#vProductName').change(function() {
            var iProductId = $(this).val();
            // console.log(iProductId);
            $.ajax({
                url: 'get_product_data.php',
                data: {
                    'action': 'getRateUnits',
                    iProductId: iProductId
                },
                success: function(data) {
                    // Decode the JSON data
                    var jsonData = JSON.parse(data);

                    // Extract the iUnit and iPrice values
                    var iUnit = jsonData.iUnit;
                    var iPrice = jsonData.iPrice;

                    // console.log(iUnit);
                    // console.log(iPrice);

                    // Set the values of the input fields
                    $('#iPrice').val(iPrice);
                    $('#iUnit').val(iUnit);
                }
            });
        });

        //function to calculate Net Amount
        $('#iDiscount, #iQty').change(function() {

            // Calculate the net amount
            const iPrice = $('#iPrice').val();
            const iDiscount = $('#iDiscount').val();
            var iNetAmount = iPrice - (iDiscount / 100) * iPrice;

            // Set the value of the net amount input field
            $('#iNetAmount').val(iNetAmount);

            // Calculate the net amount
            var iNetAmount = $('#iNetAmount').val();
            const iQty = $('#iQty').val();
            const iTotal = iNetAmount * iQty;
            console.log(iQty);
            console.log(iDiscount);
            // console.log(iTotal);
            // Set the value of the net amount input field
            $('#iTotalAmount').val(iTotal);
        });

        //function to calculate Total Amount



        $('#addData').click(function() {
            var selectedProductName = $('#vProductName option:selected').text();
            // Get the form data
            var formData = {
                vCustomerName: $('#vCustomerName').val(),
                vProductName: selectedProductName,
                iPrice: $('#iPrice').val(),
                iUnit: $('#iUnit').val(),
                iDiscount: $('#iDiscount').val(),
                iQty: $('#iQty').val(),
                iNetAmount: $('#iNetAmount').val(),
                iTotalAmount: $('#iTotalAmount').val()
            };

            // console.log(selectedProductName);
            // Create a new row in the table
            var currentID = 1;
            currentID++;

            // Create a new row in the table
            const newRow = $('<tr></tr>');

            // Add the form data and ID value to the new row
            newRow.append(`<td><input type="text" class="form-control" id="${formData.vProductName}_${currentID}" value="${formData.vProductName}" readonly/></td>`);
            newRow.append(`<td><input type="number" class="form-control" id="${formData.iPrice}_${currentID}" value="${formData.iPrice}" readonly/></td>`);
            newRow.append(`<td><input type="number" class="form-control" id="${formData.iUnit}_${currentID}" value="${formData.iUnit}" readonly/></td>`);
            newRow.append(`<td><input type="number" class="form-control" id="${formData.iDiscount}_${currentID}" value="${formData.iDiscount}" /></td>`);
            newRow.append(`<td><input type="number" class="form-control" id="${formData.iQty}_${currentID}" value="${formData.iQty}" /></td>`);
            newRow.append(`<td><input type="number" class="form-control" id="${formData.iNetAmount}_${currentID}" value="${formData.iNetAmount}" readonly/></td>`);
            newRow.append(`<td><input type="number" class="form-control" id="${formData.iTotalAmount}_${currentID}" value="${formData.iTotalAmount}" readonly/></td>`);
            newRow.append(`<td><button class="btn btn-danger remove" id="removeAllButton">Remove</button></td>`);

            // Add the new row to the table body
            $('#tableBody').append(newRow);
        });


        //function to calculate Net Amount
        $('#iDiscountedPrice').change(function() {

            // Calculate the net amount
            const iPrice = $('#ProductPrice').val();

            const iDiscountedPrice = $(this).val();
            const iNetAmount = iPrice - (iDiscountedPrice / 100) * iPrice;

            // Set the value of the net amount input field
            $('#ProductNetAmount').val(iNetAmount);
        });


        // Add a click event listener to the "Remove All" button
        $('#tableBody').on('click', '.remove', function() {
            // Remove the current row from the table
            $(this).closest('tr').remove();
        });


        $('#insertData').click(function() {
            // Get the form data
            var formData = {
                vCustomerName: $('#vCustomerName').val(),
                vProductName: $('#ProductName').val(),
                iPrice: $('#ProductPrice').val(),
                iUnit: $('#ProductUnit').val(),
                iDiscount: parseFloat($('#iDiscountedPrice').val()),
                iQty: parseInt($('#ProductQty').val()),
                iNetAmount: parseFloat($('#ProductNetAmount').val()),
                iTotalAmount: parseFloat($('#ProductTotalAmount').val())
            };

            // Make an AJAX request to insert the form data into the database
            $.ajax({
                url: 'insertOrder.php',
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(data) {
                    // console.log(data.message);
                    alert(data.message);
                    window.location.replace('index.php');
                },
            });
        });

    });
</script>