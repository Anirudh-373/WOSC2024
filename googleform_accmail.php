<?php

include_once("config.php");

require("phpmailer/class.phpmailer.php");
	$mail = new PHPMailer();

	$query="select wr.*, rim.registration_num from wosc24_registration wr
	inner join registration_id_map rim on rim.registration_id=wr.serial_no
	where delflag='Y' 
	and wr.accommodation ilike '%yes%' and wr.status ilike '%student%'";

	$result = pg_query($conn, $query);
	//$flag = 1;
	
	while ($row=pg_fetch_assoc($result)) {

		//  $row=pg_fetch_assoc($result);
		 //print_r($row);
		$email = $row['email'];  
	    $fullname = $row['fullname'];
	    $registration_num = $row['registration_num'];
	    $abstract_num = $row['abstract_num'];
	    $finaldecision = $row['finaldecision'];
	    $name = $row['name'];
	
		// Create a PHPMailer instance
		$mail = new PHPMailer(true);
	
		// Set up SMTP
		$mail->IsSMTP();
		$mail->Host = "10.80.17.18";
		$mail->SMTPAuth = false;
	
		$mail->setFrom('no-reply@niot.res.in');	

	
		$mail->IsHTML(true);
		$mail->SMTPKeepAlive = true;
		// if($flag==1) {
		// 	$mail->AddBcc('tarunsinhapvt99@gmail.com');
		// 	$mail->AddBcc('revathy@niot.res.in');
		// 	$flag=0; 
		// }
		
		//$mail->AddAddress($email); 
		// echo "data=".$email;
		// echo "data=".$registration_num;
		// echo "data=".$fullname;
		$mail->AddAddress("revathy@niot.res.in");
		$mail->Subject = "Remainder mail - WOSC 2024 Accommodation for students - with Registration no.:".$registration_num;
		$mail_body = "<HTML><HEAD> <META HTTP-EQUIV='Content-Type' CONTENT='text/html; charset=utf-8'>
		<meta http-equiv='Content-Language' content='lt'></HEAD>
		<BODY>
		<br/>
		<p><span style='color: rgb(51, 153, 102);'><b>Dear $fullname</b></span>,</p>
		<P style='text-align:justify;'> 
		Greetings from World Ocean Science Congress (WOSC2024)!!!<br /><br />
		We hope this message finds you well. We would like to remind all students who have submitted requests for accommodation to kindly bring a hardcopy of your Aadhar card and college ID card<br /><br />
		<br /><br />
		Your accommodation at Boys/Girls hostel, college of Engineering Guindy, Anna University, Chennai 600 025.  
		</br></br>	
		All would report at the above venue from 26 Feb 2024 @ 6 pm..</br></br>

		For your assistance on accommodation, please contact below numbers:</br></br>
    	Naga Sathis - +91 99523 55286 </br></br>
		Abisek kumar - +91 93044 75893
	
		Yours sincerely,<br /><br />
		<b style='color: rgb(51, 153, 102);'>Organizing Committee,</b><br />
		<b style='color: rgb(51, 153, 102);'>WOSC 2024</b><br />
		<b style='color: rgb(51, 102, 255);'>National Institute of Ocean Technology<br />
		Velachery-Tambaram Main Road<br />
		Chennai - 600100</b><br />
		<small><i>This is an auto generated mail, please do not reply. <br />
        for any query please contact us on Phone no. 044-6678-3563 / 044-6678-3347 or via email wosc2024@gmail.com </i></small><br /></p>";


		$mail->Body = $mail_body;
	
		$mail->AddAttachment('documents/WOSC_2024_Accommodation_details_students.pdf', 'documents/WOSC_2024_Accommodation_details_students.pdf');
		$response['email'] = array();
		if(!$mail->Send()) {
					$response['email']['msg'] = 'Message was not sent.';
					$response['email']['error'] =  'Mailer error: ' . $mail->ErrorInfo;
		} else {
			$response['email']['msg'] = 'Message has been sent to' .$fullname.", ".$finaldecision. ", ".$name.'<br>';
			
		} 
		echo json_encode($response);
	}



	pg_close($conn);
	// echo json_encode($response);


?>