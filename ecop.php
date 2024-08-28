<?php

include_once("config.php");

require("phpmailer/class.phpmailer.php");
	$mail = new PHPMailer();

	$query="select wr.*, rim.registration_num from wosc24_registration wr 
	join registration_id_map rim on rim.registration_id = wr.serial_no
	where wr.is_ecop ilike '%yes%' and wr.delflag='Y'";

	$result = pg_query($conn, $query);
	//$flag = 1;
	
	while ($row=pg_fetch_assoc($result)) {

		//  $row=pg_fetch_assoc($result);
		 //print_r($row);
		$email = $row['email'];  
	    $fullname = $row['fullname'];
	    $registration_num = $row['registration_num'];
	   // $abstract_num = $row['abstract_num'];
	    //$finaldecision = $row['finaldecision'];
	   // $name = $row['name'];
	
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
		
		$mail->AddAddress($email); 
		// echo "data=".$email;
		// echo "data=".$registration_num;
		// echo "data=".$fullname;
	//$mail->AddAddress("revathy@niot.res.in");
		$mail->Subject = "World Ocean Science Congress (WOSC2024) - with Registration no.:".$registration_num;
		$mail_body = "<HTML><HEAD> <META HTTP-EQUIV='Content-Type' CONTENT='text/html; charset=utf-8'>
		<meta http-equiv='Content-Language' content='lt'></HEAD>
		<BODY>
		<br/>
		<p><span style='color: rgb(51, 153, 102);'><b>Dear $fullname</b></span>,</p>
		<P style='text-align:justify;'> 
		Greetings from World Ocean Science Congress (WOSC2024)!!!<br /><br />
		Trust this email finds you well. The Early Career Ocean Professional (ECOP) program is a network of self-identified professionals early in their careers in any field or activity related to the ocean. The framework of the ECOP network aims to align individual research interests to the UN Ocean Decade goals of a sustainable Ocean.
		<br /><br />
	In the context of the WOSC 2024, we invite you for an open and interactive dialogue on the &apos;Early Career Ocean Professionals Meet and Panel Discussion&apos; planned under the ECOP program.
	<br /><br />
	The details of the event are as follows.<br /><br />
	<b>Date and Time &#8208; 27 February 2024, 16:00 to 17:30 IST</b><br /><br />
	<b>Panel Discussion Topic- Innovating the Oceans for a sustainable future - perspectives of Young Oceanographers</b><br /><br />
	The event includes<br>
	<ul>
	<li> Introduction to ECOP by Ms. Sunanda Narayanan, ECOP Coordinator and Research Scholar, IIT Kharagpur</li>
	<li> Meet and greet by researchers voluntarily</li>
	<li> Panel discussion</li>
	<li> Interactive Q/A discussion</li>
	<li> Concluding remarks</li>
	</ul>
	Your presence and expertise are needed for the success of this event and thereby to increase the visibility of the early career researchers in the field.
	</br></br>
	
	Thank you,<br /><br />
		<b style='color: rgb(51, 153, 102);'>ECOP session coordinators,</b><br />
		<b style='color: rgb(51, 153, 102);'>Dr Divya David T, NCPOR, Goa (divya@ncpor.res.in)</b><br />
		<b style='color: rgb(51, 153, 102);'>Ms Sunanda Narayanan, IIT Kharagpur (sunanda.narayanan@gmail.com)</b><br />
		<small><i>This is an auto generated mail, please do not reply. <br />
        for any query please contact us on Phone no. 044-6678-3563 / 044-6678-3347 or via email wosc2024@gmail.com </i></small><br /></p>";


		$mail->Body = $mail_body;
	
		
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