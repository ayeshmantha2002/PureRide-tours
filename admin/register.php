<?php
include("../includes/connection.php");
$errors = array();
$today = date("Y-m-d");

$check_Admins = "SELECT * FROM `admins`";
$check_Admins_result = mysqli_query($connection, $check_Admins);
if (mysqli_num_rows($check_Admins_result) > 0) {
    header("location: login.php");
} else {
    $First_Name = "";
    $Last_Name = "";
    $username = "";
    $password = "";
    $C_password = "";

    if (isset($_POST['reg'])) {
        $First_Name = ucfirst(mysqli_real_escape_string($connection, $_POST['fname']));
        $Last_Name = ucfirst(mysqli_real_escape_string($connection, $_POST['lname']));
        $username = mysqli_real_escape_string($connection, $_POST['uname']);
        $password = mysqli_real_escape_string($connection, $_POST['pass']);
        $C_password = mysqli_real_escape_string($connection, $_POST['cpass']);
        $hash_password = sha1($password);

        if ($password != $C_password) {
            $errors[] = "The password and the confirmation password do not match.";
        } else {
            $insert_admin = "INSERT INTO `admins` (`First_name`, `Last_name`, `Username`, `Password`, `Job`, `Register_date`, `Notification`, `Status`) VALUES ('{$First_Name}', '{$Last_Name}', '{$username}', '{$hash_password}', 'OWNER', '{$today}', 1, 1)";
            $insert_admin_result = mysqli_query($connection, $insert_admin);

            if ($insert_admin_result) {
                header("location: login.php?register=done");
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>
    <link rel="stylesheet" href="../assect/css/admin.css">
</head>

<body>
    <section class="login">
        <!-- login form  -->
        <form method="post">
            <h2> Admin Register Form </h2>
            <br>
            <div style="color: red; text-align: center;">
                <?php
                if (!empty($errors)) {
                    foreach ($errors as $errors) {
                        echo $errors;
                    }
                }
                ?>
            </div>
            <br>
            <p>
                <label for="First_Name">First Name :</label>
                <input type="text" name="fname" placeholder="First Name" id="First_Name" value="<?= $First_Name; ?>" required>
            </p>
            <br>
            <p>
                <label for="Last_Name">Last Name :</label>
                <input type="text" name="lname" placeholder="Last Name" id="Last_Name" value="<?= $Last_Name; ?>" required>
            </p>
            <br>
            <p>
                <label for="username">Username :</label>
                <input type="text" name="uname" placeholder="Username" id="username" value="<?= $username; ?>" required>
            </p>
            <br>
            <p>
                <label for="pass">Password :</label>
                <input type="password" name="pass" id="pass" placeholder="Password" value="<?= $password; ?>" required>
            </p>
            <br>
            <p>
                <input type="password" name="cpass" id="cpass" placeholder="Confirm Password" value="<?= $C_password; ?>" required>
            </p>
            <br>
            <p>
                <input type="submit" value="Register" name="reg">
            </p>
        </form>
    </section>
</body>

</html>