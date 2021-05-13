<?php
  
 class DB_Connect
 {
     public $con;

     function __construct()
     {
     }
 
     function __destruct()
     {
         // $this->close();
     }
  
     //连接数据库
     public function connect()
     {
         require_once 'config.php';
         //连接mysql
         $this->con = mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE) or die(mysqli_error($this->con));
         if (mysqli_connect_errno()) {
             die("Database connection failed");
         }
  
         // 返回 database handler
         return $this->con;
     }
  
     //关闭数据连接
     public function close()
     {
         mysqli_close($this->con);
     }
  
 }
  
 ?>