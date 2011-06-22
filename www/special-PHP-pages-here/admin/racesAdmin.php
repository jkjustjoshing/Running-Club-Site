<?php
	$validate_query = mysql_query("SELECT * from `members` WHERE username='".$_SERVER["REMOTE_USER"]."'"); //selects the information for the user logged in
		if($validate = mysql_fetch_array ($validate_query)){
			include ("races/recognized.php");
		}
		else{
			echo 'You dant have permissions. Try when you are an admin';
		}
		
?>