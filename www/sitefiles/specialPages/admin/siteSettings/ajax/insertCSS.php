<?php
	header("Content-type: text/xml");
?>
 
 <css action="insert">
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
	
	$blockID = $_POST['blockID'];
	$attribute = $_POST['attribute'];
	$value = $_POST['value'];
	
	$foofers = "INSERT INTO `styles` (`blockID`,`attribute`,`value`) VALUES ('".$blockID."','".$attribute."','".$value."')";
	mysql_query($foofers);
	$query = mysql_query("SELECT * FROM `styles` ORDER BY `attributeID` DESC");
	$css = mysql_fetch_array($query);
	
	
	echo '<attribute id="'.$css["attributeID"].'">';
		echo $css["attribute"];
	echo '</attribute>';
	
	echo '<value>';
		echo $css["value"];
	echo '</value>';

?>
</css>