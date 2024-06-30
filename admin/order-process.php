<?php
session_start();
include("../includes/connection.php");
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

// Order 
if (isset($_GET['orderID'])) {
    $orderID = mysqli_real_escape_string($connection, $_GET['orderID']);

    $order = "SELECT * FROM `orders` WHERE `ID` = {$orderID}";
    $order_result = mysqli_query($connection, $order);
} else {
    header("location: orders.php");
}

// Order seen update
if (isset($_POST['seen'])) {
    $UPorderID = $_POST['UPorderID'];
    $seen_update = "UPDATE `orders` SET `Status` = 1, `Check_Admin_ID` = {$_SESSION['ID']} WHERE `ID` = {$UPorderID}";
    $seen_update_result = mysqli_query($connection, $seen_update);

    if ($seen_update_result) {
        header("location: order-process.php?order=appsect&orderID={$UPorderID}");
    }
}

// Order cancel update
if (isset($_POST['cancel'])) {
    $UPorderID = $_POST['UPorderID'];
    $cancel_update = "UPDATE `orders` SET `Status` = 4, `Check_Admin_ID` = {$_SESSION['ID']} WHERE `ID` = {$UPorderID}";
    $cancel_update_result = mysqli_query($connection, $cancel_update);

    if ($cancel_update_result) {
        header("location: order-process.php?order=canceled&orderID={$UPorderID}");
    }
}

// order messages 
if (isset($_GET['order'])) {
    if ($_GET['order'] == "appsect") {
        $appsect = "flex";
        $canceled = "none";
    } elseif ($_GET['order'] == "canceled") {
        $appsect = "none";
        $canceled = "flex";
    } else {
        $appsect = "none";
        $canceled = "none";
    }
} else {
    $appsect = "none";
    $canceled = "none";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Order details </title>
    <link rel="stylesheet" href="../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- pre loader -->
    <section class="loading" id="loading">
        <img src="../assect/img/loading2.gif" alt="loading">
    </section>

    <section class="mobile_area">
        <div class="notifi_area">
            <div class="notification">
                <div class="close">
                    <a href="orders.php"> <i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i> </a>
                </div>
                <h2 style="text-align: center;"> Order details </h2>
                <div id="notification">
                    <?php
                    if (mysqli_num_rows($order_result) > 0) {
                        while ($fetch_order = mysqli_fetch_assoc($order_result)) {
                            $ID = $fetch_order['ID'];
                            $Title = $fetch_order['Title'];
                            $Name = $fetch_order['Name'];
                            $E_mail = $fetch_order['E-mail'];
                            $Number = $fetch_order['Number'];
                            $Pickup_Location = $fetch_order['Pickup_Location'];
                            $Dropoff_Location = $fetch_order['Dropoff_Location'];
                            $Service_Type = $fetch_order['Service_Type'];
                            $Vehicle_Type = $fetch_order['Vehicle_Type'];
                            $Passengers = $fetch_order['Passengers'];
                            $Pickup_Date = $fetch_order['Pickup_Date'];
                            $Pickup_Time = $fetch_order['Pickup_Time'];
                            $Return_Date = $fetch_order['Return_Date'];
                            $Drop_Off_Time = $fetch_order['Drop_Off_Time'];
                            $Message = $fetch_order['Message'];
                            $Status = $fetch_order['Status'];
                            $Order_time = $fetch_order['Order_time'];
                            $Check_Admin_ID = $fetch_order['Check_Admin_ID'];

                            if ($Status == 1) {
                                $display1 = "block";
                                $display2 = "none";
                                $display3 = "none";
                            } elseif ($Status == 4) {
                                $display1 = "none";
                                $display2 = "block";
                                $display3 = "none";
                            } else {
                                $display1 = "none";
                                $display2 = "none";
                                $display3 = "block";
                            }

                            echo "
                            <div class='order_details'>
                                <p> <b> Name : </b> {$Title} {$Name} </p>
                                <p> <b> E-mail : </b> {$E_mail} </p>
                                <p> <b> Mobile Number : </b> 0{$Number} </p>
                                <p> <b> Service Type : {$Service_Type} </b> </p>
                                <p> <b> Vehicle Type : </b> {$Vehicle_Type} </p>
                                <p> <b> Passengers : </b> {$Passengers} </p>
                                <p> <b> Pickup Location : </b> {$Pickup_Location} </p>
                                <p> <b> Pickup Date : </b> {$Pickup_Date} | <b> Time : </b> {$Pickup_Time} </p>
                                <p> <b> Dropoff Location : </b> {$Dropoff_Location} </p>
                                <p> <b> Return Date : </b> {$Return_Date} | <b> Time : </b> {$Drop_Off_Time} </p>
                                <p> <b> Message : {$Message} </b> </p>
                                <br>
                            </div>

                            <form method='post' style='display: {$display1};'>
                                 <p style='color: #fff; text-align: center; background-color: green; padding: 10px; box-sizing: border-box; border-radius: 5px;'> This order has been completed. </p>
                            </form>

                            <form method='post' style='display: {$display2};'>
                                <p style='color: #fff; text-align: center; background-color: red; padding: 10px; box-sizing: border-box; border-radius: 5px;'> This order has been cancelled. </p>
                            </form>

                            <form method='post' style='display: {$display3};'>
                                <p> Called the customer : <input type='checkbox' name='UPorderID' value='{$ID}' required> </p>
                                <br>
                                <p> <input type='submit' value='Appsect' name='seen'> </p>
                                <br>
                                <p class='cancel'> <input type='submit' value='Cancel' name='cancel'> </p>
                            </form>
                            ";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- appcect message -->
        <div class="update_message" style="display: <?= $appsect; ?>;">
            <div class="update_message_box">
                <p class="done"> <i class="fa-solid fa-circle-check fa-beat" style="color: #00ff33;"></i> </p>
                <h3 style="margin-bottom: 15px;"> Order complete. </h3>
                <p> <a href="order-process.php?orderID=<?= $orderID; ?>" onclick='clickFunction()'> Ok </a> </p>
            </div>
        </div>

        <!-- cancel message -->
        <div class="update_message" style="display: <?= $canceled; ?>;">
            <div class="update_message_box">
                <p class="done"> <i class="fa-solid fa-circle-check fa-beat" style="color: #00ff33;"></i> </p>
                <h3 style="margin-bottom: 15px;"> Order cancellation complete. </h3>
                <p> <a href="order-process.php?orderID=<?= $orderID; ?>" onclick='clickFunction()'> Ok </a> </p>
            </div>
        </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js" integrity="sha512-QABeEm/oYtKZVyaO8mQQjePTPplrV8qoT7PrwHDJCBLqZl5UmuPi3APEcWwtTNOiH24psax69XPQtEo5dAkGcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assect/js/main.js"></script>
    <script src="../assect/js/funtions.js"></script>
</body>

</html>