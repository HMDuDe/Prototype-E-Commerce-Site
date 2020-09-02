<?php

    function randomPasswordGenerator(){
        $ascii_arr = array(
            rand(97, 122),
            rand(48, 57),
            rand(65, 90),
            rand(65, 90),
            rand(97, 122),
            rand(48, 57),
            rand(97, 122),
            rand(48, 57)
        );

        shuffle($ascii_arr);

        $password = "";

        foreach($ascii_arr as $ascii_val){
            $password =  $password . chr($ascii_val);
        }

        return $password;
    }
    
    $new_password = randomPasswordGenerator();

    $con = mysqli_connect("localhost", "root", "Hm@dude21");
    mysqli_select_db($con, "lrpc_online");

    $update_result = mysqli_query($con, "UPDATE `users` SET `password`='" . $new_password . "' WHERE `email`='" . $_POST['email'] ."'");
    
    if($update_result == FALSE){
        echo $update_result;
    }

    $message = "Dear User, \n Your new password is " . $new_password. ". \n This password can be used to access your account and change your password. \n If you didn't request a password reset, please ignore this email.";
    //mail($_POST['email'], "A-Z Projects Online PASSWORD RESET", $message);

    echo "
        <script>
            alert(\"New Password emailed.\");
            window.location.href=\"../views/loginPage.php\";
        </script>
    ";
?>