<?php
include("../includes/connection.php");

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
    <title>VEHICLE FLEET</title>
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
                    <h2> VEHICLE FLEET </h2>
                </div>
                <div>
                    <p> <a href="/PureRide-tours/index">HOME</a> / <a href="vehicle-fleet"> VEHICLE FLEET </a> </p>
                    <hr>
                </div>
            </div>
            <div class="down_fleet">
                <div class="details fleet">
                    <p style="text-align: justify;">
                        We offer a wide range of Sri Lanka car hire facilities ranging from economy to luxury. The fleet consists of cars, sports utility, and 4WD vehicles, vans and buses. There is also a range of classic and vintage cars available for weddings, television, cinema, commercials and other special occasions.
                    </p>
                    <br>
                    <div class="boxes">
                        <?php
                        $fleet = "SELECT * FROM `fleet` WHERE `Status` = 1";
                        $fleet_result = mysqli_query($connection, $fleet);
                        if (mysqli_num_rows($fleet_result) > 0) {
                            while ($fetch_fleet = mysqli_fetch_assoc($fleet_result)) {
                                $vehicle_Img = $fetch_fleet['Img'];
                                $vehicle_name = $fetch_fleet['Vehicle_name'];
                                $vehicle_Description = $fetch_fleet['Description'];

                                echo "
                                    <div class='border'>
                                        <img class='lazy' data-original='/PureRide-tours/assect/img/{$vehicle_Img}' alt='car'>
                                        <br>
                                        <div class='border-details'>
                                            <div>
                                                <h3> {$vehicle_name} </h3>
                                                <p> {$vehicle_Description} </p>
                                            </div>
                                        <div>
                                            <a href='/PureRide-tours/rates/{$vehicle_name}'> FIND OUT MORE </a>
                                        </div>
                                    </div>
                                </div>
                                ";
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="contact_form links">
                    <ul>
                        <?php
                        $fleet = "SELECT `Vehicle_name` FROM `fleet` WHERE `Status` = 1";
                        $fleet_result = mysqli_query($connection, $fleet);
                        if (mysqli_num_rows($fleet_result) > 0) {
                            while ($fetch_fleet = mysqli_fetch_assoc($fleet_result)) {
                                $vehicle_name = $fetch_fleet['Vehicle_name'];
                                echo " <li> <a href='/PureRide-tours/rates/{$vehicle_name}'> {$vehicle_name} </a> </li> ";
                            }
                        }
                        ?>
                    </ul>
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