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

     
     public function getUserCourse($user_id, $course_id) {
        $sql = "select * from takes where stut_ID = \"$user_id\" and course_id = \"$course_id\"";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            $res1 = $result->fetch_assoc();
            $res = $res1["semester"]." ".$res1["year"]." ".$res1["grade"];
            return $res;
        } else {
            return -1;
        }
     }
    }
$db = new DB_Functions();
$id = $_GET["id"];
$course_id = $_GET["course_id"];
echo $db->getUserCourse($id, $course_id);
//echo $id;
?>