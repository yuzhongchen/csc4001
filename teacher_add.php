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

     public function storeAssignment($course_id, $semester, $year, $title, $descript, $total, $type) {
        $assignment_id = -1;
        $sql = "select assignment_id from assignment where course_id = \"$course_id\" and semester = \"$semester\" and year = \"$year\"";
        $result = $this->con->query($sql);
        $assignment_id = $result->num_rows + 1;
        $sql = "select stut_id from takes where course_id = \"$course_id\" and semester = \"$semester\" and year = \"$year\"";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            while ($res1 = $result->fetch_assoc()) {
                $id = $res1["stut_id"];
                $sql = "INSERT INTO assignment VALUES (\"$id\", \"$course_id\", \"$semester\", \"$year\", \"$assignment_id\", \"$title\", \"$descript\", \"0\", \"$total\", \"$type\");";
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
$type = $_GET["type"];
$total = $_GET["total"];
// $course_id = "CSC4001";
// $semester = "Fall";
// $year = "2021";
// $title = "a1";
// $descript = "this a1";
// $type = "1";
// $total = "10";
echo $db->storeAssignment($course_id, $semester, $year, $title, $descript, $total, $type);
//echo $id;
?>