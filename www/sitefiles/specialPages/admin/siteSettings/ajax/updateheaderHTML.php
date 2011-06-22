<?php
	header("Content-type: text/plain");

	//absolute path to web directory
	$indexWebPathEnd=0;
	while(strpos($_SERVER['SCRIPT_FILENAME'], '/', $indexWebPathEnd) !== false){
		if (strpos($_SERVER['SCRIPT_FILENAME'], '/', $indexWebPathEnd+1) !== false){
			$indexWebPathEnd = strpos($_SERVER['SCRIPT_FILENAME'], '/', $indexWebPathEnd+1);
		}else {
			break;
		}
	}
	$absolutePath = substr($_SERVER['SCRIPT_FILENAME'], 0, $indexWebPathEnd)."/../../../../../";
	
	//gets all the required site-specific information
	require ($absolutePath.'profile.php');
	
	require($absolutePath.'/sitefiles/extras/dbconnect.php');
	$_POST['HTML']=str_replace('\n','***NEWLINE***', $_POST['HTML']);
	mysql_query("UPDATE `settings` SET `value`='".mysql_real_escape_string($_POST['HTML'])."' WHERE `name`='headerHTML'");
	$htmlquery = mysql_query("SELECT `value` FROM `settings` WHERE `name`='headerHTML'");
	$html = mysql_fetch_array($htmlquery);
	echo stripslashes($html['value']);
	
?>
