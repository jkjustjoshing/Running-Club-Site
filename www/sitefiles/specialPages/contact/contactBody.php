<?php
	
	if (isset($_POST["mail_message_communication_message"]))
		echo $messageSentMessage;
	else
		include ("compose.php");

?>