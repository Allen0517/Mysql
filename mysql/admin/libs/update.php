<?php
include_once './constant.php';
include_once HOME_DIR.'/admin/libs/dbhandle.php';
$workId = $_GET['id'];
$data = $conn->prepare("SELECT * FROM works where id = ".$workId);
$data->execute();
$result = $data->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
    <html lang="en">
<?php include_once HOME_DIR."/admin/layout/header_script.php"; ?>
<body>

<?php include_once HOME_DIR."/admin/layout/header.php"; ?>
<div class="container">
    <div class="row">
        <div class="alert " role="alert"><?php if(isset($msg['add_insert_fail'])){echo $msg['add_insert_fail'];}?></div>
        <form role="form" class="form-horizontal col-sm-10 col-sm-offset-1" method="post" action="./update_file.php?id=<?php echo $workId?>" enctype="multipart/form-data">
            <div class="form-group"></div>
            <div class="form-group">
                <label class="col-sm-2" for="project-name">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="project-name" placeholder="Enter Name" value="<?php echo $result[0]['name']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2" for="website-link">Link</label>
                <div class="col-sm-10">
                    <input type="text" name="link" class="form-control" id="website-link" placeholder="Website Link" value="<?php echo $result[0]['link']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2" for="overview">Overview</label>
                <div class="col-sm-10">
                    <textarea name="overview" class="form-control" id="Overview" placeholder="Overview"><?php echo $result[0]['overview']?></textarea>
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
                    <input type="number" name="position" class="form-control" id="position" placeholder="Position" value="<?php echo $result[0]['position']?>"/>
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
                    <button name="submit" type="submit" value="submit" class="btn btn-default ">Submit</button>
                </div>
            </div>
    </div>
    </form>
</div>
</div>
<?php include_once HOME_DIR."/admin/layout/footer_script.php"; ?>
</body>
</html>