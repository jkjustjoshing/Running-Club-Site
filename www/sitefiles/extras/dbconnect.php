<?php

//Session and MySQL
//starts a PHP session with a session cookie
session_start(); 

//connects to MySQL
//SET AN ERROR CATCHING STATEMENT HERE
if (@isset($dbpath)){
	require ($absolutePath.$dbpath);
} else {
	//connect with password and username variable
	mysql_connect($dbserver, $dbusername, $dbpassword) or die(mysql_error());
	mysql_select_db ($dbdatabase) or die(mysql_error());
}
?>