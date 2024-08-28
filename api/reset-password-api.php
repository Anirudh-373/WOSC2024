<?php
// Connect to PostgreSQL
include_once "../config.php";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['val_psw'] === 'true') {
    $token = $_POST['token'];
    // $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $password = $_POST['password'];

    // Check if the token is valid and not expired
    $result = pg_query_params($conn, "SELECT * FROM wosc24_registration WHERE reset_token = $1 AND reset_token_expiration > NOW();", array($token));
    // $result = pg_query($conn, "SELECT NOW();");
    $user = pg_fetch_array($result);

    if ($user) {
        // Update the password and clear the reset token fields
        pg_query_params($conn, 'UPDATE wosc24_registration SET password = $1, reset_token = NULL, reset_token_expiration = NULL WHERE reset_token = $2', array($password, $token));

        echo '<h3 style="color: green; text-align: center;">Password has been reset successfully.</h3> <p><a href="https://www.niot.res.in/WOSC2024/login.php">Click here</a> to Login</p>';
    } else {
        echo '<h3 style="color: red; text-align: center;">Invalid or expired token.</h3>';
    }
} else {
    $return_url = $_POST['return_url'];
    echo "<h3 style='color: red; text-align: center;'>Entered password policy is incorrect</h3><p><a href='$return_url'>Click here</a> to return on previous page</p>";
}
?>
