<?php 
	include 'config.php';
	$id = $_REQUEST['id'];
	$sql_for_delete_nomeinee = "DELETE FROM nomeinee WHERE id = $id ";
	$query_for_delete_nomeinee = mysqli_query($conn,$sql_for_delete_nomeinee);
	if ($query_for_delete_nomeinee) {
		header('Location: nomeinee.php');
	}
?>