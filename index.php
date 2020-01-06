<?php 
  session_start();
  if (!isset($_SESSION['user_name'])) {
    header('Location: login.php');
  }
  $customer_id = $_SESSION['customer_id'];
  // $msg='';
  include 'config.php';
  //get old account and set new account value to input field
  $sql_for_get_old_account = "SELECT account_no FROM account ORDER BY account_id DESC LIMIT 1 ";
  $query_for_get_old_account = mysqli_query($conn,$sql_for_get_old_account);
  $result_for_get_old_account = mysqli_fetch_array($query_for_get_old_account);
  $old_account = $result_for_get_old_account['account_no'];
  if ($old_account=='')
    $new_account = '100001';
  else
    $new_account = intval($old_account)+1;

  //create new account
  if (isset($_POST['create_account'])) {
    $account_no = $_POST['account_no'];
    $current_balance = 0;
    $sql_for_create_new_account = "INSERT INTO account(customer_id,account_no,current_balance) VALUES($customer_id,'$account_no',$current_balance) ";
    $query_for_create_new_account = mysqli_query($conn,$sql_for_create_new_account);
    if ($query_for_create_new_account) {
      // $msg = '<div class="alert alert-success alert-dismissible">
      // <button type="button" class="close" data-dismiss="alert">&times;</button>
      // <strong>account created..!</strong> successfull.</div>';
      header('location: ???');
    }
  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>HOME</title>
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
					<a class="nav-link active" href="index.php">Home</a>
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
          <a class="nav-link" href="nomeinee.php">Nomeinee</a>
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
		<a class="active" href="index.php">Home</a>
	</div>
<br>

<div class="container">
  <h2>Account Information <small class="text-info">(<?php echo $_SESSION['user_name']; ?>)</small> </h2><hr>
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Account Number</th>
        <th class="amount">Current Balance (TK)</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $sql_for_account_details = "SELECT account_no,current_balance FROM account WHERE customer_id = $customer_id ";
        $query_for_account_details = mysqli_query($conn,$sql_for_account_details);
        while($result_for_account_details = mysqli_fetch_array($query_for_account_details)){
      ?>
      <tr>
        <td><?php echo $result_for_account_details['account_no']; ?></td>
        <td class="amount"><?php echo $result_for_account_details['current_balance']; ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  <br><br>
  <hr>
  <br><br>
  <h2>Create New Account</h2><hr>
  <form action="" method="POST">
    <div class="form-group">
      <label for="account_no">Account No:</label>
      <input readonly type="text" class="form-control" id="account_no" name="account_no" required=""value="<?php echo $new_account; ?>">
    </div>
    <button type="submit" class="btn btn-primary" name="create_account">Create Account</button>
  </form><br><br>
  <!-- <?php echo $msg; ?> -->
</div>

</body>
</html>
