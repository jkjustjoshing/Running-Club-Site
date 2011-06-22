<?php

$fromGettingData = mysql_fetch_array(mysql_query("SELECT * from members WHERE username='".$_SERVER["REMOTE_USER"]."'"));
$from = $fromGettingData["firstName"]." ".$fromGettingData["lastName"]."<".$fromGettingData["preferredEmail"].">";
$toString = "";
$confirmString = "";
if ($_POST["toField"] == "eboard"){
//send email to the eboard
	
	$adminMySQL = mysql_query("SELECT * FROM `members` WHERE memberType_id IN (SELECT `id` FROM `member_types` WHERE `admin`=1)");
	while($admin=mysql_fetch_array($adminMySQL)){
		$adminArr[] = $admin;
	}
	
	foreach ($adminArr as $adminIndividual){
		if ($toString != "" && $adminIndividual["preferredEmail"] != "") $toString .= ", ";
		$toString .= $adminIndividual["firstName"]." ".$adminIndividual["lastName"]."<".$adminIndividual["preferredEmail"].">";
	}
}


else if ($_POST["toField"] == "regMembers"){ //send email to members who have a 1 in mailingList

	$holdToData = mysql_query("SELECT * from `members` WHERE `mailingList`='1'");
	while ($getToData = mysql_fetch_array($holdToData)){
		if ($toString != "") $toString .= ", ";
		$toString .= $getToData['firstName']." ".$getToData['lastName']."<".$getToData["preferredEmail"].">";
	}

}

else if ($_POST["toField"] == "allMembers"){ //send email ta ALL members

	$holdToData = mysql_query("SELECT * from members");
	while ($getToData = mysql_fetch_array($holdToData)){
		if ($toString != "") $toString .= ", ";
		$toString .= $getToData['firstName']." ".$getToData['lastName']."<".$getToData["preferredEmail"].">";
	}

}

else if ($_POST["toField"] == "select"){
	foreach ($_POST["manualTo"] as $email){
		if ($toString != "") $toString .= ", ";
		$name = mysql_fetch_array(mysql_query("SELECT `firstName`, `lastName` FROM `members` WHERE preferredEmail='".$email."'"));//gets the person's first and last names
		$toString .= $name['firstName']." ".$name['lastName']."<".$email.">";
	}

}

$message = wordwrap($_POST["mail_message_communication_message"], 70);
$mail = mail($toString, $_POST["subject"], $message, "From: ".$from);

if ($mail)
	$successMessage =  "Mail sent successfully to:<br /> ".$toString."<br /><br />";
else
	$successMessage = "Uhoh! Something went wrong! Try again, and if it doesn't work let the webmaster know.<br /><br />";
?>