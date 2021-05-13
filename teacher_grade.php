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

     public function storeGrade($course_id, $semester, $year, $assignment_id, $grade, $stut_id) {
        $sql = "UPDATE assignment SET grade = \"$grade\" where course_id = \"$course_id\" and semester = \"$semester\" and year = \"$year\" and stut_id = \"$stut_id\" and assignment_id = \"$assignment_id\";";
        $result = $this->con->query($sql);
        return 1;
     }
    }
$db = new DB_Functions();
$course_id = $_GET["course_id"];
$semester = $_GET["semester"];
$year = $_GET["year"];
$assignment_id = $_GET["assignment_id"];
$grade = $_GET["grade"];
$stut_id = $_GET["stut_id"];
// $course_id = "CSC4001";
// $semester = "Fall";
// $year = "2021";
// $title = "t1";
// $descript = "this t1";
// $assignment_id = "1";
// $grade = "10";
echo $db->storeGrade($course_id, $semester, $year, $assignment_id, $grade, $stut_id);
//echo $id;
?>