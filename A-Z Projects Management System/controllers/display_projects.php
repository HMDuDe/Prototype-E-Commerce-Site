<?php 
    $con = mysqli_connect("localhost", "root", "Hm@dude21");
    mysqli_select_db($con, "lrpc_online");

    $sql_select = "SELECT * FROM `projects` WHERE 1";
    $select_result = mysqli_query($con, $sql_select);

    if(mysqli_num_rows($select_result) > 0){
        while($row = mysqli_fetch_assoc($select_result)){

            ?>
                <div class="col-sm-3">
                    <div class="card-deck card-columns">
                        <div class="card">
                            <div id="project" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100 img-fluid" src="<?php echo $row['imgBefore']; ?>" style="width: 300px; height: 200px;" alt="before">
                                    </div>

                                    <div class="carousel-item">
                                        <img class="d-block w-100 img-fluid" src="<?php echo $row['imgAfter']; ?>" style="width: 300px; height: 200px;" alt="after">
                                    </div>
                                </div>

                                <a class="carousel-control-prev" href="#project" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#project" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                            <div class="card-header"><?php echo $row['projectTitle'] ?></div>

                            <div class="card-body">
                                <p><?php echo $row['description'] ?></p>
                                Date: <?php echo $row['dateCompleted'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
        }
    }
?>