<?php
session_start();
include("../includes/connection.php");
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

// notifications update
if (isset($_GET['id'])) {
    $notiUpdateID = mysqli_real_escape_string($connection, $_GET['id']);
    $notification_read = "UPDATE `messages` SET `Status` = 2 WHERE `ID` = {$notiUpdateID}";
    $notification_read_result = mysqli_query($connection, $notification_read);

    // details 
    $noti_details = "SELECT * FROM `messages` WHERE `ID` = {$notiUpdateID}";
    $noti_details_result = mysqli_query($connection, $noti_details);
}

// send email
if (isset($_POST['rp_submit'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $email = "pureridet@gmail.com";
    $_to_email = mysqli_real_escape_string($connection, $_POST['email']);
    $_to_msg = mysqli_real_escape_string($connection, $_POST['msg']);

    $to = $_to_email;
    $email_subject = "Message from PureRide tours";
    $email_body = "<b>Message :</b> {$_to_msg} <br>" . nl2br(strip_tags($_to_msg));

    $headers = "From: {$email}\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $status = mail($to, $email_subject, $email_body, $headers);
    var_dump($status); // Debugging line

    if ($status) {
        header('location:admin.php?mail=successfully_completed');
    } else {
        $errors[] = "E-mail is not sent.";
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
    <title> View Notification </title>
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
                    <a href="notifications.php"> <i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i> </a>
                </div>
                <h2 style="text-align: center;"> Notification </h2>
                <div id="notification">
                    <?php
                    if (mysqli_num_rows($noti_details_result) > 0) {
                        $fetch_noti_details = mysqli_fetch_assoc($noti_details_result);
                        $ID = $fetch_noti_details['ID'];
                        $Order_ID = $fetch_noti_details['Order_ID'];
                        $Name = $fetch_noti_details['Name'];
                        $E_mail = $fetch_noti_details['E-mail'];
                        $Number = $fetch_noti_details['Number'];
                        $Subject = $fetch_noti_details['Subject'];
                        $Message = $fetch_noti_details['Message'];
                        $Status = $fetch_noti_details['Status'];

                        if ($Subject == "Order") {
                            header("location: order-process.php?orderID={$Order_ID}");
                        }

                        echo "
                            <div class='order_details'>
                                <p> <b> Name : </b> {$Name} </p>
                                <p> <b> E-mail : </b> {$E_mail} </p>
                                <p> <b> Mobile Number : </b> 0{$Number} </p>
                                <p> <b> Subject : </b> {$Subject} </p>
                                <p> <b> Message : </b> </p>
                                <p class='justify'> {$Message} </p>
                                <br>
                            </div>
                            ";
                    }
                    ?>
                    <div class="reply">
                        <p> <a href="#" id="reply"> Reply </a> </p>
                    </div>
                </div>
            </div>
        </div>

        <section class="reply_section">
            <form method="post">
                <div class="close">
                    <a href="#"> <i class="fa-solid fa-circle-xmark xxx" style="color: #ff0000;"></i> </a>
                </div>
                <br><br>
                <h3 style="text-align: center;"> Reply To <?= $Name; ?> </h3>
                <br>
                <p>
                    <label> To : </label>
                    <input type="email" value="<?= $E_mail; ?>" name="email" required>
                </p>
                <br>
                <p>
                    <label> Message : </label>
                    <textarea name="msg" placeholder="Message" required></textarea>
                </p>
                <br>
                <p>
                    <input type="submit" name="rp_submit">
                </p>
            </form>
        </section>
    </section>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js" integrity="sha512-QABeEm/oYtKZVyaO8mQQjePTPplrV8qoT7PrwHDJCBLqZl5UmuPi3APEcWwtTNOiH24psax69XPQtEo5dAkGcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assect/js/main.js"></script>
    <script src="../assect/js/funtions.js"></script>
</body>

</html>