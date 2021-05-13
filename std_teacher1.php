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

     
     public function getUserCourse($user_id) {
        $sql = "select course_id, semester, year from teaches where Inst_ID = $user_id";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            $res1 = $result->fetch_assoc();
            $res = $res1["course_id"].",".$res1["year"].",".$res1["semester"];
            while ($res1 = $result->fetch_assoc()) {
                $res = $res." ".$res1["course_id"].",".$res1["year"].",".$res1["semester"];
            }
            return $res;
        } else {
            return -1;
        }
     }
    }
$db = new DB_Functions();
$id = $_GET["id"];
echo $db->getUserCourse($id);
//echo $id;
?>