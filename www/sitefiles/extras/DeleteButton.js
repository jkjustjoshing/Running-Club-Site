function DeleteButton(){
	this.parent;
	this.deleteButton;
	
	this.placeButton = function(parent,confirm){
		this.parent = parent;
		
		var deleteButtonString='<div class="deleteButton" ';
		deleteButtonString += 'style="position:absolute;left:20px;background-image:url(\''.$webDir.'/sitefiles/media/redXup.png\');float:left;visibility:hidden;cursor:pointer;width:15px;height:15px;">';
		deleteButtonString += '</div>';
		deleteButtonString += '<div class="confirmContainer" style="width:45px;font-size:6pt;float:left;padding:2px 0 0 0;">';
			deleteButtonString += '<div class="confirm" style="width:0px;overflow:hidden;">';
				deleteButtonString += 'CONFIRM?';
			deleteButtonString += '</div>';
		deleteButtonString += '</div>';

		this.deleteButton = parent.append(deleteButtonString);
		
		parent.bind('mouseover', function(){
				this.deleteButton.css('visibility', 'visible');
			}).bind('mouseout',function(){
				this.deleteButton.css('visibility', 'hidden');
			});
			
		//delete button mouseover depressed
		this.deleteButton.live('click',function(){
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
		
	} //end create function
	
	this.
	
	
} //end object
	
	
	


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