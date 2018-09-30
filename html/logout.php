<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/21/2017
 * Time: 4:51 AM
 */
session_start();
session_destroy();

header('Location:index.php');

