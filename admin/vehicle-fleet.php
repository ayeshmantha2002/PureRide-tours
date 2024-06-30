<?php
session_start();
include("../includes/connection.php");
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

$errors = array();

// vehicle category 
$vehicle_category = "SELECT * FROM `vehicle_type` WHERE `Status` = 1";
$vehicle_category_result = mysqli_query($connection, $vehicle_category);

// vehicle fleet 
$vehicle_fleet = "SELECT * FROM `fleet`";
$vehicle_fleet_result = mysqli_query($connection, $vehicle_fleet);

// upload new fleet 
if (isset($_POST['fleet'])) {

    $fileName = $_FILES['vehicle_img']['name'];
    $fileTemp = $_FILES['vehicle_img']['tmp_name'];
    $fileSize = $_FILES['vehicle_img']['size'];
    $fileType = $_FILES['vehicle_img']['type'];

    $Vehicle_nameQ = mysqli_real_escape_string($connection, $_POST['vehicle_name']);
    $Description = mysqli_real_escape_string($connection, $_POST['vehicle_description']);

    if ($fileType == 'image/jpg' || $fileType == 'image/jpeg' || $fileType == 'image/png') {
        $upload_to = "../assect/img/";

        $checkImage = "SELECT * FROM `fleet` WHERE `Img` = '{$fileName}'";
        $checkImage_result = mysqli_query($connection, $checkImage);

        if (mysqli_num_rows($checkImage_result) > 0) {
            $errors[] = "<p style='color: red; text-align: center;'> This picture already exists. </p>";
        } else {
            $uploadIMage = move_uploaded_file($fileTemp, $upload_to . $fileName);
            if ($uploadIMage) {
                $addItem = "INSERT INTO `fleet` (`Img`, `Vehicle_name`, `Description`, `Status`) VALUES ('{$fileName}', '{$Vehicle_nameQ}', '{$Description}', 1)";
                $addItemResult = mysqli_query($connection, $addItem);
                if ($addItemResult) {
                    header("location:vehicle-fleet.php?recode=updated");
                }
            }
        }
    }
}

// edit form
if (isset($_GET['edit_id'])) {
    $edit_form = "flex";

    $vehicle_details = "SELECT * FROM `fleet` WHERE `ID` = {$_GET['edit_id']}";
    $vehicle_details_result = mysqli_query($connection, $vehicle_details);
    if (mysqli_num_rows($vehicle_details_result) > 0) {
        $fetch_vehicle_details = mysqli_fetch_assoc($vehicle_details_result);
        $fetchvehicle_name = $fetch_vehicle_details['Vehicle_name'];
        $fetchDescription = $fetch_vehicle_details['Description'];
    }
} else {
    $edit_form = "none";
    $fetchvehicle_name = "";
    $fetchDescription = "";
}


// update details
if (isset($_POST['update_details'])) {

    $update_name = mysqli_real_escape_string($connection, $_POST['update_name']);
    $update_description = mysqli_real_escape_string($connection, $_POST['update_description']);

    if (!isset($_FILES['update_img']['name']) || strlen(trim($_FILES['update_img']['name'])) < 1) {
        $update_fleet = "UPDATE `fleet` SET `Vehicle_name` = '{$update_name}', `Description` = '{$update_description}' WHERE `ID` = {$_GET['edit_id']}";
        $update_fleet_result = mysqli_query($connection, $update_fleet);
        if ($update_fleet_result) {
            header("location:vehicle-fleet.php?recode=updated");
        }
    } else {

        $fileName = $_FILES['update_img']['name'];
        $fileTemp = $_FILES['update_img']['tmp_name'];
        $fileSize = $_FILES['update_img']['size'];
        $fileType = $_FILES['update_img']['type'];

        if ($fileType == 'image/jpg' || $fileType == 'image/jpeg' || $fileType == 'image/png') {

            // check image name
            $vehicle_details = "SELECT * FROM `fleet` WHERE `ID` = {$_GET['edit_id']}";
            $vehicle_details_result = mysqli_query($connection, $vehicle_details);
            if (mysqli_num_rows($vehicle_details_result) > 0) {
                $fetch_vehicle_details = mysqli_fetch_assoc($vehicle_details_result);
                $fetchvehicle_img_name = $fetch_vehicle_details['Img'];
            }

            $parth = "../assect/img/{$fetchvehicle_img_name}";
            $insert_parth = "../assect/img/";

            if (unlink($parth)) {
                $uploadIMage = move_uploaded_file($fileTemp, $insert_parth . $fileName);
                if ($uploadIMage) {
                    $update_fleet = "UPDATE `fleet` SET `Img` = '{$fileName}', `Vehicle_name` = '{$update_name}', `Description` = '{$update_description}' WHERE `ID` = {$_GET['edit_id']}";
                    $update_fleet_result = mysqli_query($connection, $update_fleet);
                    if ($update_fleet_result) {
                        header("location:vehicle-fleet.php?recode=updated");
                    }
                }
            } else {
                $uploadIMage = move_uploaded_file($fileTemp, $insert_parth . $fileName);
                if ($uploadIMage) {
                    $update_fleet = "UPDATE `fleet` SET `Img` = '{$fileName}', `Vehicle_name` = '{$update_name}', `Description` = '{$update_description}' WHERE `ID` = {$_GET['edit_id']}";
                    $update_fleet_result = mysqli_query($connection, $update_fleet);
                    if ($update_fleet_result) {
                        header("location:vehicle-fleet.php?recode=updated");
                    }
                }
            }
        }
    }
}

