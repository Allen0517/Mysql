<?php
include_once './constant.php';
include_once HOME_DIR.'/admin/libs/dbhandle.php';
$workId = $_GET['id'];
$data = $conn->prepare("SELECT * FROM works where id = ".$workId);
$data->execute();
$result = $data->fetchAll(PDO::FETCH_ASSOC);

if(!empty($_POST['submit'])){
    $name        = empty($_POST['name'])? $result[0]['name']:$_POST['name'];
    $link        = empty($_POST['link'])? $result[0]['link']:$_POST['link'];
    $overview    = empty($_POST['overview'])? $result[0]['overview']:$_POST['overview'];
    $cover_image = empty($_FILES['coverimage']['name'])? $result[0]['cover_image']:$_FILES['coverimage']['name'];
    $position    = empty($_POST['position'])? $result[0]['position']:$_POST['position'];
    $status      = $_POST['status'];

    $target_file = HOME_DIR."/images/".basename($cover_image);

    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["coverimage"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["coverimage"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $more_images = array();
    foreach($_FILES['moreimage']['name'] as $key => $value){
        $target_file = HOME_DIR."/images/".$value;
        if (!file_exists($target_file)) {
            move_uploaded_file($_FILES["moreimage"]["tmp_name"][$key], $target_file);
            $more_images[] = basename($target_file);
        } else {
            $more_images[] = basename($target_file);
            echo 'file already exists';
        }
    }

    $data_post = array(
        "name" => $name,
        "link" => $link,
        "overview" => $overview,
        "cover_image"=> $cover_image,
        "position"=> $position,
        "status"=> $status,
    );


    try{
        $sql = "UPDATE `works` SET `name`='".$name."',`link`='".$link."',`overview`='".$overview."',`cover_image`='".$cover_image."',`position`='".$position."',`status`='".$status."' WHERE `id`=".$workId;
        $statement = $conn->prepare($sql);
        $statement->execute();
        if ($statement->execute()){
            $work_id = $conn->lastInsertId();
            if(!empty($more_images)){
                foreach($more_images as $more_image){
                    $sql = "UPDATE `work_image` SET `work_id`='".$work_id."',`image`='".$more_image."' WHERE `id`=".$workId;
                    $statement = $conn->prepare($sql);
                    $statement->execute();
                }
            }

            header("Location:".SITE_ADDRESS."admin/index.php");
        }else{
            header("Location:".SITE_ADDRESS."admin/libs/update.php?id=".$workId);
            $msg['add_insert_fail'] = "Add info failed, please insert again";
        }
    } catch(PDOException $e){
        header("Location:".SITE_ADDRESS."admin/libs/update.php?id=".$workId);
        $msg['add_insert_fail'] = "Add info failed: " . $e->getMessage();
    }
}