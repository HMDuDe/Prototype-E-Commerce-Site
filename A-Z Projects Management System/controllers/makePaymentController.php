<?php
    session_start();

    $con = mysqli_connect("localhost", "root", "Hm@dude21");
    mysqli_select_db($con, "lrpc_online");

    $total = 0;
    $invoiceId_list = "";

    if(isset($_SESSION['cartItems'])){
        foreach($_SESSION['cartItems'] as $cartItem){

            //Get the amount to be paid for a specific cart item
            $select_pmnt_result = mysqli_query($con, "SELECT `paymentAmount`, `invoiceId` FROM `payments` WHERE paymentId=".$cartItem);
            $payments_row = mysqli_fetch_assoc($select_pmnt_result);

            //Get said cartItem's invoice information
            $select_inv_result = mysqli_query($con, "SELECT * FROM `invoices` WHERE invoiceId=". $payments_row['invoiceId']);
            $invoice_row = mysqli_fetch_assoc($select_inv_result);

            //Calculate the remaining amount
            $amountRemaining = $invoice_row['amountRemaining'] - $payments_row['paymentAmount'];

            if($amountRemaining == 0){
                $update_inv_status = mysqli_query($con, "UPDATE `invoices` SET `status`='PAID IN FULL' WHERE `invoiceId`=". $invoice_row['invoiceId']);

                if($update_inv_status == FALSE){
                    echo "<script>alert(\"An error occurred when trying to update invoice status.\");</script>";
                }
            }

            //update payments and invoices tables with new information
            $update_inv_result = mysqli_query($con, "UPDATE `invoices` SET `amountRemaining`='".$amountRemaining . "' WHERE `invoiceId`=" . $payments_row['invoiceId']);
            echo "ERROR: " . mysqli_error($con) . "<br><br>";

            $update_pmnt_result = mysqli_query($con, "UPDATE `payments` SET `status`='PAID' WHERE `paymentId`=".$cartItem);
            echo "ERROR: " . mysqli_error($con) . "<br><br>";
            
            if($update_inv_result == TRUE and $update_pmnt_result == TRUE){
                $total = $total + $payments_row['paymentAmount'];
                $invoiceId_list = $invoiceId_list . " " . $payments_row['invoiceId'];

                unset($_SESSION['cartItems']);
                echo "
                    <script>
                        alert(\"Payment completed Successfully - Thank You.\");
                        window.location.href=\"../views/customerDashboard.php\";
                    </script>
                ";
            }else{
                echo "
                    <script>
                        alert(\"Payment failed to complete.\");
                        
                    </script>
                ";
            }
        }
    }

    $date_arr = getDate();
    $date_today = $date_arr['mday'] . " " . $date_arr['month'] . " " . $date_arr['year'];
    $insert_transaction_sql = "INSERT INTO `transactions` (`totalPaid`, `datePaid`, `invoiceIdList`, `userId`) VALUES ('". $total ."', '". $date_today ."', '". $invoiceId_list ."', '". $_SESSION['userId'] ."')";

    $insert_transaction_result = mysqli_query($con, $insert_transaction_sql);

    if($insert_transaction_result == FALSE){
        echo "<script>alert(\"An Error occurred when trying to update Transaction History\");</script>";
    }
?>