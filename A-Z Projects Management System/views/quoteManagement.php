<?php
    session_start();

    require '../models/Quote.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Quote Management</title>
        <script>
            function logoutBtn(){
                window.location.href="../controllers/logoutController.php";
            }

            function sendToClient(quoteId){
                window.location.href="../controllers/sendQuoteToCustController.php?quoteId=" + quoteId;
            }

            function deleteQuoteBtn(quoteId){
                window.location.href="../controllers/deleteQuoteController.php?quoteId=" + quoteId;
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
                    <a href="quoteManagement.php" class="nav-link active"><h4>Quotes</h4></a>
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

        <div class="container">
            <div class="row mb-5">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#createQuoteModal">Create Quote</button>

                    <div class="modal fade" id="createQuoteModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Create New Quote</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">
                                    <form action="../controllers/createQuoteController.php" method="POST">
                                        <div class="form-group">
                                            <label for="quoteDate">Date:</label>
                                            <input id="quoteDate" class="form-control" type="date" name="quoteDate">
                                        </div>

                                        <div class="form-group">
                                            <label for="customerName">Select Customer</label>
                                            <select id="customerName" class="form-control" name="customerName">
                                                <option>Select</option>
                                                <!--PHP code to display customer select options-->
                                                <?php
                                                    $con = mysqli_connect("localhost", "root", "Hm@dude21");
                                                    mysqli_select_db($con, "lrpc_online");

                                                    $select_result = mysqli_query($con, "SELECT `firstName`, lastName FROM `users` WHERE 1");

                                                    if(mysqli_num_rows($select_result) > 0){
                                                        while($row = mysqli_fetch_assoc($select_result)){
                                                            echo "<option>" . $row['firstName'] . " " . $row['lastName']. "</option>";
                                                        }
                                                    }

                                                    $con->close();
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="description" rows="10" name="description"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="estimatedPrice">Estimated Total: </label>
                                            <input id="estimatedPrice" class="form-control" type="number" name="estimatedPrice">
                                        </div>

                                        <div class="form-group float-right">
                                            <input type="submit" value="Create Quote" class="btn btn-success">
                                            <input type="reset" value="Cancel" class="btn btn-danger" data-dismiss="modal">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container border">
            <div class="row">
                <div class="col-sm-3"></div>

                <div class="col-sm-6">
                    <h2 style="text-align: center;">All Quotes</h2>
                </div>

                <div class="col-sm-3 mt-3">
                    <form class="form-inline" action="../controllers/searchQuotesController.php" method="post">
                        <input type="text" placeholder="Search Quotes" name="searchQuote" id="searchQuote">
                        <button class="btn-success" type="submit">Go</button>
                    </form>
                </div>
            </div>

            <div class="row mt-2">
                <?php 
                    $quote = new Quote();
                    $quote->display_quotes();
                ?>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    
    </body>
</html>