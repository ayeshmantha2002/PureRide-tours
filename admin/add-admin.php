<?php
session_start();
include("../includes/connection.php");
if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
} elseif (!isset($_SESSION['ID'])) {
    header("location: login.php?login_first");
}

$today = date("Y-m-d");

$Fname = "";
$Lname = "";
$Uname = "";
$Pword = "";
$errors = array();

if (isset($_POST['add_addmin'])) {
    $Fname = ucfirst(mysqli_real_escape_string($connection, $_POST['Fname']));
    $Lname = ucfirst(mysqli_real_escape_string($connection, $_POST['Lname']));
    $Uname = mysqli_real_escape_string($connection, $_POST['Uname']);
    $Pword = mysqli_real_escape_string($connection, $_POST['Pword']);
    $hash_pass = sha1($Pword);

    $chech_user = "SELECT * FROM `admins` WHERE `Username` = '{$Uname}'";
    $chech_user_result = mysqli_query($connection, $chech_user);
    if (mysqli_num_rows($chech_user_result) == 1) {
        $errors[] = "Username already exists.";
    } else {
        $insert_admin = "INSERT INTO `admins` (`First_name`, `Last_name`, `Username`, `Password`, `Job`, `Register_date`, `Notification`, `Status`) VALUES ('{$Fname}', '{$Lname}', '{$Uname}', '{$hash_pass}', 'ADMIN', '{$today}', 1, 1)";
        $insert_admin_result = mysqli_query($connection, $insert_admin);
        if ($insert_admin_result) {
            header("location: add-admin.php?recode=updated");
        }
    }
}

// admins list 
$admins = "SELECT * FROM `admins`";
$admins_result = mysqli_query($connection, $admins);

if (isset($_GET['admin_id'])) {
    $edit_id = mysqli_real_escape_string($connection, $_GET['admin_id']);

    $chech_status = "SELECT `Status` FROM `admins` WHERE `ID` = {$edit_id}";
    $chech_status_result = mysqli_query($connection, $chech_status);
    if (mysqli_num_rows($chech_status_result) == 1) {
        $fetch_check = mysqli_fetch_assoc($chech_status_result);
        $check_status = $fetch_check['Status'];
        if ($check_status == 1) {
            $button = "<input type='submit' onclick='clickFunction()' value='Deactivert' name='deactivet'>";
        } elseif ($check_status == 2) {
            $button = "<input type='submit' onclick='clickFunction()' value='Activert' name='activet'>";
        }
    }
    $display = "flex";
} else {
    $edit_id = "";
    $display = "none";
}

if (isset($_POST['deactivet'])) {
    $deactivet_id = mysqli_real_escape_string($connection, $_POST['edit_id']);
    $update_deactivet = "UPDATE `admins` SET `Status` = 2 WHERE `ID` = {$deactivet_id}";
    $update_deactivet_result = mysqli_query($connection, $update_deactivet);
    if ($update_deactivet_result) {
        header("location: add-admin.php?recode=updated");
    }
}

if (isset($_POST['activet'])) {
    $activet_id = mysqli_real_escape_string($connection, $_POST['edit_id']);
    $update_activet = "UPDATE `admins` SET `Status` = 1 WHERE `ID` = {$activet_id}";
    $update_activet_result = mysqli_query($connection, $update_activet);
    if ($update_activet_result) {
        header("location: add-admin.php?recode=updated");
    }
}

if (isset($_POST['delete'])) {
    $delete_id = mysqli_real_escape_string($connection, $_POST['edit_id']);
    $update_delete = "DELETE FROM `admins` WHERE `ID` = {$delete_id}";
    $update_delete_result = mysqli_query($connection, $update_delete);
    if ($update_delete_result) {
        header("location: add-admin.php?delete=done");
    }
}


