<?php
include("includes/connection.php");

$today = date("M d");

if (isset($_POST['wht-message'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['msg']);

    $whatsappUrl = "https://api.whatsapp.com/send?phone=94712916663&text=*Name:*%20$name%0A*Email:*%20$email%0A*Message:*%20$message";
    header("Location: $whatsappUrl");
    exit();
}

// banner
$banner_list = "SELECT * FROM `banner` WHERE `Status` = 1";
$banner_list_result = mysqli_query($connection, $banner_list);

// trip card
$trip = "SELECT * FROM `tours` WHERE `Status` = 1";
$trip_result = mysqli_query($connection, $trip);

if (isset($_GET['traval'])) {
    $tour_id = mysqli_real_escape_string($connection, $_GET['traval']);
    $display = "flex";
    $tour_details = "SELECT * FROM `tours` WHERE `ID` = {$tour_id}";
    $tour_details_result = mysqli_query($connection, $tour_details);
    if (mysqli_num_rows($tour_details_result) == 1) {
        $fetch_tour = mysqli_fetch_assoc($tour_details_result);
        $trip_ID = $fetch_tour['ID'];
        $trip_Pic = $fetch_tour['Pic'];
        $trip_P_From = $fetch_tour['P_From'];
        $trip_P_To = $fetch_tour['P_To'];
        $trip_Distance = $fetch_tour['Distance'];
        $trip_Duration = $fetch_tour['Duration'];
        $trip_Description_one = $fetch_tour['Description_one'];
        $trip_Description_tow = $fetch_tour['Description_tow'];
        $trip_Description_three = $fetch_tour['Description_three'];
        $trip_Price = $fetch_tour['Price'];
    }
} else {
    $display = "none";
}

if (isset($_POST['booking'])) {
    $insert_trip_id = mysqli_real_escape_string($connection, $_POST['id']);
    $insert_trip_trip_name = mysqli_real_escape_string($connection, $_POST['trip_name']);
    $insert_trip_Name = mysqli_real_escape_string($connection, $_POST['Name']);
    $insert_trip_email = mysqli_real_escape_string($connection, $_POST['email']);
    $insert_trip_Number = mysqli_real_escape_string($connection, $_POST['Number']);
    $insert_trip_p_date = mysqli_real_escape_string($connection, $_POST['p_date']);

    $insert_trip = "INSERT INTO `tours_orders` (`Name`, `E-mail`, `Number`, `Picup_date`, `Tour_ID`, `Tour_Name`, `Status`, `Order_date`) VALUES ('{$insert_trip_Name}', '{$insert_trip_email}', {$insert_trip_Number}, '{$insert_trip_p_date}', {$insert_trip_id}, '{$insert_trip_trip_name}', 3, '{$today}')";
    $insert_trip_result = mysqli_query($connection, $insert_trip);
    if ($insert_trip_result) {
        header("location: /PureRide-tours/index.php?order=done");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PureRide tours </title>
    <link rel="stylesheet" href="/PureRide-tours/assect/css/slider.css">
    <link rel="stylesheet" href="/PureRide-tours/assect/css/style.css">
    <link rel="stylesheet" href="/PureRide-tours/assect/css/mobile.css">
    <link rel="icon" type="image/x-icon" href="/PureRide-tours/assect/img/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="content">
        <!-- navigation bar -->
        <?php
        include("includes/navbar.php");
        ?>

        <!-- slide show -->
        <div id="carouselExampleIndicators" class="carousel slide">
            <?php
            if (mysqli_num_rows($banner_list_result) == 1) {
                $fetch_banner = mysqli_fetch_assoc($banner_list_result);
                $desctop = $fetch_banner['Image_name'];
                $mobile = $fetch_banner['Mobile_image'];
                $Hedding = $fetch_banner['Hedding'];
                $Description = $fetch_banner['Description'];

                echo "
                    <ol class='carousel-indicators'>
                        <li data-target='#carouselExampleIndicators' data-slide-to='0' class='active'></li>
                    </ol>
                    <div class='carousel-inner'>
                        <div class='carousel-item active'>
                            <img class='small' src='/PureRide-tours/assect/img/{$desctop}' alt='cover 1 image'>
                            <img class='small-off' src='/PureRide-tours/assect/img/{$mobile}' alt='cover 1 image'>
                            <div class='carousel-caption d-none d-md-block'>
                                <h5>{$Hedding}</h5>
                                <p> {$Description} </p>
                            </div>
                        </div>
                    </div>
                ";
            } elseif (mysqli_num_rows($banner_list_result) == 2) {
                $fetch_banner1 = mysqli_fetch_assoc($banner_list_result);
                $desctop = $fetch_banner1['Image_name'];
                $mobile = $fetch_banner1['Mobile_image'];
                $Hedding = $fetch_banner1['Hedding'];
                $Description = $fetch_banner1['Description'];

                $fetch_banner2 = mysqli_fetch_assoc($banner_list_result);
                $desctop2 = $fetch_banner2['Image_name'];
                $mobile2 = $fetch_banner2['Mobile_image'];
                $Hedding2 = $fetch_banner2['Hedding'];
                $Description2 = $fetch_banner2['Description'];
                echo "
                    <ol class='carousel-indicators'>
                        <li data-target='#carouselExampleIndicators' data-slide-to='0' class='active'></li>
                        <li data-target='#carouselExampleIndicators' data-slide-to='1'></li>
                    </ol>
                    <div class='carousel-inner'>
                        <div class='carousel-item active'>
                            <img class='small' src='/PureRide-tours/assect/img/{$desctop}' alt='cover 1 image'>
                            <img class='small-off' src='/PureRide-tours/assect/img/{$mobile}' alt='cover 1 image'>
                            <div class='carousel-caption d-none d-md-block'>
                                <h5> {$Hedding} </h5>
                                <p> {$Description} </p>
                            </div>
                        </div>
                        <div class='carousel-item'>
                            <img class='small' src='/PureRide-tours/assect/img/{$desctop2}' alt='cover 1 image'>
                            <img class='small-off' src='/PureRide-tours/assect/img/{$mobile2}' alt='cover 1 image'>
                            <div class='carousel-caption d-none d-md-block'>
                                <h5> {$Hedding2} </h5>
                                <p> {$Description2} </p>
                            </div>
                        </div>
                    </div>
                ";
            } elseif (mysqli_num_rows($banner_list_result) == 3) {
                $fetch_banner1 = mysqli_fetch_assoc($banner_list_result);
                $desctop = $fetch_banner1['Image_name'];
                $mobile = $fetch_banner1['Mobile_image'];
                $Hedding = $fetch_banner1['Hedding'];
                $Description = $fetch_banner1['Description'];

                $fetch_banner2 = mysqli_fetch_assoc($banner_list_result);
                $desctop2 = $fetch_banner2['Image_name'];
                $mobile2 = $fetch_banner2['Mobile_image'];
                $Hedding2 = $fetch_banner2['Hedding'];
                $Description2 = $fetch_banner2['Description'];

                $fetch_banner3 = mysqli_fetch_assoc($banner_list_result);
                $desctop3 = $fetch_banner3['Image_name'];
                $mobile3 = $fetch_banner3['Mobile_image'];
                $Hedding3 = $fetch_banner3['Hedding'];
                $Description3 = $fetch_banner3['Description'];

                echo "
                    <ol class='carousel-indicators'>
                        <li data-target='#carouselExampleIndicators' data-slide-to='0' class='active'></li>
                        <li data-target='#carouselExampleIndicators' data-slide-to='1'></li>
                        <li data-target='#carouselExampleIndicators' data-slide-to='3'></li>
                    </ol>
                    <div class='carousel-inner'>
                        <div class='carousel-item active'>
                            <img class='small' src='/PureRide-tours/assect/img/{$desctop}' alt='cover 1 image'>
                            <img class='small-off' src='/PureRide-tours/assect/img/{$mobile}' alt='cover 1 image'>
                            <div class='carousel-caption d-none d-md-block'>
                                <h5> {$Hedding} </h5>
                                <p> {$Description} </p>
                            </div>
                        </div>
                        <div class='carousel-item'>
                            <img class='small' src='/PureRide-tours/assect/img/{$desctop2}' alt='cover 1 image'>
                            <img class='small-off' src='/PureRide-tours/assect/img/{$mobile2}' alt='cover 1 image'>
                            <div class='carousel-caption d-none d-md-block'>
                                <h5> {$Hedding2} </h5>
                                <p> {$Description2} </p>
                            </div>
                        </div>
                        <div class='carousel-item'>
                            <img class='small' src='/PureRide-tours/assect/img/{$desctop3}' alt='cover 1 image'>
                            <img class='small-off' src='/PureRide-tours/assect/img/{$mobile3}' alt='cover 1 image'>
                            <div class='carousel-caption d-none d-md-block'>
                                <h5> {$Hedding3} </h5>
                                <p> {$Description3} </p>
                            </div>
                        </div>
                    </div>
                ";
            } else {
                echo "
                    <ol class='carousel-indicators'>
                        <li data-target='#carouselExampleIndicators' data-slide-to='0' class='active'></li>
                        <li data-target='#carouselExampleIndicators' data-slide-to='1'></li>
                    </ol>
                    <div class='carousel-inner'>
                        <div class='carousel-item active'>
                            <img class='small' src='https://placehold.co/800x300' alt='cover 1 image'>
                            <img class='small-off' src='https://placehold.co/400x300' alt='cover 1 image'>
                            <div class='carousel-caption d-none d-md-block'>
                                <h5>Lorem ipsum dolor sit.</h5>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque, amet.</p>
                            </div>
                        </div>
                        <div class='carousel-item'>
                            <img class='small' src='https://placehold.co/800x300?text=PureRide_Tours' alt='cover 1 image'>
                            <img class='small-off' src='https://placehold.co/400x300?text=PureRide_Tours' alt='cover 1 image'>
                            <div class='carousel-caption d-none d-md-block'>
                                <h5>Lorem ipsum dolor sit.</h5>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque, amet.</p>
                            </div>
                        </div>
                    </div>
                ";
            }
            ?>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <!-- About -->
        <div class="about" id="about">
            <div class="about_content">
                <h2> WELCOME TO <br> PureRide tours RENT-A-CAR </h2>
                <p> <i>PREMIER CAR RENTAL SERVICES IN SRI LANKA</i> </p>
                <br>
                <p>
                    At PureRide Tours, we're your trusted source for safe and reliable rides. We understand that getting where you need to be on time and comfortably is important. That's why we offer a clean, well-maintained fleet of vehicles and professional, courteous drivers. Whether you're heading to the airport, a business meeting, a night out, or a Holiday Trip, you can count on us to get you there smoothly and efficiently. We ride All over Sri Lanka.
                </p>
                <br><br>
                <p class="link_center"> <a href="#">More Details</a> </p>
            </div>
            <div class="about_img">
                <img class="lazy" data-original="/PureRide-tours/assect/img/car.png" alt="car">
            </div>
            <div class="aditionol">
                <div>
                    <div class="box">
                        <h2>24/7</h2>
                        <h4>PICKUP/DROP</h4>
                        <p>(Advanced Reservations)</p>
                    </div>
                    <div class="box">
                        <h2>GPS</h2>
                        <h4>SAT NAV</h4>
                        <p>(Available on Request)</p>
                    </div>
                    <div class="box">
                        <h2>MRIA</h2>
                        <h4>AIRPORT LOCATION</h4>
                        <p>(MRIA Hambantota)</p>
                    </div>
                    <p> <a href="rates">View Rates</a> </p>
                </div>
            </div>
        </div>

        <!-- Vehicle leeft  -->
        <div class="vehicle_feeft" id="vehicle_feeft">
            <div>
                <h2> VEHICLE FLEET </h2>
                <p> We offer a wide range of options from economy to luxury. The fleet consists of cars, sports utility, and 4WD vehicles, vans and buses. </p>
                <br>
                <a href="vehicle-fleet">More Details</a>
            </div>
        </div>
        <div class="leeft">
            <div class="double">
                <div class="leef_box">
                    <img class="lazy" data-original="/PureRide-tours/assect/img/car.jpg" alt="car">
                    <div class="cat">
                        <h2> CARS </h2>
                        <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores, odit? </p>
                        <br>
                        <a href="/PureRide-tours/rates/car"> More Details </a>
                    </div>
                </div>
                <div class="leef_box">
                    <img class="lazy" data-original="/PureRide-tours/assect/img/van.jpg" alt="car">
                    <div class="cat">
                        <h2> VANS </h2>
                        <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores, odit? </p>
                        <br>
                        <a href="/PureRide-tours/rates/van"> More Details </a>
                    </div>
                </div>
            </div>
            <div class="double">
                <div class="leef_box">
                    <img class="lazy" data-original="/PureRide-tours/assect/img/bus.jpg" alt="car">
                    <div class="cat">
                        <h2> BUSSES </h2>
                        <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores, odit? </p>
                        <br>
                        <a href="/PureRide-tours/rates/Bus"> More Details </a>
                    </div>
                </div>
                <div class="leef_box">
                    <img class="lazy" data-original="/PureRide-tours/assect/img/tuk.jpg" alt="car">
                    <div class="cat">
                        <h2> TUK-TUK </h2>
                        <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores, odit? </p>
                        <br>
                        <a href="/PureRide-tours/rates/Tuk_Tuk"> More Details </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="wedding">
            <div class="wedding_img">
                <img class="lazy" data-original="/PureRide-tours/assect/img/wedding.jpg" alt="car">
            </div>
            <div class="wedding_content">
                <h1> Weddings And Events </h1>
                <br>
                <p>
                    Style and class are what we promise for your special occasions. Choose from our extensive fleet of luxury vehicles and make your day a truly unforgettable one.
                </p>
                <br><br>
                <a href="#">More Details</a>
            </div>
        </div>

        <!-- services  -->
        <div class="leeft" id="services">
            <div class="double">
                <div class="leef_box service">
                    <div>
                        <h1> SERVICES </h1>
                        <p> Our services are tailor-made to meet any type of transportation service you require. </p>
                        <br>
                        <a href="#"> More Details </a>
                    </div>
                </div>
                <div class="leef_box">
                    <img class="lazy" data-original="/PureRide-tours/assect/img/driver.jpg" alt="car">
                    <div class="cat">
                        <h2> WITH DRIVER/TOURS </h2>
                        <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores, odit? </p>
                    </div>
                </div>
            </div>
            <div class="double">
                <div class="leef_box">
                    <img class="lazy" data-original="/PureRide-tours/assect/img/airport.jpg" alt="car">
                    <div class="cat">
                        <h2> AIRPORT / CITY </h2>
                        <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores, odit? </p>
                    </div>
                </div>
                <div class="leef_box">
                    <img class="lazy" data-original="/PureRide-tours/assect/img/wedding_car.jpg" alt="car">
                    <div class="cat">
                        <h2> WEDDING CARS </h2>
                        <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores, odit? </p>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <!-- traval -->
        <?php
        if (mysqli_num_rows($trip_result) > 0) {
            echo "<h1 style='text-align: center;'> BOOK A TOURS </h1>";
            echo "<section class='traval'>";
            while ($fetch_trip = mysqli_fetch_assoc($trip_result)) {
                $tri_ID = $fetch_trip['ID'];
                $tri_Pic = $fetch_trip['Pic'];
                $tri_P_From = $fetch_trip['P_From'];
                $tri_P_To = $fetch_trip['P_To'];
                $tri_Distance = $fetch_trip['Distance'];
                $tri_Duration = $fetch_trip['Duration'];
                $tri_Description_one = $fetch_trip['Description_one'];
                $tri_Description_tow = $fetch_trip['Description_tow'];
                $tri_Description_three = $fetch_trip['Description_three'];
                $tri_Price = $fetch_trip['Price'];

                echo "
                    <div class='card'>
                        <img class='lazy' data-original='/PureRide-tours/assect/img/{$tri_Pic}' alt='galle'>
                        <div class='headline'>
                            <h3> {$tri_P_From} to {$tri_P_To} </h3>
                        </div>
                        <div class='duration_time'>
                            <div>
                                <h4> {$tri_Distance} </h4>
                                <p> Distance </p>
                            </div>
                            <div style='width: 1px; height: 30px; background-color: var(--main-color2);'></div>
                            <div>
                                <h4> {$tri_Duration} </h4>
                                <p> Duration </p>
                            </div>
                        </div>
                        <br>
                        <div class='visit'>
                            <ul>
                                <li> {$tri_Description_one} </li>
                                <li> {$tri_Description_tow} </li>
                                <li> {$tri_Description_three} </li>
                            </ul>
                            <br>
                        </div>
                        <h3> LKR {$tri_Price} | Vehicle </h3>
                        <div class='book'>
                            <a href='/PureRide-tours/index/{$tri_ID}'> BOOK NOW </a>
                        </div>
                    </div>
                    ";
            }
            echo "</section>";
        }
        ?>

        <section class="booking" style="display: <?= $display; ?>;">
            <form method="post">
                <div class="close">
                    <a href="/PureRide-tours/index"> <i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i> </a>
                </div>
                <h2 style="text-align: center;"> Fill Form </h2>
                <br>
                <h3>
                    <b> <?= $trip_P_From; ?> to <?= $trip_P_To; ?> </b>
                </h3>
                <br>
                <p>
                    Distance : <b> <?= $trip_Distance; ?> </b>
                </p>
                <p>
                    Duration : <b> <?= $trip_Duration; ?> </b>
                </p>
                <br>
                <p>
                    <?= $trip_Description_one; ?>
                </p>
                <p>
                    <?= $trip_Description_tow; ?>
                </p>
                <p>
                    <?= $trip_Description_three; ?>
                </p>
                <br>
                <input type="number" value="<?= $trip_ID ?>" name="id" hidden required>
                <input type="text" value="<?= $trip_P_From; ?> to <?= $trip_P_To; ?>" name="trip_name" hidden required>
                <p>
                    <label for="Name"> Name :</label>
                    <input type="text" id="Name" placeholder="Your Name" name="Name" required>
                </p>
                <p>
                    <label for="email">E-mail :</label>
                    <input type="text" id="email" placeholder="E-mail" name="email" required>
                </p>
                <p>
                    <label for="Number"> Number :</label>
                    <input type="number" id="Number" placeholder="Mobile number" name="Number" required>
                </p>
                <p>
                    <label for="p_date"> Picup date :</label>
                    <input type="date" id="p_date" name="p_date" min="<?= date("Y-m-d"); ?>" required>
                </p>
                <br>
                <p>
                    <input type="submit" value="Place Order" name="booking">
                </p>
            </form>
        </section>

        <!-- footer  -->
        <?php
        include("includes/footer.php");
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