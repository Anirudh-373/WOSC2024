<?php
session_start();

include_once("../config.php");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	
    $accommodation = $_POST['accommodation'];
    $registration_id = $_POST['registration_id'];
    $response = Array();

    $sql ="
        UPDATE public.wosc24_registration SET accommodation=$1 WHERE serial_no = $2";
	
    //$ret = pg_query($conn, $sql);
	$ret = pg_query_params($conn, $sql, array($accommodation, $registration_id));
    if(!$ret) {
        $response['msg'] = "Something went wrong.\n don't worry it's not you, it's from our side."; 
    } else {
        $response['msg'] = "Accomodation details updated Successfully\n";
        $_SESSION['accommodation'] = $accommodation;
	}
    pg_close($conn);
} else {
    $response['msg'] =  "Invalid Request";
}

echo json_encode($response);
?>