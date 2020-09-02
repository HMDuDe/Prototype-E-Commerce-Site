<?php
    require 'Invoice.php';

    class Booking{
        private $bookingId, $date, $startTime, $endTime, $bookingStatus, $userId, $serviceRequested, $description, $arivalInstructions;

        public function __construct(){
            $args_val = func_get_args();

            switch(func_num_args()){
                case 8:
                    $this->__construct1($args_val[0], $args_val[1], $args_val[2], $args_val[3], $args_val[4], $args_val[5], $args_val[6], $args_val[7]);
                    break;
                default:
                    $this->__construct2();
            }
        }

        public function __construct1($date, $startTime, $endTime, $bookingStatus, $userId, $serviceRequested, $description, $arivalInstructions){
            $this->date = $date;
            $this->startTime = $startTime;
            $this->endTime = $endTime;
            $this->bookingStatus = $bookingStatus;
            $this->userId = $userId;
            $this->serviceRequested = $serviceRequested;
            $this->description = $description;
            $this->arivalInstructions = $arivalInstructions;
        }

        public function __construct2(){
            //default
        }

        private function connect_db(){
            $con = mysqli_connect("localhost", "root", "Hm@dude21");
            mysqli_select_db($con, "lrpc_online");

            return $con;
        }

        public function send_booking_request(){
            $con = $this->connect_db();
            
            $sql_insert = "INSERT INTO `bookings` (`userId`, `date`, `startTime`, `endTime`, `bookingStatus`, `serviceRequested`, `description`, `arivalInstructions`) VALUES ('". $this->userId ."','" . $this->date . "', '". $this->startTime ."', '" . $this->endTime ."', '". $this->bookingStatus ."', '" . $this->serviceRequested ."', '". $this->description ."', '" . $this->arivalInstructions ."')";
            $insert_result = mysqli_query($con, $sql_insert);

            if($insert_result == FALSE){
                ?>
                    <script>
                        alert("AN ERROR HAS OCCURRED: <?php echo mysqli_error($con); ?>");
                        window.location.href="../views/customerDashboard.php";
                    </script>
                <?php
            }else{
                ?>
                    <script>
                        alert("Booking request made - we'll get in touch with you shortly.");
                        window.location.href="../views/customerDashboard.php";
                    </script>
                <?php
            }

            $con->close();
        }

        public function receive_booking_request(){
            $con = $this->connect_db();

            $sql_select = "SELECT * FROM `bookings` WHERE bookingStatus=\"AWAITING CONFIRMATION\"";
            $select_result = mysqli_query($con, $sql_select);

            if(mysqli_num_rows($select_result) > 0){
                while($row = mysqli_fetch_assoc($select_result)){

                    ?>
                        <div class="col-sm-12">
                            <div class="card-deck card-columns">
                                <div class="card">
                                    <div class="card-header">

                                        <h3><?php echo User::get_user_fullname($row['userId']);?></h3><br>
                                        <b>Service Requested: </b> <?php echo $row['serviceRequested'];?>
                                    </div>

                                    <div class="card-body">
                                        <h4>Description</h4><br> <?php echo $row['description'];?><br>
                                        <b>Requested Start Time: <?php echo $row['startTime']; ?></b>
                                        <b class="float-center ml-5"> Requested End Time: <?php echo $row['endTime']; ?></b>
                                        
                                        <button type="button" class="btn float-right btn-info" data-toggle="modal" data-target="#changeTimeModal">Change Time</button>

                                        <div class="modal fade" id="changeTimeModal">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h2 class="modal-title">Change Time</h2>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="jumbotron">
                                                            <b>Note: </b>
                                                            You should decide on the time with the client before saving a time here. If this form is not filled, the original time sugested by the client will be used.
                                                        </div>

                                                        <form action="changeBookingTimeController.php?bookingId=<?php echo $row['bookingId'];?>" method="post">
                                                            <div class="form-group">
                                                                <label for="startTime">New Start Time</label>
                                                                <input type="time" id="startTime" name="startTime">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="endTime">New End Time</label>
                                                                <input type="time" id="endTime" name="endTime">
                                                            </div>

                                                            <div class="form-group float-right">
                                                                <input type="submit" value="Save" class="btn btn-success">
                                                                <input type="reset" value="Cancel" class="btn btn-danger" data-dismiss="modal">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="jumbotron mt-4">
                                            <b>Instructions on Arival: </b> <?php echo $row['arivalInstructions'];?> 
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="button" onclick="confirmBooking(<?php echo $row['bookingId']; ?>)" class="btn btn-success">Confirm</button>
                                        <button type="button" onclick="denyBooking(<?php echo $row['bookingId']; ?>)" class="btn btn-success">Deny</button>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    <?php
                }
            }else{
                ?>
                    <div class="col-sm-12"><h2 style="text-align: center;">There are no <br> pending booking requests</h2></div>
                <?php
            }
        }

        public function customer_view_booking(){
            //Allow customer to view booking information
            $con = $this->connect_db();

            $sql_select = "SELECT * FROM `bookings` WHERE userId=" . $_SESSION['userId'] . " AND bookingStatus='CONFIRMED'";
            $select_result = mysqli_query($con, $sql_select);

            if(mysqli_num_rows($select_result) > 0){
                while($row = mysqli_fetch_assoc($select_result)){

                    ?>
                        <div class="col-sm-12">
                            <div class="card-deck card-columns">
                                <div class="card">
                                    <div class="card-header">
                                        
                                        <h3 style="">Next Booking:</h3> 
                                        <h3 style="text-align: right;"> Date: <?php echo $row['date']; ?></h3>
                                    </div>

                                    <div class="card-body">
                                        Start Time: <?php echo $row['startTime'];?>
                                        End Time: <?php echo $row['endTime'];?>
                                    </div> 

                                    <div class="card-footer float-center">
                                        Status: <?php echo $row['bookingStatus'];?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                }
            }

            $con->close();
        }

        public function confirmBookingTime($bookingId){
            $con = $this->connect_db();

            $sql_update = "UPDATE `bookings` SET `bookingStatus`=\"CONFIRMED\" WHERE bookingId=" . $bookingId;
            $update_result = mysqli_query($con, $sql_update);

            if($update_result == FALSE){
                echo "
                    <script>
                        alert(\"An ERROR has occurred\");
                        window.location.href=\"../views/adminDashboard.php\";
                    </script>
                ";
            }else{
                echo "
                    <script>
                        alert(\"Booking Confirmed.\");
                        window.location.href=\"../views/adminDashboard.php\";
                    </script>
                ";
            }

            $con->close();
        }

        public function denyBookingTime($bookingId){
            $con = $this->connect_db();

            $sql_update = "UPDATE `bookings` SET `bookingStatus`=\"DENIED\" WHERE bookingId=" . $bookingId;
            $update_result = mysqli_query($con, $sql_update);

            if($update_result == FALSE){
                echo "
                    <script>
                        alert(\"An ERROR has occurred\");
                        window.location.href=\"../views/adminDashboard.php\";
                    </script>
                ";
            }else{
                echo "
                    <script>
                        alert(\"Booking Confirmed\");
                        window.location.href=\"../views/adminDashboard.php\";
                    </script>
                ";
            }

            $con->close();
        }

        public function display_all_bookings(){
            $con = $this->connect_db();

            $sql_select = "SELECT * FROM `bookings` ORDER BY startTime ASC, date ASC";
            $select_result = mysqli_query($con, $sql_select);

            if(mysqli_num_rows($select_result) > 0){
                while($row = mysqli_fetch_assoc($select_result)){
                    ?>
                        <div class="col-sm-12">
                            <div class="card-deck card-columns">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 style="text-align: center;"> Date: <?php echo $row['date']; ?></h3>
                                        
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <span class="float-right">
                                                    <h4>Start Time: <?php echo $row['startTime']; ?></h4>
                                                </span>
                                            </div>

                                            <div class="col-sm-6">
                                                <span class="float-left">
                                                    <h4> End Time: <?php echo $row['endTime']; ?></h4>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <b><?php echo $row['serviceRequested']; ?></b><br>
                                        <b>Description: </b><br>
                                        <p><?php echo $row['description']; ?></p>
                                        <b>Arival Instructions: </b><br>
                                        <p><?php echo $row['arivalInstructions']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            }else{
                echo "
                    <h2 style=\"text-align: center;\">No Scheduled Bookings Found</h2>
                ";
            }

            $con->close();
        }

        public function getBookingId()
        {
                return $this->bookingId;
        }

        public function setBookingId($bookingId)
        {
                $this->bookingId = $bookingId;

                return $this;
        }

        public function getDate()
        {
                return $this->date;
        }

        public function setDate($date)
        {
                $this->date = $date;

                return $this;
        }

        public function getStartTime()
        {
                return $this->startTime;
        }

        public function setStartTime($startTime)
        {
                $this->startTime = $startTime;

                return $this;
        }

        public function getEndTime()
        {
                return $this->endTime;
        }

        public function setEndTime($endTime)
        {
                $this->endTime = $endTime;

                return $this;
        }

        public function getBookingStatus()
        {
                return $this->bookingStatus;
        }

        public function setBookingStatus($bookingStatus)
        {
                $this->bookingStatus = $bookingStatus;

                return $this;
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
    }
?>