<?php
// Connect to PostgreSQL
//$conn = pg_connect("host=localhost dbname=your_database user=your_username password=your_password");

include_once "../config.php";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $query = 'SELECT * FROM wosc24_registration WHERE email = $1';
    $result = pg_query_params($conn, $query, array($email));
    $user = pg_fetch_array($result);

    if ($user) {
        // print_r($user);
        // echo "user=".$user['fullname'];
        $name = $user['fullname'];

        // Generate a unique reset token
        $resetToken = bin2hex(random_bytes(32));

        // // Set the token and its expiration time in the database
        // $expirationTime = date('Y-m-d H:i:s', strtotime('+1 hour'));
        pg_query_params($conn, "UPDATE wosc24_registration SET reset_token = $1, reset_token_expiration = NOW() + interval '1' HOUR WHERE email = $2",
        // array($resetToken, $expirationTime, $email));
        array($resetToken, $email));

        // // Send an email with the reset link
        $resetLink = "https://www.niot.res.in/WOSC2024/reset_password.php?token=$resetToken";
        // // Use a library like PHPMailer to send emails
        // // Example: https://github.com/PHPMailer/PHPMailer
        // // mail($email, 'Password Reset', "Click the following link to reset your password: $resetLink");
        require("../phpmailer/class.phpmailer.php");
        $mail = new PHPMailer();
    
        $mail->IsSMTP();
        $mail->Host = "10.80.17.18";
        $mail->SMTPAuth = false;

        $mail->setFrom('sysadmin@niot.res.in');	

        $mail->Subject = "WOSC24 Password Reset";
        $mail->IsHTML(true);
        $mail->SMTPKeepAlive = true;
        
        $mail->AddAddress($email);
    
        $mail->Body  = "<HTML><HEAD> <META HTTP-EQUIV='Content-Type' CONTENT='text/html; charset=utf-8'>";
        $mail->Body.="<meta http-equiv='Content-Language' content='lt'></HEAD>";
        $mail->Body.="<BODY bgcolor=>";
            
        $mail->Body.="<br/>";
    
    
        $mail->Body.="<p> <span style='color: rgb(51, 153, 102);'><b>Dear $name</b></span>,</p>";
        // $mail->Body.="<P>Sub :Password Reset</p>";
        $mail->Body.="<p align='justify'> 
        We have received a request to reset the password for your account on 
        WOSC 2024. Please follow the instructions below to reset your password<br />
        <ol>
            <li> Click on the following link: <a href='$resetLink'>$resetLink</a></li> 
            <li>You will be directed to a page where you can create a new password for your account</li>
        </ol>
        If you did not initiate this password reset request, please ignore this email. Your account security is important to us.
        <br /><br /> <b>This link is only valid for the next one hour.</b>"; 
        
        $mail->Body .= "<br /><br /><br /><b>Thank you,<br />
        <span style='color: rgb(51, 153, 102);'>WOSC 2024</span><br />
        <span style='color: rgb(51, 102, 255);'>National Institute of Ocean Technology<br />
        Velachery-Tambaram Main Road<br />
        Chennai - 600100</span></b><br /><br />
        <small>This is an auto generated mail, please do not reply. <br />
        for any query please contact us on Phone no. 044-6678-3563/044-6678-3347 or via email wosc2024@gmail.com </small>
        </p>
        ";

        $response['email'] = array();
        if(!$mail->Send()) {
                    $response['email']['msg'] = 'Message was not sent.';
                    $response['email']['error'] =  'Mailer error: ' . $mail->ErrorInfo;
        } else {
            // $response['email']['msg'] = 'Message has been sent to' .$name. '<br>';
            $response['email']['msg'] = '<h3 style="color: green; text-align: center;">An email with instructions has been sent to '.$email.'</h3><br>';
        } 

        $mail->ClearAddresses();


        // echo "An email with instructions has been sent to your email address.";
        echo $response['email']['msg'];
        if(isset($response['email']['error'])) {
            echo "</br>".$response['email']['error'];
        }
    } else {
        echo "Email not found in the database.";
    }
}
?>