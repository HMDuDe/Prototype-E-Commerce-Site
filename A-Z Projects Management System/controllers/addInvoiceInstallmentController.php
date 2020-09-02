<?php
    require '../models/Invoice.php';

    $invoice = new Invoice();

    $invoice->create_payment_install($_POST['invoiceId'], $_POST['userId'], $_POST['amount'], $_POST['date']);
?>