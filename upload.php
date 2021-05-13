<?php
    $filename = "/Users/chenyuzhong/Desktop/student/recv_result.txt";
    $handle = fopen($filename, "r");
    $contents = fread($handle, filesize ($filename));
    fclose($handle);
    $contents = $contents.split("|");
    echo $contents;
?>