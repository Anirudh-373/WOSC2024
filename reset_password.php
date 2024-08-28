<?php include_once "header.php"; ?>
<?php include_once "config.php"; 
$return_url = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<div id="columnA">
    <h2>Reset Password</h2>

<!--    <link href="regModule/css/style.css" rel="stylesheet" type="text/css" />-->
    <link href="regModule/regFormStyle.css" rel="stylesheet" type="text/css" />
    <style>
        .submit-button {
            background-color: #2980b9;
            color: white;
            border: none;
            border-radius: 3px;
            margin-left: 220px;
            padding: 7px;
            margin-bottom:20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

    </style>

    <script>
        <?php if($_SERVER['REQUEST_METHOD']=='GET' && isset($_GET['status']) && $_GET['status']==0) { ?>
            alert("Invalid username or password");
        <?php } ?>
    </script>
    
<form method="post" action="api/reset-password-api.php">
   
    
    
    

    <div class="datagrid" style="width: 780px">
        <table>
            <thead>
                <tr>
                    <th align="center" colspan="2">Forgot Password</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                    <input type="hidden" name="return_url" value="<?php echo $return_url; ?>"></td>
                    <td><input type="hidden" name="val_psw" id="val_psw" value="false"></td>
                </tr>
                <tr>
                    <td><label for="password">New Password:</label><font color="red">*</font> </td>
                    <td><input onkeyup="validate_password(this)" type="password" name="password" id="password" size="35" maxlength="20" required>
                    <br>
					 <font color="#a7166d" id="psw_alert">(password must contain atleast 2 digits, 1 special character and 8 characters long)</font>
                    </td>
                </tr>
                <tr>
                <td>Retype Password <font color="red">*</font> </td>
                    <td><input onkeyup="confirm_password(this)" type="password" name="retype_password" id="retype_password" size="35" maxlength="20" required><br>
                    <font color="#a7166d" id="rpsw_alert"></font>
                </tr>
               
            <tr>
                <td></td>
            </tr>
            </tbody>
        </table>
      
        <p style="color: red; text-align: center;" id="alert_msg"></p>
        <button type="submit"  class="submit-button">Reset Password</button>

</form>

<script>

    var val_flag = 0;
function validate_password(elem) {
    console.log("validation running...");
    var myInput = elem.value;
    var flag = 1;
    var error = "";
    var numbers = /[0-9]/g;
    var specialChars =  /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
    var psw_alert_el =document.getElementById('psw_alert');
    var rpsw =document.getElementById("retype_password");
    var rpsw_alert_el =document.getElementById("rpsw_alert");

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

    rpsw.value = "";
    rpsw_alert_el.innerText = "";
    document.getElementById("val_psw").value="false";

    if(flag==0) {
        psw_alert_el.innerHTML = error;
        psw_alert_el.style.color = "#a7166d";
        val_flag = 0;
    } else {
        psw_alert_el.innerHTML = " &#10003; validated";
        psw_alert_el.style.color = "green";
        val_flag = 1;
    }
}

function confirm_password(rpsw) {
    
    var psw =document.getElementById("password");
    var rpsw_alert_el =document.getElementById("rpsw_alert");
    if(rpsw.value==psw.value) {
       
        if(val_flag==0) {
            alert("Please enter password with correct password policy");
        } else {
            rpsw_alert_el.style.color = "green";
            rpsw_alert_el.innerHTML = "&#10003; password matched";
            document.getElementById("val_psw").value="true";
        }
        
    } else {
        rpsw_alert_el.style.color = "#a7166d";
        rpsw_alert_el.innerHTML = "&#x274c; password not matched";
        document.getElementById("val_psw").value="false";
    }
}
</script>
    
</div>
<?php include_once "footer.php"; ?>