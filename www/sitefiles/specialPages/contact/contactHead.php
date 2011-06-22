<?php 
	include($absolutePath.'/sitefiles/jquery/jquery_html_latest.php');
	include($absolutePath.'/sitefiles/jquery/jquery_ui_html_latest.php');
	
	if (isset($_POST["mail_message_communication_message"])){
		echo '<script type="text/javascript">window.location.hash = "#sent";window.title += " - Message Sent";</script>';
		include ("send.php");
	}else{
		echo '<script type="text/javascript">window.location.hash = "";</script>';
	}
?>
<script type="text/javascript">
function $id(which){
	return document.getElementById(which);
}

function validForm(form){
	$id('nameError').style.display = 'none';
	$id('emailError').style.display = 'none';
	$id('messageError').style.display = 'none';
	
	var submit = true;
		if ($id('name').value == ''){
			$id('nameError').style.display = '';
			submit = false;
		}
		if ($id('email').value == ''){
			$id('emailError').style.display = '';
			submit = false;
		} 
		if (!($id('email').value.indexOf(".") > 2) || !($id('email').value.indexOf('@') > 0)){
			$id('emailError').style.display = '';
			submit = false;
		}
		if ($id('message').value == ''){
		$id('messageError').style.display = '';
			submit = false;
		}
		
		/*if(submit){
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
		}*/
		
		return submit;	
}
</script>