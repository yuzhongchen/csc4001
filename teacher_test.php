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

     public function storeTest($course_id, $semester, $year, $title, $descript, $assignment_id, $grade) {
        $test_id = -1;
        $sql = "select test_id from test where course_id = \"$course_id\" and semester = \"$semester\" and year = \"$year\" and assignment_id = \"$assignment_id\"";
        $result = $this->con->query($sql);
        $test_id = $result->num_rows + 1;
        $sql = "select stut_id from takes where course_id = \"$course_id\" and semester = \"$semester\" and year = \"$year\"";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            while ($res1 = $result->fetch_assoc()) {
                $id = $res1["stut_id"];
                $sql = "INSERT INTO test VALUES (\"$id\", \"$course_id\", \"$semester\", \"$year\", \"$assignment_id\", \"$test_id\", \"$title\", \"$descript\", \"$grade\", \"0\");";
                $result = $this->con->query($sql);
            }
            return 1;
        } 
        return 1;
     }
    }
$db = new DB_Functions();
$course_id = $_GET["course_id"];
$semester = $_GET["semester"];
$year = $_GET["year"];
$title = $_GET["title"];
$descript = $_GET["descript"];
$assignment_id = $_GET["assignment_id"];
$grade = $_GET["grade"];
// $course_id = "CSC4001";
// $semester = "Fall";
// $year = "2021";
// $title = "t1";
// $descript = "this t1";
// $assignment_id = "1";
// $grade = "10";
echo $db->storeTest($course_id, $semester, $year, $title, $descript, $assignment_id, $grade);
//echo $id;
?>