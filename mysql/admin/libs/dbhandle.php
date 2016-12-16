<?php
include_once "constant.php";
$servername = "localhost";
$username = "root";
$password = "";
global $msg;
try {
    $conn = new PDO("mysql:host=$servername;dbname=web_develop", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $msg['dbhandle_con_success'] =  "Connected successfully";
}
catch(PDOException $e)
{
    $msg['dbhandle_con_failed'] = "Connection failed: " . $e->getMessage();
}


