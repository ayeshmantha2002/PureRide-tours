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
