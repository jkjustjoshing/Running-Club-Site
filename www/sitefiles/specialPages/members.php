
	<br />
	<span style="text-decoration:underline;font-size:18pt;">The Elected Board</span>
	<div id="publicMemberList"><br />
	<?php

$adminQuery = mysql_query("SELECT * FROM `member_types` WHERE `admin`=1 ORDER BY `id`");
while($admin = mysql_fetch_array($adminQuery)){
	$adminArr[] = $admin;
}


foreach($adminArr as $admin){
	$memberMySQL = mysql_query("SELECT * FROM `members` WHERE `memberType_id`='".$admin['id']."'");
	
	if (mysql_num_rows($memberMySQL) != 0){
		echo '<span class="title">'.$admin['type'].'</span><br />';

		unset($memberArr);
		while ($member = mysql_fetch_array($memberMySQL)){
			$memberArr[] = $member;
		}
		
		$first = true;
		foreach ($memberArr as $member){
			if ($first === false) echo ", ";
			else $first = false;
			echo '<a href="mailto:'.$member['preferredEmail'].'">'.$member['firstName'].' '.$member['lastName'].'</a>';
		}
	
		echo '<br /><br />';
	}
}

	?>
	<br /><br />
	</div>
	<br />
<div style="position:absolute;left:600px;top:50px;width:200px;border:1px solid #f36e21;">
Log in <a href="<?php echo $webDir;?>/members/communicationPortal">here</a>
with your RIT username and password. You must be a member of the RIT 
community to use this section of our site. 
If you are alreay a member of the club you can modify your 
subscription settings. If you are not, you can sign up to receive our 
periodical emails.
</div>
