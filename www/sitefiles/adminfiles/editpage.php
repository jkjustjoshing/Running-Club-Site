<?php


	//absolute path to web directory
	$indexWebPathEnd=0;
	while(strpos($_SERVER['SCRIPT_FILENAME'], '/', $indexWebPathEnd) !== false){
		if (strpos($_SERVER['SCRIPT_FILENAME'], '/', $indexWebPathEnd+1) !== false){
			$indexWebPathEnd = strpos($_SERVER['SCRIPT_FILENAME'], '/', $indexWebPathEnd+1);
		}else {
			break;
		}
	}
	$absolutePath = substr($_SERVER['SCRIPT_FILENAME'], 0, $indexWebPathEnd).'/../..'; //dots since we are 2 levels deeper
	
	

	//gets all the required site-specific information
	require ($absolutePath.'/profile.php');
	
	//connect to the database
	require ($absolutePath.'/sitefiles/extras/dbconnect.php');
	
	
	//gets the header
	require($absolutePath.'/sitefiles/header/header.php'); 

		
	//get the content from the server
	$query = mysql_query("SELECT * from `page_data` WHERE `page`='".$_GET['page']."'");
	$data = mysql_fetch_array($query);
	$content = $data['content'];
	$dataType = $data['dataType'];
	$adminContent = $data['adminContent'];
	
	if ($pageExists === true){
		//this page exists
		if ($ritWebEnvironment === true){
			if ($dataType == 'path'){
				require('../../special-PHP-pages-here/'.$adminContent);
			} else if ($dataType == 'content'){
				//if we are in the RIT web environment and are using http authentication
				include ('index.php');
			}
		}else {
			//if we are not using RIT http authenitcation
			echo 'The admin feature isn\'t supported yet outside the main RIT web environment';
		}
	} else if ($pageExists === false) {
		//this page doesn't exist
		include('../errordocs/404.php');
	}

include ($absolutePath.'/sitefiles/header/footer.php');

?>

