<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

        <script>
            
            function cancelLoginBtn(){
                window.location.href="index.php";
            }

            function registerBtn(){

                window.location.href="registrationPage.html";
            }

            function validateLogin(){
                var userEmail = document.form["loginForm"]["email"].value;
                var userPassword = document.form["loginForm"]["password"].value;

                if(userEmail == ""){
                    alert("Email can't be blank");
                    return false;
                }else{
                    if(userPassword == ""){
                        alert("Password can't be blank");
                        return false;
                    }else{
                        window.location.href="../controllers/loginController.php"
                    } 
                }
            }
        </script>
    </head>

    <body style="text-align: center;">
        <div class="row mt-3">
            <div class="col-sm-12">

                <h2>Please Login</h2>

                <form name="loginForm" action="../controllers/loginController.php" method="post" style="margin-top: 15px;">
                    <div class="form-group">
                        <label for="email">Email: </label><br>
                        <input type="email" name="email" id="email">
                    </div>

                    <div class="form-group">
                        <label for="password">Password: </label><br>
                        <input type="password" name="password" id="password">
                    </div>

                    <button type="submit" onclick="validateLogin()" class="btn btn-success">Login</button>
                    <button type="button" onclick="registerBtn()" class="btn btn-info">Register</button>
                    <button type="button" onclick="cancelLoginBtn()" class="btn btn-danger">Cancel</button>
                </form>

                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#forgotPasswordModal">Forgot Password?</button>

                <div class="modal" id="forgotPasswordModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Send Password Reset Email</h3>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <div class="jumbotron">
                                    <b>NOTE!</b> This will reset your account password and send you an email with the new
                                    password which you can use to login. You can then use the Change Password feature to
                                    change your password.
                                </div>

                                <form action="../controllers/passwordResetController.php" method="post">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" class="form-control" type="text" name="email">
                                    </div>

                                    <div class="form-group float-right">
                                            <input type="submit" value="Send Email" class="btn btn-success">
                                            <input type="reset" value="Cancel" class="btn btn-danger" data-dismiss="modal">
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    
    </body>
</html>