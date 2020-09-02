<?php
    
    require '../models/Service.php';

    $service = new Service();
    $service->remove_service($_GET['serviceId']);
?>