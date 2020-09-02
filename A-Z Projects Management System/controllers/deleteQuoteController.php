<?php

    $con = mysqli_connect("localhost", "root", "Hm@dude21");
    mysqli_select_db($con, "lrpc_online");

    $sql_delete ="DELETE FROM `quotes` WHERE quoteId=" . $_GET['quoteId'];
    $delete_result = mysqli_query($con, $sql_delete);

    if($delete_result == TRUE){
        echo "
            <script>
                alert(\"Quote Deleted.\");
                window.location.href=\"../views/quoteManagement.php\";
            </script>
        ";
    }else{
        echo "
            <script>
                alert(\"An Error Occurred " . mysqli_error($con) . " \");
                window.location.href=\"../views/quoteManagement.php\";
            </script>
        ";
    }
?>