<?php
session_start();
include("../includes/connection.php");
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

$service = "";
$errors = array();

if (isset($_POST['add_service'])) {
    $service = ucfirst(mysqli_real_escape_string($connection, $_POST['service']));
    $check_service = "SELECT * FROM `service` WHERE `Service` = '{$service}'";
    $check_service_result = mysqli_query($connection, $check_service);
    if (mysqli_num_rows($check_service_result) == 1) {
        $errors[] = "This service already exists.";
    } else {
        $insert_service = "INSERT INTO `service` (`Service`, `Status`) VALUES ('{$service}', 1)";
        $insert_service_result = mysqli_query($connection, $insert_service);
        if ($insert_service_result) {
            header("location: services.php?recode=updated");
        }
    }
}

// list Service 
$service_list = "SELECT * FROM `service`";
$service_list_result = mysqli_query($connection, $service_list);

if (isset($_GET['edit'])) {

    $visible = "";
    $editId = mysqli_real_escape_string($connection, $_GET['edit']);
    $editName = mysqli_real_escape_string($connection, $_GET['name']);

    $check_service_status = "SELECT  `Status` FROM `service` WHERE `ID` = {$editId}";
    $check_service_status_result = mysqli_query($connection, $check_service_status);
    if (mysqli_num_rows($check_service_status_result) == 1) {
        $fetch_service_status = mysqli_fetch_assoc($check_service_status_result);
        $s_status = $fetch_service_status['Status'];

        if ($s_status == 1) {
            $service_updare_status = "Not available";
            $service_updare_value = 0;
        } elseif ($s_status == 0) {
            $service_updare_status = "Available";
            $service_updare_value = 1;
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

    $update_avilibility = "UPDATE `service` SET `Status` = {$value} WHERE `ID` = {$updateid}";
    $update_avilibility_result = mysqli_query($connection, $update_avilibility);
    if ($update_avilibility_result) {
        header("location: services.php?recode=updated");
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
        $delete_message = "";
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
    <title> Services </title>
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
            <h3> Manage Services </h3>
        </nav>
        <br><br>

        <!-- add admins form -->
        <form method="post" class="ad-form">
            <h4 style="text-align: center;"> Add Services </h4>
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
                <input type="text" placeholder="Service" name="service" id="service" value="<?= $service ?>" required>
            </p>
            <p>
                <input type="submit" value="Add service" name="add_service">
            </p>
        </form>

        <!-- admin list -->
        <div class="notifi_area">
            <div class="notification">
                <h3 style="text-align: center;"> Services </h3>
                <div id="notification">
                    <?php
                    if (mysqli_num_rows($service_list_result) > 0) {
                        while ($setch_Services = mysqli_fetch_assoc($service_list_result)) {
                            $service_ID = $setch_Services['ID'];
                            $service_type = $setch_Services['Service'];
                            $service_status = $setch_Services['Status'];

                            if ($service_status == 1) {
                                $service_status_view = "Available";
                            } elseif ($service_status == 0) {
                                $service_status_view = "Not available";
                            }

                            echo "
                            <a href='services.php?edit={$service_ID}&name={$service_type}'>
                                <div class='msg'>
                                    <div class='img'>
                                        <i class='fa-solid fa-taxi'></i>
                                    </div>
                                    <div class='title'>
                                        <div class='title_up'>
                                            <div class='sub'>
                                                <h4> {$service_type} </h4>
                                            </div>
                                            <div>
                                                <p style='font-size: 12px;'> {$service_status_view} </p>
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
            <div class="close">
                <a href="services.php"> <i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i> </a>
            </div>
            <div class="editbox">
                <h2> <?= $editName; ?> </h2>
                <div>
                    <p>
                        <a href="delete.php?delete_service_type=<?= $editId; ?>" style="background-color: red;" onclick="clickFunction()">DELETE</a>
                    </p>
                    <p>
                        <a href="services.php?update_validate=<?= $service_updare_value; ?>&updateid=<?= $editId; ?>" onclick="clickFunction()"><?= $service_updare_status; ?></a>
                    </p>
                </div>
            </div>
        </div>

        <!-- update_message -->
        <div class="update_message" style="display: <?= $update_message; ?>;">
            <div class="update_message_box">
                <p class="done"> <i class="fa-solid fa-circle-check fa-beat" style="color: #00ff33;"></i> </p>
                <h3 style="margin-bottom: 15px;"> The task is complete. </h3>
                <p> <a href="services.php" onclick='clickFunction()'> Ok </a> </p>
            </div>
        </div>

        <!-- delete_message -->
        <div class="update_message" style="display: <?= $delete_message; ?>;">
            <div class="update_message_box">
                <p> <i class="fa-solid fa-trash-can fa-beat" style="color: #ff0000;"></i> </p>
                <h3 style="margin-bottom: 15px;"> The deletion is complete. </h3>
                <p> <a href="services.php" onclick='clickFunction()'> Ok </a> </p>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js" integrity="sha512-QABeEm/oYtKZVyaO8mQQjePTPplrV8qoT7PrwHDJCBLqZl5UmuPi3APEcWwtTNOiH24psax69XPQtEo5dAkGcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assect/js/main.js"></script>
    <script src="../assect/js/funtions.js"></script>
</body>

</html>