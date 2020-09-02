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
        
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#checkoutModal">Checkout</button>

                <div class="modal fade" id="checkoutModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Payment Information</h3>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <div class="jumbotron">
                                    <b>Note!</b> DO NOT enter real payment information here, this payment system is just a mockup for examination purposes. None of the information entered below is stored.
                                </div>

                                <form action="../controllers/makePaymentController.php" method="post">
                                    <div class="form-group">
                                        <label for="accountHolder">Account Holder</label>
                                        <input id="accountHolder" class="form-control" type="text" name="">
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="bank">Bank</label>
                                                <input id="bank" class="form-control" type="text" name="bank">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="branchCode">Branch Code</label>
                                                <input id="branchCode" class="form-control" type="text" name="branchCode">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="accountNo">Account Number</label>
                                        <input id="accountNo" class="form-control" type="text" name="accountNo">
                                    </div>

                                    <div class="form-group">
                                        <label for="expiryDate">Expires On</label>
                                        <input id="expiryDate" class="form-control" type="month" name="expiryDate">
                                    </div>

                                    <div class="form-group">
                                        <label for="cvvCode">CVV Code</label>
                                        <input id="cvvCode" class="form-control" type="text" name="cvvCode">
                                    </div>

                                    <div class="form-group float-right">
                                        <input type="submit" value="Make Payment" class="btn btn-success">
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
        <div class="container-fluid mt-2">
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
                                <a class="dropdown-item" href="customerInvoices.php">My Invoices</a>
                                <a class="dropdown-item" href="customerQuotes.php">My Quotes</a>
                                <a class="dropdown-item" href="transactionHistory.php">Payment History</a>
                                <button type="button" class="btn btn-danger dropdown-item" data-toggle="modal" data-target="#changePasswordModal">Change Password</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>

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

        <div class="container">
            <div class="row">

                <?php
                    $con = mysqli_connect("localhost", "root", "Hm@dude21");
                    mysqli_select_db($con, "lrpc_online");

                    if(isset($_SESSION['cartItems'])){
                        foreach($_SESSION['cartItems'] as $cartItem){

                            $select_result = mysqli_query($con, "SELECT * FROM `payments` WHERE paymentId=" . $cartItem);
                            $row = mysqli_fetch_assoc($select_result);
    
                            ?>
                                <div class="col-sm-12">
                                    <div class="card-deck card-columns">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 style="text-align: center;">Invoice No: <?php echo $row['invoiceId'] ?></h4>
                                            </div>
    
                                            <div class="card-body">
                                                <b>Status: </b> <?php echo $row['status']; ?><br>
                                                <b>Amount: </b> <?php echo $row['paymentAmount']; ?> <br>
                                                <b>To be paid by: </b> <?php echo $row['paymentDate']; ?>
                                            </div>
    
                                            <div class="card-footer">
                                                <button type="button" class="btn btn-danger float-right" onclick="removeFromCart(<?php echo $row['paymentId']; ?>)">Remove From Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    }else{
                        echo "<h2 style=\"text-align: center;\"></h2>";
                    }
                ?>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    
    </body>
</html>