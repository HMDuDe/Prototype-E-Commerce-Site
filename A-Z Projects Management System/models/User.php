<?php
    //Author: Hugh-Martin Roux

    class User{
        private $email, $password, $fName, $lName, $contactNo, $address;

        //Default constructor
        public function __construct(){
            $par_vals = func_get_args();

            switch(func_num_args()){
                case 2:
                    $this->__construct2($par_vals[0], $par_vals[1]);
                    break;
                
                case 6:
                    $this->__construct1($par_vals[0], $par_vals[1], $par_vals[2], $par_vals[3], $par_vals[4], $par_vals[5]);
                    break;
                
                default:
                    $this->__construct3();
            }
        }

        //Constructor w/all parameters
        public function __construct1($email, $password, $fName, $lName, $contactNo, $address){
            $this->email = $email;
            $this->password = $password;
            $this->fName = $fName;
            $this->lName = $lName;
            $this->contactNo = $contactNo;
            $this->address = $address;

        }

        //Constructor with login parameters
        public function __construct2($email, $password){
            $this->email = $email;
            $this->password = $password;
        }

        //default constructor
        public function __construct3(){

        }

        public function connect_db(){
            $con = mysqli_connect("localhost", "root", "Hm@dude21");
            mysqli_select_db($con, "lrpc_online");

            return $con;
        }

        public function register_user(){
            $con = $this->connect_db();

            //Check if user exists
            if($this->check_user_existence($this->email) == FALSE){
                $sql_insert = "INSERT INTO `Users`(`email`, `password`, `firstName`, `lastName`, `contactNo`, `address`) VALUES ('" . $this->email ."', '" . $this->password . "', '". $this->fName . "', '" . $this->lName ."', '" . $this->contactNo."', '" . $this->address . "')";
                $insert_result = mysqli_query($con, $sql_insert);

                //Verify succesful registration
                if($insert_result){
                    echo "
                        <script>
                            alert(\"Registration successful\");
                            window.location.href = \"../views/loginPage.php\";
                        </script>
                    ";
            
                }else{
                    echo "<script>alert(\"An error has occurred\");</script>";
                }
            }else{
                echo "
                    <script>
                        alert(\"A user with that email already exists\");
                        window.location.href = \"../views/loginPage.php\";
                    </script>
                ";
            }

            $con->close();
        }

        public function login(){
            $con = $this->connect_db();

            $select_sql = "SELECT `password` FROM `users` WHERE `email`='" . $this->email ."'";
            $select_result = mysqli_query($con, $select_sql);
            $select_result = $select_result->fetch_all();

            //Check if email exists in db
            if(count($select_result) == 0){
                echo "
                    <script>
                        alert(\"The email and password given do not match\");
                        window.location.href = \"../views/loginPage.php\";
                    </script>
                ";
            }else{
                //Check if passwords match
                if($select_result[0][0] == $this->password){
                    //Check for owner login
                    if($this->email == "lroux868@gmail.com"){
                        $sql_select_all = "SELECT * FROM `users` WHERE email='". $this->email ."'";
                        $select_all_result = mysqli_query($con, $sql_select_all);

                        if(mysqli_num_rows($select_all_result) > 0){
                            $row = mysqli_fetch_assoc($select_all_result);

                            $_SESSION['userId'] = $row['userId'];
                            $_SESSION['email'] = $row['email'];
                            $_SESSION['firstName'] = $row['firstName'];
                            $_SESSION['lastName'] = $row['lastName'];
                            $_SESSION['contactNo'] = $row['contactNo'];
                            $_SESSION['address'] = $row['address'];
                        }
                        
                        echo "
                            <script>
                                alert(\"Login successful\");
                                window.location.href = \"../views/adminDashboard.php?email=" . $this->email . "\";
                            </script>
                        ";
                    }else{

                        $sql_select_all = "SELECT * FROM `users` WHERE email='". $this->email ."'";
                        $select_all_result = mysqli_query($con, $sql_select_all);

                        if(mysqli_num_rows($select_all_result) > 0){
                            $row = mysqli_fetch_assoc($select_all_result);

                            $_SESSION['userId'] = $row['userId'];
                            $_SESSION['email'] = $row['email'];
                            $_SESSION['firstName'] = $row['firstName'];
                            $_SESSION['lastName'] = $row['lastName'];
                            $_SESSION['contactNo'] = $row['contactNo'];
                            $_SESSION['address'] = $row['address'];
                        }

                        echo "
                            <script>
                                alert(\"Login successful\");
                                window.location.href = \"../views/customerDashboard.php?email=" . $this->email . "\";
                            </script>
                        ";
                    }
                    
                }else{
                    echo "
                        <script>
                            alert(\"INCORRECT PASSWORD\");
                            window.location.href = \"../views/loginPage.php\";
                        </script>
                    ";
                }
            }

            $con->close();
        }

        public function log_out(){
            session_unset();
            session_destroy();

            echo "<script>alert(\"SESSION TERMINATED\");</script>";
            echo "<script>window.location.href=\"../views/index.php\"</script>";
        }
        
        public function check_user_existence($user_email){
            $con = $this->connect_db();
    
            $sql_select = "SELECT * FROM `Users` WHERE 1";
    
            $select_result = mysqli_query($con, $sql_select);
            $users = $select_result->fetch_all();
    
            foreach($users as $user){
                if($user[1] == $user_email){
                    return true;
    
                }else{
                    return false;
    
                }
            }

            $con->close();
        }

        public function retrieve_data($email){
            $con = $this->connect_db();

            $sql_select = "SELECT * FROM `Users` WHERE email='" . $email ."'";
            $select_result = mysqli_query($con, $sql_select);
            $select_result = $select_result->fetch_all();

            $con->close();

            return $select_result[0];
        }

        public static function get_user_fullname($custId){
            $con = (new self)->connect_db();

            $sql_select = "SELECT `firstName`, `lastName` FROM `users` WHERE userId='". $custId ."';";
            $select_result = mysqli_query($con, $sql_select);

            if(!$select_result){
                return mysqli_error();
            }else{
                $custNameArr = mysqli_fetch_assoc($select_result);
                
                return $custNameArr['firstName'] . " " . $custNameArr['lastName'];
            }
        }

        public function changeUserPassword($userId, $new_password){
            $con = $this->connect_db();

            $sql_update = "UPDATE `users` SET `password`='" . $new_password . "' WHERE `userId`='" . $userId . "'";
            $update_result = mysqli_query($con, $sql_update);

            if($update_result == TRUE){
                echo "
                    <script>
                        alert(\"Password Changed.\");
                        window.location.href = \"../views/customerDashboard.php?email=" . $this->email . "\";
                    </script>
                ";
            }else{
                echo "
                    <script>
                        alert(\"An ERROR occurred: ". mysqli_error($con) ."\");
                        window.location.href = \"../views/customerDashboard.php?email=" . $this->email . "\";
                    </script>
                ";
            }

            $con->close();
        }

        public function getEmail()
        {
                return $this->email;
        }

        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        public function getFName()
        {
                return $this->fName;
        }

        public function setFName($fName)
        {
                $this->fName = $fName;

                return $this;
        }

        public function getLName()
        {
                return $this->lName;
        }

        public function setLName($lName)
        {
                $this->lName = $lName;

                return $this;
        }

        public function getContactNo()
        {
                return $this->contactNo;
        }

        public function setContactNo($contactNo)
        {
                $this->contactNo = $contactNo;

                return $this;
        }

        public function getAddress()
        {
                return $this->address;
        }

        public function setAddress($address)
        {
                $this->address = $address;

                return $this;
        }
    }
?>