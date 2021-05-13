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

     
     public function getUserCourse($course_id, $semester, $year) {
        $sql = "select grade, count(distinct Stut_id) as sum from takes where course_id = \"$course_id\" and semester = \"$semester\" and year = \"$year\" group by grade";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            $res1 = $result->fetch_assoc();
            $res = $res1["grade"].",".$res1["sum"];
            while ($res1 = $result->fetch_assoc()) {
                $res = $res." ".$res1["grade"].",".$res1["sum"];
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
echo $db->getUserCourse($id, $semester, $year);
//echo $id;
?>