<?php
//start if E-Baord Member
$admin_checkMySQL = mysql_query("SELECT `admin` FROM `member_types` WHERE `id`=".$validate["memberType_id"]);
$admin_check = mysql_fetch_array($admin_checkMySQL);
if ($admin_check['admin'] = 1){
		include ("racesEditing.php");
}
else{
	echo 'You are not an admin. Try again';
}
?>