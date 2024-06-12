<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rates</title>
    <link rel="stylesheet" href="../assect/css/style.css">
    <link rel="stylesheet" href="../assect/css/mobile.css">
    <link rel="icon" type="image/x-icon" href="../assect/img/favicon.png">
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
                        <img src="../assect/img/Pueride Tours Nav Logo.png" alt="logo">
                    </div>
                    <div>
                        <h1> PureRide tours </h1>
                        <p> Lorem ipsum dolor sit. </p>
                    </div>
                </div>
                <div class="up_links">
                    <ul>
                        <li> <a href="../index"> HOME </a> </li>
                        <li> <a href="../index.php#about"> ABOUT </a> </li>
                        <li> <a href="../index.php#vehicle_feeft" class="active_page"> VEHICLE FLEET </a> </li>
                        <li> <a href="../index.php#services"> SERVICE </a> </li>
                        <li> <a href="#"> GUIDES </a> </li>
                        <li> <a href="/contact"> CONTACT US </a> </li>
                    </ul>
                </div>
                <div class="hotline">
                    <i class="fa-solid fa-phone-volume"></i>
                    <p> +94 71 15 96 479 </p>
                </div>
            </div>
            <div class="downNav">
                <form action="quick-inquiry-form.php" method="post">
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
                                    <option value="bike"> bike </option>
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
            <form action="quick-inquiry-form.php" method="post">
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
                        <option value="bike"> bike </option>
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
            <p> <a href="../index" class="active_page"> HOME </a> </p>
            <p> <a href="../index.php#about"> ABOUT </a> </p>
            <p> <a href="../index.php#vehicle_feeft"> VEHICLE FLEET </a> </p>
            <p> <a href="../index.php#services"> SERVICE </a> </p>
            <p> <a href="#"> GUIDES </a> </p>
            <p> <a href="contact"> CONTACT US </a> </p>
        </div>

        <!-- contact form  -->
        <section class="aling">
            <div class="up">
                <div>
                    <h2> VEHICLE RATES </h2>
                </div>
                <div>
                    <p> <a href="../index.php">HOME</a> / <a href="rates.php"> VEHICLE RATES </a> </p>
                    <hr>
                </div>
                <br>
                <table>
                    <thead>
                        <tr>
                            <th> IMAGE </th>
                            <th> VEHICLES </th>
                            <th> RATE PER MONTH </th>
                            <th> RATE PER WEEK </th>
                            <th style="width: 120px;"> EXCESS MILEAGE OVER 80 KM PER DAY </th>
                        </tr>
                        <tr>
                            <td colspan="5" class="categary"> car </td>
                        </tr>
                    </thead>
                    <tr>
                        <td><img src="../assect/img/car_fleet.jpg" alt="car"></td>
                        <td> Mercedes-Benz </td>
                        <td> 295,000.00 </td>
                        <td> 85,000.00 </td>
                        <td> 85,000.00 </td>
                    </tr>
                    <tr>
                        <td><img src="../assect/img/car_fleet.jpg" alt="car"></td>
                        <td> Mercedes-Benz </td>
                        <td> 295,000.00 </td>
                        <td> 85,000.00 </td>
                        <td> 85,000.00 </td>
                    </tr>
                    <tr>
                        <td><img src="../assect/img/car_fleet.jpg" alt="car"></td>
                        <td> Mercedes-Benz </td>
                        <td> 295,000.00 </td>
                        <td> 85,000.00 </td>
                        <td> 85,000.00 </td>
                    </tr>
                </table>

                <div class="mobile_rates">
                    <div>
                        <table>
                            <tr>
                                <th colspan="2"> <img src="../assect/img/car_fleet.jpg" alt="car"> </th>
                            </tr>
                            <tr>
                                <th style="width: 50%;"> VEHICLES : </th>
                                <td> Mercedes-Benz </td>
                            </tr>
                            <tr>
                                <th style="width: 50%;"> RATE PER MONTH : </th>
                                <td> 295,000.00 </td>
                            </tr>
                            <tr>
                                <th style="width: 50%;"> RATE PER WEEK : </th>
                                <td> 85,000.00 </td>
                            </tr>
                            <tr>
                                <th style="width: 50%;"> EXCESS MILEAGE OVER 80 KM PER DAY : </th>
                                <td> 85.00 </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table>
                            <tr>
                                <th colspan="2"> <img src="../assect/img/car_fleet.jpg" alt="car"> </th>
                            </tr>
                            <tr>
                                <th style="width: 50%;"> VEHICLES : </th>
                                <td> Mercedes-Benz </td>
                            </tr>
                            <tr>
                                <th style="width: 50%;"> RATE PER MONTH : </th>
                                <td> 295,000.00 </td>
                            </tr>
                            <tr>
                                <th style="width: 50%;"> RATE PER WEEK : </th>
                                <td> 85,000.00 </td>
                            </tr>
                            <tr>
                                <th style="width: 50%;"> EXCESS MILEAGE OVER 80 KM PER DAY : </th>
                                <td> 85.00 </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <br><br>
        <!-- footer  -->
        <section class="footer">
            <footer>
                <div class="up">
                    <div class="footer_logo">
                        <p class="logo">
                            <img src="../assect/img/Pueride Tours Logo.png" alt="logo">
                        </p>
                        <h2> PureRide Tours </h2>
                        <br>
                        <h5> Address </h5>
                        <p> PureRide tours (Pvt.) Ltd.
                            <br>
                            No 58 Pamankada Road,
                            <br>
                            Colombo 06,
                            <br>
                            Sri Lanka.
                        </p>
                    </div>
                    <div class="quick_link">
                        <h3> Quick Links </h3>
                        <hr>
                        <br>
                        <div style="display: flex; justify-content: space-between; width: 100%;">
                            <ul>
                                <li> <a href="#">HOME</a> </li>
                                <li> <a href="#">ABOUT</a> </li>
                                <li> <a href="#">SERVICE</a> </li>
                                <li> <a href="#">VEHICLE FLEET</a> </li>
                                <li> <a href="#">RATES</a> </li>
                            </ul>
                            <ul>
                                <li> <a href="https://distancecalculator.globefeed.com/Sri_Lanka_Distance_Calculator.asp" target="_blank">DISTANCE</a> </li>
                                <li> <a href="#">CONTACT US</a> </li>
                                <li> <a href="#">CUSTOMER REVIEWS</a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="social_meadia">
                        <h3> Social Media </h3>
                        <hr>
                        <br>
                        <ul>
                            <li> <a href="#"><i class="fa-brands fa-square-whatsapp"></i> WhatsApp</a> </li>
                            <li> <a href="#"><i class="fa-brands fa-square-facebook"></i> Facebook</a>
                        </ul>
                    </div>
                    <div class="contact_footer">
                        <p> <i class="fa-solid fa-phone-volume"></i> +94 71 1596479 </p>
                        <p> <i class="fa-solid fa-phone-volume"></i> +94 71 1596479 </p>
                    </div>
                </div>
                <hr>
                <div class="down">
                    <p> Copyright @ 2024 PureRide tours. All rights reserved. Designed By <a href="https://wa.me/94711596479?text=Hello%20Sameera%20Ayeshmantha." target="_blank">Nethub.lk</a> </p>
                </div>
            </footer>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js" integrity="sha512-QABeEm/oYtKZVyaO8mQQjePTPplrV8qoT7PrwHDJCBLqZl5UmuPi3APEcWwtTNOiH24psax69XPQtEo5dAkGcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../assect/js/main.js"></script>
</body>

</html>