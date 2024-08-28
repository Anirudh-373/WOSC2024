<?php include_once "header.php"; ?>
<?php include_once "side_menu.php"; ?>
<div id="columnA">
    <h2>Login</h2>

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
    <form id="loginForm" action="api/login-api.php" name="loginForm" enctype="multipart/form-data" method="post">
    <div class="datagrid" style="width: 780px">
        <table>
            <thead>
                <tr>
                    <th align="center" colspan="2">Login</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Enter your Email-ID: <font color="red">*</font> </td>
                    <td><input type="email" id="email" name="email" size="35" placeholder="someone@example.com" maxlength="75"></td>
                </tr>
                <tr class="alt">
                    <td>Enter your Password: <font color="red">*</font> </td>
                    <td><input type="password" id="password" name="password" size="35" maxlength="20" </td>
                </tr>
            <tr>
                <td></td>
            </tr>
            </tbody>
        </table>
        <p style="color: red; text-align: center;" id="alert_msg"></p>
        <button type="submit" class="submit-button">Login</button>   Don't have an account? Click here to <a href="register.php" style="text-decoration: none">Register </a><br><a href="forgot.php" style="margin-left: 440px; text-decoration: none">Forgot Password?</a>

    </div>
    </form>
</div>
<?php include_once "footer.php"; ?>