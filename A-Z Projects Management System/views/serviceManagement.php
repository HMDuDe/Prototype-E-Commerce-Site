<?php
    session_start();

    require '../models/Service.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Service Management</title>

        <script>
            function logoutBtn(){
                window.location.href="../controllers/logoutController.php";
            }

            function deleteService(serviceId){
                window.location.href="../controllers/deleteServiceController.php?serviceId=" + serviceId;
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
                    <a href="invoiceManagement.php" class="nav-link"><h4>Invoices</h4></a>
                </li>

                <li class="nav-item">
                    <a href="serviceManagement.html" class="nav-link active"><h4>Services</h4></a>
                </li>

                <li class="nav-item">
                    <a href="projectManagement.php" class="nav-link"><h4>Projects</h4></a>
                </li>
            </ul>
        </nav>
        
        <div class="container">
            <div class="row mb-5">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#addServiceModal">Add Service</button>

                    <div class="modal fade" id="addServiceModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h3 class="modal-title">Create a New Service</h3>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">
                                    <form action="../controllers/submitServiceController.php" method="post">
                                        <div class="form-group">
                                            <label for="serviceTitle">Service Title</label>
                                            <input id="serviceTitle" class="form-control" type="text" name="serviceTitle">
                                        </div>

                                        <div class="form-group">
                                            <label for="my-select">Category</label>
                                            <select id="category" class="form-control" name="category">
                                                <option>Construction</option>
                                                <option>Painting</option>
                                                <option>Maintenance</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea id="description" class="form-control" rows="10" name="description"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="startingPrice">Starting Price</label>
                                            <input id="startingPrice" class="form-control" type="number" name="startingPrice">
                                        </div>

                                        <div class="form-group float-right">
                                            <input type="submit" value="Add Service" class="btn btn-success">
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

        <div class="container-fluid">
            <div class="row">
                <?php
                    $service = new Service();
                    $service->display_services();
                ?>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    
    </body>
</html>