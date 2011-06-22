<?php
	if ($_SERVER["HTTPS"] != "on"){
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		
		header("Location: https://".$pageURL);
	} else {
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
		include ($absolutePath.'/profile.php');
			if ($_GET['type'] == '403'){
				$_GET['page'] = '403 Authentication Error';
			} else if ($_GET['type'] == '404'){
				$_GET['page'] = '404 Error Not Found';
			}
		
		
		include ($absolutePath.'/sitefiles/header/header.php');
		include ($_GET['type'].'.php');
		include ($absolutePath.'/sitefiles/header/footer.php'); 
		
	}	
?>
