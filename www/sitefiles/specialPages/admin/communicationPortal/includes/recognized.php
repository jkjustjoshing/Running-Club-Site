<?php

//start if E-Baord Member
$adminMySQL = mysql_query("SELECT * FROM `member_types` WHERE `id`=".$validate["memberType_id"]);
$adminArr = mysql_fetch_array($adminMySQL);
$admin = $adminArr["admin"];

include("member_function.php");

if (isset($successMessage))echo $successMessage;
echo "Welcome, ".$adminArr["type"]." ".$validate["lastName"]; //welcomes eboarder
echo "<br />";
include ("recognized/menu.php"); //script to display menu of options
echo '<div id="content" style="position:relative;top:30px;left:-10px;">';
include ("recognized/fullMemberList.php"); //script to show full member list
include ("recognized/myEdit.php"); //script to show personal data editor

if ($admin == 1){
		$permission = "eboard"; //lets later scripts know that this user has eboard permissions without doing that big if statement.
		include ("recognized/editMember.php"); //script to edit member list	
		include ("recognized/addMember.php"); //script to add member to list
		include ("recognized/mail_interface.php"); //script to show emailer
}

echo "</div>";


?>