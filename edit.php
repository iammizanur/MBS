<?php 
  session_start();
  if (!isset($_SESSION['user_name'])) {
    header('Location: login.php');
  }
  $customer_id = $_SESSION['customer_id'];
  include 'config.php';
  $msg = "";
  $id = $_REQUEST['id'];
  $sql_for_get_nomeinee_for_update = "SELECT * FROM nomeinee WHERE id = $id ";
  $query_for_get_nomeinee_for_update = mysqli_query($conn,$sql_for_get_nomeinee_for_update);
  $result_for_get_nomeinee_for_update = mysqli_fetch_array($query_for_get_nomeinee_for_update);

  if (isset($_POST['update'])) {
    $nomeinee_name = $_POST['nomeinee_name'];
    $relation = $_POST['relationship'];
    $nid = $_POST['nid'];
    $sql_for_nomeinee_update = "UPDATE nomeinee SET nomeinee_name = '$nomeinee_name',relation = '$relation',nid = '$nid' WHERE id = $id ";
    $query_for_nomeinee_update = mysqli_query($conn,$sql_for_nomeinee_update);
    if ($query_for_nomeinee_update) {
      header('Location: nomeinee.php');
    }
  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Nomeinee</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
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
          <li class="nav-item">
            <a class="nav-link" href="deposit.php">Deposit</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="withdrow.php">Withdrow</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="transfer.php">Transfer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="nomeinee.php">Nomeinee</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">logout</a>
          </li>
  			</ul>
  		</div>  
  	</nav>
  </section>
  <!-- section for top nav bar start -->
  <!-- The sidebar -->
	<div class="sidebar">
		<a class="" href="index.php">Home</a>
	</div>
<br>

<div class="container">
  <h2>Update Nomeinee</h2><hr>
  <?php echo $msg; ?>
  <form action="" method="POST">
    <div class="form-group">
      <label for="account_no">Account NO:</label>
      <input type="text" name="" class="form-control" value="<?php echo $result_for_get_nomeinee_for_update['account_no']; ?>" id="account_no" readonly >
    </div>
    <div class="form-group">
      <label for="nomeinee_name">Nomeinee Name</label>
      <input type="text" class="form-control" id="nomeinee_name" name="nomeinee_name" required="" value="<?php echo $result_for_get_nomeinee_for_update['nomeinee_name']; ?>">
    </div>
    <div class="form-group">
      <label for="relationship">Relationship With Nomeinee</label>
      <input type="text" name="relationship" id="relationship" class="form-control" value="<?php echo $result_for_get_nomeinee_for_update['relation']; ?>">
    </div>
    <div class="form-group">
      <label for="nid">Nomeinee NID NO</label>
      <input type="text" name="nid" id="nid" class="form-control" value="<?php echo $result_for_get_nomeinee_for_update['nid'] ?>">
    </div>
    <button type="submit" class="btn btn-success" name="update">Update</button>&nbsp;<a href="nomeinee.php" class="btn btn-info">Cancel</a>
  </form>
</div>

</body>
</html>