if (isset($_POST['rates'])) {
    $fileName = $_FILES['vehicle_img']['name'];
    $fileTemp = $_FILES['vehicle_img']['tmp_name'];
    $fileSize = $_FILES['vehicle_img']['size'];
    $fileType = $_FILES['vehicle_img']['type'];

    $rates_vehicle_type = mysqli_real_escape_string($connection, $_POST['vehicle_type']);
    $rates_vehicle_name = mysqli_real_escape_string($connection, $_POST['vehicle_name']);
    $rates_rate_month = mysqli_real_escape_string($connection, $_POST['rate_month']);
    $rates_rate_week = mysqli_real_escape_string($connection, $_POST['rate_week']);
    $rates_over80 = mysqli_real_escape_string($connection, $_POST['over80']);

    $insert_img_parth = "../assect/img/rates/";
    $uploadIMage = move_uploaded_file($fileTemp, $insert_img_parth . $fileName);
    if ($uploadIMage) {
        $insert_rates = "INSERT INTO `rates` (`Vehicle_type`, `Image_name`, `Vehicle_name`, `Rate_per_month`, `Rate_per_week`, `Over_KM`, `Status`) VALUES ('{$rates_vehicle_type}', '{$fileName}', '{$rates_vehicle_name}', {$rates_rate_month}, {$rates_rate_week}, {$rates_over80}, 1)";
        $insert_rates_result = mysqli_query($connection, $insert_rates);
        if ($insert_rates_result) {
            header("location:vehicle-fleet.php?recode=updated");
        }
    }
}


// update_message
if (isset($_GET['recode'])) {
    if ($_GET['recode'] == "updated") {
        $update_message = "flex";
    } else {
        $update_message = "none";
    }
} else {
    $update_message = "none";
}

