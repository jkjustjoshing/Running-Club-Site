<?php $page='Frosh Add Form';
	  $mysql = true;
			require("../../header/header.php"); 
			
if (isset($_POST["submittedAdd"])){

	$test_success = mysql_query("INSERT into members 
	(username, firstName, lastName, mailingList, preferredEmail, memberType_id) 
	VALUES 
	('".$_POST["username"]."', '".$_POST["firstName"]."', '".$_POST["lastName"]."', '1', '".$_POST["preferredEmail"]."', '11')");
	
echo '<div id="confirmation" style="display:">';

	if($test_success){
		echo $_POST["firstName"].' '.$_POST["lastName"].' (RIT ID '.$_POST["username"].', email '.$_POST["preferredEmail"].') has been successfully been added';
	} else {
	echo 'Error: Please Try Again';
	}
echo '<div style="position:absolute;top:0px;width:100px;height:10px;color:black;">';
echo '</div>';
}

?>
<h1>Join the Running Club's Mailing List</h1>
<form method="post" id="addMember" action="frosh_add.php" onsubmit="checkForm(this);">
<table border="1">
<tr>
<td>Username</td>
<td>First Name</td>
<td>Last Name</td>
<td>Preferred Email</td>
</tr>


<script type="text/javascript">
function emailFill(foo){
document.getElementById('preferredEmail').value = foo.value+'@rit.edu';
}
</script>


<tr>
<td><input type="text" id="username" name="username" onchange="emailFill(this);"/></td>
<td><input type="text" id="firstName" name="firstName" /></td>
<td><input type="text" id="lastName" name="lastName" /></td>
<td><input type="text" id="preferredEmail" name="preferredEmail" /></td>
</tr>

</table>
<input type="hidden" name="submittedAdd" value="set" />
<input type="submit" value="Add this Member" />
</form>


<?php 

		
	include ("../../header/footer.php"); ?>

