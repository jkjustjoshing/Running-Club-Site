<?php
	$webmasterMySQL = mysql_query("SELECT `id` from `member_types` WHERE `type`='Webmaster'"); 
	$webmasterForeignID = mysql_fetch_array($webmasterMySQL);
	$webmasterMySQL = mysql_query("SELECT * from `members` WHERE `memberType_id`=".$webmasterForeignID['id']);
	if (mysql_num_rows($webmasterMySQL) < 1){
		$adminMySQL = mysql_query("SELECT * from `member_types` WHERE `admin`=1"); 
		while($adminForeignID = mysql_fetch_array($adminMySQL)){
			$admin[] = $adminForeignID;
		}
		$i = 0;
		do {
			$adminMySQL = mysql_query("SELECT * from `members` WHERE `memberType_id`='".$admin[$i]['id']."'");
			$i++;
		}while(mysql_num_rows($adminMySQL) < 1 && $i <= sizeof($admin));
		$eboard_type = mysql_fetch_array(mysql_query("SELECT `type` from `member_types` WHERE `id`=".$admin[$i-1]['id'] )); 
		$eboard_type = $eboard_type['type'];
		$eboard_contact = mysql_fetch_array($adminMySQL);
		$eboard_contact = $eboard_contact['preferredEmail'];
		
	} else {
		$eboard_contact = mysql_fetch_array($webmasterMySQL);
		$eboard_contact = $eboard_contact['preferredEmail'];
		$eboard_type = "Webmaster";
	}
	echo 'You don\'t have permission to edit this page. If you believe you have found this message 
	in error, please contact <a href="mailto:'.$eboard_contact.'">the '.$eboard_type.'</a>';
	?>