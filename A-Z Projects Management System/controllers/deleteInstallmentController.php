<?php
    require '../models/Invoice.php';

    $invoice = new Invoice();
    $invoice->delete_installment($_GET['paymentId']);
?>