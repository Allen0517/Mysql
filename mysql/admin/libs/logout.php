<?php
include_once './constant.php';
include_once HOME_DIR.'/admin/libs/dbhandle.php';
if(isset($_SESSION['is_login']) and $_SESSION['is_login'] == true ){
    session_destroy();
    header("Location:".SITE_ADDRESS."admin/libs/login.php");
}else{
    header("Location:".SITE_ADDRESS."admin/libs/login.php");
}