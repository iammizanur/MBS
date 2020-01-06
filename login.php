<?php
  session_start();
  if (isset($_SESSION['user_name'])) {
    header('Location: index.php');
  }
  include 'config.php';
  $msg = "";
  if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM customer WHERE email = '$email' AND password = '$password' ";
    $query = mysqli_query($conn,$sql);
    if(mysqli_num_rows($query)==1){
      $result = mysqli_fetch_array($query);
      $_SESSION['user_name'] = $result['first_name'].' '.$result['last_name'];
      $_SESSION['customer_id'] = $result['customer_id'];
      header('Location: index.php');
    }
    else{
      $msg = '<div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Login Failed..!</strong> Wrong Email or Password.</div>';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
  <!-- section for top nav bar start -->
  <section>
	<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="index.php">MBS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>    
      </ul>
    </div>  
  </nav>
  </section>
  <!-- section for top nav bar start -->
  <!-- The sidebar -->
  <div class="sidebar">
    <a href="index.php">Home</a>
  </div>
<br>
<div class="container">
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <h2 class="text-center">Login</h2>
      <hr>
      <form action="" method="POST">
        <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required="">
        </div>
        <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required="">
        </div>
        <button type="submit" class="btn btn-primary" name="login">Login</button>
        <a style="float: right;" href="registration.php">Don't have account</a>
        <br><br>
        <?php echo $msg;?>
      </form>
    </div>
    <div class="col-md-4"></div>
  </div>
</div>
</body>
</html>
