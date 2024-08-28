<?php
include_once('../config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $select_query = "
		SELECT serial_no, stitle, fullname, registration_num, status, accommodation, mode_of_participation, is_ecop FROM wosc24_registration
		join registration_id_map on registration_id_map.registration_id = wosc24_registration.serial_no
		WHERE email = $1 AND password = $2";
        $result = pg_query_params($conn, $select_query, array($email, $password));
        $rows = pg_fetch_array($result);

        // print_r($rows);
        // echo "rows=".$rows['fullname'];
		$_SESSION['uts'] = time();
        $_SESSION['id'] = $rows['serial_no'];
		$_SESSION['registration_num'] = $rows['registration_num'];
        $_SESSION['stitle'] = $rows['stitle'];
        $_SESSION['fullname'] = $rows['fullname'];
        $_SESSION['participant_status'] = $rows['status'];
        $_SESSION['accommodation'] = $rows['accommodation'];
        $_SESSION['ecop'] = $rows['is_ecop'];
        $_SESSION['mode_of_participation'] = $rows['mode_of_participation'];

        // echo "session=";
        // print_r($_SESSION);


        $data = array();
        if ($rows > 0) {
            $data['msg'] = "Login Successful";
            $data["msg_code"] = "EXEC_SUCCESSFUL";
            $data['status'] = 1;

            // header("Location: ../submission_new.php"); 
        

        } else {
            $data['msg'] = "Invalid email or password";
            $data["msg_code"] = "EXEC_FAILED";
            $data['status'] = 0;
            // header("Location: ../login.php?status=0"); 
     
        }

        pg_close($conn);
    } catch (Exception $e) {
        $data['msg'] = 'An error occurred: ' . $e->getMessage();
        $data["msg_code"] = "EXEC_FAILED";
        $data['status'] = 0;
        // header("Location: ../login.php?status=0"); 
   
    }

    echo json_encode($data);
}
?>
