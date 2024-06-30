<?php
session_start();
include("../includes/connection.php");
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

// Add tours 
if (isset($_POST['add_tours'])) {
    $fileName = $_FILES['place_img']['name'];
    $fileTemp = $_FILES['place_img']['tmp_name'];
    $fileSize = $_FILES['place_img']['size'];
    $fileType = $_FILES['place_img']['type'];

    $tours_from = mysqli_real_escape_string($connection, $_POST['from']);
    $tours_to = mysqli_real_escape_string($connection, $_POST['to']);
    $tours_distance = mysqli_real_escape_string($connection, $_POST['distance']);
    $tours_duration = mysqli_real_escape_string($connection, $_POST['duration']);
    $tours_price = mysqli_real_escape_string($connection, $_POST['price']);
    $tours_description_one = mysqli_real_escape_string($connection, $_POST['description_one']);
    $tours_description_tow = mysqli_real_escape_string($connection, $_POST['description_tow']);
    $tours_description_three = mysqli_real_escape_string($connection, $_POST['description_three']);

    $upload_to = "../assect/img/";

    $uploadIMage = move_uploaded_file($fileTemp, $upload_to . $fileName);

    if ($uploadIMage) {
        $upload_tours = "INSERT INTO `tours` (`Pic`, `P_From`, `P_To`, `Distance`, `Duration`, `Description_one`, `Description_tow`, `Description_three`, `Price`, `Status`) VALUES ('{$fileName}', '{$tours_from}', '{$tours_to}', '{$tours_distance}KM', '{$tours_duration} Hours', '{$tours_description_one}', '{$tours_description_tow}', '{$tours_description_three}', '{$tours_price}', 1)";
        $upload_tours_result = mysqli_query($connection, $upload_tours);
        if ($upload_tours_result) {
            header("location: tours.php?recode=updated");
        }
    }
}

if (isset($_GET['edit_id'])) {
    $display = "flex";
    $edit_id = mysqli_real_escape_string($connection, $_GET['edit_id']);
    $edit_tours = "SELECT * FROM `tours` WHERE `ID` = {$edit_id}";
    $edit_tours_result = mysqli_query($connection, $edit_tours);
    if (mysqli_num_rows($edit_tours_result) == 1) {
        $fetch_tours = mysqli_fetch_assoc($edit_tours_result);
        $old_P_From = $fetch_tours['P_From'];
        $old_P_To = $fetch_tours['P_To'];
        $old_Distance = $fetch_tours['Distance'];
        $old_Duration = $fetch_tours['Duration'];
        $old_Description_one = $fetch_tours['Description_one'];
        $old_Description_tow = $fetch_tours['Description_tow'];
        $old_Description_three = $fetch_tours['Description_three'];
        $old_Price = $fetch_tours['Price'];
    } else {
        $old_P_From = "";
        $old_P_To = "";
        $old_Distance = "";
        $old_Duration = "";
        $old_Description_one = "";
        $old_Description_tow = "";
        $old_Description_three = "";
        $old_Price = "";
    }
} else {
    $display = "none";
}

