<?php
	require_once('./phpmailer/PHPMailerAutoload.php');
	$mail = new PHPMailer();

	$mail->IsSMTP(); // telling the class to use SMTP
	//$mail->Host       = "mail.yourdomain.com"; // SMTP server
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
	                                           // 1 = errors and messages
	                                           // 2 = messages only
	$mail->SMTPAuth		= true;                  // enable SMTP authentication
	$mail->SMTPSecure	= "tls";                 
	$mail->Host			= "smtp.gmail.com";      // SMTP server
	$mail->Port			= 587;                   // SMTP port
	$mail->Username   	= "matteo.mssmr@gmail.com";  // username
	$mail->Password   	= "Matteo1234";            // password
	
	$mail->SetFrom('matteo.mssmr@gmail.com', 'Matteo');

	$mail->Subject    = "Social Network Signup!";

	$mail->MsgHTML('<!DOCTYPE HTML>'
			. '<html>'
			.	'<head>'
			.		'<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'
			.	'</head>'
			. 	'<body>'
			.		'<div style="background-color:#88AAFF; border-radius: 10px; padding: 20px">'
		  	.	 		'<h1>Hi ' . $_POST["name"] . ',</h1>'
		  	.			'<h4>I\'m Matteo from Social Team ☺</h4>'
		  	.			'<p>I\'m glad you want to sign up to my big project :)</p>'
		  	.			'<div style="text-align: center">'
			.				'<a href="https://placenet.com/verify.php?token=' . $token . '"><img src="https://s27.postimg.org/5ywldl3gz/button.png"/></a>'
			.			'</div>'
			.		'</div>'
			.	'</body>'
			. '</html>');

	$mail->AddAddress($address, "Matteo");

	if(!$mail->Send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "Message sent!";
	}
?>