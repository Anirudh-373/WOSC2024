<?php include_once "header.php"; ?>
<?php include_once "side_menu.php"; ?>
<div id="columnA">
    <h2>Abstract Submission</h2>
    <style>
        .submit-button {
            background-color: #2980b9;
            margin-top: 10px;
            color: white;
            border: none;
            border-radius: 3px;
            max-width: 200px;
            padding: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            margin-bottom: 10px;
        }

        .clear-button {
            background-color: #2980b9;
            color: white;
            border: none;
            border-radius: 3px;
            margin-left: 300px;
            max-width: 200px;
            padding: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
    </style>
    <div class="datagrid" style="width: 780px">
        <table>
            <thead>
                <tr>
                    <th colspan="2">Personal Details</th>
                </tr>
            </thead>
            <tbody>
                <tr id="personal">
                    <td>Are you a Student or a Professional? <font color="red">*</font> </td>
                    <td>
                        <label>
                            <input type="radio" name="user_type" value="Student" id="student_radio" required>Student
                            <input type="radio" name="user_type" value="Professional" id="professional_radio" required>Professional
                        </label>
                    </td>
                </tr>
                <tr class="alt" id="university-college_name" style="display:none;">
                    <td>University/College Name: <font color="red">*</font> </td>
                    <td>
                        <label for="university-college_name">
                            <input type="text" name="university-college_name" size="35" maxlength="75" id="university-college_name">
                        </label>
                    </td>
                </tr>
                <tr id="year_of_study" style="display:none;">
                    <td>Year of Study <font color="red">*</font> </td>
                    <td>
                        <label for="year_of_study">
                            <input type="text" maxlength="3" size="35" id="year_of_study" name="year_of_study">
                        </label>
                    </td>
                </tr>
                <tr class="alt" id="specialization_student" style="display:none;">
                    <td>Specialization <font color="red">*</font> </td>
                    <td>
                        <label for="specialization_student">
                            <input type="text" maxlength="75" size="35" id="specialization_student" name="specialization_student">
                        </label>
                    </td>
                </tr>
                <tr id="company_name" style="display:none;" class="alt">
                    <td>Company Name <font color="red">*</font> </td>
                    <td>
                        <label for="company_name">
                            <input type="text" maxlength="75" size="35" id="company_name" name="company_name">
                        </label>
                    </td>
                </tr>
                <tr id="designation" style="display:none;">
                    <td>Designation <font color="red">*</font> </td>
                    <td>
                        <label for="designation">
                            <input type="text" id="designation" size="35" maxlength="75" name="designation">
                        </label>
                    </td>
                </tr>
                <tr class="alt" id="specialization_professional" style="display:none;">
                    <td>Specialization <font color="red">*</font> </td>
                    <td>
                        <label for="specialization_professional">
                            <input type="text" id="specialization_professional" name="specialization_professional" maxlength="75" size="35">
                        </label>
                    </td>
                </tr>

                <tr>
                    <td>Mode of Participation <font color="red">*</font> </td>
                    <td>
                        <label>
                            <input type="radio" name="user_type" value="Student" id="student_radio" required>Oral Presentation
                            <input type="radio" name="user_type" value="Professional" id="professional_radio" required>Poster Presentation
                            <input type="radio" name="user_type" value="Delegate" id="delegate_radio" required>Delegate
                        </label>
                    </td>
                </tr>
                <tr>

                </tr>
            </tbody>
        </table>
        <tr>
            <td><button type="reset" class="clear-button" id="clear-button">Clear</button></td>
            <td><button type="submit" class="submit-button">Next</button>
        </tr>
    </div>
</div>

<script>
    document.getElementById("student_radio").addEventListener("click", function (){
        document.getElementById("university-college_name").style.display = "table-row";
        document.getElementById("year_of_study").style.display = "table-row";
        document.getElementById("specialization_student").style.display = "table-row";

        document.getElementById("company_name").style.display = "none";
        document.getElementById("designation").style.display = "none";
        document.getElementById("specialization_professional").style.display = "none";
    });

    document.getElementById("professional_radio").addEventListener("click",function (){
       document.getElementById("company_name").style.display = "table-row";
       document.getElementById("designation").style.display = "table-row";
       document.getElementById("specialization_professional").style.display = "table-row";

       document.getElementById("university-college_name").style.display = "none";
       document.getElementById("year_of_study").style.display = "none";
       document.getElementById("specialization_student").style.display = "none";
    });

    document.getElementById("clear-button").addEventListener("click",function (){
        document.getElementById("university-college_name").style.display = "none";
        document.getElementById("year_of_study").style.display = "none";
        document.getElementById("specialization_student").style.display = "none";
        document.getElementById("company_name").style.display = "none";
        document.getElementById("designation").style.display = "none";
        document.getElementById("specialization_professional").style.display = "none";
    });

</script>

<?php include_once "footer.php"; ?>