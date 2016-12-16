<?php
include_once './constant.php';
include_once HOME_DIR.'/admin/libs/dbhandle.php';
$work_id = $_GET['id'];
$data = $conn->prepare("DELETE FROM `works` WHERE id=".$work_id);
$data->execute();
header("Location:".SITE_ADDRESS."admin/index.php");
