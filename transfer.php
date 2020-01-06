<?php 
  session_start();
  if (!isset($_SESSION['user_name'])) {
    header('Location: login.php');
  }
  $msg = '';
  $today = date('d-m-y');
  $customer_id = $_SESSION['customer_id'];
  include 'config.php';
  

  if (isset($_POST['transfer'])) {
    $from_account_no = $_POST['from_account_no'];
    $to_account_no = $_POST['to_account_no'];
    $amount = $_POST['amount'];
    //get available balance in account
    $sql_for_get_current_balance = "SELECT current_balance FROM account WHERE account_no = '$from_account_no' ";
    $query_for_get_current_balance = mysqli_query($conn,$sql_for_get_current_balance);
    $result_for_get_current_balance = mysqli_fetch_array($query_for_get_current_balance);
    $old_balance = doubleval($result_for_get_current_balance['current_balance']);
    //check available balance for transfer
    if ($old_balance < doubleval($amount)) {
      $msg = '<div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Falied..!</strong> You do not have enough money.</div>';
    }
    else{
      if ($from_account_no==$to_account_no) {
        $msg = '<div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Falied..!</strong> You can not transfer to same account.</div>';
      }
      else{
        $sql_for_transfer_from_account = "INSERT INTO transjection_info(account_no,amount,status,transjection_date) VALUES('$from_account_no',$amount,'OUT','$today') ";
        $query_for_transfer_from_account = mysqli_query($conn,$sql_for_transfer_from_account);
        if ($query_for_transfer_from_account) {
          $sql_for_transfer_to_account = "INSERT INTO transjection_info(account_no,amount,status,transjection_date) VALUES('$to_account_no',$amount,'IN','$today') ";
          $query_for_transfer_to_account = mysqli_query($conn,$sql_for_transfer_to_account);
          if ($query_for_transfer_to_account) {
            $new_balance_from_account = $old_balance - doubleval($amount);
            $sql_for_update_amount_from_account = "UPDATE account SET current_balance = $new_balance_from_account WHERE account_no = '$from_account_no' ";
            $query_for_update_amount_from_account = mysqli_query($conn,$sql_for_update_amount_from_account);
            if ($query_for_update_amount_from_account) {
              $sql_for_to_account_balance = "SELECT current_balance FROM account WHERE account_no = '$to_account_no' ";
              $query_for_to_account_balance = mysqli_query($conn,$sql_for_to_account_balance);
              $result_for_to_account_balance = mysqli_fetch_array($query_for_to_account_balance);
              $old_balance_to_account = doubleval($result_for_to_account_balance['current_balance']);
              $new_balance_to_account = $old_balance_to_account + doubleval($amount);
              $sql_for_update_amount_to_account = "UPDATE account SET current_balance = $new_balance_to_account WHERE account_no = '$to_account_no' ";
              $query_for_update_amount_to_account = mysqli_query($conn,$sql_for_update_amount_to_account);
              if ($query_for_update_amount_to_account) {
                $sql_for_save_info_from_account_and_to_account = "INSERT INTO transfer_info(from_account_no,to_account_no,t_amount) VALUES('$from_account_no','$to_account_no
                ',$amount) ";
                $query_for_save_info_from_account_and_to_account = mysqli_query($conn,$sql_for_save_info_from_account_and_to_account);
                if ($query_for_save_info_from_account_and_to_account) {
                  $msg = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>successful..!</strong> transfer.</div>';
                }
              }
            }
          }
        }
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Transfer</title>
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
        <li class="nav-item">
          <a class="nav-link" href="deposit.php">Deposit</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="withdrow.php">Withdrow</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="transfer.php">Transfer</a>
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
  <h2>Transfer Information</h2><hr>
  <div class="form-group">
      <label for="amount">From Account NO:</label>
      <select class="form-control" id="account_no" required="" onchange="get_deposite_info()">
        <option value="">Select Account NO</option>
        <?php 
          $sql_for_account_no = "SELECT account_no FROM account WHERE customer_id = $customer_id ";
          $query_for_account_no = mysqli_query($conn,$sql_for_account_no);
          while($result_for_account_no = mysqli_fetch_array($query_for_account_no)){
        ?>
        <option><?php echo $result_for_account_no['account_no'] ?></option>
        <?php } ?>
      </select>
    </div>
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>From Account Number</th>
        <th>To Account Number</th>
        <th class="amount">Deposit Amount (TK)</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody id="depo_info">
      
    </tbody>
  </table>
  <br><br>
  <hr>
  <br><br>
  <h2>Transfer Amount</h2><hr>
  <?php echo $msg; ?>
  <form action="" method="POST">
    <div class="form-group">
      <label for="amount">From Account NO:</label>
      <select class="form-control" name="from_account_no" required="">
        <option value="">Select From Account NO</option>
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
      <label for="amount">To Account NO:</label>
      <select class="form-control" name="to_account_no" required="">
        <option value="">Select To Account NO</option>
        <?php 
          $sql_for_account_no2 = "SELECT account_no FROM account WHERE customer_id = $customer_id ";
          $query_for_account_no2 = mysqli_query($conn,$sql_for_account_no2);
          while($result_for_account_no2 = mysqli_fetch_array($query_for_account_no2)){
        ?>
        <option><?php echo $result_for_account_no2['account_no']; ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label for="amount">Amount:</label>
      <input type="number" class="form-control" id="amount" name="amount" required="" min="0">
    </div>
    <button type="submit" class="btn btn-success" name="transfer">Transfer</button>
  </form> 
</div>

<script type="text/javascript">
  function get_deposite_info(){
    var account_no = $('#account_no').val();
    if (account_no=='') {
      alert('Please select Account NO');
    }
    else{
      $.ajax({
        url: "account_info.php",
        type: 'POST',
        data: {account_no:account_no,work_function:'Transfer'},
        success: function(response){
          $('#depo_info').html(response);
        }
      });
    }
  }
</script>

</body>
</html>