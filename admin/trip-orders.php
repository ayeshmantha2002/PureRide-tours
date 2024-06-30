<?php
session_start();
include("../includes/connection.php");
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

// order list 
$orders = "SELECT * FROM `tours_orders` ORDER BY `ID` DESC";
$orders_result = mysqli_query($connection, $orders);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Tours Orders </title>
    <link rel="stylesheet" href="../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .mobile_area {
            height: 100vh;
        }

        .notifi_area {
            height: calc(100% - 50px);
        }

        .notification {
            height: calc(100% - 20px);
        }

        #notification {
            top: 0;
        }
    </style>
</head>

<body>
    <!-- pre loader -->
    <section class="loading" id="loading">
        <img src="../assect/img/loading2.gif" alt="loading">
    </section>

    <section class="mobile_area">
        <nav>
            <div class="back">
                <a href="admin.php"> <i class="fa-solid fa-chevron-left" onclick="clickFunction()"></i> </a>
            </div>
            <h3> Manage Tours Orders </h3>
        </nav>
        <br><br>
        <div class="notifi_area">
            <div class="notification">
                <div id="notification">
                    <?php
                    if (mysqli_num_rows($orders_result) > 0) {
                        while ($fetch_orders = mysqli_fetch_assoc($orders_result)) {
                            $orderID = $fetch_orders['ID'];
                            $order_Name = $fetch_orders['Name'];
                            $order_E_mail = $fetch_orders['E-mail'];
                            $order_Number = $fetch_orders['Number'];
                            $order_Picup_date = $fetch_orders['Picup_date'];
                            $order_Tour_ID = $fetch_orders['Tour_ID'];
                            $order_Tour_Name = $fetch_orders['Tour_Name'];
                            $order_Status = $fetch_orders['Status'];
                            $order_Order_date = $fetch_orders['Order_date'];
                            if ($order_Status == 3) {
                                $color = "#000";
                                $font_weight = "bold";
                            } elseif ($order_Status == 1) {
                                $color = "gray";
                                $font_weight = "normal";
                            } elseif ($order_Status == 4) {
                                $color = "Red";
                                $font_weight = "normal";
                            }

                            echo "
                            <a href='trip_order-process.php?orderID={$orderID}'>
                                <div class='msg'>
                                    <div class='img'>
                                        <i class='fa-solid fa-car-side'></i>
                                    </div>
                                    <div class='title'>
                                        <div class='title_up'>
                                            <div class='sub'>
                                                <h4 style='color: {$color}; font-weight: {$font_weight};'> {$order_Tour_Name} </h4>
                                            </div>
                                            <div>
                                                <p style='font-size: 12px; font-weight: {$font_weight};'> {$order_Order_date} </p>
                                            </div>
                                        </div>
                                        <div class='title_down'>
                                            <p> {$order_Name} <br> {$order_E_mail} <br> {$order_Number} </p>
                                        </div>
                                    </div>
                                </div>
                            </a>";
                        }
                    } else {
                        echo "<br><br><br><br><br><br>
                    <p style='text-align: center;'> No results </p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js" integrity="sha512-QABeEm/oYtKZVyaO8mQQjePTPplrV8qoT7PrwHDJCBLqZl5UmuPi3APEcWwtTNOiH24psax69XPQtEo5dAkGcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assect/js/main.js"></script>
    <script src="../assect/js/funtions.js"></script>
</body>

</html>