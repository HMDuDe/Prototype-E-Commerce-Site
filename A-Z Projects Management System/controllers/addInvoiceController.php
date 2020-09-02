<?php
    include '../models/Invoice.php';

    //$total, $invoiceDate, $description, $userId
    $con = mysqli_connect("localhost", "root", "Hm@dude21");
    mysqli_select_db($con, "lrpc_online");

    $userFullname = explode(" ", $_POST['customer']);

    $sql_select = "SELECT `userId` FROM `users` WHERE `firstName`='" . $userFullname[0] . "'";
    $select_result = mysqli_query($con, $sql_select);
    $select_result = mysqli_fetch_row($select_result);

    $invoice = new Invoice($_POST['totalAmount'], $_POST['invoiceDate'], $_POST['description'], $select_result[0]);
    $invoice->save_invoice();
?>