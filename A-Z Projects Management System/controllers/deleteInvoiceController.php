<?php
    require '../models/Invoice.php';

    $invoice = new Invoice();
    $invoice->delete_invoice($_GET['invoiceId']);
?>