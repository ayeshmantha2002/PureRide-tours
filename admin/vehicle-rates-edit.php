<?php
session_start();
include("../includes/connection.php");
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

if (isset($_GET['edit_id'])) {
    $edit_id = mysqli_real_escape_string($connection, $_GET['edit_id']);
    $vehicle = "SELECT * FROM `rates` WHERE `ID` = {$edit_id}";
    $vehicle_result = mysqli_query($connection, $vehicle);
    if (mysqli_num_rows($vehicle_result) > 0) {
        $fetch_vehicle = mysqli_fetch_assoc($vehicle_result);
        $vehicle_type = $fetch_vehicle['Vehicle_type'];
        $upvehicle_name = $fetch_vehicle['Vehicle_name'];
        $Rate_per_month = $fetch_vehicle['Rate_per_month'];
        $Rate_per_week = $fetch_vehicle['Rate_per_week'];
        $Over_KM = $fetch_vehicle['Over_KM'];
    } else {
        header("location: vehicle-fleet.php");
    }
} else {
    header("location: vehicle-fleet.php");
}

if (isset($_POST['rates'])) {
    $insert_vehicle_type = mysqli_real_escape_string($connection, $_POST['vehicle_type']);
    $insert_upvehicle_name = mysqli_real_escape_string($connection, $_POST['vehicle_name']);
    $insert_Rate_per_month = mysqli_real_escape_string($connection, $_POST['rate_month']);
    $insert_Rate_per_week = mysqli_real_escape_string($connection, $_POST['rate_week']);
    $insert_Over_KM = mysqli_real_escape_string($connection, $_POST['over80']);

    $upadate_rates = "UPDATE `rates` SET `Vehicle_type` = '{$insert_vehicle_type}', `Vehicle_name` = '{$insert_upvehicle_name}', `Rate_per_month` = {$insert_Rate_per_month}, `Rate_per_week` = {$insert_Rate_per_week}, `Over_KM` = {$insert_Over_KM} WHERE `ID` = {$edit_id}";
    $upadate_rates_result = mysqli_query($connection, $upadate_rates);
    if ($upadate_rates_result) {
        header("location:vehicle-fleet.php?recode=updated");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Rates</title>
    <link rel="stylesheet" href="../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .rate_view {
            display: flex;
            height: 90vh;
        }

        .mobile_area {
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>
    <!-- pre loader -->
    <section class="loading" id="loading">
        <img src="../assect/img/loading2.gif" alt="loading">
    </section>

    <section class="mobile_area">
        <div class="rate_view">
            <div class="close">
                <a href="vehicle-fleet.php"> <i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i> </a>
            </div>
            <form method="post" enctype="multipart/form-data">
                <h2> Edit Vehicle Rates </h2>
                <?php
                if (!empty($errors)) {
                    foreach ($errors as $errors) {
                        echo $errors;
                    }
                }
                ?>
                <p>
                    <label for="vehicle_type"> Vehicle Category : </label>
                    <select name="vehicle_type" id="vehicle_type" required>
                        <option value=""> Chooce vehicle category </option>
                        <?php
                        // vehicle category 
                        $vehicle_category = "SELECT * FROM `vehicle_type` WHERE `Status` = 1";
                        $vehicle_category_result = mysqli_query($connection, $vehicle_category);

                        if (mysqli_num_rows($vehicle_category_result) > 0) {
                            while ($vehicle_category_fetch = mysqli_fetch_assoc($vehicle_category_result)) {
                                $vehicle_ID = $vehicle_category_fetch['ID'];
                                $vehicle_name = $vehicle_category_fetch['Vehicle'];

                                if ($vehicle_name == $vehicle_type) {
                                    $select = "selected";
                                } else {
                                    $select = "";
                                }

                                echo "<option value='{$vehicle_name}' {$select}> {$vehicle_name} </option>";
                            }
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label for="vehicle_name"> Vehicle name : </label>
                    <input type="text" id="vehicle_name" name="vehicle_name" placeholder="Vehicle name" value="<?= $upvehicle_name; ?>" required>
                </p>
                <!-- <p>
                    <label for="vehicle_img"> Vehicle Image : </label>
                    <br>
                    <label for="vehicle_img" style="color: red;"> 16:9 aspect ratio required </label>
                    <input type="file" name="vehicle_img" id="vehicle_img" required>
                </p> -->
                <p>
                    <label for="rate_month"> RATE PER MONTH : </label>
                    <input type="number" name="rate_month" id="rate_month" placeholder="RATE PER MONTH" value="<?= $Rate_per_month; ?>" required>
                </p>
                <p>
                    <label for="rate_week"> RATE PER WEEK : </label>
                    <input type="number" name="rate_week" id="rate_week" placeholder="RATE PER WEEK" value="<?= $Rate_per_week; ?>" required>
                </p>
                <p>
                    <label for="over80"> EXCESS MILEAGE OVER 80 KM PER DAY : </label>
                    <input type="number" name="over80" id="over80" placeholder="EXCESS MILEAGE OVER 80 KM PER DAY" value="<?= $Over_KM; ?>" required>
                </p>
                <br>
                <p>
                    <input type="submit" name="rates" value="Update">
                </p>
            </form>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js" integrity="sha512-QABeEm/oYtKZVyaO8mQQjePTPplrV8qoT7PrwHDJCBLqZl5UmuPi3APEcWwtTNOiH24psax69XPQtEo5dAkGcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assect/js/main.js"></script>
    <script src="../assect/js/funtions.js"></script>
</body>

</html>