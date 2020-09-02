<?php
    session_start();
    
    require '../models/Invoice.php';

    $con = mysqli_connect("localhost", "root", "Hm@dude21");
    mysqli_select_db($con, "lrpc_online");

    $sql_select = "SELECT * FROM `invoices` WHERE invoiceId='". $_GET['invoiceId'] ."'";
    $select_result = mysqli_query($con, $sql_select);
    $invoiceArr = mysqli_fetch_assoc($select_result);

    //$invoiceNo, $total, $amountRemaining, $invoiceDate, $description, $userId
    $invoice = new Invoice($invoiceArr['invoiceId'], $invoiceArr['totalAmountDue'], $invoiceArr['amountRemaining'], $invoiceArr['invoiceDate'], $invoiceArr['description'], $invoiceArr['userId'], $invoiceArr['status']);
    
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Invoice </title>

        <script>
            function deleteInstallment(paymentId){
                window.location.href="../controllers/deleteInstallmentController.php?paymentId=" + paymentId;
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

        <hr style="height: 2px; background-color: black;">

        <nav class="navbar navbar-expand-sm bg-dark fixed-top">
            <ul class="navbar-nav nav-tabs">
                <li class="nav-item">
                    <a href="adminDashboard.php" class="nav-link"><h4>Bookings</h4></a>
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
                <div class="col-sm-6">
                    <h2><?php echo User::get_user_fullname($invoice->get_userId());?></h2>
                </div>

                <div class="col-sm-6">
                    <h2 style="text-align: right;"><?php echo $invoice->get_invoiceNo(); ?></h2>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <h2>
                        <?php 
                            $sql_select_user_address = "SELECT `address` FROM `users` WHERE userId='". $invoice->get_userId() ."'";

                            $user_addr_result = mysqli_query($con, $sql_select_user_address);
                            $userArr = mysqli_fetch_assoc($user_addr_result);
                            
                            echo $userArr['address'];
                        ?>
                    </h2>
                </div>

                <div class="col-sm-6">
                    <h2 style="text-align: right;">R <?php echo $invoice->get_total(); ?></h2>
                </div>
            </div>
        </div>

        <hr style="height: 2px; background-color: black;">
        
        <div class="container-fluid border">
            <h2>Description</h2>
            
            <p>
                <?php echo $invoice->get_description(); ?>
            </p>
        </div>

        <div class="cointainer-fluid border">
            <!--View installments here-->
            <?php $invoice->display_installments($invoice->get_invoiceNo());?>
        </div>

        <div class="cointainer-fluid border">
            <hr style="height: 2px; background-color: black;">
            <div class="row">
                <div class="col-sm-12">
                    <h2 style="text-align: center;">Add Installment</h2>
                </div>
            </div>

            <hr style="height: 2px; background-color: black;">

            <div class="row mb-5">
                <div class="col-sm-12">
                    <form action="../controllers/addInvoiceInstallmentController.php" method="post">
                        <div class="form-group">
                            <label for="date">Choose Date Payable</label>
                            <input class="form-control" type="date" id="date" name="date">
                        </div>

                        <div class="form-group">
                            <label for="amount">Installment Amount</label>
                            <input class="form-control" type="number" id="amount" name="amount">
                        </div>

                        <input type="hidden" name="invoiceId" value="<?php echo $invoice->get_invoiceNo();?>">
                        <input type="hidden" name="userId" value="<?php echo $invoice->get_userId();?>">

                        <div class="form-group float-right">
                            <input type="submit" class="btn btn-success" value="Add Installment">
                            <input type="reset" class="btn btn-danger" value="Clear">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>