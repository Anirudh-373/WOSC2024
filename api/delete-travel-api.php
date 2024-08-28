<?php
include_once("../config.php");

if($_SERVER['REQUEST_METHOD']=='POST')
{	 
	$tid = $_POST['t_id'];

	$travel_support_query = "delete from wosc24_travel_support where t_id=$1;";

	$result = pg_query_params($conn,$travel_support_query, array($tid));
	$_SESSION['active_tab'] = "travel";
	$response = array();
	if(!$result) {
		$response['msg'] = "Something went wrong. Please try again later.";
	} else {
		$response['msg'] = "1 row deleted successfully";
	}

	pg_close($conn);
	echo json_encode($response);
	
}
			
?>