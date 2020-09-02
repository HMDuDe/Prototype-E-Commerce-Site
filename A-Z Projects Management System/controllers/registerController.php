<?php

    require '../models/User.php';

    //$email, $password, $fName, $lName, $contactNo, $address
    $address = $_POST['streetNo'] . " " . $_POST['streetName'] . " " . $_POST['suburb'] . " " . $_POST['city'] . " " . $_POST['zip'];
    $user = new User($_POST['email'], $_POST['password'], $_POST['fName'], $_POST['lName'], $_POST['contactNo'], $address);

    $user->register_user();
?>