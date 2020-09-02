<?php

    //Author: Hugh-Martin Roux
    require 'User.php';

    class Quote{
        
        private $userId, $quoteDescription, $estimatedPrice, $status;

        public function __construct(){
            $arg_vals = func_get_args();

            switch(func_num_args()){
                case 3:
                    $this->__construct2($arg_vals[0], $arg_vals[1], $arg_vals[2]);
                    break;
                default:
                    $this->__construct1();
            }
        }

        public function __construct1(){
            //default
        }

        public function __construct2($userId, $quoteDescription, $estimatedPrice){
            $this->userId = $userId;
            $this->quoteDescription = $quoteDescription;
            $this->estimatedPrice = $estimatedPrice;

            //echo "UserId: " . $userId;
        }

        public function connect_db(){
            $con = mysqli_connect("localhost", "root", "Hm@dude21");
            mysqli_select_db($con, "lrpc_online");

            return $con;
        }

        public function create_quote(){
            $con = $this->connect_db();

            $sql_insert = "INSERT INTO `quotes` (`userId`, `quoteDescription`, `estimatedPrice`, `status`) VALUES ('". $this->userId ."', '". $this->quoteDescription ."', '". $this->estimatedPrice ."', 'NOT SENT')";
            $insert_result = mysqli_query($con, $sql_insert);

            if($insert_result == TRUE){
                echo "
                    <script>
                        alert(\"New Quote Created Successfully.\");
                        window.location.href=\"../views/quoteManagement.php\";
                    </script>
                ";
            }else{
                echo "
                    <script>
                        alert(\"An Error Occurred " . mysqli_error($con) . " \");
                        window.location.href=\"../views/quoteManagement.php\";
                    </script>

                    <h1>" . $this->userId . "</h1>
                ";
            }

            $con->close();
        }

        public function display_quotes($search_criteria = ""){
            $con = $this->connect_db();
            $sql;

            if($search_criteria == ""){
                $sql = "SELECT * FROM `quotes` WHERE 1";
            }else if(is_int($search_criteria) == TRUE){
                $sql = "SELECT * FROM `quotes` WHERE `quoteId`='" . $search_criteria . "'";
            }else{
                $get_userId_sql = "SELECT `userId` FROM `users` WHERE `firstName`='" .$search_criteria."'";
                $userId_result = mysqli_query($con, $get_userId_sql);

                $temp_row = mysqli_fetch_assoc($userId_result);

                $sql = "SELECT * FROM `quotes` WHERE userId=" . $temp_row['userId'];

            }

            $select_result = mysqli_query($con, $sql);

            if(mysqli_num_rows($select_result) > 0){
                while($row = mysqli_fetch_assoc($select_result)){
                    ?>
                        <div class="col-sm-12">
                            <div class="card-deck card-columns">
                                <div class="card">
                                    <div class="card-header">
                                        <h3><?php echo User::get_user_fullname($row['userId']); ?></h3>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <b>Description</b><br>
                                                <?php echo $row['quoteDescription']; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 float-right">
                                                <b>Status: </b> <?php echo $row['status']; ?>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer float-center">
                                        <button type="button" onclick="sendToClient(<?php echo $row['quoteId']; ?>)" class="btn btn-success">Send Quote</button>
                                        <button type="button" onclick="deleteQuoteBtn(<?php echo $row['quoteId']; ?>)" class="btn btn-danger">Delete Quote</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            }else{
                echo "<h2 style=\"text-align: center;\">No Quotes Found</h2>";
            }

            $con->close();
        }

        public function send_quote($quoteId){
            $con = $this->connect_db();

            $sql_update = "UPDATE `quotes` SET `status`='SENT TO CLIENT' WHERE quoteId=".$quoteId;
            $update_result = mysqli_query($con, $sql_update);

            if($update_result == TRUE){
                echo "
                    <script>
                        alert(\"Quote sent to customer\");
                        window.location.href=\"../views/quoteManagement.php\";
                    </script>
                ";
            }else{
                echo "
                    <script>
                        alert(\"An ERROR occurred\");
                        window.location.href=\"../views/quoteManagement.php\";
                    </script>
                ";
            }

            $con->close();
        }
        public function getUserId()
        {
                return $this->userId;
        }

        public function setUserId($userId)
        {
                $this->userId = $userId;

                return $this;
        }

        public function getQuoteDescription()
        {
                return $this->quoteDescription;
        }

        public function setQuoteDescription($quoteDescription)
        {
                $this->quoteDescription = $quoteDescription;

                return $this;
        }

        public function getEstimatedPrice()
        {
                return $this->estimatedPrice;
        }

        public function setEstimatedPrice($estimatedPrice)
        {
                $this->estimatedPrice = $estimatedPrice;

                return $this;
        }

        public function getStatus()
        {
                return $this->status;
        }

        public function setStatus($status)
        {
                $this->status = $status;

                return $this;
        }
    }
?>