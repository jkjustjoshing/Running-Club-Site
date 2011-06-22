<form method="post" action="" style="display:none" id="mail" onsubmit="checkForm('mail')">
<h2>Send an email to the club!</h2>
<h6 style="margin:0;padding:0;">Plain text now, possibly in the future a "pretty email" option will be made available</h6>
<br /><br />
Who is this getting sent to:
<select id="toField" name="toField" onchange="detailedTo(this.value);"><!-- the "to" chooser -->
	<option value="none"> - </option>	
	<option value="eboard">The E-Board</option>
	<option value="regMembers">Subscribed members (who do want regular updates)</option>
	<option value="allMembers">All members (even those who don't want regular mailings)</option>	
	<option value="select">Select which members to contact -&gt;</option>	
</select><!-- end "to" chooser -->
<br /><br />
<label for="subject">Subject:</label><br />
<input type="text" name="subject" id="subject" />
<br /><br />


<label for="message">Message:</label><br />
<textarea id="message" name="mail_message_communication_message" style="width:400px;height:150px"></textarea>

<input type="hidden" id="mailSent" name="mailSent" value="set" />
<br /><input type="submit" value="Send email!" />

<span id="detailedTo" style="display:none;width:250px;position:relative;left:500px;top:-220px">
Who do you want to send it to?<br /><br />
<?php
$result = mysql_query("SELECT * from members ORDER BY lastName"); //selects entire table
while ($row = mysql_fetch_array($result)){
	$i=$row["username"];
	echo '<input type="checkbox" id="'.$i.'mailer" value="'.$row["preferredEmail"].'" name="manualTo[]" /><label for="'.$i.'mailer">'.$row["firstName"].' '.$row["lastName"].'</label>';
	echo '<br />';
}
?>
</span>

</form>