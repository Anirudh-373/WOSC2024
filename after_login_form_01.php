<?php

$host = "host = localhost";
$port = "port = 5432";
$dbname = "dbname = webapp";
$credentials = "user = postgres password = 2003";

$db = pg_connect("$host $port $dbname $credentials");
if (!$db){
    echo "Error";
}else{
    echo "";
}

$usertype = $_POST['user_type'];
$university = $_POST['university'];
$year_of_study = $_POST['year_of_study'];
$specialization = $_POST['specialization'];
$company_name = $_POST['company_name'];
$designation = $_POST['designation'];
$area_of_specialization = $_POST['area_of_specialization'];
$participation_mode = $_POST['participation_mode'];
$num_papers = $_POST['num_papers'];

$sql = <<<EOF

        insert into abstract_submit_1(user_type, university_college_name, year_of_study, 
                                      specialization, company_name, designation, 
                                      area_of_specialization, participation_mode, number_of_abstracts)
        values('$usertype', '$university', '$year_of_study', '$specialization', '$company_name', '$designation', '$area_of_specialization', '$participation_mode','$num_papers');

    EOF;

$return = pg_query($db,$sql);
if(!$return){
    echo pg_last_error($db);
}else{
}
pg_close($db);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abstract Submission Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        select, input[type="text"], input[type="number"], input[type="email"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        select {
            height: 40px;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"], input[type="reset"], input[type="button"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover, input[type="reset"]:hover, input[type="button"]:hover {
            background-color: #0056b3;
        }

        /*#author_emails {*/
        /*    margin-top: 10px;*/
        /*}*/
    </style>
</head>
<body>
<?php include_once "header.php"; ?>
<?php include_once "side_menu.php"; ?>
<div id="columnA">
    <h2>Abstract Submission Form</h2>
    <form action="after_login_form_02.php" method="post">
<!--        <table>-->

            <tr>
                <td><label for="subtheme_title">Select Subtheme:</label></td>
                <td><select name="subtheme_title" id="subtheme_title" required>
                        <option value="select">Select</option>
                        <option value="Fisheries with a special focus on offshore cage culture technology and policy.">Fisheries with a special focus on offshore cage culture technology and policy.</option>
                        <option value="Tourism: Development of Tourism in coastal states and islands and policy.">Tourism: Development of Tourism in coastal states and islands and policy.</option>
                        <option value="Ocean services: what is existing and what is required?</opti">Ocean services: what is existing and what is required?</option>
                        <option value="Ocean Observations and Modelling.">Ocean Observations and Modelling.</option>
                        <option value="Harvesting of mineral and other resources from coastal waters, possibilities for mining, EIA requirements etc.">Harvesting of mineral and other resources from coastal waters, possibilities for mining, EIA requirements etc.</option>
                        <option value="Ocean Summit: Interactions with neighboring countries. (Hybrid)">Ocean Summit: Interactions with neighboring countries. (Hybrid)</option>
                        <option value="Policy requirements for sustainable utilization of ocean.">Policy requirements for sustainable utilization of ocean.</option>
                        <option value="Ocean technologies for sustainable development.">Ocean technologies for sustainable development.</option>
                        <option value="Coastal protection and restoration of coasts.">Coastal protection and restoration of coasts.</option>
                        <option value="Marine biodiversity and ocean ecosystem.">Marine biodiversity and ocean ecosystem.</option>
                    </select><br></td>
            </tr>

            <tr>
                <td><label for="abstract_title">Title of the Abstract:</label></td>
                <td><input type="text" name="abstract_title" id="abstract_title" required><br></td>
            </tr>

            <tr>
                <td><label for="author_name">Author's Name:</label></td>
                <td><input type="text" name="author_name" id="author_name"><br></td>
            </tr>
            <tr>
                <td><label for="author_name">Author's Affiliation:</label></td>
                <td><input type="text" name="author_name" id="author_name"><br></td>
            </tr>
            <tr>
                <td><label for="author_mail_id">Author's Mail ID:</label></td>
                <td><input type="text" name="author_mail_id" id="author_mail_id"><br></td>
            </tr>
            <tr>
                <p>Please enter the details of the coauthors (if any)</p>
                <p>[CoAuthor1 name, Affiliation; CoAuthor2 name, Affiliation;.....;CoAuthor-n name, Affiliation]</p>
<!--                <td><label for="coauthor_name">CoAuthor's Names:</label></td>-->
                <td><textarea type="text" name="coauthor_name" id="coauthor_name"></textarea><br></td>
            </tr>

        <label for="abstract_text">Abstract (Maximum word limit 300):</label><br>
        <textarea name="abstract_text" id="abstract_text" rows="4" cols="50" maxlength="300" required></textarea><br>

        <input type="button" value="Previous" onclick="history.back()">
        <input type="reset" value="Clear" onclick="confirm('Are you sure you want to clear?');">
        <input type="submit" value="Save as Draft">
        <input type="submit" value="Submit">
    </form>
</div>
<?php include_once "footer.php"; ?>
</body>
</html>

