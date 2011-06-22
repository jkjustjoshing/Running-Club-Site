
var newStyleDiv = $('<div class="newStyle" style="padding-left:65px;float:left;visibility:hidden;font-style:italic;cursor:pointer;"></div>');
newStyleDiv.append('New style . . .');

var attributeDivTemplate = $('<div class="newStyleInputs" style="height:24px;cursor:pointer"></div>');
attributeDivTemplate.append('<div class="deleteButton" style="position:absolute;left:20px;background-image:url(\'../sitefiles/media/redXup.png\');float:left;visibility:hidden;cursor:pointer;width:15px;height:15px;"></div>');
attributeDivTemplate.append('<div class="confirmContainer" style="width:45px;font-size:6pt;float:left;padding:2px 0 0 0;"><div style="width:0px;overflow:hidden;">CONFIRM?</div></div>');
attributeDivTemplate.append('<div class="attribute lineContent" style="padding-left:20px;float:left;"></div>');
attributeDivTemplate.append('<div style="float:left" class="colonDiv lineContent">:</div>');
attributeDivTemplate.append('<div class="value lineContent" style="float:left;"></div>');
attributeDivTemplate.append('<div style="float:left" class="semicolonDiv lineContent">;</div>');

	
//make the inputs
function makeStyleInputs(attributeDiv, whichInput){
	//stop the onclicks making new text inputs
	attributeDiv.children('.lineContent').unbind('click');
	
	//if another field is being edited, submit that field's data to server
	if($('#submit').length !=0){
		ajaxCSSsubmit($('#submit').parent());
		
	}
	
	//if we are trying to create a new style
	if(whichInput == null){
		var attributeParent = attributeDiv.parent();
		attributeDiv.replaceWith(attributeDivTemplate.clone());
		attributeDiv = attributeParent.children('.newStyleInputs');
		whichInput = attributeDiv.children('.attribute');
	}
	
	var attributeText = $.trim(attributeDiv.children('.attribute').text());
	var valueText = $.trim(attributeDiv.children('.value').text());
	
	attributeDiv.children('.attribute').html('<input type="text" value="'+attributeText+'" />');
	
	attributeDiv.children('.value').html('<input type="text" value="'+valueText+'" />');
	attributeDiv.append('<div id="submit" style="display:none;">Submit</div>');
	//alert(attributeDiv.html())
	$('#submit').click(function(){ajaxCSSsubmit(attributeDiv)});

	//focus on the just made attribute input
	whichInput.children('input').focus();
	
}

//submit the ajax
function ajaxCSSsubmit(attributeDiv){
	while($('#submit').length){
		$('#submit').remove();
	}
	
	var submit = true;
	
	if(attributeDiv.attr('class') == 'newStyleInputs'){
		//if they entered something in both fields
		if(attributeDiv.children('.attribute').children('input').val()  == '' || attributeDiv.children('.value').children('input').val() == ''){
			submit = false;
		}else{
			var url = 'ajax/insertCSS.php'; 
			var attributeID = '';
			var blockID = attributeDiv.parent().children('div').attr('id');
		}
	}else{
		var url = 'ajax/updateCSS.php';
		var attributeID = attributeDiv.attr('id').substring(12);
		var blockID = '';
	}
	
	var attribute = attributeDiv.children('.attribute').children('input').val();
	var value = attributeDiv.children('.value').children('input').val();
	
	if(submit){
		//start ajax
		$.ajax({
			type:'post',
			async:true,
			url:url,
			data:{attributeID:attributeID,blockID:blockID,attribute:attribute,value:value},
			dataType:'xml',
			success:function(data,status){
				//put text back on the page, whatever is in the XML
				attributeDiv.children('.attribute').html($(data).find('attribute').text());
				attributeDiv.children('.value').html($(data).find('value').text());
				
				//if we just created a new style, make it look like all others
				//and make a new "New Style . . ." link
				if(attributeDiv.attr('class') == "newStyleInputs"){
					//make the new style look like rest
					attributeDiv.addClass('attributeDiv');
					attributeDiv.removeClass('newStyleInputs');
					var id = $(data).find('attribute').attr('id');
					attributeDiv.attr('id', 'attributeDiv'+id);
					
					//make rolling over show/hide the delete button
					attributeDiv.bind('mouseover', function(){
						$(this).children('.deleteButton').css('visibility', 'visible');
					}).bind('mouseout',function(){
						$(this).children('.deleteButton').css('visibility', 'hidden');
					});
					
					//make "New Style . . ." text reappear
					//at end but BEFORE CLOSING CURLY BRACE
					attributeDiv.after(newStyleDiv.clone());
				}
				
				//add the onclicks back to the text
				attributeDiv.children('.attribute').click(function(){makeStyleInputs($(this).parent(),$(this))});
				attributeDiv.children('.value').click(function(){makeStyleInputs($(this).parent(),$(this))});
				attributeDiv.children('.semicolonDiv').click(function(){makeStyleInputs($(this).parent(),$(this).parent().children('.value'))});
				attributeDiv.children('.colonDiv').click(function(){makeStyleInputs($(this).parent(),$(this).parent().children('.attribute'))});

				//show CSS changes with javascript
				//attributeDiv.parent().children(1).html() gets the block name
				var attribute = $(data).find('attribute').text();
				$(attributeDiv.parent().children(1).html()).css(attribute, $(data).find('value').text());
				if(attribute.indexOf('background') != -1){
					updateFooter();
				}
			}
		});
		//end ajax
	}else{
		//make "New Style . . ." text reappear
		//at end but BEFORE CLOSING CURLY BRACE
		attributeDiv.after(newStyleDiv.clone());
		
		//get rid of the input div
		attributeDiv.remove();

	}
}

function deleteButtonFunctionality(which){
		if(which.parent().attr('id')!='newStyle'){
			//show confirm dialoge if the x is not for a new attribute
			which.animate({"left":"67px"}, 100);
			which.next().children().animate({"width":"+=45px"}, 100);
			which.parent().unbind('mouseout');
			which.delay('100').bind('click',function(){
					//change the "confirm" text to "working..."
					$(this).parent().children('.confirmContainer').children().html('WORKING...');
					
					//hide the delete button
					$(this).hide();

					//delete the style now!
					$.ajax({
						type:'post',
						async:true,
						url:'ajax/deleteCSS.php',
						data:{attributeID:$(this).parent().attr('id').substring(12)},
						dataType:'xml',
						success:function(data,status){
							if($(data).find('delete').text() == '1'){
								//success
								var removeDiv = '#attributeDiv'+$(data).find('delete').attr('attributeID');
								$(removeDiv).slideUp(400);//.slideUp();
								
							}else{
								//failure
								alert("There was a problem. Try reloading the page.");
							}
						}
					});
			}
			
			).parent().mouseleave(function(){
				//functionality for undoing the confirm dialogue
				$(this).unbind('mouseleave');

				$(this).children('.confirmContainer').children().animate({"width":"-=45px"},100);
				$(this).children('.deleteButton').css('visibility','visible')
				.unbind('click').animate({"left":"-=47px"},100).delay(20000,function(){
					$(this).css('visibility','hidden')
					.parent().bind('mouseout', function(){
						//make rolling out the attributeDiv hide the delete button again
						$(this).children('.deleteButton').css('visibility', 'hidden');
					});
				})
	
			});
		} else {
			//revert to showing "New Style . . ."
			//make x rollout
			$(this).parent().replaceWith(newStyleDiv.clone());
			$('.deleteButton').css('background-image',"url('../sitefiles/media/redXup.png')");
		}
	}