<?php

    require '../models/Quote.php';

    $quote = new Quote();
    $quote->send_quote($_GET['quoteId']);
?>