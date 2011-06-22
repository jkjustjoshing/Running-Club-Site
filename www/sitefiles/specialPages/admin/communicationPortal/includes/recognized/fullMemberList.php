<div id="memberList" style="display:none">
<table border="1"><tr>
<td>Username</td>
<td>Name</td>
<?php

if($admin = 1){ //only lets eboard members see email preferences
	echo "<td>Email Subscribe?</td>";}
?>
<td>Preferred Email</td>
<td>Member Type</td></tr>

<?php
$i=0;
$result = mysql_query("SELECT * from `members` ORDER BY `memberType_id`"); //selects entire table
while ($row = mysql_fetch_array($result)){
	echo "<tr><td>".$row["username"]."</td>";
	echo "<td>".$row["firstName"]." ".$row["lastName"]."</td>";
	if($admin = 1){ //only lets eboard memebers see email preferences
		echo "<td>";
		if ($row["mailingList"] == 1) echo "Yes"; else echo "No";
		echo "</td>";
	}
	echo "<td><a href=\"mailto:".$row["preferredEmail"]."\">".$row["preferredEmail"]."</a></td>";
	echo "<td>";
	$member = mysql_fetch_array(mysql_query("SELECT * FROM `member_types` WHERE `id`=".$row["memberType_id"]));
	echo $member['type'];
	echo "</td></tr>";
}
echo "</table>";
echo "</div>";
//memberDropdown($row["preferredEmail"], $row["memberType_id"]);

?>