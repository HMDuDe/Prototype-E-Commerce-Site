<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Invoice Management</title>

        <script>
            function view_invoice(invoiceId){
                window.location.href="invoiceIndiv.php?invoiceId=" + invoiceId;
            }

            function logoutBtn(){
                window.location.href="../controllers/logoutController.php";
            }

            function deleteInvoiceBtn(invoiceId){
                window.location.href="../controllers/deleteInvoiceController.php?invoiceId=" + invoiceId;
            }

            function sendInvoiceBtn(invoiceId){
                window.location.href="../controllers/sendInvoiceController.php?invoiceId=" + invoiceId;
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
                    <a href="adminDashboard.php" class="nav-link"><h4>Bookings</h4></a>
                </li>

                <li class="nav-item">
                    <a href="quoteManagement.php" class="nav-link"><h4>Quotes</h4></a>
                </li>

                <li class="nav-item">
                    <a href="invoiceManagement.php" class="nav-link active"><h4>Invoices</h4></a>
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
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <!--Open create invoice modal button here-->
                <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#createInvoiceModal">Create New Invoice</button>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <div class="modal fade" id="createInvoiceModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Create invoice</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <form action="../controllers/addInvoiceController.php" method="post">
                            <div class="form-group">
                                <label for="customer">Select Customer</label>
                                <select class="form-control" id="customer" name="customer">
                                    <option>select</option>
                                    <!--Show customer names as options-->
                                    <?php 
                                        $con = mysqli_connect("localhost", "root", "Hm@dude21");
                                        mysqli_select_db($con, "lrpc_online");

                                        $sql_select = "SELECT * FROM `users` WHERE 1";
                                        $select_result = mysqli_query($con, $sql_select);

                                        if(mysqli_num_rows($select_result) > 0){
                                            while($row = mysqli_fetch_assoc($select_result)){
                                                echo "<option>" . $row['firstName'] . " " . $row['lastName'] . "</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description">Invoice Description</label>
                                <textarea class="form-control" id="description" name="description" rows="10" cols="50"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="invoiceDate">Date</label>
                                <input class="form-control" type="date" id="invoiceDate" name="invoiceDate">
                            </div>

                            <div class="form-group">
                                <label for="totalAmount">Total Value</label>
                                <input class="form-control" type="number" id="totalAmount" name="totalAmount">
                            </div>

                            <div class="form-group float-right">
                                <input type="submit" class="btn btn-success" value="Create Invoice">
                                <input type="reset" class="btn btn-danger" value="Cancel" data-dismiss="modal">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr style="height: 5px; background-color: black;">
        <div class="row mt-2">
            <div class="col-sm-4"></div>

            <div class="col-sm-4">
                <h2 style="text-align: center;">All Invoices</h2>
            </div>

            <div class="col-sm-1"></div>

            <div class="col-sm-3 align-self-end">
                <form class="form-inline" action="" method="post">
                    <input type="text" placeholder="Search" name="searchInvoice" id="searchInvoice">
                    <button class="btn-success" type="submit">Go</button>
                </form>
            </div>
        </div>

        <div class="row">
            <!--Display invoice php code-->
            <?php
                include '../models/Invoice.php';

                $invoice = new Invoice();
                $invoice->display_invoice_cards();
            ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    
    </body>
</html>