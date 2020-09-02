<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Customer Home Page</title>
        
        <script>
            function logoutBtn(){
                window.location.href="../controllers/logoutController.php";
            }

            function cartBtn(){
                window.location.href="customerCart.php";
            }

            function getQuoteBtn(){
                window.location.href="customerBookings.php";
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

        <hr style="height: 5px; background-color: black;"/>
        
        <div class="container-fluid">
            <nav class="navbar navbar-expand-sm fixed-bottom bg-dark">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <b><a class="nav-link" href="#home">Home</a></b>
                    </li>

                    <li class="nav-item">
                        <b><a class="nav-link" href="#services">Services</a></b>
                    </li>
                    
                    <li class="nav-item">
                        <b><a class="nav-link" href="#about"> About</a></b>
                    </li>

                    <li class="nav-item">
                        <b><a class="nav-link" href="#contact">Contact Us</a></b>
                    </li>

                    <li class="nav-item">
                        <div class="dropup">
                            <button type="button" class="nav-link btn btn-primary dropdown-toggle" data-toggle="dropdown">My Account</button>

                            <div class="nav-item dropdown-menu">
                                <a class="dropdown-item" href="customerBookings.php">Bookings</a>
                                <a class="dropdown-item" href="customerInvoices.php">My Invoices</a>
                                <a class="dropdown-item" href="customerQuotes.php">My Quotes</a>
                                <a class="dropdown-item" href="transactionHistory.php">Payment History</a>
                                <button type="button" class="btn btn-danger dropdown-item" data-toggle="modal" data-target="#changePasswordModal">Change Password</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
            
            <div class="modal fade" id="changePasswordModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Reset Password</h3>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <form action="../controllers/changePasswordController.php" method="post">
                                <div class="form-group">
                                    <label for="currentPassword">Current Password</label>
                                    <input id="currentPassword" class="form-control" type="password" name="currentPassword">
                                </div>

                                <div class="form-group">
                                    <label for="newPassword">New Password</label>
                                    <input id="newPassword" class="form-control" type="password" name="newPassword">
                                </div>

                                <div class="form-group">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input id="confirmPassword" class="form-control" type="password" name="confirmPassword">
                                </div>

                                <div class="form-group float-right">
                                    <input type="submit" value="Change" class="btn btn-success">
                                    <input type="reset" value="Cancel" class="btn btn-danger" data-dismiss="modal">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h2 id="services">Services We Offer</h2>

                    <P>
                        SAMPLE TEXT Offices parties lasting outward nothing age few resolve. Impression to discretion understood to we interested he excellence. 
                        Him remarkably use projection collecting. Going about eat forty world has round miles. Attention affection at my preferred 
                        offending shameless me if agreeable. Life lain held calm and true neat she. Much feet each so went no from. Truth began maids 
                        linen an mr to after. Received shutters expenses ye he pleasant. Drift as blind above at up. No up simple county stairs do 
                        should praise as. Drawings sir gay together landlord had law smallest. Formerly welcomed attended declared met say unlocked. 
                        Jennings outlived no dwelling denoting in peculiar as he believed. Behaviour excellent middleton be as it curiosity departure 
                        ourselves. Answer misery adieus add wooded how nay men before though. Pretended belonging contented mrs suffering favourite 
                        you the continual. Mrs civil nay least means tried drift. Natural end law whether but and towards certain. Furnished unfeeling 
                        his sometimes see day promotion. Quitting informed concerns can men now. Projection to or up conviction uncommonly delightful 
                        continuing. In appetite ecstatic opinions hastened by handsome admitted.
                    </P>
                </div>
            </div>

            <div class="row">
                <?php include '../controllers/display_services_controller.php'; ?>
            </div>
        </div>

        <hr style="height: 10px; background-color: black;"/>
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-sm-12">
                    <h2 id="about">About Our Company</h2>
                    <P>
                        SAMPLE TEXT Offices parties lasting outward nothing age few resolve. Impression to discretion understood to we interested he excellence. 
                        Him remarkably use projection collecting. Going about eat forty world has round miles. Attention affection at my preferred 
                        offending shameless me if agreeable. Life lain held calm and true neat she. Much feet each so went no from. Truth began maids 
                        linen an mr to after. Received shutters expenses ye he pleasant. Drift as blind above at up. No up simple county stairs do 
                        should praise as. Drawings sir gay together landlord had law smallest. Formerly welcomed attended declared met say unlocked. 
                        Jennings outlived no dwelling denoting in peculiar as he believed. Behaviour excellent middleton be as it curiosity departure 
                        ourselves. Answer misery adieus add wooded how nay men before though. Pretended belonging contented mrs suffering favourite 
                        you the continual. Mrs civil nay least means tried drift. Natural end law whether but and towards certain. Furnished unfeeling 
                        his sometimes see day promotion. Quitting informed concerns can men now. Projection to or up conviction uncommonly delightful 
                        continuing. In appetite ecstatic opinions hastened by handsome admitted.
                    </P>
                </div>
            </div>

            <div class="row">
                <!--Display past projects-->
                <div class="col-sm-12">
                    <h3 style="text-align: center;">Previous Projects:</h3>
                </div>
            </div>
        </div>

        <hr style="height: 10px; background-color: black;"/>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h2 id="contact">Contact Us</h2>      
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <h3>Need more information? Send us a Message:</h3>

                    <form autocomplete="off" style="margin-bottom: 30px;">
                        <div class="form-group">
                            <label for="email">Your Email:</label>
                            <input class="form-control" type="email" name="email" id="email">
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject:</label>
                            <input class="form-control" type="text" name="subject" id="subject">
                        </div>

                        <div class="form-group">
                            <label for="body">Message:</label>
                            <textarea class="form-control" rows="10" name="body" id="body"></textarea>
                        </div>
                            
                        <input type="submit" value="Send">
                        <input type="reset" value="Clear">    
                    </form>
                    
                </div>

                <div class="col-sm-6 ">
                    <div style="margin-top: 25%;" class="jumbotron">
                        <table>
                            <th>Our Info</th>
                            
                            <tr>
                                <td>Contact Number:</td>
                                <td></td>
                                <td>082 446 5919</td>
                            </tr>

                            <tr>
                                <td>Email Address:</td>
                                <td></td>
                                <td>lroux868@gmail.com</td>
                            </tr>

                            <tr>
                                <td>Address:</td>
                                <td></td>
                                <td>119 Woodgate Rd <br> Plumstead <br> Cape Town <br> 7800</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>