// delete_message
if (isset($_GET['delete'])) {
    if ($_GET['delete'] == "done") {
        $delete_message = "flex";
    } else {
        $delete_message = "none";
    }
} else {
    $delete_message = "none";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Vehicle fleet </title>
    <link rel="stylesheet" href="../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- pre loader -->
    <section class="loading" id="loading">
        <img src="../assect/img/loading2.gif" alt="loading">
    </section>

    <section class="mobile_area">
        <nav>
            <div class="back">
                <a href="admin.php"> <i class="fa-solid fa-chevron-left" onclick="clickFunction()"></i> </a>
            </div>
            <h3> Vehicle fleet </h3>
        </nav>
        <br><br>
        <div class="fleet">
            <p> <a href="#fleet" class="fleet_link"> <i class="fa-brands fa-slack"></i> Vehicle Fleet </a> </p>
            <p> <a href="#rates" class="rates_link"> <i class="fa-brands fa-slack"></i> Rates </a> </p>
        </div>
        <div class="fleet_view">
            <form method="post" enctype="multipart/form-data">
                <h2> Add Vehicle details </h2>
                <?php
                if (!empty($errors)) {
                    foreach ($errors as $errors) {
                        echo $errors;
                    }
                }
                ?>
                <p>
                    <label for="vehicle_name"> Vehicle Category : </label>
                    <select name="vehicle_name" id="vehicle_name" required>
                        <option value=""> Chooce vehicle category </option>
                        <?php
                        if (mysqli_num_rows($vehicle_category_result) > 0) {
                            while ($vehicle_category_fetch = mysqli_fetch_assoc($vehicle_category_result)) {
                                $vehicle_ID = $vehicle_category_fetch['ID'];
                                $vehicle_name = $vehicle_category_fetch['Vehicle'];

                                echo "<option value='{$vehicle_name}'> {$vehicle_name} </option>";
                            }
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label for="vehicle_img"> Vehicle Image : </label>
                    <br>
                    <label for="vehicle_img" style="color: red;"> 16:9 aspect ratio required </label>
                    <input type="file" name="vehicle_img" id="vehicle_img" required>
                </p>
                <p>
                    <label for="vehicle_description"> Vehicle Description : </label>
                    <input type="text" name="vehicle_description" id="vehicle_description" placeholder="Vehicle Description" required>
                </p>
                <p>
                    <input type="submit" name="fleet" value="Upload">
                </p>
            </form>

            <div class="fleet_list">
                <?php
                if (mysqli_num_rows($vehicle_fleet_result) > 0) {
                    while ($vehicle_fleet_fetch = mysqli_fetch_assoc($vehicle_fleet_result)) {
                        $fleet_ID = $vehicle_fleet_fetch['ID'];
                        $fleet_Img = $vehicle_fleet_fetch['Img'];
                        $fleet_Vehicle_name = ucwords($vehicle_fleet_fetch['Vehicle_name']);
                        $fleet_Description = $vehicle_fleet_fetch['Description'];

                        echo "
                    <div class='fleet_list_aling'>
                        <div class='img'>
                            <img src='../assect/img/{$fleet_Img}' alt='fleet'>
                        </div>
                        <div class='details'>
                            <h4> {$fleet_Vehicle_name} </h4>
                            <p> {$fleet_Description} </p>
                            <div class='links'>
                                <a href='vehicle-fleet.php?edit_id={$fleet_ID}' onclick='clickFunction()'> EDIT </a>
                                <a href='delete.php?delete_id={$fleet_ID}&image_name={$fleet_Img}' onclick='clickFunction()' style='background-color: red;'> DELETE </a>
                            </div>
                        </div>
                    </div>
                        ";
                    }
                }
                ?>
            </div>
        </div>

        <!-- vechicle rates -->
        <div class="rate_view">
            <form method="post" enctype="multipart/form-data">
                <h2> Add Vehicle Rates </h2>
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

                                echo "<option value='{$vehicle_name}'> {$vehicle_name} </option>";
                            }
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label for="vehicle_name"> Vehicle name : </label>
                    <input type="text" id="vehicle_name" name="vehicle_name" placeholder="Vehicle name" required>
                </p>
                <p>
                    <label for="vehicle_img"> Vehicle Image : </label>
                    <br>
                    <label for="vehicle_img" style="color: red;"> 16:9 aspect ratio required </label>
                    <input type="file" name="vehicle_img" id="vehicle_img" required>
                </p>
                <p>
                    <label for="rate_month"> RATE PER MONTH : </label>
                    <input type="number" name="rate_month" id="rate_month" placeholder="RATE PER MONTH" required>
                </p>
                <p>
                    <label for="rate_week"> RATE PER WEEK : </label>
                    <input type="number" name="rate_week" id="rate_week" placeholder="RATE PER WEEK" required>
                </p>
                <p>
                    <label for="over80"> EXCESS MILEAGE OVER 80 KM PER DAY : </label>
                    <input type="number" name="over80" id="over80" placeholder="EXCESS MILEAGE OVER 80 KM PER DAY" required>
                </p>
                <br>
                <p>
                    <input type="submit" name="rates" value="Upload">
                </p>
            </form>
            <br>


            <form method="post">
                <input type="search" name="search_rates" placeholder="Search vehicle">
                <br>
                <p style="text-align: center;"> <a href="vehicle-fleet.php"> All Vehicles </a> </p>
            </form>
            <div class="rate_list_aling">
                <?php
                // view rates
                if (isset($_POST['search_rates'])) {
                    $search = mysqli_real_escape_string($connection, $_POST['search_rates']);
                    $view_rate = "SELECT * FROM `rates` WHERE (`Vehicle_name` LIKE '%{$search}%' OR `Vehicle_type` LIKE '%{$search}%')";
                } else {
                    $view_rate = "SELECT * FROM `rates`";
                }
                $view_rate_result = mysqli_query($connection, $view_rate);
                if (mysqli_num_rows($view_rate_result) > 0) {
                    while ($fetch_rates = mysqli_fetch_assoc($view_rate_result)) {
                        $rates_ID = $fetch_rates['ID'];
                        $rates_Image_name = $fetch_rates['Image_name'];
                        $rates_Vehicle_name = $fetch_rates['Vehicle_name'];
                        $rates_Rate_per_month = $fetch_rates['Rate_per_month'];
                        $rates_Rate_per_week = $fetch_rates['Rate_per_week'];
                        $rates_Over_KM = $fetch_rates['Over_KM'];

                        echo "
                    <div class='rate_list'>
                        <img src='../assect/img/rates/{$rates_Image_name}' alt='rate'>
                        <div class='rare_details'>
                            <p>
                                <span>
                                    <b> Vehicle : </b>
                                </span>
                                <span>
                                    {$rates_Vehicle_name}
                                </span>
                            </p>
                            <p> <span>
                                    <b> RATE PER MONTH : </b>
                                </span>
                                <span>
                                    {$rates_Rate_per_month}
                                </span>
                            </p>
                            <p> <span>
                                    <b> RATE PER WEEK : </b>
                                </span>
                                <span>
                                    {$rates_Rate_per_week}
                                </span>
                            </p>
                            <p> <span>
                                    <b> EXCESS MILEAGE OVER 80 KM PER DAY : </b>
                                </span>
                                <span>
                                    {$rates_Over_KM}
                                </span>
                            </p>
                            <br>
                            <div class='links'>
                                <a href='vehicle-rates-edit.php?edit_id={$rates_ID}' onclick='clickFunction()'> EDIT </a>
                                <a href='delete.php?delete_rates_id={$rates_ID}&image_name={$rates_Image_name}' onclick='clickFunction()' style='background-color: red;'> DELETE </a>
                            </div>
                        </div>
                    </div>
                    ";
                    }
                }
                ?>
            </div>
        </div>

        <!-- edit form  -->
        <div class="edit_fleet" style="display: <?= $edit_form; ?>;">
            <div class="close">
                <a href="vehicle-fleet.php"> <i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i> </a>
            </div>

            <form method="post" enctype="multipart/form-data">
                <h2> Edit Details </h2>
                <br>
                <p>
                    <input type="file" name="update_img">
                </p>
                <p>
                    <label> Vehicle Name : </label>
                    <input type="text" name="update_name" value="<?= $fetchvehicle_name; ?>" required>
                </p>
                <p>
                    <label> Description : </label>
                    <input type="text" name="update_description" value="<?= $fetchDescription; ?>" required>
                </p>
                <br>
                <p>
                    <input type="submit" value="Update Details" name="update_details">
                </p>
            </form>
        </div>

        <!-- update_message -->
        <div class="update_message" style="display: <?= $update_message; ?>;">
            <div class="update_message_box">
                <p class="done"> <i class="fa-solid fa-circle-check fa-beat" style="color: #00ff33;"></i> </p>
                <h3 style="margin-bottom: 15px;"> Added a new record. </h3>
                <p> <a href="vehicle-fleet.php" onclick='clickFunction()'> Ok </a> </p>
            </div>
        </div>

        <!-- delete_message -->
        <div class="update_message" style="display: <?= $delete_message; ?>;">
            <div class="update_message_box">
                <p> <i class="fa-solid fa-trash-can fa-beat" style="color: #ff0000;"></i> </p>
                <h3 style="margin-bottom: 15px;"> The deletion is complete. </h3>
                <p> <a href="vehicle-fleet.php" onclick='clickFunction()'> Ok </a> </p>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js" integrity="sha512-QABeEm/oYtKZVyaO8mQQjePTPplrV8qoT7PrwHDJCBLqZl5UmuPi3APEcWwtTNOiH24psax69XPQtEo5dAkGcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assect/js/main.js"></script>
    <script src="../assect/js/funtions.js"></script>
</body>

</html>