<?php
    $con = mysqli_connect("localhost", "root", "Hm@dude21");
    mysqli_select_db($con, "lrpc_online");

    $select_sql = "SELECT * FROM `services` WHERE 1";
    $select_result = mysqli_query($con, $select_sql);

    if(mysqli_num_rows($select_result) > 0){
        while($row = mysqli_fetch_assoc($select_result)){

            ?>
                <div class="col-sm-3 mt-3">
                    <div class="card-deck card-columns">
                        <div class="card">
                            <div class="card-header"><img src="" alt=""></div>
        
                            <div class="card-body">
                                <h3 style="text-align: center;"><?php echo $row['serviceTitle']; ?></h3>
                                <p><?php echo $row['description'];?></p>
                                <b>Starting Price: R <?php echo $row['startingPrice'];?></b>
            
                            </div>

                            <div class="card-footer">
                                <button type="button" onclick="getQuoteBtn()" class="btn btn-success">Get Quote</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
        }
    }
?>