<nav>
    <div class="upNav">
        <div class="menu_btn">
            <i class="fa-solid fa-bars"></i>
        </div>
        <div class="com_name">
            <div>
                <img src="/PureRide-tours/assect/img/Pueride Tours Nav Logo.png" alt="logo">
            </div>
            <div>
                <h1> PureRide tours </h1>
                <p> Lorem ipsum dolor sit. </p>
            </div>
        </div>
        <div class="up_links">
            <ul>
                <li> <a href="/PureRide-tours/index"> HOME </a> </li>
                <li> <a href="/PureRide-tours/index.php#about"> ABOUT </a> </li>
                <li> <a href="/PureRide-tours/index.php#vehicle_feeft"> VEHICLE FLEET </a> </li>
                <li> <a href="/PureRide-tours/index.php#services"> SERVICE </a> </li>
                <li> <a href="#"> GUIDES </a> </li>
                <li> <a href="/PureRide-tours/contact"> CONTACT US </a> </li>
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
                            <?php
                            // list Service 
                            $service_list = "SELECT * FROM `service` WHERE `Status` = 1";
                            $service_list_result = mysqli_query($connection, $service_list);
                            if (mysqli_num_rows($service_list_result) > 0) {
                                while ($setch_Services = mysqli_fetch_assoc($service_list_result)) {
                                    $service_type = $setch_Services['Service'];
                                    echo " <option value='{$service_type}'>{$service_type}</option> ";
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name="location" required>
                            <option value=""> Pickup Location </option>
                            <?php
                            // list pickup_locations 
                            $location_list = "SELECT * FROM `pickup_location`";
                            $location_list_result = mysqli_query($connection, $location_list);
                            if (mysqli_num_rows($location_list_result) > 0) {
                                while ($fetch_pickup_locations = mysqli_fetch_assoc($location_list_result)) {
                                    $pickup_location_ID = $fetch_pickup_locations['ID'];
                                    $pickup_location_type = $fetch_pickup_locations['Location'];
                                    $pickup_location_status = $fetch_pickup_locations['Status'];

                                    echo " <option value='{$pickup_location_type}'> {$pickup_location_type} </option> ";
                                }
                            }
                            ?>
                            <option> Other </option>
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
                            <?php
                            // list vehicles 
                            $vehicle_list = "SELECT * FROM `vehicle_type` WHERE `Status` = 1";
                            $vehicle_list_result = mysqli_query($connection, $vehicle_list);
                            if (mysqli_num_rows($vehicle_list_result) > 0) {
                                while ($fetch_vehicles = mysqli_fetch_assoc($vehicle_list_result)) {
                                    $vehicle_type = $fetch_vehicles['Vehicle'];
                                    echo "
                                        <option value='{$vehicle_type}'> {$vehicle_type} </option>
                                    ";
                                }
                            }
                            ?>
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
                <?php
                // list Service 
                $service_list = "SELECT * FROM `service` WHERE `Status` = 1";
                $service_list_result = mysqli_query($connection, $service_list);
                if (mysqli_num_rows($service_list_result) > 0) {
                    while ($setch_Services = mysqli_fetch_assoc($service_list_result)) {
                        $service_type = $setch_Services['Service'];
                        echo " <option value='{$service_type}'>{$service_type}</option> ";
                    }
                }
                ?>
            </select>
        </p>
        <p>
            <select name="location" required>
                <option value=""> Pickup Location </option>
                <?php
                // list pickup_locations 
                $location_list = "SELECT * FROM `pickup_location`";
                $location_list_result = mysqli_query($connection, $location_list);
                if (mysqli_num_rows($location_list_result) > 0) {
                    while ($fetch_pickup_locations = mysqli_fetch_assoc($location_list_result)) {
                        $pickup_location_ID = $fetch_pickup_locations['ID'];
                        $pickup_location_type = $fetch_pickup_locations['Location'];
                        $pickup_location_status = $fetch_pickup_locations['Status'];

                        echo " <option value='{$pickup_location_type}'> {$pickup_location_type} </option> ";
                    }
                }
                ?>
                <option> Other </option>
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
                <?php
                // list vehicles 
                $vehicle_list = "SELECT * FROM `vehicle_type` WHERE `Status` = 1";
                $vehicle_list_result = mysqli_query($connection, $vehicle_list);
                if (mysqli_num_rows($vehicle_list_result) > 0) {
                    while ($fetch_vehicles = mysqli_fetch_assoc($vehicle_list_result)) {
                        $vehicle_type = $fetch_vehicles['Vehicle'];
                        echo "
                            <option value='{$vehicle_type}'> {$vehicle_type} </option>
                            ";
                    }
                }
                ?>
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
    <p> <a href="/PureRide-tours/index" class="active_page"> HOME </a> </p>
    <p> <a href="/PureRide-tours/index.php#about"> ABOUT </a> </p>
    <p> <a href="/PureRide-tours/index.php#vehicle_feeft"> VEHICLE FLEET </a> </p>
    <p> <a href="/PureRide-tours/index.php#services"> SERVICE </a> </p>
    <p> <a href="#"> GUIDES </a> </p>
    <p> <a href="/PureRide-tours/contact"> CONTACT US </a> </p>
</div>