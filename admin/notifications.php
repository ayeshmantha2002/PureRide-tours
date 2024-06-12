<?php
session_start();
include("../includes/connection.php");
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

// notifications 
$notification = "SELECT * FROM `messages` WHERE `Status` = 3 OR `Status` = 2 ORDER BY `ID` DESC";
$notification_result = mysqli_query($connection, $notification);

// notifications update
$notifiUP = "UPDATE `admins` SET `Notification` = 0 WHERE `ID` = {$_SESSION['ID']}";
$notifiUP_result = mysqli_query($connection, $notifiUP);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Notification </title>
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
                    <a href="admin.php"> <i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i> </a>
                </div>
                <h2 style="text-align: center;"> Notifications </h2>
                <div id="notification">
                    <?php
                    if (mysqli_num_rows($notification_result) > 0) {
                        while ($fetch_notifications = mysqli_fetch_assoc($notification_result)) {
                            $notiID = $fetch_notifications['ID'];
                            $notiIcon = $fetch_notifications['Icon'];
                            $notiSubject = $fetch_notifications['Subject'];
                            $notiDate = $fetch_notifications['Date'];
                            $notiMessage = $fetch_notifications['Message'];
                            $notiStatus = $fetch_notifications['Status'];
                            if ($notiStatus == 3) {
                                $color = "#000";
                            } elseif ($notiStatus == 2) {
                                $color = "gray";
                            }
                            echo "
                                <a href='view-notification.php?id={$notiID}'>
                                    <div class='msg'>
                                        <div class='img'>
                                            <i class='{$notiIcon}'></i>
                                        </div>
                                        <div class='title'>
                                            <div class='title_up'>
                                                <div class='sub'>
                                                    <h4 style='color: {$color};'> {$notiSubject} </h4>
                                                </div>
                                                <div>
                                                    <p style='font-size: 12px;'> {$notiDate} </p>
                                                </div>
                                            </div>
                                            <div class='title_down'>
                                                <p> {$notiMessage} </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            ";
                        }
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