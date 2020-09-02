<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>My Invoices</title>
        
        <script>
            function view_invoice(invoiceId){
                window.location.href="customerIndivInvoice.php?invoiceId=" + invoiceId;
            }

            function logoutBtn(){
                window.location.href="../controllers/logoutController.php";
            }
            
            function cartBtn(){
                window.location.href="customerCart.php";
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
                            <b style="margin-left: 50px;">Logged In As</b>
                        </div>
                        <div class="col-sm-12">
                            <i style="margin-left: 15px;"> <?php echo $_SESSION['email'];?></i>
                        </div>
                        <div class="col-sm-12">
                            <button type="button" onclick="logoutBtn()" style="margin-left: 40px;" class=" btn btn-outline-dark">Logout</button>
                            <button type="button" onclick="cartBtn()" style="margin-left: 5px;" class=" btn btn-success">Cart</button>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr style="height: 2px; background-color: black;"/>
        
        <div class="container-fluid">
            <nav class="navbar navbar-expand-sm fixed-top bg-dark">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <b><a class="nav-link" href="customerDashboard.php">Home</a></b>
                    </li>

                    <li class="nav-item">
                        <b><a class="nav-link" href="customerDashboard.php#services">Services</a></b>
                    </li>
                    
                    <li class="nav-item">
                        <b><a class="nav-link" href="customerDashboard.php#about"> About</a></b>
                    </li>

                    <li class="nav-item">
                        <b><a class="nav-link" href="customerDashboard.php#contact">Contact Us</a></b>
                    </li>

                    <li class="nav-item">
                        <div class="dropdown">
                            <button type="button" class="nav-link btn btn-primary dropdown-toggle" data-toggle="dropdown">My Account</button>

                            <div class="nav-item dropdown-menu">
                                <a class="dropdown-item" href="customerBookings.php">Bookings</a>
                                <a class="dropdown-item active" href="customerInvoices.php">My Invoices</a>
                                <a class="dropdown-item" href="customerQuotes.php">My Quotes</a>
                                <a class="dropdown-item" href="transactionHistory.php">Payment History</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="container-fluid border">
            <div class="row">
                <?php 
                    include '../models/Invoice.php';

                    $invoice = new Invoice();
                    $invoice->display_cust_invoices($_SESSION['userId']);
                ?>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    
    </body>
</html>