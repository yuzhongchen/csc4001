<?php
	if ((isset($_POST["userName"]))&&(isset($_POST["password"]))){
		$userName = $_POST["userName"];
		$passWord = $_POST["password"];
		if($userName == ""||$passWord == "da39a3ee5e6b4b0d3255bfef95601890afd80709"){
            die("用户名/密码不能为空！");}
	    }
    //数据库操作，取出保存的用户名和密码$savedUserName和$savedPassWord 
		if($savedUserName=== $userName){}else{die("用户名错误");}
		if($savedPassWord != $passWord){
		    die("密码错误");
		}else{ 
			echo "OK";
			return;
        }
    }
?>
