<?php 
	include ("includes/mysql_commands.php"); 

	$validate_query = mysql_query("SELECT * from members WHERE username='".$_SERVER["REMOTE_USER"]."'"); //selects the information for the user logged in
	if($validate = mysql_fetch_array ($validate_query)){
		include ("includes/recognized.php");
	}
	else{
		include ("includes/unrecognized.php");
	}

?>