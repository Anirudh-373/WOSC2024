<?php

//     $host = "host = 127.0.0.1";
//     $port = "port = 5432";
//     $dbname = "dbname = wosc2024";
//     $credentials = "user = postgres password = root";

//     $conn = pg_connect("$host $port $dbname $credentials");

//    if (!$conn){
//        echo "Error";
//    }else{
//        echo "Connected Successfully";
//    }

   $DB_SETTINGS = array(
    'dbname' => 'moesnt',
    'user' => 'dbadm',
    'password' => 'dbAdmin#@!',
    'host' => 'dbsrv',
    'port' => '5432'
);

$conn = pg_connect("dbname={$DB_SETTINGS['dbname']} user={$DB_SETTINGS['user']} password={$DB_SETTINGS['password']} host={$DB_SETTINGS['host']}  port={$DB_SETTINGS['port']} ");

// if (!$conn){
   // echo 'Error';
// }else{
    // echo 'Connected Successfully';
// }

?>