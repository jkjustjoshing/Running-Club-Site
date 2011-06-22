<script type="text/javascript">
	//$('#globalNavContainer').sortable( "option", "disabled", true );
	$( "#settingsTabs" ).bind( "tabsselect", function(event, ui) {
		if(ui.panel.id=='globalNavSettings'){
			$('#globalNavContainer').sortable( "option", "disabled", false );
			$('#globalNavContainer').css('border-color','white');
		}else{
			$('#globalNavContainer').sortable( "option", "disabled", true );
			$('#globalNavContainer').css('border-color','black');

		}
	});


	$(document).ready(function(){	
		$('#globalNavContainer').sortable({
			disabled:true,
			revert:true,
			placeholder: "ui-state-highlight",
			distance:3,
			forcePlaceholderSize:true,
			placeholder: 'globalNavIndividual-dragging',
			scroll:false,
			stop:function(event,ui){
				var menuString='';
				$(this).children('.globalNavIndividual').each(function(index){
					menuString += index+'='+$(this).attr('id').substr(9)+'&';
				})
				
				$.ajax({
					type:'post',
					async:true,
					url:'ajax/updateGlobalOrder.php',
					data:menuString,
					dataType:'xml',
					success:function(data,status){
						//SHOW SOMETHING ABOUT THE SERVER REQUEST BEING SUCCESSFUL
					}
				});
				
			}

		});
		$('#globalNavContainer').disableSelection();
		if(window.location.hash=='#globalNavSettings'){
			$('#globalNavContainer').sortable( "option", "disabled", false );
			$('#globalNavContainer').css('border-color','white');
		}
		
	});
	
	
	
</script>

Drag and drop the main navigation links to reorder.
<br /><br /><br />
<h2 style="display:inline;">Pages(only renaming works now. Careful - doesn't check for invalid input)</h2><br />
You can only make normal text pages currently. Dynamic pages possible in the future.<br /><br />

<div style="float:left;width:100px;font-size:8pt;text-align:center;">
	Hidden on <br />Global Nav?
</div>
<div style="float:left;width:40px;font-size:8pt;text-align:center;">
	Delete?
</div>
<div style="float:left;width:200px;font-size:8pt;text-align:center;">
	Page Name (Click to edit)
</div>
<div style="clear:both;"></div>


<?php
	$query=mysql_query("SELECT `navIndex`, `page` from `page_data` ORDER BY `page`");
	while($data=mysql_fetch_array($query)){
		$pages[] = $data;
	}
	
	foreach($pages as $page){
		echo "<hr />";
		echo '<div id="settings'.$page['page'].'" style="float:left;">';
			echo '<div class="visibilityCheckboxDiv"><input type="checkbox" class="visibilityCheckbox" /></div>';
			echo '<div style="float:left;width:60px;"><div onclick="alert(\'thth\');" class="deletePageButton"></div></div>';
			echo '<div class="pageNameAjax" style="float:left;">'.$page['page'].'</div>';
		echo '</div>';
		
		echo '<div style="clear:both;"></div>';
	}
?>

<hr />
<div style="float:left;" class="ajaxDiv">
	<div class="visibilityCheckboxDiv" style="visibility:hidden;"><input type="checkbox" class="visibilityCheckbox" /></div>
	<div style="float:left;width:60px;visibility:hidden;"><div class="deletePageButton"></div></div>
	<div class="pageNameAjax" name="newItem" style="float:left;" 
	onclick="$(this).prev().prev().css('visibility', 'visible');">New Page</div>
</div>
<div style="clear:both;"></div>

<br />
<br />
<br />




<script type="text/javascript">
//<![CDATA[
function AjaxText(jqueryDivToActOn, submitFile, dataType, returnFunction){
		jqueryDivToActOn.click(function(){
			if($(this).attr('name') == 'newItem'){
				var newInput = $('<input type="text" name="newInputCONFIRMATION" value=""/>');
			}else{
				var newInput = $('<input type="text" name="'+$(this).html()+'" value="'+$(this).html()+'"/>');
			}
			var thisVar = $(this);
			$(this).replaceWith(newInput);
			newInput.focus();
			
			newInput.bind('blur',function(){
				$.ajax({
					type:'post',
					async:true,
					url:submitFile,
					data:'oldData='+newInput.attr('name')+'&newData='+newInput.val(),
					dataType:dataType,
					success:function(data, status){
						newInput.replaceWith(thisVar.html(data));
						thisVar.attr('name', newInput.attr('name'));
						returnFunction(thisVar);
						AjaxText(thisVar, submitFile, dataType, returnFunction);
						
					}
				});
			});
			
			//makes enter OR blur submit
			newInput.bind('keypress', function(event){
				if(event.keyCode == '13'){
					newInput.blur();
				}
			});
		});
	}
	
	
	$(document).ready(function(){
		AjaxText($('.pageNameAjax'), 'ajax/pageName.php','text', function(which){
			
			$("#globalNav"+which.attr('name')).attr('id', 'globalNav'+which.html())
			.children('a').html(which.html());
			
		});
	});


//]]>
</script>