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

     
     public function getUserAssignment($course_id, $stut_id, $assignment_id) {
        $sql = "select title, type, grade, total, descript from assignment where course_id = \"$course_id\" and stut_id = \"$stut_id\" and assignment_id = \"$assignment_id\"";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            $res1 = $result->fetch_assoc();
            $res = $res1["title"].",".$res1["type"].",".$res1["grade"].",".$res1["total"].",".$res1["descript"];
            $sql1 = "select title, pass, grade, descript from test where course_id = \"$course_id\" and stut_id = \"$stut_id\" and assignment_id = \"$assignment_id\"";
            $result1 = $this->con->query($sql1);
            while ($res2 = $result1->fetch_assoc()) {
                $res = $res."|".$res2["title"].",".$res2["pass"].",".$res2["grade"].",".$res2["descript"];
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
$assignment_id = $_GET["assignment_id"];
// $course_id = "CSC4001";
// $stut_id = "118011000";
// $assignment_id = "1";
echo $db->getUserAssignment($course_id, $stut_id, $assignment_id);