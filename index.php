<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PureRide tours </title>
    <link rel="stylesheet" href="assect/css/slider.css">
    <link rel="stylesheet" href="assect/css/style.css">
    <link rel="stylesheet" href="assect/css/mobile.css">
    <link rel="icon" type="image/x-icon" href="assect/img/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="content">
        <!-- navigation bar -->
        <nav>
            <div class="upNav">
                <div class="menu_btn">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="com_name">
                    <div>
                        <img src="assect/img/Pueride Tours Nav Logo.png" alt="logo">
                    </div>
                    <div>
                        <h1> PureRide tours </h1>
                        <p> Lorem ipsum dolor sit. </p>
                    </div>
                </div>
                <div class="up_links">
                    <ul>
                        <li> <a href="#" class="active_page"> HOME </a> </li>
                        <li> <a href="#about"> ABOUT </a> </li>
                        <li> <a href="#vehicle_feeft"> VEHICLE FLEET </a> </li>
                        <li> <a href="#services"> SERVICE </a> </li>
                        <li> <a href="#"> GUIDES </a> </li>
                        <li> <a href="contact"> CONTACT US </a> </li>
                    </ul>
                </div>
                <div class="hotline">
                    <i class="fa-solid fa-phone-volume"></i>
                    <p> +94 70 49 02 790 </p>
                </div>
            </div>
            <div class="downNav">
                <form action="quick" method="post">
                    <table>
                        <tr>
                            <td>
                                <select name="dr_mod" required>
                                    <option value="Self Drive" disabled>Self Drive</option>
                                    <option value="Tours/ Chauffeur Driven">Tours/ Chauffeur Driven</option>
                                    <option value="Weddings &amp; Events">Weddings &amp; Events</option>
                                </select>
                            </td>
                            <td>
                                <select name="location" required>
                                    <option value=""> Pickup Location </option>
                                    <option value="Ettampitiya"> Ettampitiya </option>
                                </select>
                            </td>
                            <td>
                                <label for="picup_date"> Pickup Date </label><br>
                                <input type="date" name="picup_date" id="picup_date" value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" required>
                            </td>
                            <td>
                                <label for="picup_time"> Pickup Time </label><br>
                                <input type="time" name="picup_time" id="picup_time" required>
                            </td>
                            <td>
                                <label for="return_date"> Return Date </label><br>
                                <input type="date" name="return_date" id="return_date" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" required>
                            </td>
                            <td>
                                <select name="vehicle" required>
                                    <option value=""> Vehicle Type </option>
                                    <option value="car"> car </option>
                                    <option value="van"> van </option>
                                    <option value="tuk-tuk"> bike </option>
                                    <option value="tuk-tuk"> tuk-tuk </option>
                                    <option value="bus"> bus </option>
                                </select>
                            </td>
                            <td style="position: relative; width: 200px;">
                                <input type="submit" name="submit" value="SUBMIT">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

            <!-- mobile down menu  -->
            <div class="mobile_down_nav">
                <div>
                    <button class="menu_btn_phone"> <i class="fa-solid fa-bars"></i> </button>
                </div>
                <div>
                    <button class="quick_btn"> Quick Book </button>
                </div>
            </div>
        </nav>

        <!-- Mobile screen form  -->
        <button class="quickBook quickBookone">
            Quick Book
        </button>

        <button class="quickBook quickBooktow">
            <i class="fa-solid fa-xmark fa-2xl"></i>
        </button>

        <section class="mobile_submit">
            <form action="quick" method="post">
                <p>
                    <select name="dr_mod" required>
                        <option value="Self Drive" disabled>Self Drive</option>
                        <option value="Tours/ Chauffeur Driven">Tours/ Chauffeur Driven</option>
                        <option value="Weddings &amp; Events">Weddings &amp; Events</option>
                    </select>
                </p>
                <p>
                    <select name="location" required>
                        <option value=""> Pickup Location </option>
                        <option value="Ettampitiya"> Ettampitiya </option>
                    </select>
                </p>
                <p>
                    <label for="picup_date"> Pickup Date </label><br>
                    <input type="date" name="picup_date" id="picup_date" value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" required>
                </p>
                <p>
                    <label for="picup_time"> Pickup Time </label><br>
                    <input type="time" name="picup_time" id="picup_time" required>
                </p>
                <p>
                    <label for="return_date"> Return Date </label><br>
                    <input type="date" name="return_date" id="return_date" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" required>
                </p>
                <p>
                    <select name="vehicle" required>
                        <option value=""> Vehicle Type </option>
                        <option value="car"> car </option>
                        <option value="van"> van </option>
                        <option value="tuk-tuk"> tuk-tuk </option>
                        <option value="bus"> bus </option>
                    </select>
                </p>
                <br>
                <p>
                    <input type="submit" name="submit" value="SUBMIT">
                </p>
            </form>
        </section>

        <!-- mobile menu -->
        <div class="mobile_menu">
            <br>
            <p> <a href="#" class="active_page"> HOME </a> </p>
            <p> <a href="#about"> ABOUT </a> </p>
            <p> <a href="#vehicle_feeft"> VEHICLE FLEET </a> </p>
            <p> <a href="#services"> SERVICE </a> </p>
            <p> <a href="#"> GUIDES </a> </p>
            <p> <a href="contact"> CONTACT US </a> </p>
        </div>

        <!-- slide show -->
        <div id="carouselExampleIndicators" class="carousel slide">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="small" src="assect/img/cover.jpg" alt="cover 1 image">
                    <img class="small-off" src="assect/img/cover-mobile.jpg" alt="cover 1 image">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Lorem ipsum dolor sit.</h5>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque, amet.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="small" src="assect/img/cover2.jpg" alt="cover 1 image">
                    <img class="small-off" src="assect/img/cover2-mobile.jpg" alt="cover 1 image">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Lorem ipsum dolor sit.</h5>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque, amet.</p>
                    </div>
                </div>
            </div>
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
                <img src="assect/img/car.png" alt="car">
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
                    <p> <a href="view/rates.php">View Rates</a> </p>
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
                    <img src="assect/img/car.jpg" alt="car">
                    <div class="cat">
                        <h2> CARS </h2>
                        <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores, odit? </p>
                        <br>
                        <a href="view/rates.php?cat=car"> More Details </a>
                    </div>
                </div>
                <div class="leef_box">
                    <img src="assect/img/van.jpg" alt="car">
                    <div class="cat">
                        <h2> VANS </h2>
                        <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores, odit? </p>
                        <br>
                        <a href="view/rates.php?cat=Van"> More Details </a>
                    </div>
                </div>
            </div>
            <div class="double">
                <div class="leef_box">
                    <img src="assect/img/bus.jpg" alt="car">
                    <div class="cat">
                        <h2> BUSSES </h2>
                        <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores, odit? </p>
                        <br>
                        <a href="view/rates.php?cat=Bus"> More Details </a>
                    </div>
                </div>
                <div class="leef_box">
                    <img src="assect/img/tuk.jpg" alt="car">
                    <div class="cat">
                        <h2> TUK-TUK </h2>
                        <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores, odit? </p>
                        <br>
                        <a href="view/rates.php?cat=Tuk_Tuk"> More Details </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="wedding">
            <div class="wedding_img">
                <img src="assect/img/wedding.jpg" alt="car">
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
                    <img src="assect/img/driver.jpg" alt="car">
                    <div class="cat">
                        <h2> WITH DRIVER/TOURS </h2>
                        <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores, odit? </p>
                    </div>
                </div>
            </div>
            <div class="double">
                <div class="leef_box">
                    <img src="assect/img/airport.jpg" alt="car">
                    <div class="cat">
                        <h2> AIRPORT / CITY </h2>
                        <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores, odit? </p>
                    </div>
                </div>
                <div class="leef_box">
                    <img src="assect/img/wedding_car.jpg" alt="car">
                    <div class="cat">
                        <h2> WEDDING CARS </h2>
                        <p> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores, odit? </p>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <!-- traval -->
        <h1 style="text-align: center;"> BOOK A TOURS </h1>
        <section class="traval">
            <div class="card">
                <img src="https://www.civitatis.com/f/sri-lanka/unawatuna/excursion-galle-589x392.jpg" alt="galle">
                <div class="headline">
                    <h3> Collombo to Galle </h3>
                </div>
                <div class="duration_time">
                    <div>
                        <h4> 250KM </h4>
                        <p> Distance </p>
                    </div>
                    <div style="width: 1px; height: 30px; background-color: var(--main-color2);"></div>
                    <div>
                        <h4> 12 Hours </h4>
                        <p> Duration </p>
                    </div>
                </div>
                <br>
                <div class="visit">
                    <ul>
                        <li> Lorem, ipsum dolor. </li>
                        <li> Lorem, ipsum dolor. </li>
                        <li> Galle fort national maritime architecture </li>
                    </ul>
                    <br>
                </div>
                <h3> LKR 7,500 | Vehicle </h3>
                <div class="book">
                    <a href="#"> BOOK NOW </a>
                </div>
            </div>
        </section>

        <section class="whatsapp">
            <form method="get">
                <h2 style="text-align: center;"> WhatsApp </h2>
                <br>
                <p>
                    <label for="name"> Name : </label>
                    <input type="text" name="name" placeholder="Name">
                </p>
                <br>
                <p>
                    <label for="name"> E-mail : </label>
                    <input type="email" name="email" placeholder="E-mail">
                </p>
                <br>
                <p>
                    <label for="name"> Subject : </label>
                    <input type="text" name="subject" placeholder="Subject">
                </p>
                <br>
                <p>
                    <label for="name"> Message : </label>
                    <input type="text" name="msg" placeholder="Message">
                </p>
                <br>
                <br>
                <p>
                    <input type="submit" name="wht-message" value="Send">
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
    <script src="assect/js/main.js"></script>
</body>

</html>