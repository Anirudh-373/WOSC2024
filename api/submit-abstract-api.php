<?php
//session_start();

include_once("../config.php");

if(isset($_POST["status"])){
    $subtheme_id = $_POST['subtheme_id'];
    $abstract_title = $_POST['abstract_title'];
    $author_name = $_POST['author_name'];
    $author_affiliation = $_POST['author_affiliation'];
    $author_email = $_POST['author_email'];
    $coauthor_details = $_POST['coauthor_details'];
    $abstract_text = $_POST['abstract_text'];
    $created_at = date("Y-m-d h:i:s A");
    $updated_at = date("Y-m-d h:i:s A");
    $remarks = "";
    $status = $_POST['status'];
    $registration_id = $_POST['registration_id'];
    $response = Array();


    $sql ="
        INSERT INTO wosc24_abstract (subtheme_id,abstract_title,author_name,
        author_affiliation,author_email,coauthor_details,abstract_text, created_at, updated_at, remarks, status,registration_id)
        VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12)
        RETURNING id as lid;
    ";

    $ret = pg_query_params($conn, $sql, array($subtheme_id, $abstract_title, $author_name, $author_affiliation, 
                                            $author_email, $coauthor_details, $abstract_text, $created_at,
                                            $updated_at, $remarks, $status, $registration_id));

    //$ret = pg_query($conn, $sql);
    if(!$ret) {
		$response['msg'] = "Something went wrong.\n don't worry it's not you, it's from our side."; 
        //echo pg_last_error($conn);
    } else {
        $last_insert_id = pg_fetch_assoc($ret)['lid'];
        $abs_num = "WOSC/2024/ABS/".$last_insert_id;

        $sql ="
        INSERT INTO abstract_id_map (abstract_submission_id, abstract_num)
        VALUES ($last_insert_id, '$abs_num');
       ";

        $ret = pg_query($conn, $sql);
        if(!$ret) {
            // echo pg_last_error($conn);
            $response['msg'] = "Something went wrong.\n don't worry it's not you, it's from our side."; 
        } else {
            $sub_type = "";
            if($status=="D") {
                $sub_type = "Saved as Draft";
            } else {
                $sub_type = "Submitted";
            }

            $response['msg'] = "Abstract $sub_type Successfully\n";
            $response['abs_id'] = $abs_num;
        }
    }
    pg_close($conn);
} else {
    $response['msg'] =  "Invalid Request";
}

echo json_encode($response);
?>