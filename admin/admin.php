<?php
session_start();
include("../includes/connection.php");
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

$errors = array();

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
$notifiOrders = "SELECT `Status` FROM `orders` WHERE `Status` = 3";
$notifiOrders_result = mysqli_query($connection, $notifiOrders);
if (mysqli_num_rows($notifiOrders_result) > 0) {
    $hiddenOrders = "";
} else {
    $hiddenOrders = "hidden";
}

// tours_orders indicator
$notifitours_orders = "SELECT `Status` FROM `tours_orders` WHERE `Status` = 3";
$notifitours_orders_result = mysqli_query($connection, $notifitours_orders);
if (mysqli_num_rows($notifitours_orders_result) > 0) {
    $hiddentours_orders = "";
} else {
    $hiddentours_orders = "hidden";
}

// change password 
if (isset($_POST['change'])) {
    $current = mysqli_real_escape_string($connection, $_POST['current']);
    $hash_current = sha1($current);
    $new = mysqli_real_escape_string($connection, $_POST['new']);
    $confirm = mysqli_real_escape_string($connection, $_POST['c_new']);
    $hash_new = sha1($new);

    $check_current_pw = "SELECT `Password` FROM `admins` WHERE `ID` = {$_SESSION['ID']}";
    $check_current_pw_result = mysqli_query($connection, $check_current_pw);
    if (mysqli_num_rows($check_current_pw_result) == 1) {
        $fetch_result = mysqli_fetch_assoc($check_current_pw_result);
        $fetch_password = $fetch_result['Password'];

        if ($fetch_password == $hash_current) {
            if ($new == $confirm) {
                $update_pass = "UPDATE `admins` SET `Password` = '{$hash_new}' WHERE `ID` = {$_SESSION['ID']}";
                $update_pass_result = mysqli_query($connection, $update_pass);
                if ($update_pass_result) {
                    header("location: admin.php?recode=updated");
                }
            } else {
                $errors[] = "Your new password and confirm password do not match.";
            }
        } else {
            $errors[] = "Your current password does not match";
        }
    } else {
        header("location: admin.php");
    }
} else {
    $current = "";
    $new = "";
    $confirm = "";
}

if (isset($_GET['change_password'])) {
    $displya_change = "flex";
} else {
    $displya_change = "none";
}

// update_message
if (isset($_GET['recode'])) {
    if ($_GET['recode'] == "updated") {
        $update_message = "flex";
    } else {
        $update_message = "none";
    }
} else {
    $update_message = "none";
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
                    <button> <a href="trip-orders.php" class="click" onclick="clickFunction()"> Trip Orders </a> </button>
                </div>
                <div>
                    <div class="noti fa-beat-fade"></div>
                    <button> <a href="#" class="click"> Hotel / Guides Orders </a> </button>
                </div>
            </div>
        </section>

        <!-- main controles  -->
        <section class="website-contolers">
            <h4> Main controls </h4>
            <div class="buttons">
                <div> <button> <a href="banner.php" class="click" onclick="clickFunction()"> MAIN BANNER </a> </button> </div>
                <div> <button> <a href="vehicle.php" class="click" onclick="clickFunction()"> VEHICLE TYPES </a> </button> </div>
                <div> <button> <a href="vehicle-fleet.php" class="click" onclick="clickFunction()"> VEHICLE FLEET </a> </button> </div>
                <div> <button> <a href="services.php" class="click" onclick="clickFunction()"> SERVICES </a> </button> </div>
                <div> <button> <a href="pickup-locations.php" class="click" onclick="clickFunction()"> PICKUP LOCATIONS </a> </button> </div>
                <div> <button> <a href="tours.php" class="click" onclick="clickFunction()"> TOURS </a> </button> </div>
                <div> <button> <a href="add-admin.php" class="click" onclick="clickFunction()"> ADMINS </a> </button> </div>
                <div> <button> <a href="admin.php?change_password" class="click" onclick="clickFunction()"> <i class="fa-solid fa-gear fa-spin"></i> </a> </button> </div>
                <div> <button> <a href="log-out.php" class="click" onclick="clickFunction()"> <i class="fa-solid fa-right-from-bracket"></i> </a> </button> </div>
            </div>
        </section>

        <section class="change_pw" style="display: <?= $displya_change; ?>;">
            <form method="post">
                <div class="close">
                    <a href="admin.php"> <i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i> </a>
                </div>
                <br><br>
                <h2 style="text-align: center;"> Change Your Password </h2>
                <p style="color: red; text-align: center;">
                    <?php
                    if (!empty($errors)) {
                        foreach ($errors as $errors) {
                            echo $errors;
                        }
                    } else {
                        echo "<br>";
                    }
                    ?>
                </p>
                <p>
                    <label for="current"> Current password : </label>
                    <input class="pw" type="password" placeholder="Current password" value="<?= $current; ?>" name="current" required>
                </p>
                <br>
                <p>
                    <label for="new"> New password : </label>
                    <input class="pw" style="margin-bottom: 5px;" type="password" placeholder="New password" value="<?= $new; ?>" name="new" minlength="6" required>
                    <input class="pw" type="password" placeholder="Confirm password" value="<?= $confirm; ?>" name="c_new" minlength="6" required>
                </p>
                <br>
                <p>
                    <input type="checkbox" id="show_pw"> <label for="show_pw"> : Show password </label>
                </p>
                <br>
                <p>
                    <input type="submit" name="change">
                </p>
                <br>
            </form>
        </section>

        <!-- update_message -->
        <div class="update_message" style="display: <?= $update_message; ?>;">
            <div class="update_message_box">
                <p class="done"> <i class="fa-solid fa-circle-check fa-beat" style="color: #00ff33;"></i> </p>
                <h3 style="margin-bottom: 15px;"> Your password has been changed. </h3>
                <p> <a href="admin.php" onclick='clickFunction()'> Ok </a> </p>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js" integrity="sha512-QABeEm/oYtKZVyaO8mQQjePTPplrV8qoT7PrwHDJCBLqZl5UmuPi3APEcWwtTNOiH24psax69XPQtEo5dAkGcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assect/js/main.js"></script>
    <script src="../assect/js/funtions.js"></script>
</body>

</html>