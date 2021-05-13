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
     public function storeUser($name, $user_id, $password) {
         $uuid = uniqid('', true);
         $hash = $this->hashSSHA($password);
         $encrypted_password = $hash["encrypted"]; // 加密后的密文
         $salt = $hash["salt"]; // salt
         $result = mysqli_query($this->con,"INSERT INTO user_login(unique_id, name, user_id, encrypted_password, salt, created_at) VALUES('$uuid', '$name', '$user_id', '$encrypted_password', '$salt', NOW())");
         // 检查结果
         if ($result) {
             // 获取用户信息
             $uid = mysqli_insert_id($this->con); // 获取最新的id
             $result = mysqli_query($this->con,"SELECT * FROM user_login WHERE uid = $uid");
             //返回刚插入的用户信息
             return mysqli_fetch_array($result);
         } else {
             return false;
         }
     }
     public function getUserByIdAndPassword($user_id, $password) {
         $sql = "SELECT * FROM user_login WHERE user_id = '$user_id'";
         $result = $this->con->query($sql);
         if ($result->num_rows > 0) {
            $res = $result->fetch_assoc();
            // check for password
            if ($res["password"] == $password) {
                return $value["user_id"]." ".$value["user_type"];
            }
        } else {
            return -1;
        }
     }
     public function isUserExisted($user_id) {
         $result = mysqli_query($this->con,"SELECT user_id from user_login WHERE user_id = '$user_id'");
         $no_of_rows = mysqli_num_rows($result);
         if ($no_of_rows > 0) {
             // 用户存在
             return true;
         } else {
             //用户不存在
             return false;
         }
     }
    }
$db = new DB_Functions();
$value = $db->getUserByIdAndPassword("001", "123456");
echo $value["user_id"]." ".$value["user_type"];
?>