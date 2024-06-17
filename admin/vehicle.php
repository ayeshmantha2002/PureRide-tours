<?php
session_start();
include("../includes/connection.php");
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

$vehicle = "";
$errors = array();

if (isset($_POST['add_vehicle'])) {
    $vehicle = ucfirst(mysqli_real_escape_string($connection, $_POST['vehicle']));
    $check_vehicle = "SELECT * FROM `vehicle_type` WHERE `Vehicle` = '{$vehicle}'";
    $check_vehicle_result = mysqli_query($connection, $check_vehicle);
    if (mysqli_num_rows($check_vehicle_result) == 1) {
        $errors[] = "This vehicle already exists.";
    } else {
        $insert_vehicle = "INSERT INTO `vehicle_type` (`Vehicle`, `Status`) VALUES ('{$vehicle}', 1)";
        $insert_vehicle_result = mysqli_query($connection, $insert_vehicle);
        if ($insert_vehicle_result) {
            header("location: vehicle.php?recode=updated");
        }
    }
}

// list vehicles 
$vehicle_list = "SELECT * FROM `vehicle_type`";
$vehicle_list_result = mysqli_query($connection, $vehicle_list);

if (isset($_GET['edit'])) {

    $visible = "";
    $editId = mysqli_real_escape_string($connection, $_GET['edit']);
    $editName = mysqli_real_escape_string($connection, $_GET['name']);

    $check_vehicle_status = "SELECT  `Status` FROM `vehicle_type` WHERE `ID` = {$editId}";
    $check_vehicle_status_result = mysqli_query($connection, $check_vehicle_status);
    if (mysqli_num_rows($check_vehicle_status_result) == 1) {
        $fetch_vehicle_status = mysqli_fetch_assoc($check_vehicle_status_result);
        $v_status = $fetch_vehicle_status['Status'];

        if ($v_status == 1) {
            $vehicle_updare_status = "Not available";
            $vehicle_updare_value = 0;
        } elseif ($v_status == 0) {
            $vehicle_updare_status = "Available";
            $vehicle_updare_value = 1;
        }
    }
} else {
    $visible = "none";
    $editId = "";
    $editName = "";
}

// update avilibility
if (isset($_GET['update_validate'])) {
    $value = mysqli_real_escape_string($connection, $_GET['update_validate']);
    $updateid = mysqli_real_escape_string($connection, $_GET['updateid']);

    $update_avilibility = "UPDATE `vehicle_type` SET `Status` = {$value} WHERE `ID` = {$updateid}";
    $update_avilibility_result = mysqli_query($connection, $update_avilibility);
    if ($update_avilibility_result) {
        header("location: vehicle.php?recode=updated");
    }
}

// update_message
if (isset($_GET['recode'])) {
    if ($_GET['recode'] == "updated") {
        $update_message = "";
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
        .mobile_area {
            height: 100vh;
        }

        .notifi_area {
            height: calc(100% - 220px);
        }

        .notification {
            height: calc(100% - 20px);
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
            <h3> Manage Vehicle Types </h3>
        </nav>
        <br><br>

        <!-- add admins form -->
        <form method="post" class="ad-form">
            <h4 style="text-align: center;"> Add Vehicle Type </h4>
            <p style="color: red; text-align: center;">
                <?php
                if (!empty($errors)) {
                    foreach ($errors as $errors) {
                        echo $errors;
                    }
                }
                ?>
            </p>
            <p>
                <input type="text" placeholder="Vehicle type" name="vehicle" id="vehicle" value="<?= $vehicle ?>" required>
            </p>
            <p>
                <input type="submit" value="Add Vehicle" name="add_vehicle">
            </p>
        </form>

        <!-- admin list -->
        <div class="notifi_area">
            <div class="notification">
                <h3 style="text-align: center;"> Vehicles </h3>
                <div id="notification">
                    <?php
                    if (mysqli_num_rows($vehicle_list_result) > 0) {
                        while ($fetch_vehicles = mysqli_fetch_assoc($vehicle_list_result)) {
                            $vehicle_ID = $fetch_vehicles['ID'];
                            $vehicle_type = $fetch_vehicles['Vehicle'];
                            $vehicle_status = $fetch_vehicles['Status'];

                            if ($vehicle_status == 1) {
                                $vehicle_status_view = "Available";
                            } elseif ($vehicle_status == 0) {
                                $vehicle_status_view = "Not available";
                            }

                            echo "
                            <a href='vehicle.php?edit={$vehicle_ID}&name={$vehicle_type}'>
                                <div class='msg'>
                                    <div class='img'>
                                        <i class='fa-solid fa-circle-dot'></i>
                                    </div>
                                    <div class='title'>
                                        <div class='title_up'>
                                            <div class='sub'>
                                                <h4> {$vehicle_type} </h4>
                                            </div>
                                            <div>
                                                <p style='font-size: 12px;'> {$vehicle_status_view} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            ";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- editbox -->
        <div class="editbox_area" style="display: <?= $visible; ?>;">
            <div class="editbox">
                <h2> <?= $editName; ?> </h2>
                <div>
                    <p>
                        <a href="delete.php?delete_vehicle_type=<?= $editId; ?>" style="background-color: red;">DELETE</a>
                    </p>
                    <p>
                        <a href="vehicle.php?update_validate=<?= $vehicle_updare_value; ?>&updateid=<?= $editId; ?>"><?= $vehicle_updare_status; ?></a>
                    </p>
                </div>
            </div>
        </div>

        <!-- update_message -->
        <div class="update_message" style="display: <?= $update_message; ?>;">
            <div class="update_message_box">
                <p class="done"> <i class="fa-solid fa-circle-check fa-beat" style="color: #00ff33;"></i> </p>
                <h3 style="margin-bottom: 15px;"> The task is complete. </h3>
                <p> <a href="vehicle.php"> Ok </a> </p>
            </div>
        </div>

        <!-- delete_message -->
        <div class="update_message" style="display: <?= $delete_message; ?>;">
            <div class="update_message_box">
                <p> <i class="fa-solid fa-trash-can fa-beat" style="color: #ff0000;"></i> </p>
                <h3 style="margin-bottom: 15px;"> The deletion is complete. </h3>
                <p> <a href="vehicle.php"> Ok </a> </p>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js" integrity="sha512-QABeEm/oYtKZVyaO8mQQjePTPplrV8qoT7PrwHDJCBLqZl5UmuPi3APEcWwtTNOiH24psax69XPQtEo5dAkGcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assect/js/main.js"></script>
    <script src="../assect/js/funtions.js"></script>
</body>

</html>