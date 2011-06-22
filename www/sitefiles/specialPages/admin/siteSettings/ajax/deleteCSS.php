<?php
	header("Content-type: text/xml");
?>
 
 <css>
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
	$absolutePath = substr($_SERVER['SCRIPT_FILENAME'], 0, $indexWebPathEnd)."/../../../../../";
	
	//gets all the required site-specific information
	require ($absolutePath.'profile.php');
	
	require($absolutePath.'/sitefiles/extras/dbconnect.php');
	
	echo '<delete attributeID="'.$_POST["attributeID"].'">';
	
	$foofers = "DELETE FROM `styles` WHERE `attributeID`=".mysql_escape_string($_POST["attributeID"]);
	mysql_query($foofers);
	if (mysql_affected_rows()){
		echo "1"; //success
	}else{
		echo "0"; //failute
	}
	
	echo '</delete>';

?>
</css>