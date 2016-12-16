<?php include_once './constant.php';
include_once HOME_DIR.'/admin/libs/dbhandle.php';
global $msg;
$uploadOk = 1;
if(!empty($_POST)){
      $name        = $_POST['name'];
      $link        = $_POST['link'];
      $overview    = $_POST['overview'];
      $cover_image = $_FILES['coverimage']['name'];
      $position    = $_POST['position'];
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
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->beginTransaction();

    $statement = $conn->prepare("INSERT INTO works(name, link, overview,cover_image,position,status) VALUES(:name, :link, :overview,:cover_image,:position,:status)");
    if ($statement->execute($data_post)){
      $work_id = $conn->lastInsertId();
      if(!empty($more_images)){
          foreach($more_images as $more_image){
              $workimage = array(
                  "work_id" => $work_id,
                  "more_image" => $more_image,
              );
              $statement = $conn->prepare("INSERT INTO work_image(work_id,image) VALUES(:work_id, :more_image)");
              $statement->execute($workimage);
          }
      }

     header("Location:".SITE_ADDRESS."admin/index.php");
  }else{
    header("Location:".SITE_ADDRESS."admin/libs/add.php");
    $msg['add_insert_fail'] = "Add info failed, please insert again";
  }
    $conn->commit();
} catch(PDOException $e){
    $conn->rollBack();
    header("Location:".SITE_ADDRESS."admin/libs/add.php");
    $msg['add_insert_fail'] = "Add info failed: " . $e->getMessage();
}
}


?>

    <!DOCTYPE html>
    <html lang="en">
<?php include_once HOME_DIR."/admin/layout/header_script.php"; ?>

<body>

<?php include_once HOME_DIR."/admin/layout/header.php"; ?>

<div class="container">
  <div class="row">
    <div class="alert " role="alert"><?php if(isset($msg['add_insert_fail'])){echo $msg['add_insert_fail'];}?></div>
    <form role="form" class="form-horizontal col-sm-10 col-sm-offset-1" method="post" action="" enctype="multipart/form-data">
      <div class="form-group"></div>
      <div class="form-group">
        <label class="col-sm-2" for="project-name">Name</label>
        <div class="col-sm-10">
          <input type="text" name="name" class="form-control" id="project-name" placeholder="Enter Name">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2" for="website-link">Link</label>
        <div class="col-sm-10">
          <input type="text" name="link" class="form-control" id="website-link" placeholder="Website Link">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2" for="overview">Overview</label>
        <div class="col-sm-10">
          <textarea name="overview" class="form-control" id="Overview" placeholder="Overview"></textarea>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2" for="cover-image">Cover Image</label>
        <div class="col-sm-10">
          <input type="file" style="height:auto;" name="coverimage" class="form-control" id="cover-image" placeholder="Cover Image"/>
        </div>
      </div>
        <div class="form-group">
            <label class="col-sm-2" for="more-image">More Image</label>
            <div class="col-sm-10" id="more_image_container">
                <div class="moreimage_unit">
                <input type="file" style="height:auto;" name="moreimage[]" class="form-control" id="more-image" placeholder="More Image"/>
                <a class="add_more">Add one more image</a>
                </div>
            </div>
        </div>

        <script type="application/javascript">
            $(document).ready(function(){
                $("#more_image_container").on("click",".add_more",function() {

                    var unitToAppend = $(this).parent().clone()
                    if (unitToAppend.find(".removeimage").length == 0) {
                        unitToAppend.append("<a class='removeimage'>remove</a>"
                    )
                    }
                    $("#more_image_container").append(unitToAppend)

                    if ($(this).parent().find(".removeimage").length == 0) {
                        $(this).text("remove").removeClass("add_more").addClass("removeimage")
                    } else {
                        $(this).remove()
                    }
                    if($("#more_image_container .moreimage_unit").length == 5){
                        $("#more_image_container .moreimage_unit .add_more").remove()
                    }
                })

                $("#more_image_container").on("click",".removeimage",function(){
                        $(this).parent().remove()
                        if($("#more_image_container").find(".add_more").length == 0){
                            $("<a class='add_more'>Add more image</a>").insertBefore($("#more_image_container .moreimage_unit").last().find(".removeimage"))
                        }
                        if ($("#more_image_container .moreimage_unit").length == 1){
                            $("#more_image_container .moreimage_unit .removeimage").remove()
                        }

                    })


            })
        </script>


      <div class="form-group">
        <label class="col-sm-2" for="position">Position</label>
        <div class="col-sm-10">
          <input type="number" name="position" class="form-control" id="position" placeholder="Position"/>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2" for="status">Status</label>
        <div class="col-sm-10">
          <select class="form-control" name="status">
            <option value="0">Enbale</option>
            <option value="1">Disable</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-2 col-sm-offset-2">
          <button name="submit" type="submit" class="btn btn-default ">Submit</button>
        </div>
      </div>
      </div>
    </form>
  </div>
</div>
<?php include_once HOME_DIR."/admin/layout/footer_script.php"; ?>
</body>
    </html>