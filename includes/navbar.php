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
                <li> <a href="index"> HOME </a> </li>
                <li> <a href="index.php#about"> ABOUT </a> </li>
                <li> <a href="index.php#vehicle_feeft"> VEHICLE FLEET </a> </li>
                <li> <a href="index.php#services"> SERVICE </a> </li>
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
    <p> <a href="index" class="active_page"> HOME </a> </p>
    <p> <a href="index.php#about"> ABOUT </a> </p>
    <p> <a href="index.php#vehicle_feeft"> VEHICLE FLEET </a> </p>
    <p> <a href="index.php#services"> SERVICE </a> </p>
    <p> <a href="#"> GUIDES </a> </p>
    <p> <a href="contact"> CONTACT US </a> </p>
</div>