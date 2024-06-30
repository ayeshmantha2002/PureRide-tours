<?php
session_start();
include("../includes/connection.php");
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

if (isset($_POST['baner_input'])) {
    $fileName_desktop = $_FILES['desktop_img']['name'];
    $fileTemp_desktop = $_FILES['desktop_img']['tmp_name'];
    $fileSize_desktop = $_FILES['desktop_img']['size'];
    $fileType_desktop = $_FILES['desktop_img']['type'];

    $fileName_mobile = $_FILES['mobile_img']['name'];
    $fileTemp_mobile = $_FILES['mobile_img']['tmp_name'];
    $fileSize_mobile = $_FILES['mobile_img']['size'];
    $fileType_mobile = $_FILES['mobile_img']['type'];

    $hedding = mysqli_real_escape_string($connection, $_POST['hedding']);
    $details = mysqli_real_escape_string($connection, $_POST['details']);

    $upload_to = "../assect/img/";

    $desktop_uploadIMage = move_uploaded_file($fileTemp_desktop, $upload_to . $fileName_desktop);
    $mobile_uploadIMage = move_uploaded_file($fileTemp_mobile, $upload_to . $fileName_mobile);

    if ($desktop_uploadIMage && $mobile_uploadIMage) {
        $insert_banner = "INSERT INTO `banner` (`Image_name`, `Mobile_image`, `Hedding`, `Description`, `Status`) VALUES ('{$fileName_desktop}', '{$fileName_mobile}', '{$hedding}', '{$details}', 1)";
        $insert_banner_result = mysqli_query($connection, $insert_banner);
        if ($insert_banner_result) {
            header("location: banner.php?recode=updated");
        } else {
            header("location: banner.php?recode=error");
        }
    }
}

// edit form display
if (isset($_GET['edit_id'])) {
    $edit_id = mysqli_real_escape_string($connection, $_GET['edit_id']);
    $banner_details = "SELECT * FROM `banner` WHERE `ID` = {$edit_id}";
    $banner_details_result = mysqli_query($connection, $banner_details);
    if (mysqli_num_rows($banner_details_result) == 1) {
        $banner_details_fetch = mysqli_fetch_assoc($banner_details_result);
        $fetch_ID = $banner_details_fetch['ID'];
        $fetch_hedding = $banner_details_fetch['Hedding'];
        $fetch_Description = $banner_details_fetch['Description'];
    } else {
        header("location: banner.php");
    }
    $display = "flex";
} else {
    $display = "none";
    $fetch_hedding = "";
    $fetch_Description = "";
    $fetch_ID = "";
}

