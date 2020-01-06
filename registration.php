<?php
  include 'config.php';
  $msg = "";
  if(isset($_POST['Registration'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql_for_insert = "insert into customer(first_name,last_name,email,password) values('$first_name','$last_name','$email','$password')";
    $query_for_insert = mysqli_query($conn,$sql_for_insert);
    if($query_for_insert){
      $msg = '<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Registration Success!</strong>.</div>';
    }
    else{
      $msg = '<div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Registration Failed!</strong>.</div>';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registration</title>
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
      <h2 class="text-center">Registration</h2>
      <hr>
      <form action="" method="POST">
        <div class="form-group">
        <label for="first_name">First Name:</label>
        <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="first_name" required="">
        </div>
        <div class="form-group">
        <label for="last_name">Last Name:</label>
        <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name" required="">
        </div>
        <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required="">
        </div>
        <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required="">
        </div>
        <button type="submit" class="btn btn-primary" name="Registration">Submit</button>
        <a style="float: right;" href="login.php">Login</a>
        <br><br>
        <?php echo $msg;?>
      </form>
    </div>
    <div class="col-md-4"></div>
  </div>
</div>

</body>
</html>
