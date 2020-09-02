<?php
    require 'User.php';

    class Invoice{
        private $invoiceNo, $total, $amountRemaining, $invoiceDate, $description, $userId, $status;
        
        public function __construct(){
            $arg_vals = func_get_args();

            switch(func_num_args()){
                case 7:
                    $this->__construct4($arg_vals[0], $arg_vals[1], $arg_vals[2], $arg_vals[3], $arg_vals[4], $arg_vals[5], $arg_vals[6]);
                    break;
                case 5:
                    $this->__construct2($arg_vals[0], $arg_vals[1], $arg_vals[2], $arg_vals[3], $arg_vals[4]);
                    break;
                case 4:
                    $this->__construct3($arg_vals[0], $arg_vals[1], $arg_vals[2], $arg_vals[3]);
                    break;
                default:
                    $this->__construct1();
            }
        }

        //Default constructor
        function __construct1(){

        }

        function __construct2($total, $amountRemaining, $invoiceDate, $description, $userId){
            $this->total = $total;
            $this->amountRemaining = $amountRemaining;
            $this->invoiceDate = $invoiceDate;
            $this->description = $description;
            $this->userId = $userId;
        }

        function __construct3($total, $invoiceDate, $description, $userId){
            $this->total = $total;
            $this->invoiceDate = $invoiceDate;
            $this->description = $description;
            $this->userId = $userId;
        }

        function __construct4($invoiceNo, $total, $amountRemaining, $invoiceDate, $description, $userId, $status){
            $this->invoiceNo = $invoiceNo;
            $this->total = $total;
            $this->amountRemaining = $amountRemaining;
            $this->invoiceDate = $invoiceDate;
            $this->description = $description;
            $this->userId = $userId;
            $this->status = $status;
        }

        public function get_invoiceNo(){
            return $this->invoiceNo;
        }

        public function get_total(){
            return $this->total;
        }

        public function get_amountRemaining(){
            return $this->amountRemaining;
        }

        public function get_invoiceDate(){
            return $this->invoiceDate;
        }

        public function get_description(){
            return $this->description;
        }

        public function get_userId(){
            return $this->userId;
        }


        public function connect_db(){
            $con = mysqli_connect("localhost", "root", "Hm@dude21");
            mysqli_select_db($con, "lrpc_online");

            return $con;
        }

        public function save_invoice(){
            $con = $this->connect_db();

            $sql_insert = "INSERT INTO `invoices`(`invoiceDate`, `description`, `totalAmountDue`, `amountRemaining`, `userId`, `status`) VALUES ('" . $this->invoiceDate . "', '" . $this->description ."', '" . $this->total ."', '" . $this->total ."', '" . $this->userId ."', 'NOT SENT')";
            $insert_result = mysqli_query($con, $sql_insert);

            if($insert_result == TRUE){
                echo "
                    <script>
                        alert(\"Invoice Created\");
                        window.location.href=\"../views/invoiceManagement.php\";
                    </script>
                ";
            }else{
                echo "
                    <script>
                        alert(\"An error occurred\");
                    </script>
                ";
            }
        }

        public function get_invoice_details($invoiceId){
            $con = $this->connect_db();

            $sql_select = "SELECT * FROM `invoices` WHERE invoiceId='" . $invoiceId . "'";
            $select_result = mysqli_query($con, $sql_select);
            $sql_result = $sql_result->fetch_all();

            return $sql_result[0];
        } 

        public function display_invoice_cards(){
            $con = $this->connect_db();

            $sql_select = "SELECT * FROM `invoices` ORDER BY `status` DESC";
            $select_result = mysqli_query($con, $sql_select);
            
            if(mysqli_num_rows($select_result) > 0){
                while($row = mysqli_fetch_assoc($select_result)){
                    ?>
                        <div class="col-sm-12">
                            <div class="card-deck card-columns">
                                <div class="card">
                                    <div class="card-header">
                                        <b> <?php echo User::get_user_fullname($row['userId']); ?></b>
                                        <b class="float-right"> Invoice No: <?php echo $row['invoiceId']?></b><br>
                                        <b>Status: </b> <?php echo $row['status']; ?>
                                    </div>

                                    <div class="card-body">
                                        <?php echo "<p>" . $row['description'] . "</p>";?>
                                        <?php echo "<b>DATE: " . $row['invoiceDate'] . "</b><br>";?>
                                        <?php echo "<b>TOTAL: </b> R " . $row['totalAmountDue']; ?>
                                    </div>

                                    <div class="card-footer">
                                        <?php 
                                            if($row['status'] == 'SENT TO CLIENT' or $row['status'] == 'NOT SENT'){
                                                ?>
                                                    <button type="button" onclick="view_invoice(<?php echo $row['invoiceId']?>)" class="btn btn-success">View Invoice</button>
                                                    <button type="button" onclick="sendInvoiceBtn(<?php echo $row['invoiceId']; ?>)" class="btn btn-info">Send Invoice</button>
                                                    <button type="button" onclick="deleteInvoiceBtn(<?php echo $row['invoiceId']; ?>)" class="btn btn-danger">Delete Invoice</button>
                                                <?php
                                            }else if($row['status'] == 'PAID IN FULL'){
                                                ?>
                                                    <button type="button" onclick="view_invoice(<?php echo $row['invoiceId']?>)" class="btn btn-success">View Invoice</button>
                                                    
                                                <?php
                                            }
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            }else{
                echo "
                    <b class=\"float-center\">No Invoices found</b>
                ";
            }
        }

        public function create_payment_install($invoiceId, $userId, $amount, $dueDate){
            $con = $this->connect_db();

            $sql_insert = "INSERT INTO `payments` (`invoiceId`, `userId`, `paymentAmount`, `paymentDate`,`status`) VALUES ('" . $invoiceId ."', '" . $userId . "', '" . $amount . "', '" . $dueDate . "', 'NOT YET PAID')";
            $insert_result = mysqli_query($con, $sql_insert);

            if($insert_result){
                echo "
                    <script>
                        alert(\"Installment created\");
                        window.location.href=\"../views/invoiceIndiv.php?invoiceId=". $invoiceId ."\";
                    </script>
                ";
            }else{
                echo "
                    <script>
                        alert(\"An error occurred: ". mysqli_error($con) ."\");
                    </script>
                ";
            }
        }

        public function display_installments($invoiceId){
            $con = $this->connect_db();

            $sql_select = "SELECT * FROM `payments` WHERE invoiceId='" . $invoiceId . "'";
            $select_result = mysqli_query($con, $sql_select);

            if(mysqli_num_rows($select_result) > 0){
                while($row = mysqli_fetch_assoc($select_result)){

                    ?>
                        <div class="row p-2" style="text-align: center;">
                            <div class="col-sm-3 border">
                                <?php echo $row['paymentId'];?>
                            </div>

                            <div class="col-sm-3 border">
                                <?php echo $row['paymentDate']; ?>
                            </div>

                            <div class="col-sm-2 border">
                                <?php echo $row['status']; ?>
                            </div>

                            <div class="col-sm-2 border">
                                <?php echo "R " . $row['paymentAmount']; ?>
                            </div>

                            <div class="col-sm-2">
                                <?php 
                                    if($row['status'] == 'PAID'){
                                        if($_SESSION['email'] != "lroux868@gmail.com"){
                                            ?>
                                                <button type="button" onclick="addToCart(<?php echo $row['paymentId']; ?>)" class="btn btn-success active" disabled>Add to cart</button>
                                            <?php
                                        }else{
                                            ?>
                                                <button type="button" onclick="deleteInstallment(<?php echo $row['paymentId']; ?>)" class="btn btn-danger active" disabled>Delete</button>
                                            <?php
                                        }
                                    }else{
                                        if($_SESSION['email'] != "lroux868@gmail.com"){
                                            if(isset($_SESSION['cartItems'])){
                                                if(in_array($row['paymentId'], $_SESSION['cartItems'])){
                                                    ?>
                                                        <button type="button" onclick="addToCart(<?php echo $row['paymentId']; ?>)" class="btn btn-success active" disabled>Add to cart</button>
                                                    <?php
                                                }else{
                                                    ?>
                                                        <button type="button" onclick="addToCart(<?php echo $row['paymentId']; ?>)" class="btn btn-success">Add to cart</button>
                                                    <?php
                                                }
                                            }else{
                                                    ?>
                                                        <button type="button" onclick="addToCart(<?php echo $row['paymentId']; ?>)" class="btn btn-success">Add to cart</button>
                                                    <?php
                                            }
                                        }else{
                                            ?>
                                                <button type="button" onclick="deleteInstallment(<?php echo $row['paymentId']; ?>)" class="btn btn-danger">Delete</button>
                                            <?php
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    <?php
                }
            }else{
                echo "<p>No installments found</p>";
            }
        }

        public function display_cust_invoices($userId){
            $con = $this->connect_db();

            $sql_select = "SELECT * FROM `invoices` WHERE userId='" . $userId . "' AND status='SENT TO CLIENT' AND `amountRemaining`<>0";
            $select_result = mysqli_query($con, $sql_select);

            if(mysqli_num_rows($select_result) > 0){
                while($row = mysqli_fetch_assoc($select_result)){
                    ?>
                        <div class="col-sm-12">
                            <div class="card-deck card-columns">
                                <div class="card">
                                    <div class="card-header">
                                        <h2 style="text-align: center;"><?php echo $row['invoiceDate'];?></h2>
                                    </div>

                                    <div class="card-body">
                                        <p><?php echo $row['description'];?></p>

                                        <b>Total: R <?php echo $row['totalAmountDue'];?></b>
                                        <b class="float-right">Amount Remaining: R <?php echo $row['amountRemaining'];?></b>
                                    </div>
                                    
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-success" onclick="view_invoice(<?php echo $row['invoiceId'];?>)">View Invoice</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            }else{
                echo "<h2 style=\"text-align: center;\">No Active Invoices found</h2>";
            }
        }

        public function delete_invoice($invoiceId){
            $con = $this->connect_db();
            
            $sql_delete = "DELETE FROM `invoices` WHERE invoiceId=" .$invoiceId;
            $delete_result = mysqli_query($con, $sql_delete);

            if($delete_result == TRUE){
                echo "
                    <script>
                        alert(\"Invoice Deleted\");
                        window.location.href=\"../views/invoiceManagement.php\";
                    </script>
                ";
            }else{
                echo "
                    <script>
                        alert(\"An ERROR occurred: ". mysqli_error($con) ."\");
                        window.location.href=\"../views/invoiceManagement.php\";
                    </script>
                ";
            }

            $con->close();
        }

        public function delete_installment($paymentId){
            $con = $this->connect_db();

            $sql_delete = "DELETE FROM `payments` WHERE paymentId=" . $paymentId;
            $delete_result = mysqli_query($con, $sql_delete);

            if($delete_result == TRUE){
                echo "
                    <script>
                        alert(\"Payment Installment Deleted\");
                        window.location.href=\"../views/invoiceManagement.php\";
                    </script>
                ";
            }else{
                echo "
                    <script>
                        alert(\"An ERROR occurred: ". mysqli_error($con) ."\");
                        window.location.href=\"../views/invoiceManagement.php\";
                    </script>
                ";
            }

            $con->close();
        }

        public function send_to_client($invoiceId){
            $con = $this->connect_db();

            $sql_update = "UPDATE `invoices` SET status='SENT TO CLIENT' WHERE `invoiceId`=". $invoiceId;
            $update_result = mysqli_query($con, $sql_update);

            if($update_result == TRUE){
                echo "
                    <script>
                        alert(\"Invoice Sent to client\");
                        window.location.href=\"../views/invoiceManagement.php\";
                    </script>
                ";
            }else{
                echo "
                    <script>
                        alert(\"An ERROR occurred: ". mysqli_error($con) ."\");
                        window.location.href=\"../views/invoiceManagement.php\";
                    </script>
                ";
            }

            $con->close();
        }

        public function setInvoiceNo($invoiceNo)
        {
                $this->invoiceNo = $invoiceNo;

                return $this;
        }

        public function setTotal($total)
        {
                $this->total = $total;

                return $this;
        }

        public function setAmountRemaining($amountRemaining)
        {
                $this->amountRemaining = $amountRemaining;

                return $this;
        }
 
        public function setInvoiceDate($invoiceDate)
        {
                $this->invoiceDate = $invoiceDate;

                return $this;
        }

        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }

        public function setUserId($userId)
        {
                $this->userId = $userId;

                return $this;
        }
    }
?>