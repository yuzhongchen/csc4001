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

     
     public function getUserAssignment($course_id, $stut_id) {
        $sql = "select assignment_id, title from assignment where course_id = \"$course_id\" and stut_id = \"$stut_id\"";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            $res1 = $result->fetch_assoc();
            $res = $res1["assignment_id"].",".$res1["title"];
            while ($res1 = $result->fetch_assoc()) {
                $res = $res."|".$res1["assignment_id"].",".$res1["title"];
            }
            return $res;
        } else {
            return -1;
        }
     }
    }
$db = new DB_Functions();
$course_id = $_GET["course_id"];
$stut_id = $_GET["id"];
// $course_id = "CSC4001";
// $stut_id = "118011000";
echo $db->getUserAssignment($course_id, $stut_id);