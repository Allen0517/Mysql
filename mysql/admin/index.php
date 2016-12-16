<?php
include_once './libs/constant.php';
include_once HOME_DIR.'/admin/libs/dbhandle.php';

if ($_SESSION['is_login'] !== true ){
    header("Location:".SITE_ADDRESS."admin/libs/login.php");
}


$data = $conn->prepare("SELECT * FROM works ORDER by POSITION DESC ");
$data->execute();

$result = $data->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<?php include_once HOME_DIR."/admin/layout/header_script.php"; ?>

<body>

<?php include_once HOME_DIR."/admin/layout/header.php"; ?>




<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active"><a href="#">Works</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Works</h1>


            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Website</th>
                        <th>Image</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Update</th>
                        <th>Delete</th>



                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result as $item){?>
                    <tr>
                        <td><?php echo $item['id']?></td>
                        <td><?php echo $item['name']?></td>
                        <td><?php echo $item['link']?></td>
                        <td><img width="150" src="<?php echo SITE_ADDRESS."/images/".basename($item['cover_image']);?>"></td>
                        <td><?php echo $item['position']?></td>
                        <td><?php echo ($item['status'] == 1)? "Enabled":"Disabled";?></td>
                        <td><a href="<?php echo SITE_ADDRESS."admin/libs/update.php?id=".$item['id']?>" onclick="return confirm('Are you sure to update this message?')">Update</a></td>
                        <td><a href="<?php echo SITE_ADDRESS."admin/libs/delete.php?id=".$item['id']?>" onclick="return confirm('Are you sure to delete this message?')">Delete</a></td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="col-sm-2 col-sm-offset-3 col-md-2 col-md-offset-9 text-right"><a href="<?php echo SITE_ADDRESS."admin/libs/add.php"?>" class="btn btn-default btn-lg active" role="button">Add</a></div>
    </div>
</div>


<?php include_once HOME_DIR."/admin/layout/footer_script.php"; ?>
</body>
</html>