// update message
if (isset($_POST['update_banner'])) {
    $update_id = mysqli_real_escape_string($connection, $_POST['id']);
    $update_hedding = mysqli_real_escape_string($connection, $_POST['hedding']);
    $update_Description = mysqli_real_escape_string($connection, $_POST['Description']);

    $update_banner = "UPDATE `banner` SET `Hedding` = '{$update_hedding}', `Description` = '{$update_Description}' WHERE `ID` = {$update_id}";
    $update_banner_result = mysqli_query($connection, $update_banner);

    if ($update_banner_result) {
        header("location: banner.php?recode=updated");
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
    <title> Manage Banner </title>
    <link rel="stylesheet" href="../assect/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        form {
            width: 100%;
            padding: 15px;
            box-sizing: border-box;
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
            <h3> Manage Banner </h3>
        </nav>
        <br><br>

        <section class="mobile_area">
            <form method="post" enctype="multipart/form-data">
                <h2> Add Banner </h2>
                <p>
                    <label for="desktop_img"> Desktop View Image : </label>
                    <br>
                    <label for="desktop_img" style="color: red;"> 8:3 aspect ratio required </label>
                    <input type="file" id="desktop_img" name="desktop_img" required>
                </p>
                <br>
                <p>
                    <label for="mobile_img"> Mobile View Image : </label>
                    <br>
                    <label for="mobile_img" style="color: red;"> 4:3 aspect ratio required </label>
                    <input type="file" id="mobile_img" name="mobile_img" required>
                </p>
                <br>
                <p>
                    <label for="hedding"> Hedding : </label>
                    <input type="text" name="hedding" id="hedding" placeholder="Hedding" required>
                </p>
                <p>
                    <label for="details"> Details : </label>
                    <input type="text" placeholder="Details" name="details" id="details" required>
                </p>
                <br>
                <p>
                    <input type="submit" name="baner_input" value="Upload">
                </p>
            </form>
            <br>
            <div style="padding: 10px; box-sizing: border-box;">
                <?php
                $banner_list = "SELECT * FROM `banner` WHERE `Status` = 1";
                $banner_list_result = mysqli_query($connection, $banner_list);
                if (mysqli_num_rows($banner_list_result) > 0) {
                    while ($banner_list_fetch = mysqli_fetch_assoc($banner_list_result)) {
                        $ID = $banner_list_fetch['ID'];
                        $Image_name = $banner_list_fetch['Image_name'];
                        $Mobile_image = $banner_list_fetch['Mobile_image'];
                        $Hedding = $banner_list_fetch['Hedding'];
                        $Description = $banner_list_fetch['Description'];

                        echo "
                        <div class='fleet_list'>
                            <div class='fleet_list_aling'>
                                <div class='img'>
                                    <img class='lazy' data-original='../assect/img/{$Image_name}' alt='Banner'>
                                </div>
                                <div class='details'>
                                    <h4> {$Hedding} </h4>
                                    <p> {$Description} </p>
                                    <div class='links'>
                                        <a href='banner.php?edit_id={$ID}' onclick='clickFunction()'> EDIT </a>
                                        <a href='delete.php?delete_banner={$ID}&image_name={$Image_name}&mobile_image={$Mobile_image}' onclick='clickFunction()' style='background-color: red;'> DELETE </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <br>
                        ";
                    }
                }
                ?>
            </div>

            <!-- edit form -->
            <section class="edit_section" style="display: <?= $display; ?>;">
                <form method="post">
                    <div class="close">
                        <a href="banner.php"> <i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i> </a>
                    </div>
                    <br>
                    <h3 style="text-align: center;"> Edit Banner Details </h3>
                    <br>
                    <p>
                        <input type="number" name="id" value="<?= $fetch_ID; ?>" hidden>
                    </p>
                    <p>
                        <label for="hedding"> Hedding : </label>
                        <input type="text" id="hedding" name="hedding" value="<?= $fetch_hedding; ?>" placeholder="Hedding" required>
                    </p>
                    <br>
                    <p>
                        <label for="Description"> Description : </label>
                        <input type="text" id="Description" value="<?= $fetch_Description; ?>" name="Description" placeholder="Description" required>
                    </p>
                    <br>
                    <p>
                        <input type="submit" value="Save" name="update_banner">
                    </p>
                </form>
            </section>
        </section>

        <!-- update_message -->
        <div class="update_message" style="display: <?= $update_message; ?>;">
            <div class="update_message_box">
                <p class="done"> <i class="fa-solid fa-circle-check fa-beat" style="color: #00ff33;"></i> </p>
                <h3 style="margin-bottom: 15px;"> Added a new record. </h3>
                <p> <a href="banner.php" onclick='clickFunction()'> Ok </a> </p>
            </div>
        </div>

        <!-- delete_message -->
        <div class="update_message" style="display: <?= $delete_message; ?>;">
            <div class="update_message_box">
                <p> <i class="fa-solid fa-trash-can fa-beat" style="color: #ff0000;"></i> </p>
                <h3 style="margin-bottom: 15px;"> The deletion is complete. </h3>
                <p> <a href="banner.php" onclick='clickFunction()'> Ok </a> </p>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js" integrity="sha512-QABeEm/oYtKZVyaO8mQQjePTPplrV8qoT7PrwHDJCBLqZl5UmuPi3APEcWwtTNOiH24psax69XPQtEo5dAkGcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assect/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js" integrity="sha512-jNDtFf7qgU0eH/+Z42FG4fw3w7DM/9zbgNPe3wfJlCylVDTT3IgKW5r92Vy9IHa6U50vyMz5gRByIu4YIXFtaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function() {
            $("img.lazy").lazyload();
        });
    </script>
    <script src="../assect/js/funtions.js"></script>
</body>

</html>