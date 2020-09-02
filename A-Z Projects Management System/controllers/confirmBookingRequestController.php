<?php
    require '../models/Booking.php';

    $booking = new Booking();
    $booking->confirmBookingTime($_GET['bookingId']);
?>