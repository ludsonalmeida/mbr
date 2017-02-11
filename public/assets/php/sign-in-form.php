<?php

	$email = trim($_POST['emailSigned']);
	
	$emailTo = $email; 
	$emailReply = 'do-not-reply@fadev.com.br'; // Reply email address
	$emailFrom = 'naoresponda@fadev.com.br'; // Your email
	$subject = 'Cadastramento Ebook'; // Subject
	$body = "
	ey!\n
	Teste/\n
	Thanks,
	FADEV
	"; // Email content
	$headers = 'De: '.$emailFrom."\r\n" .
        'Para: '.$emailReply."\r\n";

	mail($emailTo, $subject, $body, $headers);
	$emailSent = true;
	echo ('SEND');
	
?>
