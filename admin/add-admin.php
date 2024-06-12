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
                    <input type="text" placeholder="First Name" name="Fname" id="Fname" value="<?= $Fname ?>" required>
                </p>
                <p>
                    <input type="text" placeholder="Last Name" name="Lname" id="Lname" value="<?= $Lname ?>" required>
                </p>
            </div>
            <p>
                <input type="text" placeholder="Username" name="Uname" id="Uname" value="<?= $Uname ?>" required>
            </p>
            <p>
                <input type="text" placeholder="Password" name="Pword" id="Pword" value="<?= $Pword ?>" required>
            </p>
            <p>
                <input type="submit" value="Register" name="add_addmin">
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
                            $admin_First_name = $fetch_admins['First_name'];
                            $admin_Last_name = $fetch_admins['Last_name'];
                            $admin_Username = $fetch_admins['Username'];
                            $admin_Job = $fetch_admins['Job'];
                            $admin_Register_date = $fetch_admins['Register_date'];

                            echo "
                                <a href='#'>
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
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.min.js" integrity="sha512-QABeEm/oYtKZVyaO8mQQjePTPplrV8qoT7PrwHDJCBLqZl5UmuPi3APEcWwtTNOiH24psax69XPQtEo5dAkGcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assect/js/main.js"></script>
    <script src="../assect/js/funtions.js"></script>
</body>

</html>