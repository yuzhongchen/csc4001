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

     public function storeUser($user_id, $password, $type) {
        $val = $this->isUserExisted($user_id);
        if ($val != -1) {
            $sql = "INSERT INTO user_login VALUES (\"$user_id\", \"$password\", \"$type\");";
            $result = $this->con->query($sql);
            return 1;
        } else {
            return -1;
        }
     }
     public function isUserExisted($user_id) {
        $sql = "SELECT * FROM user_login WHERE user_id = \"$user_id\"";
        $result = $this->con->query($sql);
         if ($result->num_rows > 0) {
             return -1;
         } else {
             //用户不存在
             return 1;
         }
     }
    }
$db = new DB_Functions();
$id = $_GET["id"];
$password = $_GET["password"];
$type = $_GET["type"];
//$id = "1";
//$password = "1";
//$type  = 1;
echo $db->storeUser($id, $password, $type);
//echo $id;
?>