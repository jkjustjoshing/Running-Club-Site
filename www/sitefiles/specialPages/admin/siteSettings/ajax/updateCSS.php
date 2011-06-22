<?php
	header("Content-type: text/xml");
?>
 
 <css action="update">
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
	
	$foofers = "UPDATE `styles` SET `attribute`='".mysql_escape_string($_POST['attribute'])."', `value`='".mysql_escape_string($_POST["value"])."' WHERE `attributeID`=".mysql_escape_string($_POST["attributeID"]);
	mysql_query($foofers);
	$query = mysql_query("SELECT * FROM `styles` WHERE `attributeID`=".$_POST['attributeID']);
	$css = mysql_fetch_array($query);
	
	
	echo '<attribute id="'.$_POST["attributeID"].'">';
		echo $css["attribute"];
	echo '</attribute>';
	
	echo '<value>';
		echo $css["value"];
	echo '</value>';

?>
</css>