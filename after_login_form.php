<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abstract Submission Form</title>
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

        p {
            font-weight: bold;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="radio"], input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="radio"] {
            margin-right: 5px;
            cursor: pointer;
            display: inline;
        }

        input[type="submit"], input[type="reset"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #0056b3;
        }

        #student_details, #professional_details {
            display: none;
        }
    </style>
</head>
<body>
<?php include_once "header.php"; ?>
<?php include_once "side_menu.php"; ?>
<div id="columnA">
    <h2>Abstract Submission Form</h2>
    <form action="after_login_form_01.php" method="post">
        <table>
            <tr>
                <td><p>Are you a student or a professional?</p></td>
                <td><input type="radio" name="user_type" value="Student" id="student_radio" required></td>
                <td><label for="student_radio">Student</label></td>
                <td><input type="radio" name="user_type" value="Professional" id="professional_radio" required></td>
                <td><label for="professional_radio">Professional</label></td>
            </tr>
        </table>

        <div id="student_details">
            <p>Student Details:</p>
            <label for="university">University/College Name:</label>
            <input type="text" name="university" id="university">

            <label for="year_of_study">Year of Study:</label>
            <input type="text" name="year_of_study" id="year_of_study">

            <label for="specialization">Specialisation:</label>
            <input type="text" name="specialization" id="specialization">
        </div>

        <div id="professional_details">
            <p>Professional Details:</p>
            <label for="company_name">Company Name:</label>
            <input type="text" name="company_name" id="company_name" >

            <label for="designation">Designation:</label>
            <input type="text" name="designation" id="designation" >

            <label for="area_of_specialization">Area of Specialisation:</label>
            <input type="text" name="area_of_specialization" id="area_of_specialization" >
        </div>

        <table>
            <tr>
                <td><p>Mode of Participation:</p></td>
                <td><input type="radio" name="participation_mode" value="Paper Presentation" id="paper_presentation_radio" required></td>
                <td><label for="paper_presentation_radio">Oral Presentation</label></td>
                <td><input type="radio" name="participation_mode" value="Poster Presentation" id="poster_presentation_radio" required></td>
                <td><label for="poster_presentation_radio">Poster Presentation</label></td>
<!--                <td><input type="radio" name="participation_mode" value="Participant" id="participant_radio" required></td>-->
<!--                <td><label for="participant_radio">Delegate</label></td>-->
            </tr>
        </table>
<!--        <tr>-->
<!--            <div id="number_of_papers">-->
<!--                <td><label for="num_papers">Number of Abstracts:</label></td>-->
<!--                <td><input type="text" name="num_papers" id="num_papers" min="1" max="10" maxLength="2" value="1"></td>-->
<!--            </div>-->
<!--        </tr>-->
        <input type="submit" value="Next" id="next">
        <input type="reset" value="Clear" id="clear">

    </form>
</div>
<script>
    const studentRadio = document.getElementById("student_radio");
    const professionalRadio = document.getElementById("professional_radio");
    const studentDetails = document.getElementById("student_details");
    const professionalDetails = document.getElementById("professional_details");
    const clearButton = document.getElementById("clear");
    // const nextButton = document.getElementById("next");

    studentRadio.addEventListener("click", () => {
        studentDetails.style.display = "block";
        professionalDetails.style.display = "none";
    });

    professionalRadio.addEventListener("click", () => {
        studentDetails.style.display = "none";
        professionalDetails.style.display = "block";
    });

    clearButton.addEventListener("click", () => {
        confirm("Are you sure you want to clear?");
        studentDetails.style.display = "none";
        professionalDetails.style.display = "none";
    })

</script>
<?php include_once "footer.php"; ?>
</body>
</html>



