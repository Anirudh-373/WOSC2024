<?php
 include('../config.php');
 
 if($_SERVER['REQUEST_METHOD'] == 'POST') {
	 if(isset($_POST['abs_id'])){
		$abs_id = $_POST['abs_id'];

		$query = "select * from public.wosc24_abstract where id=$1 and status='D'";
		$result = pg_query_params($conn, $query, array($abs_id));
		$row = pg_fetch_assoc($result);
		echo json_encode($row);
	 }
 }
?>