<?php
include_once("../config.php");

if($_SERVER['REQUEST_METHOD']=='POST') {

    $title = $_POST['title'];
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $status = $_POST['status'];
    $university = $_POST['university'];
    $company = $_POST['company'];
    $transaction_num = $_POST['transaction_num'];
    $date = $_POST['date'];
    $amount_to_pay = $_POST['amount_to_pay'];

    $query = "insert into wosc24_spot_registration 
            (title, fullname, address, status, university, company, transaction_no, tdate, amount)
            values('$title', '$fullname', '$address', '$status', '$university', '$company', '$transaction_num', '$date', '$amount_to_pay')";

	$result = pg_query($conn,$query);

	$response = array();
	if(!$result) {
		$response['msg'] = "Something went wrong. Please try again later.";
	} else {
		$response['msg'] = "Registration is Successful.";
	}
	
	pg_close($conn);
	echo json_encode($response);
}
?>