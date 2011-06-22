<?php 
/*** TO DO LIST
* Create test for '/' at end and beginning of paths/URLs


**/


	//absolute path to web directory
	$indexWebPathEnd=0;
	while(strpos($_SERVER['SCRIPT_FILENAME'], '/', $indexWebPathEnd) !== false){
		if (strpos($_SERVER['SCRIPT_FILENAME'], '/', $indexWebPathEnd+1) !== false){
			$indexWebPathEnd = strpos($_SERVER['SCRIPT_FILENAME'], '/', $indexWebPathEnd+1);
		}else {
			break;
		}
	}
	$absolutePath = substr($_SERVER['SCRIPT_FILENAME'], 0, $indexWebPathEnd).'/..';
	
	

	//gets all the required site-specific information
	require ($absolutePath.'/profile.php');
	
	//connect to the database
	require ($absolutePath.'/sitefiles/extras/dbconnect.php');
	
	
	//test to see if this is the first time the site has been opened. If so, run the setup file
	$query = mysql_query("SELECT `value` FROM `settings` WHERE `name`='siteConfigured'");
	$data = mysql_fetch_array($query);
	//if (!@isset($data['value']) || $data['value'] = 'false'){ //test for need for configuration page
	if (false){
		//site hasn't been configured, redirect to the configuration file
		header("HTTP/1.0 302 Found");
		header("Location: ../?siteConfiguration");
	} else {
	
		//gets the header
		require($absolutePath.'/sitefiles/header/header.php'); 
	
		//get the content from the server
		$query = mysql_query("SELECT * from `page_data` WHERE `page`='".$_GET['page']."'");
		$data = mysql_fetch_array($query);
		$pageContent = $data['content'];
		$dataType = $data['dataType'];
		
		if ($pageExists === true){
			//this page exists
			
			//if $pageContent is a file path, include the file
			if ($dataType == 'path'){
				include('../special-PHP-pages-here/'.$pageContent);
			} else if ($dataType == 'content'){
				//parse the content and put it on the screen
				include($absolutePath.'/sitefiles/contentparser.php');
				echo parseContent($pageContent);
			}
	
		} else if ($pageExists === false) {
			//this page doesn't exist
			include('errordocs/404.php');
		}
	
		include ($absolutePath.'/sitefiles/header/footer.php');
	}//end of else statement for testing if the site has run before
?>


