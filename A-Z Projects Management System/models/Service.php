<?php
    //Author: Hugh-Martin Roux

    class Service{

        private $category, $serviceTitle, $description, $startingPrice;

        //main constructor
        function __construct(){
            $arg_vals = func_get_args();

            //print_r($arg_vals);

            switch(func_num_args()){
                case 4:
                    $this->__construct2($arg_vals[0], $arg_vals[1], $arg_vals[2], $arg_vals[3]);
                    break;

                default:
                    $this->__construct1();
            }
        }

        //default constructor
        function __construct1(){

        }

        //constructor with parameters
        function __construct2($category, $serviceTitle, $description, $startingPrice){
            $this->category = $category;
            $this->serviceTitle = $serviceTitle;
            $this->description = $description;
            $this->startingPrice = $startingPrice;

            //echo "<script>alert(\"SERVICE TITLE:\"" . $this->serviceTitle . ")</script>";
        }

        public function connect_db(){
            $con = mysqli_connect("localhost", "root", "Hm@dude21");
            mysqli_select_db($con, "lrpc_online");

            return $con;
        }

        public function display_services(){
            $con = $this->connect_db();

            $sql_select = "SELECT * FROM `services` WHERE 1";
            $select_result = mysqli_query($con, $sql_select);
            
            if(mysqli_num_rows($select_result) > 0){
                while($row = mysqli_fetch_assoc($select_result)){
                    ?>
                        <div class="col-sm-2"></div>
                        
                        <div class="col-sm-8">
                            <div class="card-deck card-columns">
                                <div class="card">
                                    <div class="card-header">
                                        <h3><?php echo $row['serviceTitle']; ?></h3>
                                    </div>
                                        
                                    <div class="card-body">
                                            <b class="float-center"><?php echo $row['category'];?></b><br>
                                            <hr style="height: 2px; background-color: black;">
                                            <b>Description:</b><br>
                                            <p><?php echo $row['description']; ?></p>
                                    </div>

                                    <div class="card-footer">
                                        <b>Starting Price: R</b> <?php echo $row['startingPrice'];?>
                                        <div class="row float-right">
                            
                                            <button type="button" onclick="deleteService(<?php echo $row['serviceId']; ?>)" class="btn btn-danger">Delete</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-2"></div>
                    <?php
                }
            }

            $con->close();
        }

        public function add_service(){
            
            $con = $this->connect_db();

            $sql_insert = "INSERT INTO `services`(`category`, `serviceTitle`, `description`, `startingPrice`) VALUES ('" . $this->category. "', '" . $this->serviceTitle. "', '" . $this->description. "', '" . $this->startingPrice. "')";
            $sql_result = mysqli_query($con, $sql_insert);

            if($sql_result == TRUE){
                echo "
                    <script>
                        alert(\"New service added\");
                        window.location.href = \"../views/serviceManagement.php\";
                    </script>
                ";
            }else{
                echo "
                    <script>
                        alert(\"An error occurred: ". mysqli_error($con) ."\");
                        window.location.href = \"../views/serviceManagement.php\";
                    </script>
                ";
            }
        }

        public function remove_service($serviceId){
            $con = $this->connect_db();

            $sql_delete = "DELETE FROM `services` WHERE serviceId=" . $serviceId;

            $delete_result = mysqli_query($con, $sql_delete);

            if($delete_result == TRUE){
                echo "
                    <script>
                        alert(\"Service Deleted\");
                        window.location.href=\"../views/serviceManagement.php\";
                    </script>
                ";
            }else{
                echo "
                    <script>
                        alert(\"An error has occurred\");
                        window.location.href=\"../views/serviceManagement.php\";
                    </script>
                ";
            }
        }
    }
?>