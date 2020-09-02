<?php
    session_start();

    require '../models/Service.php';

    //$category, $serviceTitle, $description, $startingPrice
    $service = new Service($_POST['category'], $_POST['serviceTitle'], $_POST['description'], $_POST['startingPrice']);
    $service->add_service();
?>