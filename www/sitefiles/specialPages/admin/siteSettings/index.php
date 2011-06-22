<?php
	//include the latest jQuery
	require_once($absolutePath."/sitefiles/jquery/jquery_html_latest.php");
	require_once($absolutePath."/sitefiles/jquery/jquery_ui_html_latest.php");
?>

<!-- The AJAX calls to update the CSS-->
<div id="javascript_test">
	If you see this, it means you can't run this page. 
	If you have Javascript disabled, try enabling it and 
	then refreshing this page<br />
	Thank you,<br />
	Josh<br />
	Site Programmer<br /><br /><br /><br /><br />
</div>
<script type="text/javascript">
//<![CDATA[
	$("#javascript_test").hide();

	$(document).ready(function(){
		$('#settingsTabs').tabs();
	});

//]]>
</script>



<div id="settingsTabs">
	<ul>
		<li><a href="#siteStyles">Site Styles</a></li>
		<li><a href="#globalNavSettings">Site Pages</a></li>
		<li><a href="#headerHTML">Header Preferences</a></li>
	</ul>
	
	<div id="siteStyles">
		<?php include("siteStyles.php"); ?>
	</div>
	
	<div id="globalNavSettings">
		<?php include("globalNavSettings.php"); ?>
	</div>
	
	<div id="headerHTML">
		<?php include("headerHTML.php"); ?>
	</div>

</div>