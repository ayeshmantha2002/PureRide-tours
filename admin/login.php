<?php
session_start();
include("../includes/connection.php");
$errors = array();
$today = date("Y-m-d");

$uname = "";
$pass = "";

if (isset($_COOKIE['ID'])) {
    $_SESSION['ID'] = $_COOKIE['ID'];
}

if (isset($_POST['log'])) {
    $uname = mysqli_real_escape_string($connection, $_POST['uname']);
    $pass = mysqli_real_escape_string($connection, $_POST['pass']);
    $has_pass = sha1($pass);

    $check_user = "SELECT * FROM `admins` WHERE `Username` = '{$uname}' AND `Password` = '{$has_pass}' AND `Status` = 1";
    $check_user_result = mysqli_query($connection, $check_user);
    if (mysqli_num_rows($check_user_result) == 1) {
        $user_details = mysqli_fetch_assoc($check_user_result);
        $ID = $user_details['ID'];

        if (isset($_POST['rem'])) {
            setcookie('ID', $ID, time() + 60 * 60 * 24);
        }
        $_SESSION['ID'] = $ID;
        header("location: admin.php");
    } else {
        $errors[] = "Incorrect User name or Password.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assect/css/admin.css">
</head>

<body>
    <section class="login">
        <!-- login form  -->
        <form method="post">
            <h2> Admin Login </h2>
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
                <label for="username">Username :</label>
                <input type="text" name="uname" placeholder="Username" id="username" required>
            </p>
            <br>
            <p>
                <label for="pass">Password :</label>
                <input type="password" name="pass" id="pass" placeholder="Password" required>
            </p>
            <br>
            <p>
                <input type="checkbox" value="Remember" id="rem" name="rem">
                <label for="rem" style="cursor: pointer;"> : Remember me </label>
            </p>
            <br>
            <p>
                <input type="submit" value="Login" name="log">
            </p>
        </form>
    </section>
</body>

</html>