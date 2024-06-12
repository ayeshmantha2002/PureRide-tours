<?php

include("../includes/connection.php");

$fullName     =  "";
$email    =  "";
$subject      =  "";
$number      =  "";
$Message      =  "";
$errors = array();

if (isset($_POST['submit'])) {
    $date = date("M d");
    $gen     =  mysqli_real_escape_string($connection, $_POST['gen']);
    $fullName     =  mysqli_real_escape_string($connection, $_POST['fullName']);
    $email    =  mysqli_real_escape_string($connection, $_POST['email']);
    $subject      =  mysqli_real_escape_string($connection, $_POST['subject']);
    $number      =  mysqli_real_escape_string($connection, $_POST['number']);
    $Message      =  mysqli_real_escape_string($connection, $_POST['Message']);

    $name = $gen . " " . $fullName;

    $to =   "pureridet@gmail.com";
    $email_subject  =   "Message from PureRide tours";
    $email_body =   "Message from contact us page of the website.";
    $email_body .=   "<b>From :</b> {$fullName} <br>";
    $email_body .=   "<b>Mobile number :</b> {$number} <br>";
    $email_body .=   "<b>Subject :</b> {$subject} <br>";
    $email_body .=   "<b>From :</b> {$Message} <br>" . nl2br(strip_tags($Message));

    $header =   "From : {$email}\r\nContent-type: text/html;";

    $status = mail($to, $email_subject, $email_body, $header);
    if ($status) {
        $insert_message = "INSERT INTO `messages` (`Icon`, `Name`, `E-mail`, `Number`, `Subject`, `Message`, `Date`, `Status`) VALUES ('fa-solid fa-envelope-open-text', '{$name}', '{$email}', {$number}, '{$subject}', '{$Message}', '{$date}', 3)";
        $insert_message_result = mysqli_query($connection, $insert_message);
        header('location:index.php?mail=successfully_completed');
    } else {
        $errors[] = "E-mail is not send.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Contact us </title>
    <link rel="stylesheet" href="assect/css/slider.css">
    <link rel="stylesheet" href="assect/css/style.css">
    <link rel="stylesheet" href="assect/css/mobile.css">
    <link rel="icon" type="image/x-icon" href="assect/img/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="content">
        <!-- navigation bar -->
        <?php
        include("../includes/navbar.php");
        ?>

        <!-- contact form  -->
        <section class="aling">
            <div class="up">
                <div>
                    <h2> CONTACT PURERIDE TOURS </h2>
                </div>
                <div>
                    <p> <a href="index">HOME</a> / <a href="contact"> CONTACT US </a> </p>
                    <hr>
                </div>
            </div>
            <div class="down">
                <div class="details">
                    <h5> Address : </h5>
                    <p>
                        PureRide tours (Pvt.) Ltd.
                        <br>
                        275/32, Monaragala road,
                        <br>
                        Badalkumbura,
                        <br>
                        Sri Lanka.
                    </p>
                    <br>
                    <h5> Phone : </h5>
                    <p>
                        +94 704902790
                        <br><br>
                        Fax: +94 704902790
                    </p>
                    <br>
                    <h5> E-mail: </h5>
                    <p>
                        <a href="#"> info@pureridetours.lk </a>
                        <br>
                        <a href="#"> www.pureridetours.lk </a>
                    </p>
                    <br>
                    <h5>
                        AIRPORT PICKUP/ DROP OFF POINT <br> (OPEN 24/7 ON DEMAND)
                    </h5>
                    <br>
                    <p>
                        786/1 (Damro Furniture Building)
                        <br>
                        Colombo Road
                        <br>
                        Airport Junction
                        <br>
                        Seeduwa
                    </p>
                </div>
                <div class="contact_form">
                    <p>
                        When wanting to reserve car rentals in Sri Lanka through PureRide Tours (Pvt) Ltd. do take note of the contact details mentioned below.
                        <hr>
                    </p>
                    <br>
                    <form method="post">
                        <p>
                            <select name="gen" required>
                                <option value="Mr.">Mr.</option>
                                <option value="Rev.">Rev.</option>
                                <option value="Dr.">Dr.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Miss.">Miss.</option>
                            </select>
                            <input type="text" name="fullName" placeholder="Your Name" required value="<?= $fullName; ?>">
                        </p>
                        <p>
                            <input type="email" name="email" placeholder="Your E-mail" required value="<?= $email; ?>">
                        </p>
                        <p>
                            <input type="number" name="number" placeholder="Your Telephone Number" required value="<?= $number; ?>">
                        </p>
                        <p>
                            <input type="text" name="subject" placeholder="Subject" required value="<?= $subject; ?>">
                        </p>
                        <textarea name="Message" placeholder="Message" required></textarea value="<?= $Message; ?>">
                        <p>
                            <input type="submit" value="SEND" name="submit">
                        </p>
                        <br>
                        <p>
                            <li>
                                Direct Contact : <br>
                                <button> <i class="fa-brands fa-whatsapp fa-beat"> </i> WhatsApp</button>
                            </li>
                        </p>
                    </form>
                </div>
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d2038.3746099384011!2d80.98645099448325!3d6.9273576862353154!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2s!5e0!3m2!1sen!2slk!4v1713763363346!5m2!1sen!2slk" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>
        <br><br>
        <!-- footer  -->
        <?php
        include("../includes/footer.php");
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js" integrity="sha512-QABeEm/oYtKZVyaO8mQQjePTPplrV8qoT7PrwHDJCBLqZl5UmuPi3APEcWwtTNOiH24psax69XPQtEo5dAkGcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="assect/js/main.js"></script>
</body>

</html>