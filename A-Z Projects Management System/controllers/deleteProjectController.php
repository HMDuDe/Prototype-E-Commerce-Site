<?php
    require '../models/Project.php';

    $project = new Project();
    $project->delete_project($_GET['projectId']);
?>