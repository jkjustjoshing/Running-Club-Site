<form method="post" action="" style="display:none" id="myEdit" onsubmit="checkForm('myEdit')">
<table border="1"><tr>
<td></td>
<td>Username</td>
<td>First Name</td>
<td>Last Name</td>
<td>Email <br />Subscribe?</td>
<td>Preferred Email</td>
</tr>
<tr>
<?php
$result = mysql_query("SELECT * from members WHERE username='".$validate["username"]."'"); //selects table entry for logged in person

$row = mysql_fetch_array($result);
	$i = $row["username"];
	echo '<td><a href="javascript:selfDelete();"><div class="delete_button"></div></a></td>';
	echo "<td>".$i."</td>";
	echo "<td><input id=\"".$i."myfirstName\" name=\"".$i."myfirstName\" type=\"text\" value=\"".$row["firstName"]."\" size=\"12\" /></td>";
	echo "<td><input id=\"".$i."mylastName\" name=\"".$i."mylastName\" type=\"text\" value=\"".$row["lastName"]."\" size=\"12\" /></td>";
	echo "<td><select id=\"".$i."mymailingList\" name=\"".$i."mymailingList\" ><option ";
	if ($row["mailingList"] == 1){echo "selected=\"selected\"";}
	echo " value=\"1\">Yes</option><option ";
	if ($row["mailingList"] == 0){echo "selected=\"selected\"";}
	echo " value=\"0\">No</option></select></td>";
	echo "<td><input id=\"".$i."mypreferredEmail\" name=\"".$i."mypreferredEmail\" type=\"text\" value=\"".$row["preferredEmail"]."\" size=\"18\" /></td>";
	echo "</tr>";
?>	
</table>
<input type="hidden" name="submittedmyEdit" value="set" />
<input type="submit" value="Update All Fields" />
</form>

<form id="selfDelete" method="post" action="">
	<input type="hidden" name="selfDelete" value="selfDelete" />
</form>
