Welcome to the member's section of the 
<?php
	$query = mysql_query("SELECT `value` FROM `settings` WHERE `name`='site_name'");
	$pageTitle = mysql_fetch_array($query);
	echo $pageTitle['value'];
?>
 website! <br />
<br />
It appears that this is the first time you have visited us. For now, this part of the website is where members can update their personal
information (specifically, contact information) so that the elected board of the club can get in touch with the members.<br />
<br />
Please fill out the following form to be added to the database and subscribe to our mailings:<br />
<br />
<br />
<form method="post" action="">
<label class="textFieldUnrecognized">RIT Username:</label><?php echo $_SERVER["REMOTE_USER"]; ?><br />
<label class="textFieldUnrecognized" for="firstName">First Name:</label><input type="text" name="firstName" id="firstName" /><br />
<label class="textFieldUnrecognized" for="lastName">Last Name:</label><input type="text" name="lastName" id="lastName" /><br />
<label class="textFieldUnrecognized" for="preferredEmail">Preferred Email Address:</label><input type="text" name="preferredEmail" id="preferredEmail" value="<?php echo $_SERVER["REMOTE_USER"]; ?>@rit.edu" /><br />
<br />
Would you like to receive emails regularly about the club, or just when the emails are really important?<br />
(Example: A "regular email" would be a reminder about a schedule change. An "important email" would be one saying you need to sign a waiver)<br />
<?php
	if ($pageTitle['value']=="RIT Quidditch")
		echo '<h3>RIT Quidditch will not be using the email 
		feature of the Communication Portal right now. 
		Check back in the future and we may. Please keep your email updated</h3>';
	else
		echo '<br />';
	
?>
<input type="radio" id="yes" name="mailingList" value="1" /><label for="yes">All Mailings</label><br />
<input type="radio" id="no" name="mailingList" value="0" /><label for="no">Critical Mailings Only</label><br />
<br />
<br />
<br />
<input type="hidden" name="newMemberSelf" value="set" />
<input type="submit" value="Add your name to our database" />
</form>