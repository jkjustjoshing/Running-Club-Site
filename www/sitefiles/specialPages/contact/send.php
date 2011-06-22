<?php	


	//runningclubtest@gmail.com, password="ilovetorun
	$query = mysql_query("SELECT `preferredEmail` FROM `members` WHERE `memberType_id` IN (SELECT `id` FROM `member_types` WHERE `type`='Webmaster') LIMIT 1");
	$data = mysql_fetch_array($query);
	$to = $data['preferredEmail'];
	
	$subject = 'Quidditch Email from "'.$_POST["name"].'"';
	$message = 
	"Email sent from the Quidditch Contact Website
	
Name:
" . $_POST["name"] . "

Email:
". $_POST["email"]. "

Message:
" . $_POST["mail_message_communication_message"]."

End of message";
	//$message = wordwrap($message, 70);
	$header = 'From: RunningClubContactForm@DONOTREPLY.rit.edu';
	$mail_sent = @mail ($to, $subject, $message, $header);
	if ($mail_sent == false){
		$messageSentMessage = "ERROR - MESSAGE NOT SENT - 
				If you feel you have reached this in error, please email 
				the webmaster at jdk3414@rit.edu";
	}
	else{
		$messageSentMessage = "Your message was successfully sent";
	}
?>
