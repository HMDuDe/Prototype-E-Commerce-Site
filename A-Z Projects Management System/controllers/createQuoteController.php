<?php

    require '../models/Quote.php';

    $con = mysqli_connect("localhost", "root", "Hm@dude21");
    mysqli_select_db($con, "lrpc_online");

    $userName = explode(" ", $_POST['customerName']);
    //print_r($userName);
    $select_result = mysqli_query($con, "SELECT `userId` FROM `users` WHERE `firstName`='".$userName[0]."'");
    
    $row = mysqli_fetch_assoc($select_result);
    //print_r($row); 

    //$userId, $quoteDescription, $estimatedPrice
    $quote = new Quote($row['userId'], $_POST['description'], $_POST['estimatedPrice']);
    $quote->create_quote();

    echo "UserId: " . $quote->getUserId();
?>