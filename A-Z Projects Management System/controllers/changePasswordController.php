<?php
    session_start();

    require '../models/User.php';

    $user = new User();
    $user->changeUserPassword($_SESSION['userId'], $_POST['newPassword']);
?>