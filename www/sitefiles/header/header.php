<?php 

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


//test to see if the page exists
$query = mysql_query("SELECT * from `page_data` WHERE `page`='".$_GET['page']."'");
$data = mysql_fetch_array($query);
$pageContent = $data['content'];
if (strlen($pageContent) == 0){
	$_GET['page']='404 Error Not Found';
	header('HTTP/1.0 404 Not Found');
	$pageExists = false;
} else {
	$pageExists = true;
}

//XHTML head
echo '<?xml version="1.0" encoding="iso-8859-1"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<?php
		if (@isset($faviconName)){
			echo '<link type="image/gif" rel="icon" href="'.$webDir.'/media/'.$faviconName.'" />'; 
		} ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $webDir; ?>/sitefiles/extras/css.php?page=<?php echo $_GET['page']; ?>" />
	
	<!--
		if there is a blog uncomment this
		<link rel="alternate" type="application/rss+xml" title="The Running Club Blog" href="<?php echo $webDir;?>/blog/blog_feed.php">
	-->
	
	
	<?php
		$query = mysql_query("SELECT * from `page_data` WHERE `page`='".$_GET['page']."'");
		$data = mysql_fetch_array($query);
		$headContent = $data['head'];
		$dataType = $data['dataType'];
	
		if ($pageExists === true){
			//this page exists
			
			//if $pageContent is a file path, include the file
			if ($dataType == 'path' && @strlen($headContent) > 0){
				include('../special-PHP-pages-here/'.$headContent);
			} else if ($dataType == 'content'){
				//put it on the screen
				echo $headContent;
			}
		}
		
		//Get the title from the database
		$query = mysql_query("SELECT * from `settings` WHERE `name`='site_name'");
		$data = mysql_fetch_array($query);
		$site_name = $data['value'];
		
		//first part of site title - page name
		echo '<title>'.$site_name.' | ';
		
		//second part of site title - page name
		echo strtoupper(substr($_GET['page'], 0, 1)).substr($_GET['page'], 1).'</title>';
	?>
	
</head>
<body id="wrapper">
			
<div id="header">
	<?php
		if (true){//@isset($bannerName)){
			$query = mysql_query("SELECT `value` FROM `settings` WHERE `name`='headerHTML'");
			$data = mysql_fetch_array($query);
			echo str_replace("***NEWLINE***","\n",stripslashes($data['value']));
		} else if (@isset($bannerText)){
			echo '<div id="bannerText">'.$bannerText.'</div>';
		}
	
	//FIX THIS
	include ("globalNav.php");

?>
</div>
<div id="pagebackground"><div id="pagemain">
	<br />
	