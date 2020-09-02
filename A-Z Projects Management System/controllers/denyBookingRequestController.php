<?php
    require '../models/Booking.php';

    $booking = new Booking();
    $booking->denyBookingTime($_GET['bookingId']);
?>