<form method="post" style="display:none" id="addMember" action="" onsubmit="checkForm(this);">
<table border="1">
<tr>
<td>Username</td>
<td>First Name</td>
<td>Last Name</td>
<td>Email Subscribe?</td>
<td>Preferred Email</td>
<td>Member Type</td>
</tr>

<tr>
<td><input type="text" id="username" name="username" /></td>
<td><input type="text" id="firstName" name="firstName" /></td>
<td><input type="text" id="lastName" name="lastName" /></td>
<td><select id="mailingList" name="mailingList" >
	<option value="1" selected="selected"> - </option>
	<option value="1">Yes</option>
	<option value="0">No</option>
</select></td>
<td><input type="text" id="preferredEmail" name="preferredEmail" /></td>
<td><?php memberDropdown('memberType_id'); ?></td>
</tr>

</table>
<input type="hidden" name="submittedAdd" value="set" />
<input type="submit" value="Add this Member" />
</form>