// admins owner feachurs 
$admins_job = "SELECT * FROM `admins` WHERE `ID` = {$_SESSION['ID']} AND `Job` = 'OWNER'";
$admins_job_result = mysqli_query($connection, $admins_job);
if (mysqli_num_rows($admins_job_result) == 1) {
    $disabled = "";
    $display_edit = "flex";
} else {
    $disabled = "disabled";
    $display_edit = "none";
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
        .mobile_area {
            height: 100vh;
        }

        .notifi_area {
            height: calc(100% - 320px);
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
            <h3> Manage Admins </h3>
        </nav>
        <br><br>

        <!-- add admins form -->
        <form method="post" class="ad-form">
            <h4 style="text-align: center;"> Add Admin </h4>
            <p style="color: red; text-align: center;">
                <?php
                if (!empty($errors)) {
                    foreach ($errors as $errors) {
                        echo $errors;
                    }
                }
                ?>
            </p>
            <div class="double">
                <p>
                    <input type="text" placeholder="First Name" name="Fname" id="Fname" value="<?= $Fname ?>" required <?= $disabled; ?>>
                </p>
                <p>
                    <input type="text" placeholder="Last Name" name="Lname" id="Lname" value="<?= $Lname ?>" required <?= $disabled; ?>>
                </p>
            </div>
            <p>
                <input type="text" placeholder="Username" name="Uname" id="Uname" value="<?= $Uname ?>" required <?= $disabled; ?>>
            </p>
            <p>
                <input type="text" placeholder="Password" name="Pword" id="Pword" value="<?= $Pword ?>" required <?= $disabled; ?>>
            </p>
            <p>
                <input type="submit" value="Register" name="add_addmin" <?= $disabled; ?>>
            </p>
        </form>

        <!-- admin list -->
        <div class="notifi_area">
            <div class="notification">
                <h3 style="text-align: center;"> Admins </h3>
                <div id="notification">
                    <?php
                    if (mysqli_num_rows($admins_result) > 0) {
                        while ($fetch_admins = mysqli_fetch_assoc($admins_result)) {
                            $admin_ID = $fetch_admins['ID'];
                            $admin_First_name = $fetch_admins['First_name'];
                            $admin_Last_name = $fetch_admins['Last_name'];
                            $admin_Username = $fetch_admins['Username'];
                            $admin_Job = $fetch_admins['Job'];
                            $admin_Register_date = $fetch_admins['Register_date'];

                            echo "
                                <a href='add-admin.php?admin_id={$admin_ID}'>
                                    <div class='msg'>
                                        <div class='img'>
                                            <i class='fa-solid fa-user-tie'></i>
                                        </div>
                                        <div class='title'>
                                            <div class='title_up'>
                                                <div class='sub'>
                                                    <h4> {$admin_First_name} {$admin_Last_name} </h4>
                                                </div>
                                                <div>
                                                    <p style='font-size: 12px;'> {$admin_Job} </p>
                                                </div>
                                            </div>
                                            <div class='title_down'>
                                                <p> {$admin_Username} <br> Reg:Date - {$admin_Register_date} </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            ";
                        }
                    }
                    ?>
                </div>
                <div style="display: <?= $display_edit; ?>;">
                    <section class="edit_id" style="display: <?= $display; ?>;">
                        <div class="close">
                            <a href="add-admin.php"> <i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i> </a>
                        </div>
                        <form method="post">
                            <p> <input type="number" name="edit_id" value="<?= $admin_ID; ?>" hidden> </p>
                            <p> <?= $button; ?> </p>
                            <br>
                            <p> <input type="submit" style="background-color: #ff0000;" value="Delete Admin" name="delete"> </p>
                        </form>
                    </section>
                </div>
            </div>
        </div>

        <!-- update_message -->
        <div class="update_message" style="display: <?= $update_message; ?>;">
            <div class="update_message_box">
                <p class="done"> <i class="fa-solid fa-circle-check fa-beat" style="color: #00ff33;"></i> </p>
                <h3 style="margin-bottom: 15px;"> Added a new record. </h3>
                <p> <a href="add-admin.php" onclick='clickFunction()'> Ok </a> </p>
            </div>
        </div>

        <!-- delete_message -->
        <div class="update_message" style="display: <?= $delete_message; ?>;">
            <div class="update_message_box">
                <p> <i class="fa-solid fa-trash-can fa-beat" style="color: #ff0000;"></i> </p>
                <h3 style="margin-bottom: 15px;"> The deletion is complete. </h3>
                <p> <a href="add-admin.php" onclick='clickFunction()'> Ok </a> </p>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js" integrity="sha512-QABeEm/oYtKZVyaO8mQQjePTPplrV8qoT7PrwHDJCBLqZl5UmuPi3APEcWwtTNOiH24psax69XPQtEo5dAkGcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assect/js/main.js"></script>
    <script src="../assect/js/funtions.js"></script>
</body>

</html>