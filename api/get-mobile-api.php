<?php
 include('../config.php');

 if(isset($_GET['keyword'])){
    $keyword = $_GET['keyword'];
    // $keyword = "+919840334961";
    $query = "SELECT mobileno FROM wosc24_registration WHERE mobileno = $1";

    $result = pg_query_params($conn, $query, array($keyword));
    $row = pg_fetch_array($result);

    if(!$row) {
        echo "0";
    } else {
        echo "1";
    }
 
}
?>