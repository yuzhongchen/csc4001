<?php
 class DB_Functions {
  
     private $con;
     public function connect()
     {
         //连接mysql
         $this->con = new mysqli("localhost", "root", "pwdpwd", "csc4001");
         if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        }
  
         // 返回 database handler
         return $this->con;
     }  
     // constructor
     function __construct() {
         // connecting to database
         $this->connect();
     }


  
     // destructor
     function __destruct() {
 
     }

     
     public function getUserInfo($user_id) {
        $sql = "select First_name, Family_name, Gender, inst_dept_name, Salary from instructor where inst_ID = $user_id";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            $res = $result->fetch_assoc();
            return $user_id." ".$res["First_name"]." ".$res["Family_name"]." ".$res["Gender"]." ".$res["Salary"]." ".$res["inst_dept_name"];
        } else {
            return -1;
        }
     }
    }
$db = new DB_Functions();
$id = $_GET["id"];
//$id = "200000001";
echo $db->getUserInfo($id);
//echo $id;
?>