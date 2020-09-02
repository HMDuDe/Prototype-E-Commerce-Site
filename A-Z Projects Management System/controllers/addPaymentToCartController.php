<?php
    session_start();

    $_SESSION['cartItems'][] = $_GET['paymentId'];

    echo "
        <script>
            alert(\"Item Added to Cart\");
            window.location.href=\"../views/customerCart.php\";   
        </script>
    ";
    //print_r($_SESSION['cartItems']);
?>