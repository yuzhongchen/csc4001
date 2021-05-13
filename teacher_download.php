<?php
$name = $_GET["name"];
// $name = "1.txt";
$op = "cd ~\n cd Desktop/teacher/\n ./client 3 ".$name;
exec($op);
?>