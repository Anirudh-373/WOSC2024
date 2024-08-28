<?php
include_once("../config.php");

if($_SERVER['REQUEST_METHOD']=='POST')
{	 
	$submitted_abs = $_POST['sub_abs'];
	$abstract_id = $_POST['abs_id'];
	$railway_station = $_POST['near_railway_st'];
	$airport = $_POST['near_air'];
	$arrival_date_time = $_POST['dt_arrival'];
	$departure_date_time = $_POST['dt_depart'];
	$registration_id = $_POST['registration_id'];
	$uploadDirectory = '../uploads/';
	$file_name = "";
	$file_url = "https://www.niot.res.in/WOSC2024/uploads/";

	if($_FILES['files']!=='') {
		if (!file_exists($uploadDirectory)) {
			mkdir($uploadDirectory, 0777, true);
		}
	
		$response = [];
	
		// echo "filecount=".count($_FILES['files']['tmp_name']);
		$t=time();
	
		// Iterate through uploaded files
		foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
			$file_name = $t."_".$_FILES['files']['name'][$key];
			$file_tmp = $_FILES['files']['tmp_name'][$key];
			$file_type = $_FILES['files']['type'][$key];
	
			$destination = $uploadDirectory . $file_name;
			move_uploaded_file($file_tmp, $destination);
	
			// Add file information to the response array
			$response[] = ['file_name' => $file_name, 'status' => 'File uploaded successfully.'];
		}
	} else {
		$file_url = "";
	}
   

    // Other form data processing...
    
		// echo json_encode(['msg' => 'Files uploaded successfully.', 'files' => $response]);
	
	$file_url.=$file_name;

	$travel_support_query = "INSERT INTO wosc24_travel_support(submitted_abstract,abstract_id,nearest_railway_station,nearest_airport,arrival_date_time,departure_date_time,registration_id,file_url) values ('$submitted_abs','$abstract_id','$railway_station','$airport','$arrival_date_time','$departure_date_time','$registration_id','$file_url')";

	$result = pg_query($conn,$travel_support_query);
	
	$response = array();
	if(!$result) {
		$response['msg'] = "Something went wrong. Please try again later.";
	} else {
		$response['msg'] = "Successfully Opted for travel support.";
	}
	
	// header('Location: ../submission_new.php');
	
	
	pg_close($conn);
	echo json_encode($response);
	// print_r($_POST);
	
}
			
?>