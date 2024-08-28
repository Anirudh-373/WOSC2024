<?php
 include('../config.php');
 
 if($_SERVER['REQUEST_METHOD'] == 'POST') {
	 if(isset($_POST['registration_id'])){
		$registration_id = $_POST['registration_id'];

		$query = "select wosc24_abstract.id, aim.abstract_num  from wosc24_abstract
                    join abstract_id_map aim on aim.abstract_submission_id = wosc24_abstract.id
                    where registration_id=$1 
					and wosc24_abstract.id not in (select abstract_id from wosc24_travel_support where registration_id=$2)";
		// $query = "select * from (select wabs.id, aim.abstract_num, wts.id as wts_id  from wosc24_abstract as wabs
		// 			join abstract_id_map aim on aim.abstract_submission_id = wabs.id
		// 			join wosc24_travel_support as wts on wts.abstract_id = wabs.id
		// 			where registration_id=$1) as temp 
		// 			where temp.wts_id is null;";
		$result = pg_query_params($conn, $query, array($registration_id, $registration_id));
		$response = array();
		$response['data'] = array();
		while($row =  pg_fetch_assoc($result)) {
			array_push($response['data'],$row);
		}
		
		echo json_encode($response);
	 }
 }
?>