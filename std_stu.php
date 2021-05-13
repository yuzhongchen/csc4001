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
        $sql = "select * from student WHERE stut_id = $user_id";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            $res = $result->fetch_assoc();
            return $res["stut_ID"]." ".$res["first_name"]." ".$res["family_name"]." ".$res["gender"]." ".$res["major"]." ".$res["stut_dept_name"]." ".$res["course_take"];
        } else {
            return -1;
        }
     }
    }
$db = new DB_Functions();
$id = $_GET["id"];
echo $db->getUserInfo($id);
//echo $id;
?>