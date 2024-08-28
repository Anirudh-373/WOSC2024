<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        #colo{
            color: #ff7f00;
        }
        .container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 70%;
            margin-left: 100px;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            margin: 50px 20px 50px 20px;
        }

        input[type="text"],
        input[type="password"] {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .submit-button {
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 3px;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            max-width: 40%;
            margin-left: 200px;
        }

        .submit-button:hover {
            background-color: #2980b9;
        }

        .error-text {
            color: red;
            margin-top: 10px;
        }

    </style>
    <script src="own/loginjq.js"></script>
</head>
<body>
<?php include_once "header.php"; ?>
    <div id="columnA">
        <h2>Sign In</h2>
        <div class="container">
            <h1 id="colo">Login</h1>
            <div id="errorText" class="error-text"></div>
            <form id="loginForm" class="login-form" onsubmit="validateForm()">
                <table>
                    <tr>
                        <td>Enter the Username: </td>
                        <td><input type="text" name="username" id="username" placeholder="Username" required style="width: 97%"><br></td>
                    </tr>
                    <tr>
                        <td>Enter the Password: </td>
                        <td><input type="password" name="password" id="password" placeholder="Password" required style="width: 97%"><br></td>
                    </tr>
                </table>
                <button type="submit" class="submit-button">Login</button>
                <div id="signInButton" class="sign-in-button">
                    <p>Don't have an account? <a href="register.php">Register </a></p>
                </div>
            </form>

        </div>
    </div>
<?php include_once "side_menu.php"; ?>
<?php include_once "footer.php"; ?>
</body>
</html>


