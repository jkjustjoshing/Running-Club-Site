<?php

	//if the page was just submitted, update the content
	if (isset($_POST['main_content'])){
		mysql_query("UPDATE `page_data` SET `content`='".$_POST['main_content']."' WHERE `page`='".$_GET['page']."'");
	}
	
	$validate_query = mysql_query("SELECT * from members WHERE username='".$_SERVER["REMOTE_USER"]."'"); //selects the information for the user logged in
		if($validate = mysql_fetch_array ($validate_query)){
			include ("recognized.php");
		}
		else{
			include("error.php");
		}
		
		
?>