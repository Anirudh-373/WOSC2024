<?php
//session_start();

include_once("../config.php");

if(isset($_POST["status"])){
	$abstract_id = $_POST['abstract_id'];
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
        UPDATE public.wosc24_abstract SET subtheme_id=$1 ,abstract_title=$2, author_name=$3,
        author_affiliation=$4, author_email=$5, coauthor_details=$6, abstract_text=$7, 
		updated_at=$8, remarks=$9, status=$10
        WHERE id = $11;
    ";
	
    //$ret = pg_query($conn, $sql);
	$ret = pg_query_params($conn, $sql, array($subtheme_id, $abstract_title, $author_name, $author_affiliation, 
                                            $author_email, $coauthor_details, $abstract_text,
                                            $updated_at, $remarks, $status, $abstract_id));
    if(!$ret) {
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
    pg_close($conn);
} else {
    $response['msg'] =  "Invalid Request";
}

echo json_encode($response);
?>