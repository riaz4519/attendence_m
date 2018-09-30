<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/21/2017
 * Time: 2:02 AM
 */
    $server = "localhost";
    $username = "root";
    $pass = "";
    $dbname = "attendance";
    $connect = new mysqli($server,$username,$pass,$dbname)or die("database error");