<?php
 include('../config.php');

 if(isset($_GET['keyword'])){
    $keyword = $_GET['keyword'];

    $select_email_query = "SELECT email FROM wosc24_registration WHERE email = $1";

    $result_email = pg_query_params($conn, $select_email_query, array($keyword));
    $row = pg_fetch_array($result_email);
    //  print_r($row);
    if(!$row) {
        echo "0";
    } else {
        echo "1";
    }
 
}
?>