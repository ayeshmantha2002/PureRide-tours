<?php
include("../includes/connection.php");

// vehicle types delete 
if (isset($_GET['delete_vehicle_type'])) {
    $delete = "DELETE FROM `vehicle_type` WHERE `ID` = {$_GET['delete_vehicle_type']}";
    $delete_result = mysqli_query($connection, $delete);
    if ($delete_result) {
        header("location: vehicle.php?delete=done");
    }
}

// service types delete 
if (isset($_GET['delete_service_type'])) {
    $delete = "DELETE FROM `service` WHERE `ID` = {$_GET['delete_service_type']}";
    $delete_result = mysqli_query($connection, $delete);
    if ($delete_result) {
        header("location: services.php?delete=done");
    }
}

// pickup_location types delete 
if (isset($_GET['delete_pickup_location_type'])) {
    $delete = "DELETE FROM `pickup_location` WHERE `ID` = {$_GET['delete_pickup_location_type']}";
    $delete_result = mysqli_query($connection, $delete);
    if ($delete_result) {
        header("location: pickup-locations.php?delete=done");
    }
}


// Banner delete 
if (isset($_GET['delete_banner'])) {
    $parth_one = "../assect/img/{$_GET['image_name']}";
    $parth_tow = "../assect/img/{$_GET['mobile_image']}";
    if (unlink($parth_one) && unlink($parth_tow)) {
        $delete = "DELETE FROM `banner` WHERE `ID` = {$_GET['delete_banner']}";
        $delete_result = mysqli_query($connection, $delete);
        if ($delete_result) {
            header("location: banner.php?delete=done");
        }
    } else {
        $delete = "DELETE FROM `banner` WHERE `ID` = {$_GET['delete_banner']}";
        $delete_result = mysqli_query($connection, $delete);
        if ($delete_result) {
            header("location: banner.php?delete=done");
        }
    }
}

// vehicle fleet delete 
if (isset($_GET['delete_id'])) {
    $parth = "../assect/img/{$_GET['image_name']}";
    if (unlink($parth)) {
        $delete = "DELETE FROM `fleet` WHERE `ID` = {$_GET['delete_id']}";
        $delete_result = mysqli_query($connection, $delete);
        if ($delete_result) {
            header("location: vehicle-fleet.php?delete=done");
        }
    } else {
        $delete = "DELETE FROM `fleet` WHERE `ID` = {$_GET['delete_id']}";
        $delete_result = mysqli_query($connection, $delete);
        if ($delete_result) {
            header("location: vehicle-fleet.php?delete=done");
        }
    }
}

// tours delete 
if (isset($_GET['delete_tours_id'])) {
    $parth = "../assect/img/{$_GET['image_name']}";
    if (unlink($parth)) {
        $delete = "DELETE FROM `tours` WHERE `ID` = {$_GET['delete_tours_id']}";
        $delete_result = mysqli_query($connection, $delete);
        if ($delete_result) {
            header("location: tours.php?delete=done");
        }
    } else {
        $delete = "DELETE FROM `tours` WHERE `ID` = {$_GET['delete_tours_id']}";
        $delete_result = mysqli_query($connection, $delete);
        if ($delete_result) {
            header("location: tours.php?delete=done");
        }
    }
}

// vehicle rates delete 
if (isset($_GET['delete_rates_id'])) {
    $parth = "../assect/img/rates/{$_GET['image_name']}";
    if (unlink($parth)) {
        $delete = "DELETE FROM `rates` WHERE `ID` = {$_GET['delete_rates_id']}";
        $delete_result = mysqli_query($connection, $delete);
        if ($delete_result) {
            header("location: vehicle-fleet.php?delete=done");
        }
    } else {
        $delete = "DELETE FROM `rates` WHERE `ID` = {$_GET['delete_rates_id']}";
        $delete_result = mysqli_query($connection, $delete);
        if ($delete_result) {
            header("location: vehicle-fleet.php?delete=done");
        }
    }
}
