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
	
	if($_POST['oldData'] != 'newInputCONFIRMATION'){
		mysql_query("UPDATE `page_data` SET `page`='".$_POST['newData']."' WHERE `page`='".$_POST['oldData']."'");
		$query = mysql_query("SELECT `page` FROM `page_data` WHERE `page`='".$_POST['newData']."'");
		$data = mysql_fetch_array($query);
		echo $data['page'];
	}else{
		mysql_query("INSERT INTO `page_data` (`navIndex`, `page`, `dataType`, `content`) VALUES (1, '".$_POST['newData']."', 'content', 'New Page<br /><br />Click \"Edit Page\" below to add content')");
		$query = mysql_query("SELECT `page` from `page_data` WHERE `page`='".$_POST['newData']."'");
		$data = mysql_fetch_array($query);
		echo $data['page'];
	}
?>
