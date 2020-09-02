<?php
    require '../models/Invoice.php';

    $invoice = new Invoice();
    $invoice->send_to_client($_GET['invoiceId']);
?>