if (isset($_POST['edit_submit'])) {
    $new_P_From = mysqli_real_escape_string($connection, $_POST['from']);
    $new_P_To = mysqli_real_escape_string($connection, $_POST['To']);
    $new_Distance = mysqli_real_escape_string($connection, $_POST['Distance']);
    $new_Duration = mysqli_real_escape_string($connection, $_POST['Duration']);
    $new_Description_one = mysqli_real_escape_string($connection, $_POST['Description_one']);
    $new_Description_tow = mysqli_real_escape_string($connection, $_POST['Description_tow']);
    $new_Description_three = mysqli_real_escape_string($connection, $_POST['Description_three']);
    $new_Price = mysqli_real_escape_string($connection, $_POST['Price']);

    $update_tours = "UPDATE `tours` SET `P_From` = '{$new_P_From}', `P_To` = '{$new_P_To}', `Distance` = '{$new_Distance}', `Duration` = '{$new_Duration}', `Description_one` = '{$new_Description_one}', `Description_tow` = '{$new_Description_tow}', `Description_three` = '{$new_Description_three}', `Price` = '{$new_Price}' WHERE `ID` = {$edit_id}";
    $update_tours_result = mysqli_query($connection, $update_tours);
    if ($update_tours_result) {
        header("location: tours.php?recode=updated");
    } else {
        header("location: tours.php?recode=error");
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
    <title>Add admins</title>
    <link rel="stylesheet" href="../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .fleet_view {
            height: calc(100vh - 50px);
            display: block;
        }
    </style>
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
            <h3> Manage Tours </h3>
        </nav>
        <br><br>
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
                    <label for="place_img"> Location Image : </label>
                    <br>
                    <label for="place_img" style="color: red;"> 5:3 aspect ratio required </label>
                    <input type="file" name="place_img" id="place_img" required>
                </p>
                <p>
                    <label for="from"> From : </label>
                    <input type="text" placeholder="From" name="from" required>
                </p>
                <p>
                    <label for="to"> To : </label>
                    <input type="text" placeholder="To" name="to" required>
                </p>
                <p>
                    <label for="distance"> Distance : </label>
                    <input type="text" placeholder="Distance" name="distance" required>
                </p>
                <p>
                    <label for="duration"> Duration : </label>
                    <input type="number" placeholder="Duration" name="duration" required>
                </p>
                <p>
                    <label for="price"> Price : </label>
                    <input type="number" placeholder="Price" name="price" required>
                </p>
                <p>
                    <label for="Description_tow"> Description_one : </label>
                    <textarea placeholder="Description_one" name="description_one" required></textarea>
                </p>
                <p>
                    <label for="description_tow"> Description_tow : </label>
                    <textarea placeholder="Description_tow" name="description_tow"></textarea>
                </p>
                <p>
                    <label for="description_three"> Description_three : </label>
                    <textarea placeholder="Description_three" name="description_three"></textarea>
                </p>
                <p>
                    <input type="submit" name="add_tours" value="Upload">
                </p>
            </form>
            <br>

            <div class="fleet_list">
                <?php
                $tours_list = "SELECT * FROM `tours`";
                $tours_list_result = mysqli_query($connection, $tours_list);
                if (mysqli_num_rows($tours_list_result) > 0) {
                    while ($fetch_list = mysqli_fetch_assoc($tours_list_result)) {
                        $list_tours_id = $fetch_list['ID'];
                        $list_tours_Pic = $fetch_list['Pic'];
                        $list_tours_P_From = $fetch_list['P_From'];
                        $list_tours_P_To = $fetch_list['P_To'];
                        $list_tours_Distance = $fetch_list['Distance'];
                        $list_tours_Duration = $fetch_list['Duration'];
                        $list_tours_Description_one = $fetch_list['Description_one'];
                        $list_tours_Description_tow = $fetch_list['Description_tow'];
                        $list_tours_Description_three = $fetch_list['Description_three'];
                        $list_tours_Price = $fetch_list['Price'];
                        $list_tours_Status = $fetch_list['Status'];

                        echo "
                        <div class='fleet_list_aling'>
                            <div class='img'>
                                <img src='../assect/img/{$list_tours_Pic}' alt='fleet'>
                            </div>
                            <div class='details'>
                                <h4 style='text-align: center;'> {$list_tours_P_From} to {$list_tours_P_To} </h4>
                                <br>
                                <p> Distance : {$list_tours_Distance} </p>
                                <p> Duration : {$list_tours_Duration} </p>
                                <p> Price : LKR {$list_tours_Price} </p>
                                <p> : {$list_tours_Description_one} </p>
                                <p> : {$list_tours_Description_tow} </p>
                                <p> : {$list_tours_Description_three} </p>
                                <div class='links'>
                                    <a href='tours.php?edit_id={$list_tours_id}' onclick='clickFunction()'> EDIT </a>

                                    <a href='delete.php?delete_tours_id={$list_tours_id}&image_name={$list_tours_Pic}' onclick='clickFunction()' style='background-color: red;'> DELETE </a>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                }
                ?>
            </div>
        </div>

        <section class="edit_tours" style="display: <?= $display; ?>;">
            <div class="close">
                <a href="tours.php"> <i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i> </a>
            </div>

            <form method="post">
                <h3> Edit </h3>
                <br>
                <p>
                    <label for="form"> From :</label>
                    <input type="text" value="<?= $old_P_From ?>" placeholder="From" name="from" id="from" required>
                </p>
                <p>
                    <label for="form"> To :</label>
                    <input type="text" value="<?= $old_P_To ?>" placeholder="To" name="To" id="To" required>
                </p>
                <p>
                    <label for="form"> Distance :</label>
                    <input type="text" value="<?= $old_Distance ?>" placeholder="Distance" name="Distance" id="Distance" required>
                </p>
                <p>
                    <label for="form"> Duration :</label>
                    <input type="text" value="<?= $old_Duration ?>" placeholder="Duration" name="Duration" id="Duration" required>
                </p>
                <p>
                    <label for="form"> Price :</label>
                    <input type="text" value="<?= $old_Price ?>" placeholder="Price" name="Price" id="Price" required>
                </p>
                <p>
                    <label for="form"> Description_one :</label>
                    <input type="text" value="<?= $old_Description_one ?>" placeholder="Description_one" name="Description_one" id="Description_one" required>
                </p>
                <p>
                    <label for="form"> Description_tow :</label>
                    <input type="text" value="<?= $old_Description_tow ?>" placeholder="Description_tow" name="Description_tow" id="Description_tow">
                </p>
                <p>
                    <label for="form"> Description_three :</label>
                    <input type="text" value="<?= $old_Description_three ?>" placeholder="Description_three" name="Description_three" id="Description_three">
                </p>
                <br>
                <p>
                    <input type="submit" value="Update" name="edit_submit">
                </p>
            </form>
        </section>

        <!-- update_message -->
        <div class="update_message" style="display: <?= $update_message; ?>;">
            <div class="update_message_box">
                <p class="done"> <i class="fa-solid fa-circle-check fa-beat" style="color: #00ff33;"></i> </p>
                <h3 style="margin-bottom: 15px;"> Added a new record. </h3>
                <p> <a href="tours.php" onclick="clickFunction()"> Ok </a> </p>
            </div>
        </div>

        <!-- delete_message -->
        <div class="update_message" style="display: <?= $delete_message; ?>;">
            <div class="update_message_box">
                <p> <i class="fa-solid fa-trash-can fa-beat" style="color: #ff0000;"></i> </p>
                <h3 style="margin-bottom: 15px;"> The deletion is complete. </h3>
                <p> <a href="tours.php" onclick="clickFunction()"> Ok </a> </p>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js" integrity="sha512-QABeEm/oYtKZVyaO8mQQjePTPplrV8qoT7PrwHDJCBLqZl5UmuPi3APEcWwtTNOiH24psax69XPQtEo5dAkGcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assect/js/main.js"></script>
    <script src="../assect/js/funtions.js"></script>
</body>

</html>