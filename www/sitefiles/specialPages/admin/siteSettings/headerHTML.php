<script type="text/javascript">
	function headerHTMLsubmit(which){
		var newHTML = which.children("textarea").val();
		$.ajax({
			type:'post',
			async:true,
			url:'ajax/updateheaderHTML.php',
			data:'HTML='+newHTML,
			dataType:'text',
			success:function(data,status){
				which.children("textarea").val(data.replace(/***NEWLINE***/g,'\n'));
			}
		});
		
		return false;
	}
</script>
This tab lets you customize what the top of every page looks like. 
Right now you only can edit HTML, because I just freaking want to get this live! 
Who knows if I'll have the motivation to finish it...
<br />
<br />
<br />
<form method="post" action="" onsubmit="return headerHTMLsubmit($(this))">
	<textarea style="width:700px;height:300px" id="headerHTMLtextarea" name="headerHTMLtextarea"><?php
		$htmlquery = mysql_query("SELECT `value` FROM `settings` WHERE `name`='headerHTML'");
		$html = mysql_fetch_array($htmlquery);
		echo str_replace("***NEWLINE***","\n",stripslashes($html['value']));
	?></textarea>
	<input type="submit" value="Apply HTML" />
</form>
