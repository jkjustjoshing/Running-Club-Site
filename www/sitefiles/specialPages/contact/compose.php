<?php
	$query = mysql_query("SELECT `firstName` FROM `members` WHERE `memberType_id` IN (SELECT `id` FROM `member_types` WHERE `type`='President') LIMIT 1");
	$data = mysql_fetch_array($query);
	$presidentName = $data['firstName'];
?>
	<br />
	If you are interested in the club, or just have a question, ask our 
	president, <?php echo $presidentName;?>
	<br />
	<br />
	You can also get in touch with us through our <a href="http://www.facebook.com/group.php?gid=177210694136">Facebook group!</a>
	<br />
	<br />
	<br />
	<form id="contactform" action="" method="post" onsubmit="return validForm(this);">
		<label class="contact_label" for="name">Name:</label>
		<input class="contact_input" type='text' name="name" id="name" />
		<span id="nameError" style="color:red;display:none;">Please enter your name</span>
		<br />
		
		<label class="contact_label" for="email">Email Address:</label>
		<input class="contact_input" type="text" name="email" id="email" />
		<span id="emailError" style="color:red;display:none;">Please enter a valid email address</span><br />
	
		<label class="contact_label" for="message">Message:</label>
		<textarea class="contact_input" name="mail_message_communication_message" 
			rows="10" cols="35" id="message"></textarea>
		<span id="messageError" style="color:red;display:none;">Please enter a message</span><br />
	<br />
		<input type='submit' value='Submit' />
</form>

