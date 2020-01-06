<?php 
  session_start();
  if (!isset($_SESSION['user_name'])) {
    header('Location: login.php');
  }
  $customer_id = $_SESSION['customer_id'];
  include 'config.php';
  $msg = "";
  if (isset($_POST['nomeinee'])) {
    $nomeinee_name = $_POST['nomeinee_name'];
    $relation = $_POST['relationship'];
    $nid = $_POST['nid'];
    $account_no = $_POST['account_no'];
    $sql_for_nomeinee_add = "INSERT INTO nomeinee(nomeinee_name,relation,nid,account_no,c_id) VALUES('$nomeinee_name','$relation','$nid','$account_no',$customer_id) ";
    $query_for_nomeinee_add = mysqli_query($conn,$sql_for_nomeinee_add);
    if ($query_for_nomeinee_add) {
      $msg = '<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Nomeinee</strong> added successful.</div>';
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
  <h2>Nomeinee List</h2><hr>
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Relation</th>
        <th>Account No</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $sql_for_nomeinee_view = "SELECT * FROM nomeinee WHERE c_id = $customer_id ";
        $query_for_nomeinee_view = mysqli_query($conn,$sql_for_nomeinee_view);
        while ($result_for_nomeinee_view = mysqli_fetch_array($query_for_nomeinee_view)) {
      ?>
      <tr>
        <td><?php echo $result_for_nomeinee_view['nomeinee_name']; ?></td>
        <td><?php echo $result_for_nomeinee_view['relation']; ?></td>
        <td><?php echo $result_for_nomeinee_view['account_no']; ?></td>
        <td><a class="btn btn-sm btn-info" href="view.php?id=<?php echo $result_for_nomeinee_view['id']; ?>" title="View"><i class="fas fa-eye"></i></a> <a class="btn btn-sm btn-success" href="edit.php?id=<?php echo $result_for_nomeinee_view['id']; ?>" title="Edit"><i class="fas fa-edit"></i></a> <a class="btn btn-sm btn-danger" href="delete.php?id=<?php echo $result_for_nomeinee_view['id']; ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash"></i></a></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  <br><br>
  <hr>
  <br>
  <h2>Create New Nomeinee</h2><hr>
  <?php echo $msg; ?>
  <form action="" method="POST">
    <div class="form-group">
      <label for="amount">Account NO:</label>
      <select class="form-control" name="account_no" required="">
        <option value="">Select Account NO</option>
        <?php 
          $sql_for_account_no1 = "SELECT account_no FROM account WHERE customer_id = $customer_id ";
          $query_for_account_no1 = mysqli_query($conn,$sql_for_account_no1);
          while($result_for_account_no1 = mysqli_fetch_array($query_for_account_no1)){
        ?>
        <option><?php echo $result_for_account_no1['account_no']; ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label for="nomeinee_name">Nomeinee Name</label>
      <input type="text" class="form-control" id="nomeinee_name" name="nomeinee_name" required="" placeholder="">
    </div>
    <div class="form-group">
      <label for="relationship">Relationship With Nomeinee</label>
      <input type="text" name="relationship" id="relationship" class="form-control" placeholder="">
    </div>
    <div class="form-group">
      <label for="nid">Nomeinee NID NO</label>
      <input type="text" name="nid" id="nid" class="form-control" placeholder="">
    </div>
    <button type="submit" class="btn btn-success" name="nomeinee">Create Nomeinee</button>
  </form>
</div>

</body>
</html>
