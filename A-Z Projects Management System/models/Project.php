<?php

    class Project{

        private $title, $description, $imgBefore, $imgAfter, $dateCompleted;
        private $imgBeforeName, $imgAfterName;

        public function __construct(){
            $args_val = func_get_args();

            switch(func_num_args()){
                case 7:
                    $this->__construct2($args_val[0], $args_val[1], $args_val[2], $args_val[3], $args_val[4],$args_val[5], $args_val[6]);
                default:
                    $this->__construct1();
            }
        }

        //default constructor
        public function __construct1(){

        }

        public function __construct2($title, $description, $imgBefore, $imgAfter, $dateCompleted, $imgBeforeName, $imgAfterName){
            $this->title = $title;
            $this->description = $description;

            //print_r($imgBefore);
            //echo "Image 2: " + $imgAfter;

            $this->imgBefore = $this->img_prep_upload(file_get_contents($imgBefore), $imgBeforeName);
            $this->imgAfter = $this->img_prep_upload(file_get_contents($imgAfter), $imgAfterName);
            $this->dateCompleted = $dateCompleted;

            $this->imgBeforeName = $imgBeforeName;
            $this->imgAfterName = $imgAfterName;
        }

        private function connect_db(){
            $con = mysqli_connect("localhost", "root", "Hm@dude21");
            mysqli_select_db($con, "lrpc_online");

            return $con;
        }

        //Parameter must be file_get_contents
        private function img_prep_upload($target_file, $file_name){
            $accepted_file_types = array("jpg", "jpeg", "png");

            $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if(in_array($file_type, $accepted_file_types)){
                $base64Format = base64_encode($target_file);
                $image = "data:image/".$file_type.";base64,".$base64Format;
                
                return $image;
            }else{
                echo "
                    <script>
                        alert(\"The file type chosen is not supported\");
                        window.location.href=\"../views/projectManagement.php\";
                    </script>
                ";
            }
        }

        public function new_project(){
            $con = $this->connect_db();

            set_time_limit(0);
            $sql_insert = "INSERT INTO `projects` (`projectTitle`, `description`, `imgBefore`, `imgAfter`, `dateCompleted`) VALUES ('" . $this->title ."', '" . $this->description ."', '" . $this->imgBefore ."', '" . $this->imgAfter ."', '" . $this->dateCompleted ."')";
            $insert_result = mysqli_query($con, $sql_insert);
            
            if($insert_result){
                echo "
                    <script>
                        alert(\"New Project added\");
                        window.location.href=\"../views/projectManagement.php\"
                    </script>
                ";
            }else{
                echo "
                    <script>
                        alert(\"AN ERROR OCCURRED: " . mysqli_error($con) . "\");
                    </script>
                ";
            }

            $con->close();
        }

        public function display_all_projects(){
            $con = $this->connect_db();

            $sql_select = "SELECT * FROM `projects` WHERE 1";
            $select_result = mysqli_query($con, $sql_select);
            
            if(mysqli_num_rows($select_result) > 0){
                while($row = mysqli_fetch_assoc($select_result)){
                    ?>
                        <div class="col-sm-12">
                            <div class="card-deck card-columns">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title"><?php echo $row['projectTitle']; ?></h3><br>
                                        
                                    </div>

                                    <div class="card-body">
                                        
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h4>Description</h4><br>
                                                <p><?php echo $row['description']; ?></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <img src="<?php echo $row['imgBefore']; ?>" width="500" height="500" alt="imgBefore">
                                            </div>

                                            <div class="col-sm-6">
                                                <img src="<?php echo $row['imgAfter']; ?>" width="500" height="500" alt="imgBefore">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <b>Date Completed: </b> <?php echo $row['dateCompleted']; ?>
                                        <button class="btn btn-danger float-right" type="button" onclick="deleteProject(<?php echo $row['projectId']; ?>)">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            }else{
                ?>
                    <div class="col-sm-12"><h2 style="text-align: center;">There are no projects that are currently being displayed.</h2></div>
                <?php
            }

            $con->close();
        }

        public function delete_project($projectId){
            $con = $this->connect_db();

            $sql_delete = "DELETE FROM `projects` WHERE projectId=" . $projectId;
            $delete_result = mysqli_query($con, $sql_delete);

            if($delete_result == TRUE){
                echo "
                    <script>
                        alert(\"Project Deleted\");
                        window.location.href=\"../views/projectManagement.php\";
                    </script>
                ";
            }else{
                echo "
                    <script>
                        alert(\"An error has occurred\");
                        window.location.href=\"../views/projectManagement.php\";
                    </script>
                ";
            }

            $con->close();
        }
    }
?>