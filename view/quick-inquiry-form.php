<?php
include("../includes/connection.php");
if (isset($_POST['submit'])) {
    $dr_mod = $_POST['dr_mod'];
    $location = $_POST['location'];
    $picup_date = $_POST['picup_date'];
    $picup_time = $_POST['picup_time'];
    $return_date = $_POST['return_date'];
    $vehicle = $_POST['vehicle'];
    $hide_val = "hidden";
    $hide_val2 = "";
} else {
    $hide_val = "";
    $hide_val2 = "hidden";
}


if (isset($_POST['order'])) {
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $number = mysqli_real_escape_string($connection, $_POST['number']);
    $pickup = mysqli_real_escape_string($connection, $_POST['pickup']);
    $dropoff = mysqli_real_escape_string($connection, $_POST['dropoff']);
    $service = mysqli_real_escape_string($connection, $_POST['service']);
    $vehicle = mysqli_real_escape_string($connection, $_POST['vehicle']);
    $passengers = mysqli_real_escape_string($connection, $_POST['passengers']);
    $pickup_date = mysqli_real_escape_string($connection, $_POST['pickup_date']);
    $pickup_time = mysqli_real_escape_string($connection, $_POST['pickup_time']);
    $return_date = mysqli_real_escape_string($connection, $_POST['return_date']);
    $drop_off_time = mysqli_real_escape_string($connection, $_POST['drop_off_time']);
    $message = mysqli_real_escape_string($connection, $_POST['message']);

    $insert_order = "INSERT INTO `orders` (`Title`, `Name`, `E-mail`, `Number`, `Pickup_Location`, `Dropoff_Location`, `Service_Type`, `Vehicle_Type`, `Passengers`, `Pickup_Date`, `Pickup_Time`, `Return_Date`, `Drop_Off_Time`, `Message`, `Status`) VALUES ('{$title}', '{$name}', '{$email}',  {$number}, '{$pickup}', '{$dropoff}', '{$service}', '{$vehicle}', {$passengers}, '{$pickup_date}', '{$pickup_time}', '{$return_date}', '{$drop_off_time}', '{$message}', 1)";
    $insert_order_result = mysqli_query($connection, $insert_order);

    $to =   "pureridet@gmail.com";
    $email_subject  =   "Order from PureRide tours";
    $email_body =   "<b>From :</b> {$title} {$name} <br>";
    $email_body .=   "<b>Mobile number :</b> {$number} <br>";
    $email_body .=   "<b>E-mail :</b> {$email} <br>";
    $email_body .=   "<b>Pickup :</b> {$pickup} <br>";
    $email_body .=   "<b>Dropoff :</b> {$dropoff} <br>";
    $email_body .=   "<b>Service :</b> {$service} <br>";
    $email_body .=   "<b>Vehicle :</b> {$vehicle} <br>";
    $email_body .=   "<b>Passengers :</b> {$passengers} <br>";
    $email_body .=   "<b>Pickup date :</b> {$pickup_date} <br>";
    $email_body .=   "<b>Pickup time :</b> {$pickup_time} <br>";
    $email_body .=   "<b>Return_date :</b> {$return_date} <br>";
    $email_body .=   "<b>Drop off time :</b> {$drop_off_time} <br>";
    $email_body .=   "<b>Message :</b> {$message} <br>" . nl2br(strip_tags($message));

    $header =   "From : {$email}\r\nContent-type: text/html;";

    $status = mail($to, $email_subject, $email_body, $header);
    $date = date("M d");
    if ($status) {
        $insert_message = "INSERT INTO `messages` (`Icon`, `Name`, `E-mail`, `Number`, `Subject`, `Message`, `Date`, `Status`) VALUES ('fa-solid fa-car-side', '{$title} {$name}', '{$email}', {$number}, 'Order', '{$email_body}', '{$date}', 3)";
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
    <title> Quick-Inquiry-Form </title>
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
        <br>
        <section class="aling">
            <h2> QUICK INQUIRY FORM </h2>
            <br>
            <div class="orderMap">
                <form method="post" id="ff" <?= $hide_val2; ?>>
                    <div class="form_aling">
                        <p>
                            <label for="title">Title *</label>
                            <select name="title" id="title">
                                <option value="MR.">MR.</option>
                                <option value="REV.">REV.</option>
                                <option value="DR.">DR.</option>
                                <option value="MRS.">MRS.</option>
                                <option value="MISS.">MISS.</option>
                            </select>
                        </p>
                        <p>
                            <label for="name">Name *</label>
                            <input type="text" name="name" id="name" placeholder="Your name" required>
                        </p>
                    </div>
                    <br>
                    <p>
                        <label for="email">E-mail *</label>
                        <input type="email" name="email" id="email" placeholder="Your Email Address" required>
                    </p>
                    <br>
                    <p>
                        <label for="number">Contact Number *</label>
                        <input type="number" name="number" id="number" placeholder="Your Contact Number" required>
                    </p>
                    <br>
                    <p>
                        <label for="pickup">Pickup Location *</label>
                        <input type="text" name="pickup" id="pickup" placeholder="Pickup Location" value="<?= $location; ?>" required>
                    </p>
                    <br>
                    <p>
                        <label for="dropoff">Dropoff Location *</label>
                        <input type="text" name="dropoff" id="dropoff" placeholder="Dropoff Location" required>
                    </p>
                    <br>
                    <p>
                        <label for="service">Service Type *</label>
                        <input type="text" name="service" id="service" value="<?= $dr_mod; ?>" required readonly>
                    </p>
                    <br>
                    <p>
                        <label for="vehicle">Vehicle Type *</label>
                        <input type="text" name="vehicle" id="vehicle" value="<?= $vehicle; ?>" required readonly>
                    </p>
                    <br>
                    <p>
                        <label for="passengers">Passengers *</label>
                        <input type="number" name="passengers" id="passengers" placeholder="Passengers" min="1" required>
                    </p>
                    <br>
                    <div style="display: grid;
                                grid-template-columns: 1fr 1fr;
                                gap: 10px;">
                        <p>
                            <label for="pickup_date">Pickup Date *</label>
                            <input type="text" name="pickup_date" id="pickup_date" value="<?= $picup_date; ?>" required readonly>
                        </p>
                        <p>
                            <label for="pickup_time">Pickup Time *</label>
                            <input type="text" name="pickup_time" id="pickup_time" value="<?= $picup_time; ?>" required readonly>
                        </p>
                    </div>
                    <br>
                    <div style="display: grid;
                                grid-template-columns: 1fr 1fr;
                                gap: 10px;">
                        <p>
                            <label for="return_date">Return Date *</label>
                            <input type="text" name="return_date" id="return_date" value="<?= $return_date; ?>" required readonly>
                        </p>
                        <p>
                            <label for="drop_off_time">Drop Off Time *</label>
                            <input type="time" name="drop_off_time" id="drop_off_time" required>
                        </p>
                    </div>
                    <br>
                    <p>
                        <label for="message">Message</label>
                        <textarea name="message" id="message"></textarea>
                    </p>
                    <br>
                    <p>
                        <input type="submit" value="SUBMIT" name="order">
                    </p>
                </form>

                <form method="post" id="ff" <?= $hide_val; ?>>
                    <div class="form_aling">
                        <p>
                            <label for="title">Title *</label>
                            <select name="title" id="title">
                                <option value="MR.">MR.</option>
                                <option value="REV.">REV.</option>
                                <option value="DR.">DR.</option>
                                <option value="MRS.">MRS.</option>
                                <option value="MISS.">MISS.</option>
                            </select>
                        </p>
                        <p>
                            <label for="name">Name *</label>
                            <input type="text" name="name" id="name" placeholder="Your name" required>
                        </p>
                    </div>
                    <br>
                    <p>
                        <label for="email">E-mail *</label>
                        <input type="email" name="email" id="email" placeholder="Your Email Address" required>
                    </p>
                    <br>
                    <p>
                        <label for="number">Contact Number *</label>
                        <input type="number" name="number" id="number" placeholder="Your Contact Number" required>
                    </p>
                    <br>
                    <p>
                        <label for="pickup">Pickup Location *</label>
                        <input type="text" name="pickup" id="pickup" placeholder="Pickup Location" required>
                    </p>
                    <br>
                    <p>
                        <label for="dropoff">Dropoff Location *</label>
                        <input type="text" name="dropoff" id="dropoff" placeholder="Dropoff Location" required>
                    </p>
                    <br>
                    <p>
                        <label for="service">Service Type *</label>
                        <select name="service" id="service">
                            <option value="1"> sameera </option>
                        </select>
                    </p>
                    <br>
                    <p>
                        <label for="vehicle">Vehicle Type *</label>
                        <select name="vehicle" id="vehicle">
                            <option value="1"> sameera </option>
                        </select>
                    </p>
                    <br>
                    <p>
                        <label for="passengers">Passengers *</label>
                        <input type="number" name="passengers" id="passengers" placeholder="Passengers" min="1" required>
                    </p>
                    <br>
                    <div style="display: grid;
                                grid-template-columns: 1fr 1fr;
                                gap: 10px;">
                        <p>
                            <label for="pickup_date">Pickup Date *</label>
                            <input type="date" name="pickup_date" id="pickup_date" min="<?php echo date("Y-m-d"); ?>" required>
                        </p>
                        <p>
                            <label for="pickup_time">Pickup Time *</label>
                            <input type="time" name="pickup_time" id="pickup_time" required>
                        </p>
                    </div>
                    <br>
                    <div style="display: grid;
                                grid-template-columns: 1fr 1fr;
                                gap: 10px;">
                        <p>
                            <label for="return_date">Return Date *</label>
                            <input type="date" name="return_date" id="return_date" min="<?php echo date("Y-m-d"); ?>" required>
                        </p>
                        <p>
                            <label for="drop_off_time">Drop Off Time *</label>
                            <input type="time" name="drop_off_time" id="drop_off_time" required>
                        </p>
                    </div>
                    <br>
                    <p>
                        <label for="message">Message</label>
                        <textarea name="message" id="message"></textarea>
                    </p>
                    <br>
                    <p>
                        <input type="submit" value="SUBMIT" name="order">
                    </p>
                </form>
                <div class="map">
                    <div class="details">
                        <h5> Address : </h5>
                        <p>
                            PureRide tours (Pvt.) Ltd.
                            <br>
                            No 58 Pamankada Road,
                            <br>
                            Colombo 06,
                            <br>
                            Sri Lanka.
                        </p>
                        <br>
                        <h5> Phone : </h5>
                        <p>
                            +94 71 291 6663
                            <br><br>
                            Fax: +94 71 291 6663
                        </p>
                        <br>
                        <h5> E-mail: </h5>
                        <p>
                            <a href="#"> info@pureridetours.lk </a>
                            <br>
                            <a href="#"> www.pureridetours.lk </a>
                        </p>
                    </div>
                    <br>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d2038.3746099384011!2d80.98645099448325!3d6.9273576862353154!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2s!5e0!3m2!1sen!2slk!4v1713763363346!5m2!1sen!2slk" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <br><br>
        </section>

        <?php
        // footer 
        include("../includes/footer.php");
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js" integrity="sha512-QABeEm/oYtKZVyaO8mQQjePTPplrV8qoT7PrwHDJCBLqZl5UmuPi3APEcWwtTNOiH24psax69XPQtEo5dAkGcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="assect/js/main.js"></script>
</body>

</html>