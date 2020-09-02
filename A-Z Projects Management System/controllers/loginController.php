<?php 
    session_start();
    
    require '../models/User.php';

    $user = new User($_POST['email'], $_POST['password']);
    $user->login();
?>