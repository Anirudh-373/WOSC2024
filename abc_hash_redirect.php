<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // The request is using the POST method
    if($_GET['certificate_type']=='participation_cert') {
        header("location:certificate2_abc_hash.php?participant_name=".$_GET['participant_name']); 
    } elseif($_GET['certificate_type']=='presentation_cert') {
        header("location:cert_abc_hash.php?participant_name=".$_GET['participant_name']); 
    } elseif($_GET['certificate_type']=='panellist_cert') {
        header("location:panellist_certificate.php?participant_name=".$_GET['participant_name']); 
    } elseif($_GET['certificate_type']=='moderator_cert') {
        header("location:moderator_certificate.php?participant_name=".$_GET['participant_name']); 
    } elseif($_GET['certificate_type']=='volunteer_cert') {
        header("location:volunteer_certificate.php?participant_name=".$_GET['participant_name']); 
    } elseif($_GET['certificate_type']=='chair_cert') {
        header("location:chair_certificate.php?participant_name=".$_GET['participant_name']); 
    } elseif($_GET['certificate_type']=='cochair_cert') {
        header("location:cochair_certificate.php?participant_name=".$_GET['participant_name']); 
    } elseif($_GET['certificate_type']=='repporteur_cert') {
        header("location:repporteur_certificate.php?participant_name=".$_GET['participant_name']); 
    }elseif($_GET['certificate_type']=='organizing_cert') {
        header("location:organizing_committee.php?participant_name=".$_GET['participant_name']); 
    }
}
?>