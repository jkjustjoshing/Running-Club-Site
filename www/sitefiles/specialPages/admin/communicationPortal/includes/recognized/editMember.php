<form method="post" action="" style="display:none" id="editMember" onsubmit="return editMemberConfirm()">
<table border="1"><tr><td></td>
<td>Username</td>
<td>First Name</td>
<td>Last Name</td>
<td>Email <br />Subscribe?</td>
<td>Preferred Email</td>
<td>Member Type</td></tr>

<?php
$result = mysql_query("SELECT * from `members` ORDER BY `memberType_id` DESC"); //selects entire table
while ($row = mysql_fetch_array($result)){
	$i = $row["username"];
	echo '<tr><td><a href="javascript:deleteEntry(\''.$i.'\', \''.$row["firstName"].'\', '.$row["id"].');"><div class="delete_button"></div></a></td>';
	echo "<td>".$i."</td>";
	echo '<td><input id="'.$i.'firstName" name="'.$i.'firstName" type="text" value="'.$row["firstName"].'" size="12" /></td>';
	echo '<td><input id="'.$i.'lastName" name="'.$i.'lastName" type="text" value="'.$row["lastName"].'" size="12" /></td>';
	echo '<td><select id="'.$i.'mailingList" name="'.$i.'mailingList" ><option ';
	if ($row["mailingList"] == 1){echo 'selected="selected"';}
	echo ' value="1">Yes</option><option ';
	if ($row["mailingList"] == 0){echo 'selected="selected"';}
	echo ' value="0">No</option></select></td>';
	echo '<td><input id="'.$i.'preferredEmail" name="'.$i.'preferredEmail" type="text" value="'.$row["preferredEmail"].'" size="18" /></td>';
	echo '<td>'; memberDropdown($i."memberType_id", $row["memberType_id"]);
	
	echo "</td></tr>";
}
echo "</table>";
echo '<input type="hidden" name="submittedEdit" value="set" />';
echo '<input type="submit" value="Update All Fields" />';
echo "</form>";

// this part prints invisible forms to tell the page using
// POST method to delete the entry
echo '<form id="deleteForm" method="post" action="">';
$result = mysql_query("SELECT * from `members`"); //selects entire table
while ($row = mysql_fetch_array($result)){
	echo '<input type="radio" class="hidden" value="'.$row["username"].'"  id="hidden_delete_input_'.$row["id"].'" name="deleteradio" />';
}
	echo "</form>";

?>