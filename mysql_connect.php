<?php
$dbusername = "w-run";

if ($_SERVER['SERVER_NAME'] == 'www-staging.rit.edu'){
	$dbpassword = "2xDw*NZU";
	$dbserver = "www-db-staging.rit.edu";
}
else if ($_SERVER['SERVER_NAME'] == 'www.rit.edu'){
	$dbpassword = "438fwRYX";
	$dbserver = "www-db.rit.edu";
	}
	
mysql_connect($dbserver, $dbusername, $dbpassword) or die(mysql_error());
mysql_select_db ('w_run') or die(mysql_error());

//stop sql injection for $_GET
foreach ($_GET as $key => $value){
	$_GET[$key]=mysql_real_escape_string($value);
}

//stop sql injection for $_POST
foreach ($_POST as $key => $value){
	if ($key != 'mail_message_communication_message' &&
		$key != 'destination' &&
		$key != 'manualTo' &&
		!isset($_POST['mailSent'])){
			$_POST[$key]=mysql_real_escape_string($value);
	}
}

?>