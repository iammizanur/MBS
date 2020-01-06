<?php 
  session_start();
  if (!isset($_SESSION['user_name'])) {
    header('Location: login.php');
  }
  $customer_id = $_SESSION['customer_id'];
  include 'config.php';
  $id = $_REQUEST['id'];
  $sql_for_nomeinee_view = "SELECT * FROM nomeinee WHERE id = $id ";
  $query_for_nomeinee_view = mysqli_query($conn,$sql_for_nomeinee_view);
  $result_for_nomeinee_view = mysqli_fetch_array($query_for_nomeinee_view);
      
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
  <h2>Nomeinee Details</h2><hr>
  <h4>Name: <small><?php echo $result_for_nomeinee_view['nomeinee_name']; ?></small></h4>
  <h4>Relationship: <small><?php echo $result_for_nomeinee_view['relation']; ?></small></h4>
  <h4>NID: <small><?php echo $result_for_nomeinee_view['nid']; ?></small></h4>
  <h4>Account NO: <small><?php echo $result_for_nomeinee_view['account_no']; ?></small></h4>
  <a href="nomeinee.php" class="btn btn-info">Back</a>
</div>

</body>
</html>
