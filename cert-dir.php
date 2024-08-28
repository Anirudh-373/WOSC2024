<?php 
session_start();
if(!isset($_SESSION['uts']))
{
	header("location:login.php");
}

include_once('config.php');

$user_id = $_SESSION['id'];

$query = "select wosc24_abstract.id as abstract_id, wosc24_abstract.abstract_title, wosc24_abstract.author_name, 
wosc24_abstract.author_affiliation, wosc24_abstract.author_email, wosc24_abstract.coauthor_details, 
wosc24_abstract.abstract_text, wosc24_abstract.status, wosc24_abstract.registration_id, abstract_id_map.abstract_num,
wosc24_subtheme_type.name, absrev.remarks as remarks, absrev.reviewdesp as description, absrev.finaldecision 
from public.wosc24_abstract
 join abstract_id_map on abstract_id_map.abstract_submission_id = wosc24_abstract.id
 join wosc24_subtheme_type on wosc24_subtheme_type.id = wosc24_abstract.subtheme_id
 left join wosc24_abstract_review absrev on absrev.abstract_id=wosc24_abstract.id
 where registration_id = $user_id  and wosc24_abstract.status in ('S','D')";

$result=pg_query($conn, $query);

// print_r(pg_fetch_assoc($result));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Directory</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            margin: 50px;
        }

        .row {
            font-size: 1.2em;
            line-height: 2em;
            color: #1149c3;
        }
    </style>
</head>
<body>
    <h2>Certificate Directory</h2>
    <?php while($row = pg_fetch_assoc($result)) {  ?>
    <div class="row">
        <i class="fa-solid fa-caret-right"></i> &emsp;Certificate for Abstract Number:
        <a href="cert2.php?abs_id=<?php echo $row['abstract_id'] ?>"><?php echo $row['abstract_num']; ?></a>
        <br>
    </div>
    <?php } ?>
    <div class="row">
        <i class="fa-solid fa-caret-right"></i> &emsp;Participation Certificate: <a href="certificate.php">click here</a>
    </div>
</body>
</html>