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

     
     public function getUserAssignment($course_id, $semester, $year) {
        $sql = "select assignment_id, title from assignment where course_id = \"$course_id\" and semester = \"$semester\" and year = \"$year\"";
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
$id = $_GET["course_id"];
$semester = $_GET["semester"];
$year = $_GET["year"];
// $id = "CSC4001";
// $semester = "Fall";
// $year = "2021";
echo $db->getUserAssignment($id, $semester, $year);
//echo $id;