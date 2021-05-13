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

     
     public function upload($course_id, $stut_id, $assignment_id, $path) {
        $sql = "select type, descript from assignment where course_id = \"$course_id\" and stut_id = \"$stut_id\" and assignment_id = \"$assignment_id\"";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            $res1 = $result->fetch_assoc();
            $type = $res1["type"];
            $op = "cd ~\n cd Desktop/student/\n ./client 4 ".$path;
            exec($op);
            if ($type == "1") {
                $op1 = "cd ~\n cd Desktop/student/\n ./client 8 ".$path;
                exec($op1);
                $filename = "/Users/chenyuzhong/Desktop/student/recv_result.txt";
                $handle = fopen($filename, "r");
                $contents = fread($handle, filesize ($filename));
                fclose($handle);
                $contents = explode("|", (string)$contents);
                $count = 0;
                foreach ($contents as $i) {
                    if (strpos($i, ",")) {
                        $count += 1;
                        $i = explode(",", $i);
                        $pass = $i[0];
                        $descript = $i[1];
                        $sql1 = "UPDATE test SET pass = \"$pass\", descript = \"$descript\" where course_id = \"$course_id\" and stut_id = \"$stut_id\" and assignment_id = \"$assignment_id\" and test_id = \"$count\"";
                        $result1 = $this->con->query($sql1);
                    }
                }
                $grade = 0;
                $sql2 = "select pass, grade from test where course_id = \"$course_id\" and stut_id = \"$stut_id\" and assignment_id = \"$assignment_id\"";
                $result2 = $this->con->query($sql2);
                while ($res = $result2->fetch_assoc()) {
                    if ($res["pass"] == "1") {
                        $grade += (int) $res["grade"];
                    }
                }
                $sql = "UPDATE assignment SET grade = \"$grade\" where course_id = \"$course_id\" and stut_id = \"$stut_id\" and assignment_id = \"$assignment_id\"";
                $result = $this->con->query($sql);
            }
            return 1;
        } else {
            return -1;
        }
     }
    }
$db = new DB_Functions();
$course_id = $_GET["course_id"];
$stut_id = $_GET["id"];
$assignment_id = $_GET["assignment_id"];
$path = $_GET["path"];
// echo $course_id;
// echo $stut_id;
// echo $assignment_id;
// echo $path;
// $course_id = "CSC4001";
// $stut_id = "118011000";
// $assignment_id = "1";
// $path = "submission1.txt";
echo $db->upload($course_id, $stut_id, $assignment_id, $path);