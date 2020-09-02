<?php
    require '../models/Project.php';

    $project = new Project($_POST["projectTitle"], $_POST["description"], $_FILES["imgBefore"]["tmp_name"], $_FILES["imgAfter"]["tmp_name"], $_POST["dateCompleted"], $_FILES["imgBefore"]["name"], $_FILES["imgAfter"]["name"]);

    $project->new_project();
?>