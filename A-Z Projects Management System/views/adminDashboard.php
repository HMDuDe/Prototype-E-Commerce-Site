<?php
    session_start();

    require '../models/Booking.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Administrator Dashboard</title>

        <script>
            function confirmBooking(bookingId){
                window.location.href="../controllers/confirmBookingRequestController.php?bookingId=" + bookingId;
            }

            function denyBooking(bookingId){
                window.location.href="../controllers/denyBookingRequestController.php?bookingId=" + bookingId;
            }

            function logoutBtn(){
                window.location.href="../controllers/logoutController.php";
            }
        </script>
    </head>

    <body>
        <div class="container-fluid mt-4">

            <div class="row">
                <div class="col-sm-2">
                    <img src="../layouts/images/a-zprojects_logo.png" id="logo" class="img-fluid" alt="logo">
                </div>
        
                <div class="col-sm-8">
                    <h1 id="home" style="text-align: center; margin-top: 80px;">A - Z Project Management</h1>
                </div>
        
                <div class="col-sm-2 mt-5">
                    <div class="row">
                        <div class="col-sm-12">
                            <b>Logged In As</b>
                        </div>
                        <div class="col-sm-12">
                            <i>Administrator</i>
                        </div>
                        <div class="col-sm-12">
                            <button type="button" onclick="logoutBtn()" style="margin-left: 15px;" class=" btn btn-outline-dark">Logout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <hr style="height: 5px; background-color: black;">

        <nav class="navbar navbar-expand-sm bg-dark fixed-top">
            <ul class="navbar-nav nav-tabs">
                <li class="nav-item">
                    <a href="adminDashboard.php" class="nav-link active"><h4>Bookings</h4></a>
                </li>

                <li class="nav-item">
                    <a href="quoteManagement.php" class="nav-link"><h4>Quotes</h4></a>
                </li>

                <li class="nav-item">
                    <a href="invoiceManagement.php" class="nav-link"><h4>Invoices</h4></a>
                </li>

                <li class="nav-item">
                    <a href="serviceManagement.php" class="nav-link"><h4>Services</h4></a>
                </li>

                <li class="nav-item">
                    <a href="projectManagement.php" class="nav-link"><h4>Projects</h4></a>
                </li>
            </ul>
        </nav>
 
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 border">
                    <h2 style="text-align: center;">Active Booking Requests</h2>
                    
                    <?php 
                        $booking = new Booking();
                        $booking->receive_booking_request();
                    ?>

                </div>

                <div class="col-sm-6 border">
                    <h2 style="text-align: center;">My next meetings:</h2>
                    
                    <?php 
                        $booking = new Booking();
                        $booking->display_all_bookings();
                    ?>
                </div>
            </div>
            
        </div>
        <hr style="height: 5px; background-color: black;">

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    
    </body>
</html>