<?php 
	include 'config.php';
	$work_function = $_POST['work_function'];
	switch ($work_function) {
		case 'Deposit':
			$account_no = $_POST['account_no'];
			$sql_for_deposite_details = "SELECT account_no,amount,transjection_date FROM transjection_info WHERE account_no = '$account_no' AND status = '$work_function' ";
			$query_for_deposite_details = mysqli_query($conn,$sql_for_deposite_details);
			while ($result_for_deposite_details = mysqli_fetch_array($query_for_deposite_details)) {
				echo "<tr><td>".$result_for_deposite_details['account_no']."</td><td class='amount'>".$result_for_deposite_details['amount']."</td><td>".$result_for_deposite_details['transjection_date']."</td></tr>";
			}
			break;

		case 'Withdrow':
			$account_no = $_POST['account_no'];
			$sql_for_withdrow_details = "SELECT account_no,amount,transjection_date FROM transjection_info WHERE account_no = '$account_no' AND status = '$work_function' ";
			$query_for_withdrow_details = mysqli_query($conn,$sql_for_withdrow_details);
			if (mysqli_num_rows($query_for_withdrow_details)>0) {
				while ($result_for_withdrow_details = mysqli_fetch_array($query_for_withdrow_details)) {
				echo "<tr><td>".$result_for_withdrow_details['account_no']."</td><td class='amount'>".$result_for_withdrow_details['amount']."</td><td>".$result_for_withdrow_details['transjection_date']."</td></tr>";
				}
			}else echo "No record";
			break;

		case 'Transfer':
			$from_account_no = $_POST['account_no'];
			$sql_for_transfer_info = "SELECT from_account_no,to_account_no,t_amount,status FROM transfer_info INNER JOIN transjection_info ON transfer_info.from_account_no = transjection_info.account_no WHERE (from_account_no = '$from_account_no' AND (status = 'IN' OR status = 'OUT' ))";
			$query_for_transfer_info = mysqli_query($conn,$sql_for_transfer_info);
			while ($result_for_transfer_info = mysqli_fetch_array(($query_for_transfer_info))) {
				echo "<tr><td>".$result_for_transfer_info['from_account_no']."</td><td>".$result_for_transfer_info['to_account_no']."</td><td class='amount'>".$result_for_transfer_info['t_amount']."</td><td>".$result_for_transfer_info['status']."</td></tr>" ;
			}

			break;
		
		default:
			# code...
			break;
	}
?>