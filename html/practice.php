<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6/3/2017
 * Time: 11:47 PM
 */
//    $string = "riaz.i3216@gmail.com";
//echo $ans  = substr($string,strpos($string,'@')+1,strpos($string,'.')+1);

include 'connect.php';
include 'functions.php';

    $query = "select max(roll) + 1 as roll from student WHERE class = 6 and section = 'A'";
    $ans = query($query);
    $result = $ans->fetch_assoc();
    $result['roll'];
if(!0){
    echo 'yeas';
}




?>