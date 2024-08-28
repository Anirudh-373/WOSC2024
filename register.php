<?php include_once("header.php"); ?>
<div id="columnA">
    <h2>Online Registration</h2>
    <link href="regModule/css/style.css" rel="stylesheet" type="text/css" />
    <link href="regModule/regFormStyle.css" rel="stylesheet" type="text/css" />
    <script src="own/jq2.js"></script>
    <script src="own/jq3.js"></script>
    <link rel="stylesheet" href="own/jq1.css">
    <script src="own/register.js"></script>
    <style>
        .submit-button {
            background-color: #2980b9;
            color: white;
            border: none;
            border-radius: 3px;
            max-width: 200px;
            padding: 10px;
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
            margin-left: 200px;
            max-width: 200px;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        label {
            display: block;
            margin: 10px 0;
        }
        input[type="radio"] {
            margin-right: 5px;
        }

    </style>

    <form id="registrationForm" name="registrationForm" action="register.php" enctype="multipart/form-data" method="post">
        <div class="datagrid" style="width: 780px">
            <table>
                <thead>
                <tr>
                    <th align="center" colspan="2">Registration Form</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Title&nbsp;<font color="red">*</font> </td>
                    <td><select name="sTitle" id="sTitle" required>
                            <option value="">Select</option>
                            <option value="Dr">Dr</option>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Ms">Ms</option>
                            <option value="Prof">Prof</option>
                            <option value="Shri">Shri</option>
                        </select>
                    </td>
                </tr>
                <tr class="alt">
                    <td>Full Name <font color="red">*</font> </td>
                    <td><input type="text" name="fullname" id="fullname" maxlength="25" size="35" required></td>
                </tr>
                <tr>
                    <td>Address <font color="red">*</font> </td>
                    <td><textarea rows="4" cols="50" name="address" id="address" maxlength="250" required></textarea></td>
                </tr>
                <tr class="alt">
                    <td>City <font color="red">*</font> </td>
                    <td><input type="text" name="city" id="city" maxlength="75" size="35" required></td>
                </tr>
                <tr>
                    <td>State <font color="red">*</font> </td>
                    <td><input type="text" name="state" id="state" maxlength="75" size="35" required></td>
                </tr>
                <tr class="alt">
                    <td>Country <font color="red">*</font> </td>
                    <td><input type="text" name="country" id="country" maxlength="75" size="35" required></td>
                </tr>
                <tr>
                    <td>Pin Code <font color="red">*</font> </td>
                    <td><input type="number" name="pincode" id="pincode" maxlength="75" size="35" required></td>
                </tr>
                <tr class="alt">
                    <td>Email ID <font color="red">*</font> </td>
                    <td><input onkeyup="validate_unique_email(this)" type="email" name="email" id="email" size="35" placeholder="someone@example.com" maxlength="75" required>
                        <br> <font id="email_alert" color="#a7166d"></font>
                    </td>
                </tr>
                <tr>
                    <td>Password <font color="red">*</font> </td>
                    <td><input onkeyup="validate_password(this)" type="password" name="password" id="password" size="35" maxlength="20" required>
                    <br>
					 <font color="#a7166d" id="psw_alert">(password must contain atleast 2 digits, 1 special character and 8 characters long)</font>
					 </td>
                </tr>
                <tr class="alt">
                    <td>Retype Password <font color="red">*</font> </td>
                    <td><input onkeyup="confirm_password(this)" type="password" name="retype_password" id="retype_password" size="35" maxlength="20" required><br>
                    <font color="#a7166d" id="rpsw_alert"></font>
                    </td>
                </tr>
                <tr>
                    <td>Date of Birth <font color="red">*</font> </td>
                    <td><input onchange="validateBirthday(this)" type="text" name="dob" id="dob" size="35" maxlength="0" required autocomplete="off">
                    <br><font id="dob_alert" color="#a7166d">(Age must be atleast 15 years old)</font>
                    </td>
                </tr>
                <tr class="alt">
                    <td>Phone Number <font color="red">*</font> </td>
                    <td><input onkeyup="validate_mobile(this)" type="tel" name="mobileno" id="mobileno" size="35" maxlength="15" required><br>
                        <font id="mobile_alert" color="#a7166d">(Include country-code/state-code)</font>
                    </td>
                </tr>
                <tr>
                    <td>Status <font color="red">*</font> </td>
                    <td>
                        <input type="radio" name="status" value="Student" id="status-student"> Student
                        <input type="radio" name="status" value="Employed" id="status-employed"> Employed
                        <input type="radio" name="status" value="Retired" id="status-retired"> Retired
                        <!-- <input type="radio" name="status" value="ECOP" id="status-ecop"> ECOP -->
                        <input type="radio" name="status" value="Other" id="others-specify"> Others
                    </td>
                </tr>

                <tr class="alt" id="other-status" style="display: none">
                    <td>Others (Specify Status here):</td>
                    <td><input type="text" name="other-status" id="other-status" size="35" maxlength="75"></td>
                </tr>

                <tr class="alt" id="university_college_name" style="display: none">
                    <td>University/College Name: <font color="red">*</font> </td>
                    <td><input type="text" name="university_college_name" size="35" maxlength="75" id="university-college_name"></td>
                </tr>
                <tr id="course_of_study" style="display: none">
                    <td>Course of Study <font color="red">*</font> </td>
                    <td>
                        <select id="op_cos" name="op_cos" onchange="showOtherEvent()">
                            <option value="">Select</option>
                            <option value="UG">U.G</option>
                            <option value="PG">P.G</option>
                            <option value="PhD">Ph.D</option>
                            <option value="others">Others</option>
                        </select>
                    </td>
                </tr>
                <tr id="others_course_of_study" class="alt" style="display: none">
                    <td>Others: (Specify course of Study here)</td>
                    <td><input type="text" maxlength="75" size="35" id="others_course_of_study" name="others_course_of_study"></td>
                </tr>
                <tr id="specialization_student" style="display: none">
                    <td>Specialization <font color="red">*</font> </td>
                    <td><input type="text" maxlength="75" size="35" id="specialization_student" name="specialization_student"></td>
                </tr>

                <tr class="alt" id="year_of_study" style="display: none">
                    <td>Year of Study <font color="red">*</font> </td>
                    <td><input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length===1) return false;" maxlength="1" size="35" id="year_of_study" value="0" name="year_of_study"></td>

                </tr>
                <tr id="company_name" class="alt" style="display: none">
                    <td>Company Name <font color="red">*</font> </td>
                    <td>
                        <input type="text" maxlength="75" size="35" id="company_name" name="company_name">
                    </td>
                </tr>

                <tr id="designation" style="display: none">
                    <td>Designation <font color="red">*</font> </td>
                    <td>
                        <input type="text" id="designation" size="35" maxlength="75" name="designation">
                    </td>
                </tr>

                <tr class="alt" id="specialization_professional" style="display: none">
                    <td>Specialization <font color="red">*</font> </td>
                    <td>
                        <input type="text" id="specialization_professional" name="specialization_professional" maxlength="75" size="35">
                    </td>
                </tr>

                <tr>
                    <td>Mode of Participation <font color="red">*</font> </td>
                    <td>
                        <input type="radio" name="user_type2" value="Oral Presentation" id="oral_radio" required>Oral Presentation
                        <input type="radio" name="user_type2" value="Poster Presentation" id="poster_radio" required>Poster Presentation
                        <input type="radio" name="user_type2" value="Delegate" id="delegate_radio" required>Delegate
                    </td>
                </tr>

                <tr class="alt">
                    <td>Do you need Travel Support ? <font color="red">*</font> </td>
                    <td>
                        <input type="radio" name="yesno" value="yes" id="travel-yes"> Yes
                        <input type="radio" name="yesno" value="no" id="travel-no"> No
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                </tbody>
            </table>

            <tr>
                <td><button type="reset" class="clear-button" id="clear-button">Clear</button></td>
                <!--<td><button type="submit" name="submit" id="submit-button" class="submit-button">Register</button>   Already have an Account? Click here to <a href="login.php" style="text-decoration: none">Login.</a></td>-->
            </tr>
        </div>
    </form>

    <?php

    ob_start();
    
    include("config.php");
   

    /**
     * @throws Exception
     */

    function validate_input($data): bool
    {

        if (
            preg_match('/^[^\s]{8,17}$/', $data['password']) &&
            filter_var($data['email'], FILTER_VALIDATE_EMAIL) &&
            //preg_match('/^\d{10}$/', $data['mobileno']) &&
            preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $data['password']) &&
            preg_match_all('/\d/', $data['password'], $matches) && count($matches[0]) >= 2
        ){

            $selectedDate = new DateTime($data['dob']);
            $currentDate = new DateTime();
            $age = $currentDate->diff($selectedDate)->y;

            if ($selectedDate > $currentDate) {
                echo "<script>alert('Future date cannot be selected.');</script>";
                return false;
            }

            if ($age < 15) {
                echo "<script>alert('The age must be at least 18 years and above.');</script>";
                return false;
            }

            if ($data['password'] !== $data['retype_password']) {
                echo "<script>alert('Retype password does not match the Original password.');</script>";
                return false;
            }
            return true;
        } elseif (str_contains($data['password'], ' ')) {
            echo "<script>alert('Password cannot contain whitespaces.');</script>";
        }elseif (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $data['password'])) {
            echo "<script>alert('Password must contain at least one special character.');</script>";
        } elseif (preg_match_all('/\d/', $data['password'], $matches) && count($matches[0]) < 2) {
            echo "<script>alert('Password must contain at least two numbers.');</script>";
        }
        return false;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_data = $_POST;
        $registration_success = false;
        try {
            // $conn = pg_connect("host={$DB_SETTINGS['host']} port={$DB_SETTINGS['port']} dbname={$DB_SETTINGS['dbname']} user={$DB_SETTINGS['user']} password={$DB_SETTINGS['password']}");

            include('config.php');

            $select_email_query = "SELECT email FROM wosc24_registration WHERE email = $1";
            $result_email = pg_query_params($conn, $select_email_query, array($user_data['email']));
            $existing_email = pg_fetch_assoc($result_email);

            $select_mobile_query = "SELECT mobileno FROM wosc24_registration WHERE mobileno = $1";
            $result_mobile = pg_query_params($conn, $select_mobile_query, array($user_data['mobileno']));
            $existing_mobile = pg_fetch_assoc($result_mobile);

            if ($existing_email) {
                echo "<script>alert('Email address already exists. Please use a different email.');</script>";
                return false;
            } elseif ($existing_mobile) {
                echo "<script>alert('Mobile number already exists. Please use a different mobile number.');</script>";
                return false;
            } else {
                if (validate_input($user_data)) {

                    $insert_query = "INSERT INTO wosc24_registration
                    (sTitle, fullname, address, city, state, country, pincode,
                     email, password, dob, mobileno, status, other_status, university_college_name,
                     course_of_study, others_course_of_study, student_specialization, year_of_study,
                     company_name, designation, professional_specialization,
                     mode_of_participation, travel_support, date)
                        VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12,
                                $13, $14, $15, $16, $17, $18, $19, $20, $21, $22, $23, $24) RETURNING serial_no as lid;";
                    $res = pg_query_params($conn, $insert_query, array(
                        $user_data['sTitle'], $user_data['fullname'],
                        $user_data['address'], $user_data['city'], $user_data['state'],
                        $user_data['country'], $user_data['pincode'], $user_data['email'],
                        $user_data['password'], $user_data['dob'], $user_data['mobileno'],
                        $user_data['status'], $user_data['other-status'], $user_data['university_college_name'],
                        $user_data['op_cos'],
                        $user_data['others_course_of_study'], $user_data['specialization_student'],
                        $user_data['year_of_study'],
                        $user_data['company_name'], $user_data['designation'],
                        $user_data['specialization_professional'],
                        $user_data['user_type2'], $user_data['yesno'], date("Y-m-d h:i:s A")));

                        $last_insert_id = pg_fetch_assoc($res)['lid'];
                        $lid_with_pad =  str_pad($last_insert_id, 5, "0", STR_PAD_LEFT);
                        $reg_num = "WOSC/2024/".$lid_with_pad;
                
                        $sql ="
                        INSERT INTO registration_id_map (registration_id, registration_num)
                        VALUES ($last_insert_id, '$reg_num');
                      ";
                
                        $ret = pg_query($conn, $sql);

                        if(!$ret) {
                            $registration_success = false;
                        } else {
                            $registration_success = true;
                        }
                   
//                    echo "<br><br> error=".pg_last_error($conn);
                }
            }
            pg_close($conn);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }

        if ($registration_success) {
            echo "<script>alert('Registration Successful');</script>";
            echo "<script>window.location.href = 'login.php';</script>";
            exit;
        } else {
            echo "<script>alert('Registration Failed');</script>";
            exit;
        }

    }

    ?>

    <script>
        document.getElementById("status-student").addEventListener("click",function (){
            document.getElementById("university_college_name").style.display = "table-row";
            document.getElementById("specialization_student").style.display = "table-row";
            document.getElementById("year_of_study").style.display = "table-row";
            document.getElementById("company_name").style.display = "none";
            document.getElementById("specialization_professional").style.display = "none";
            document.getElementById("designation").style.display = "none";
            document.getElementById("other-status").style.display = "none";
            document.getElementById("course_of_study").style.display = "table-row";
        });

        document.getElementById("status-employed").addEventListener("click",function (){
            document.getElementById("university_college_name").style.display = "none";
            document.getElementById("specialization_student").style.display = "none";
            document.getElementById("year_of_study").style.display = "none";
            document.getElementById("other-status").style.display = "none";
            document.getElementById("company_name").style.display = "table-row";
            document.getElementById("specialization_professional").style.display = "table-row";
            document.getElementById("designation").style.display = "table-row";
            document.getElementById("course_of_study").style.display = "none";
            document.getElementById("others_course_of_study").style.display = "none";
        });

        document.getElementById("status-retired").addEventListener("click",function (){
            document.getElementById("university_college_name").style.display = "none";
            document.getElementById("specialization_student").style.display = "none";
            document.getElementById("year_of_study").style.display = "none";
            document.getElementById("company_name").style.display = "none";
            document.getElementById("specialization_professional").style.display = "none";
            document.getElementById("designation").style.display = "none";
            document.getElementById("other-status").style.display = "none";
            document.getElementById("course_of_study").style.display = "none";
            document.getElementById("others_course_of_study").style.display = "none";
        });

        document.getElementById("others-specify").addEventListener("click",function (){
            document.getElementById("other-status").style.display = "table-row";
            document.getElementById("university_college_name").style.display = "none";
            document.getElementById("specialization_student").style.display = "none";
            document.getElementById("year_of_study").style.display = "none";
            document.getElementById("company_name").style.display = "none";
            document.getElementById("specialization_professional").style.display = "none";
            document.getElementById("designation").style.display = "none";
            document.getElementById("course_of_study").style.display = "none";
            document.getElementById("others_course_of_study").style.display = "none";
        });

        document.getElementById("status-ecop").addEventListener("click",function (){
            document.getElementById("university_college_name").style.display = "none";
            document.getElementById("specialization_student").style.display = "none";
            document.getElementById("year_of_study").style.display = "none";
            document.getElementById("company_name").style.display = "none";
            document.getElementById("specialization_professional").style.display = "none";
            document.getElementById("designation").style.display = "none";
            document.getElementById("other-status").style.display = "none";
            document.getElementById("course_of_study").style.display = "none";
            document.getElementById("others_course_of_study").style.display = "none";
        });

        function showOtherEvent() {
            var x = document.getElementById("op_cos").value;
            console.log("onchange event called value:", x);
            if(x==="others") {
                document.getElementById("others_course_of_study").style.display = "table-row";
            } else {
                document.getElementById("others_course_of_study").style.display = "none";
            }
        }

        function logReset() {
            document.getElementById("other-status").style.display = "none";
            document.getElementById("university_college_name").style.display = "none";
            document.getElementById("specialization_student").style.display = "none";
            document.getElementById("year_of_study").style.display = "none";
            document.getElementById("company_name").style.display = "none";
            document.getElementById("specialization_professional").style.display = "none";
            document.getElementById("designation").style.display = "none";
            document.getElementById("course_of_study").style.display = "none";
            document.getElementById("others_course_of_study").style.display = "none";
        }
        const form = document.getElementById("registrationForm");
        form.addEventListener("reset", logReset);

        // password validation code
        function validate_password(elem) {
            console.log("validation running...");
            var myInput = elem.value;
            var flag = 1;
            var error = "";
            var numbers = /[0-9]/g;
            var specialChars =  /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
            var psw_alert_el =document.getElementById('psw_alert');

            if(!myInput.match(numbers)){
                error += "<br>&#x274c; password must contain atleast 2 digits";
                flag = 0;
            } else if(myInput.match(numbers).length<2) {
                error += "<br>&#x274c; password must contain atleast 2 digits";
                flag = 0;
            }

            if(!myInput.match(specialChars)) {
                error += "<br>&#x274c; password must contain atleast 1 special character";
                flag = 0;
            }

            if(myInput.length<8) {
                error += "<br>&#x274c; password must be 8 character long";
                flag = 0;
            }

            if(flag==0) {
                psw_alert_el.innerHTML = error;
                psw_alert_el.style.color = "#a7166d";
            } else {
                psw_alert_el.innerHTML = " &#10003; validated";
                psw_alert_el.style.color = "green";
            }
        }

        function confirm_password(rpsw) {
            var psw =document.getElementById("password");
            var rpsw_alert_el =document.getElementById("rpsw_alert");
            if(rpsw.value==psw.value) {
                rpsw_alert_el.style.color = "green";
                rpsw_alert_el.innerHTML = "&#10003; password matched";
            } else {
                rpsw_alert_el.style.color = "#a7166d";
                rpsw_alert_el.innerHTML = "&#x274c; password not matched";
            }
        }

        function validate_unique_email(elem) {
            var keyword = elem.value;
            var email_alert_elem =document.getElementById("email_alert");

            $.ajax({
                type: "GET",
                url: "api/get-email-api.php",   
                data: {"keyword": keyword},
                success: function (result) {
                    
                    if(result=="1"){
                        email_alert_elem.innerHTML = " &#x274c; email is already registered";
                        email_alert_elem.style.color = "#a7166d";
                    } else {
                        email_alert_elem.innerHTML = "";
                    }
            }
             });
        }

        function validate_mobile(elem) {
            var mobile_regex = /^[0|\+[0-9]{1,5}?([7-9][0-9]{9})$/;
            var mobile_alert = document.getElementById("mobile_alert");
            
            var keyword = elem.value;
            $.ajax({
                type: "GET",
                url: "api/get-mobile-api.php",   
                data: {"keyword": keyword},
                success: function (result) {
                    
                    if(result=="1"){
                        mobile_alert.innerHTML = " &#x274c; phone number is already registered";
                        mobile_alert.style.color = "#a7166d";
                    } else {
                        mobile_alert.innerHTML = "";
                    }
                }
            });
        }

        function validateBirthday(elem) {
            var dob_alert =document.getElementById("dob_alert");
           
            const dob = elem.value;
            const dobDate = new Date(dob);
            const currentDate = new Date();
            const diffInMs = currentDate.getTime() - dobDate.getTime() - (isLeapYear(dobDate.getFullYear()) && dobDate.getMonth() < 2 ? 1000 * 60 * 60 * 24 : 0);
            const diffInYears = diffInMs / (1000 * 60 * 60 * 24 * 365);

            if (diffInYears >= 15) {
             
                dob_alert.innerHTML = ""
            } else {
                dob_alert.innerHTML = "&#x274c; Age is not 15 years old";
            }
        }

        
        function isLeapYear(year) {
            return (year % 4 === 0 && year % 100 !== 0) || year % 400 === 0;
        }

    </script>

</div>
<script>
    $(document).ready(function() {
        $("#dob").datepicker({
            dateFormat: "yy-mm-dd",
            maxDate: 0,
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:<?php echo date('Y'); ?>"
        });
    });
</script>
<?php include_once ("side_menu.php"); ?>
<?php include_once("footer.php"); ?>
