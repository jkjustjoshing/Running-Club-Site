<!-- The AJAX calls to update the CSS-->
<?php
	$newStyleDiv = '<div class="newStyle" style="padding-left:65px;float:left;visibility:hidden;font-style:italic;cursor:pointer;">';
	$newStyleDiv .= 'New style . . .</div>';
?>

<script type="text/javascript" src="stylesJavascript.js"></script>
<script type="text/javascript">
//<![CDATA[
	
	$(document).ready(function(){
	
		//show/hide "New Style . . ."	
		$('.styleBlock').bind('mouseover',
			function(){
				$(this).children('.newStyle').css('visibility', 'visible');
			}).bind('mouseout',
			function(){
				$(this).children('.newStyle').css('visibility', 'hidden');
			}
		);
		
		
		//show/hide delete button 
		$('.attributeDiv').bind('mouseover', function(){
				$(this).children('.deleteButton').css('visibility', 'visible');
			}).bind('mouseout',function(){
				$(this).children('.deleteButton').css('visibility', 'hidden');
			}
		);
		
		//delete button mouseover depressed
		$('.deleteButton').live('click',function(){
			deleteButtonFunctionality($(this));
		}).live('mousedown',function(){
			$(this).css(
				'background-image',
				"url('../sitefiles/media/redXdown.png')"
			);
		}).live('mouseup',function(){
			$(this).css(
				'background-image',
				"url('../sitefiles/media/redXup.png')"
			);
		});
		
		
		
		//make the text turn to inputs on click. Focus on the one clicked on
		//
		//makeStyleInputs(whichAttribueDiv, whichChildFocused)
		$('.attribute').click(function(){makeStyleInputs($(this).parent(),$(this))});
		$('.value').click(function(){makeStyleInputs($(this).parent(),$(this))});
		$('.colonDiv').click(function(){makeStyleInputs($(this).parent(),$(this).parent().children('.attribute'));});
		$('.semicolonDiv').click(function(){makeStyleInputs($(this).parent(),$(this).parent().children('.value'));});
		$('.newStyle').live('click',function(){makeStyleInputs($(this),null);});
		
		
		//Enter submits the style
		$('.styleBlock').live('keypress', function(event){
			if(event.keyCode == '13'){
				$('#submit').click();
			}
		});
		
	
	}); //end document ready statement
	
	function updateFooter(){
		//send time since epoch with image so the cached version is never used
		var ko = new Date();
		var epoch = ko.getTime();
		$('#footer-gradient').css(
			'background-image',
			"url('<?php echo $webDir;?>/sitefiles/media/gd/bottom_gradient_create.php?rand="+epoch+"')" 
		);
	}
// ]]>
</script>


The removal of styles will not be shown until the page is reloaded or they are replaced.<br />
Styles may show inaccuratly on page. To guarantee results, refresh page to see new site appearance<br />
<br />

<br /><br />
<?php
	$clearBoth = '<div style="clear:both;"></div>';



	$blockQuery = mysql_query("SELECT * FROM `styleBlocks`");
	
	while($blockData = mysql_fetch_array($blockQuery)){

		//get the data for one block
		$styleQuery = mysql_query("SELECT * FROM `styles` WHERE `blockID`=".$blockData["blockID"]);
		while($styleDatatemp = mysql_fetch_array($styleQuery)){
			$styleData[] = $styleDatatemp;
		}
		
		//print out the mess of HTML
		echo '<form method="post" action="" onsubmit="return ajaxCSSsubmit($(\'#submit\').parent())" class="styleBlock">';
			echo '<div id="'.$blockData['blockID'].'" style="float:left;padding:5px 0px;">';
				echo $blockData['identifier'];
				echo '</div>';
				echo '<div style="float:left;padding:5px 0px 5px 2px">{</div>';
			echo $clearBoth;
			for($i=0;$i<sizeOf($styleData);$i++){
				echo '<div class="attributeDiv" style="height:24px;cursor:pointer" id="attributeDiv'.$styleData[$i]['attributeID'].'">';
					
					//delete button
					echo "\n";
					echo '<div class="deleteButton" style="position:absolute;left:20px;background-image:url(\''.$webDir.'/sitefiles/media/redXup.png\');float:left;visibility:hidden;cursor:pointer;width:15px;height:15px;"></div>';
					echo '<div class="confirmContainer" style="width:45px;font-size:6pt;float:left;padding:2px 0 0 0;"><div class="confirm" style="width:0px;overflow:hidden;">CONFIRM?</div></div>';
					echo '<div class="attribute lineContent" style="padding-left:20px;float:left;">';
						echo $styleData[$i]['attribute'];
					echo '</div>';
					echo '<div style="float:left" class="colonDiv lineContent">:</div>';
					echo '<div class="value lineContent" style="float:left;">';
						echo $styleData[$i]['value'];
					echo '</div>';
					echo '<div style="float:left" class="semicolonDiv lineContent">;</div>';
					
				echo '</div>';
				echo $clearBoth;
			}
			echo $newStyleDiv;
			echo $clearBoth;
			echo '<div style="float:left;">}</div>';
		echo '<div style="clear:both;height:30px;"></div>';
		echo '</form>';
		
		unset($styleData);
	}
	 
?>