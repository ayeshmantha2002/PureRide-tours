<?php
include("../includes/connection.php");

// rates list
if (isset($_GET['cat'])) {
    $cat = mysqli_real_escape_string($connection, $_GET['cat']);
    $rate = "SELECT * FROM `rates` WHERE `Vehicle_type` = '{$cat}' AND `Status` = 1 ORDER BY `Rate_per_month` ASC";
    $rate_mobile = "SELECT * FROM `rates` WHERE `Vehicle_type` = '{$cat}' AND `Status` = 1 ORDER BY `Rate_per_month` ASC";
} else {
    $rate = "SELECT * FROM `rates` WHERE `Status` = 1 ORDER BY `Vehicle_type` ASC, `Rate_per_month` ASC";
    $rate_mobile = "SELECT * FROM `rates` WHERE `Status` = 1 ORDER BY `Vehicle_type` ASC, `Rate_per_month` ASC";
}
$rate_result = mysqli_query($connection, $rate);
$rate_mobile_result = mysqli_query($connection, $rate_mobile);

// rates filters
$rate_links = "SELECT `Vehicle` FROM `vehicle_type` ORDER BY `Vehicle` ASC";
$rate_links_result = mysqli_query($connection, $rate_links);

if (isset($_POST['wht-message'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['msg']);

    $whatsappUrl = "https://api.whatsapp.com/send?phone=94712916663&text=*Name:*%20$name%0A*Email:*%20$email%0A*Message:*%20$message";
    header("Location: $whatsappUrl");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rates</title>
    <link rel="stylesheet" href="/PureRide-tours/assect/css/style.css">
    <link rel="stylesheet" href="/PureRide-tours/assect/css/mobile.css">
    <link rel="icon" type="image/x-icon" href="/PureRide-tours/assect/img/favicon.png">
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
                    <h2> VEHICLE RATES </h2>
                </div>
                <div>
                    <p> <a href="/PureRide-tours/index">HOME</a> / <a href="/PureRide-tours/rates"> VEHICLE RATES </a> </p>
                    <hr>
                </div>
                <br>
                <section class="rate_list">
                    <table>
                        <thead>
                            <tr>
                                <th> IMAGE </th>
                                <th> VEHICLES </th>
                                <th> RATE PER MONTH </th>
                                <th> RATE PER WEEK </th>
                                <th style="width: 120px;"> EXCESS MILEAGE OVER 80 KM PER DAY </th>
                            </tr>
                        </thead>
                        <?php
                        if (mysqli_num_rows($rate_result) > 0) {
                            while ($fetch_rates = mysqli_fetch_assoc($rate_result)) {
                                $Image_name = $fetch_rates['Image_name'];
                                $Vehicle_name = $fetch_rates['Vehicle_name'];
                                $Rate_per_month = $fetch_rates['Rate_per_month'];
                                $Rate_per_week = $fetch_rates['Rate_per_week'];
                                $Over_KM = $fetch_rates['Over_KM'];

                                echo "
                            <tr>
                                <td><img class='lazy' data-original='/PureRide-tours/assect/img/rates/{$Image_name}' alt='{$Vehicle_name}'></td>
                                <td> {$Vehicle_name} </td>
                                <td> {$Rate_per_month}.00 </td>
                                <td> {$Rate_per_week}.00 </td>
                                <td> {$Over_KM}.00 </td>
                            </tr>
                            ";
                            }
                        } else {
                            echo "
                            <tr>
                                <td colspan='5'> No Results. </td>
                            </tr>
                            ";
                        }
                        ?>
                    </table>
                    <div class="cate">
                        <ul>
                            <?php
                            if (mysqli_num_rows($rate_links_result) > 0) {
                                while ($fetch_links = mysqli_fetch_assoc($rate_links_result)) {
                                    $type = $fetch_links['Vehicle'];

                                    echo " <li> <a href='/PureRide-tours/rates/{$type}'> {$type} </a> </li> ";
                                }
                            }
                            ?>
                            <li> <a href='/PureRide-tours/rates'> All Vehicles </a> </li>
                        </ul>
                    </div>
                </section>

                <div class="mobile_rates">
                    <?php
                    if (mysqli_num_rows($rate_mobile_result) > 0) {
                        while ($fetch_rate_mobile = mysqli_fetch_assoc($rate_mobile_result)) {
                            $Image_name_mobile = $fetch_rate_mobile['Image_name'];
                            $Vehicle_name_mobile = $fetch_rate_mobile['Vehicle_name'];
                            $Rate_per_month_mobile = $fetch_rate_mobile['Rate_per_month'];
                            $Rate_per_week_mobile = $fetch_rate_mobile['Rate_per_week'];
                            $Over_KM_mobile = $fetch_rate_mobile['Over_KM'];

                            echo "
                            <div>
                                <table>
                                    <tr>
                                        <th colspan='2'> <img class='lazy' data-original='/PureRide-tours/assect/img/rates/{$Image_name_mobile}' alt='car'> </th>
                                    </tr>
                                    <tr>
                                        <th style='width: 50%;'> VEHICLES : </th>
                                        <td> {$Vehicle_name_mobile} </td>
                                    </tr>
                                    <tr>
                                        <th style='width: 50%;'> RATE PER MONTH : </th>
                                        <td> {$Rate_per_month_mobile}.00 </td>
                                    </tr>
                                    <tr>
                                        <th style='width: 50%;'> RATE PER WEEK : </th>
                                        <td> {$Rate_per_week_mobile}.00 </td>
                                    </tr>
                                    <tr>
                                        <th style='width: 50%;'> EXCESS MILEAGE OVER 80 KM PER DAY : </th>
                                        <td> {$Over_KM_mobile}.00 </td>
                                    </tr>
                                </table>
                            </div>
                            ";
                        }
                    } else {
                        echo "
                            <div>
                                <table>
                                    <tr>
                                        <th colspan='2'> No Results. </th>
                                    </tr>
                                </table>
                            </div>
                            ";
                    }
                    ?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js" integrity="sha512-jNDtFf7qgU0eH/+Z42FG4fw3w7DM/9zbgNPe3wfJlCylVDTT3IgKW5r92Vy9IHa6U50vyMz5gRByIu4YIXFtaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function() {
            $("img.lazy").lazyload();
        });
    </script>
    <script src="/PureRide-tours/assect/js/main.js"></script>
</body>

</html>