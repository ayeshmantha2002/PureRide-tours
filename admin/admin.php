<?php
session_start();
include("../includes/connection.php");
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

// last login time count
$last_log = "UPDATE `admins` SET `Last_login` = NOW() WHERE `ID` = {$_SESSION['ID']}";
$last_log_result = mysqli_query($connection, $last_log);

// notivication indicator
$notifiMsg = "SELECT `Notification` FROM `admins` WHERE `Notification` = 1 AND `ID` = {$_SESSION['ID']}";
$notifiMsg_result = mysqli_query($connection, $notifiMsg);
if (mysqli_num_rows($notifiMsg_result) == 1) {
    $hiddenNoti = "";
} else {
    $hiddenNoti = "hidden";
}

// order indicator
$notifiOrders = "SELECT `Status` FROM `orders` WHERE `Status` = 1";
$notifiOrders_result = mysqli_query($connection, $notifiOrders);
if (mysqli_num_rows($notifiOrders_result) > 1) {
    $hiddenOrders = "";
} else {
    $hiddenOrders = "hidden";
}

// tours_orders indicator
$notifitours_orders = "SELECT `Status` FROM `tours_orders` WHERE `Status` = 1";
$notifitours_orders_result = mysqli_query($connection, $notifitours_orders);
if (mysqli_num_rows($notifitours_orders_result) > 1) {
    $hiddentours_orders = "";
} else {
    $hiddentours_orders = "hidden";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin panal </title>
    <link rel="stylesheet" href="../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- pre loader -->
    <section class="loading" id="loading">
        <img src="../assect/img/loading2.gif" alt="loading">
    </section>

    <section class="mobile_area">
        <!-- hero section  -->
        <section class="hero">
            <div class="notifications">
                <div class="noti fa-beat-fade" <?= $hiddenNoti; ?>></div>
                <a href="notifications.php"> <i class="fa-regular fa-bell" onclick="clickFunction()"></i> </a>
            </div>
            <div class="logo">
                <div>
                    <h1> PureRide tours </h1>
                    <p> Lorem, ipsum dolor. </p>
                </div>
                <div>
                    <img src="../assect/img/Pueride Tours Logo.png" alt="PureRide tours logo">
                </div>
            </div>
            <div class="quick_buttons">
                <div>
                    <div class="noti fa-beat-fade" <?= $hiddenOrders; ?>></div>
                    <button> <a href="orders.php" class="click" onclick="clickFunction()"> Vehicle Orders </a> </button>
                </div>
                <div>
                    <div class="noti fa-beat-fade" <?= $hiddentours_orders; ?>></div>
                    <button> <a href="#" class="click" onclick="clickFunction()"> Trip Orders </a> </button>
                </div>
                <div>
                    <div class="noti fa-beat-fade"></div>
                    <button> <a href="#" class="click" onclick="clickFunction()"> Hotel / Guides Orders </a> </button>
                </div>
            </div>
        </section>

        <!-- main controles  -->
        <section class="website-contolers">
            <h4> Main controls </h4>
            <div class="buttons">
                <div> <button> <a href="#" class="click" onclick="clickFunction()"> MAIN BANNER </a> </button> </div>
                <div> <button> <a href="#" class="click" onclick="clickFunction()"> VEHICLE TYPES </a> </button> </div>
                <div> <button> <a href="#" class="click" onclick="clickFunction()"> VEHICLE FLEET </a> </button> </div>
                <div> <button> <a href="#" class="click" onclick="clickFunction()"> SERVICES </a> </button> </div>
                <div> <button> <a href="#" class="click" onclick="clickFunction()"> PICKUP LOCATIONS </a> </button> </div>
                <div> <button> <a href="#" class="click" onclick="clickFunction()"> TOURS </a> </button> </div>
                <div> <button> <a href="add-admin.php" class="click" onclick="clickFunction()"> ADMINS </a> </button> </div>
                <div> <button> <a href="#" class="click" onclick="clickFunction()"> <i class="fa-solid fa-gear fa-spin"></i> </a> </button> </div>
            </div>
        </section>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js" integrity="sha512-QABeEm/oYtKZVyaO8mQQjePTPplrV8qoT7PrwHDJCBLqZl5UmuPi3APEcWwtTNOiH24psax69XPQtEo5dAkGcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assect/js/main.js"></script>
    <script src="../assect/js/funtions.js"></script>
</body>

</html>