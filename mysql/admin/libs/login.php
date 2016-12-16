<?php
include_once './constant.php';
include_once HOME_DIR.'/admin/libs/dbhandle.php';

if(isset($_POST['submit'])){
    $data = $conn->prepare("SELECT * FROM `admins` where `email` = '".$_POST['email']."'");
    $data->execute();
    $result = $data->fetch(PDO::FETCH_ASSOC);
    if ($result !== false){
        if(Password::verify($_POST['passwd'],$result['passwd'])== true){
            $_SESSION['is_login'] = true;
            header("Location:".SITE_ADDRESS."admin/index.php");
        }else{
            $error= "wrong password";
        }
    }else{
        $error = "wrong email address";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/signin.css" rel="stylesheet">


  </head>

  <body>

    <div class="container">

      <form class="form-signin" role="form" method="post" action="">
        <h2 class="form-signin-heading">Please sign in</h2>
          <?php if(isset($error)){echo $error;}?>
        <input name="email" type="email" class="form-control" placeholder="Email address" required autofocus>
        <input name="passwd" type="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="signin">Sign in</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
