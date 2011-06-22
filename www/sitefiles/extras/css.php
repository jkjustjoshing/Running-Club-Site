<?php header("Content-type: text/css");

	//absolute path to web directory
	$indexWebPathEnd=0;
	while(strpos($_SERVER['SCRIPT_FILENAME'], '/', $indexWebPathEnd) !== false){
		if (strpos($_SERVER['SCRIPT_FILENAME'], '/', $indexWebPathEnd+1) !== false){
			$indexWebPathEnd = strpos($_SERVER['SCRIPT_FILENAME'], '/', $indexWebPathEnd+1);
		}else {
			break;
		}
	}
	$absolutePath = substr($_SERVER['SCRIPT_FILENAME'], 0, $indexWebPathEnd)."/../../";
	
	//gets all the required site-specific information
	require ($absolutePath.'profile.php');
	
	require('dbconnect.php');
	
	//if this is RIT's web environment, allaw for a production variable in staging
	//otherwise, just set $webDir to the production url
	if ($ritWebEnvironment === true){
		if ($_SERVER['SERVER_NAME'] == 'www-staging.rit.edu'){
			$webDir= $stagingURL;
			$productionDir= $productionURL;
		} else if ($_SERVER['SERVER_NAME'] == 'www.rit.edu'){
			$webDir = $productionURL;
		}
	} else {
		$webDir = $productionURL;
	}
	
	
	$styleString = "";
	echo $styleString;
	//get the site-specific style blocks, and get all the styles of 
	//each block
	$query = mysql_query("SELECT * FROM `styleBlocks`");
	while ($styleBlock = mysql_fetch_array($query)){
		
		$styleString .= $styleBlock["identifier"];
		$styleString .= "{";
		
		$subQuery = mysql_query("SELECT * FROM `styles` WHERE `blockID`='".$styleBlock["blockID"]."'");
		while($style = mysql_fetch_array($subQuery)){
			$styleString .= $style["attribute"].":".$style["value"].";";
			
		}
		
		$styleString .= "} ";
	}

	echo $styleString;
	
	
?>

/* MAIN STYLES */

body {
	text-align: center;
	min-width: 960px;
}
	
#wrapper {
	width: 960px;
	margin: 0 auto;
	text-align: left;
} 

#pagemain {
	position:relative;
	left:82px;
	width:800px;
}

#globalNavContainer {
	position:relative;
	width:964px;
	padding:0;
	margin:0;
	list-style-type:none;
}

#editFooter a {
	color:black;
	text-decoration:none;
}

#editFooter a:hover {
	text-decoration:underline;
}


/* PARSER STYLES */

.tab {
	position:relative;
	left:25px;
}


/* COMMUNICATION PORTAL */

#publicMemberList {
	text-align:left;
}

.delete_button {
	float:left;
	width:15px;
	height:15px;
	background-image:url('media/redXup.png');
}


/* UNSORTED STYLES */

.title {
	text-decoration:underline;
	font-weight:bold;
	font-size:14pt;
}

.textFieldUnrecognized{
	float:left;
	width:140px;
}

#footer-gradient {
	height:27px;
	width:964px;
	background-image:url('<?php echo $webDir;?>/sitefiles/media/bottom_gradient.jpg?epoch=<?php echo time();?>');
}

.contact_label {
	width:150px;
	float:left
}
<?php $i = 300;?>
.contact_input {
	margin:3px;
	width:<?php echo $i; ?>px;
	position:relative;
	top:-5px;
}

textarea.contact_input {
	width:<?php echo ($i+5); ?>px;
	height:100px;
}

.hidden {
	display:none;
}

.delete_button:active {
	background-image:url('media/redXdown.png');
}