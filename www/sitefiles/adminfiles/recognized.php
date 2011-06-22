<?php	
//start if E-Baord Member
$adminMySQL = mysql_query("SELECT `admin` FROM `member_types` WHERE `id` IN (SELECT `memberType_id` FROM `members` WHERE username='".$_SERVER["REMOTE_USER"]."')");
$admin = mysql_fetch_array($adminMySQL);
if ($admin["admin"] == 1){
		include ("mainEditing.php");
}
else{
	include ("error.php");
}
?>