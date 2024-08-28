<?php

//require_once 'config.php';
$DB_SETTINGS = array(
    /*'dbname' => 'webapp',
    'user' => 'postgres',
    'password' => '2003',
    'host' => 'localhost',
    'port' => '5432'*/
	
	 'dbname' => 'moesnt',
        'user' => 'dbadm',
        'password' => 'dbAdmin#@!',
        'host' => 'dbsrv',
        'port' => '5432'
	
	
	
);

//$redirect_url = 'submission.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $conn = pg_connect("host={$DB_SETTINGS['host']} port={$DB_SETTINGS['port']} dbname={$DB_SETTINGS['dbname']} user={$DB_SETTINGS['user']} password={$DB_SETTINGS['password']}");
        $select_query = "SELECT * FROM wosc24_registration WHERE email = $1 AND password = $2";
        $result = pg_query_params($conn, $select_query, array($email, $password));
        $rows = pg_num_rows($result);

        $data = array();
        if ($rows > 0) {
            $data['msg'] = "Login Successful";
            $data["msg_code"] = "EXEC_SUCCESSFUL";
            $data['status'] = 1;

        } else {
            $data['msg'] = "Invalid email or password";
            $data["msg_code"] = "EXEC_FAILED";
            $data['status'] = 0;
        }


        pg_close($conn);
    } catch (Exception $e) {
        $data['msg'] = 'An error occurred: ' . $e->getMessage();
        $data["msg_code"] = "EXEC_FAILED";
        $data['status'] = 0;
    }

    echo json_encode($data);
}
?>
