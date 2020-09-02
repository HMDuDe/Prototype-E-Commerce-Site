<?php

    session_start();

    require '../models/Booking.php';

    $booking = new Booking($_POST['bookingDate'], $_POST['bookingStartTime'], $_POST['bookingEndTime'], "AWAITING CONFIRMATION", $_SESSION['userId'], $_POST['selectService'], $_POST['jobDescription'], $_POST['instructions']);
    $booking->send_booking_request();
?>