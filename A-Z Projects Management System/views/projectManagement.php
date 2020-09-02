<?php
    session_start();

    require '../models/Project.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Project Management</title>

        <script>
            function logoutBtn(){
                window.location.href="../controllers/logoutController.php";
            }

            function deleteProject(projectId){
                window.location.href="../controllers/deleteProjectController.php?projectId=" + projectId;
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
                    <a href="serviceManagement.php" class="nav-link"><h4>Services</h4></a>
                </li>

                <li class="nav-item">
                    <a href="projectManagement.php" class="nav-link active"><h4>Projects</h4></a>
                </li>
            </ul>
        </nav>

        <div class="container">
            <div class="row">
                <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#addNewprojectModal">Add new Project</button>
            </div>

            <div class="row">
                <div class="modal fade" id="addNewprojectModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Add a project</h3>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <div class="jumbotron">
                                    <b>Note!</b> You should get your customer's permission to publically display information regarding the project you conducted for them.
                                </div>

                                <form action="../controllers/addNewProjectController.php" enctype="multipart/form-data" method="post">
                                    <div class="form-group">
                                        <label for="projectTitle">Project Title</label>
                                        <input id="projectTitle" class="form-control" type="text" name="projectTitle">
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" rows="10" id="description" name="description"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="imgBefore">Before Picture</label>
                                        <input id="imgBefore" class="form-control" type="file" name="imgBefore">
                                    </div>

                                    <div class="form-group">
                                        <label for="imgAfter">After Picture</label>
                                        <input id="imgAfter" class="form-control" type="file" name="imgAfter">
                                    </div>

                                    <div class="form-group">
                                        <label for="dateCompleted">Date Completed</label>
                                        <input id="dateCompleted" class="form-control" type="date" name="dateCompleted">
                                    </div>

                                    <div class="form-group float-right">
                                        <input type="submit" class="btn btn-success" value="Add Project">
                                        <input type="reset" class="btn btn-danger" value="Cancel" data-dismiss="modal">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-3">
            <div class="row">
                <?php
                    $project = new Project();
                    $project->display_all_projects();
                ?>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    
    </body>
</html>