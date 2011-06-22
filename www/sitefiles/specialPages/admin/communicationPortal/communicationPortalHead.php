<script style="text/javascript">
function $id(which){
	return document.getElementById(which);
}

function menuChange(item, permission){ //changes what option is showing. 
	//permission variable determines eboard member or not. 1=eboard, 2=not
	var sure;
	if (permission == 1 && item == "editMember"){
		var message = "Editing this page will change other users preferences, ";
		message += "and could result in data being permanently deleted. Are you sure you would like to proceed?";
		sure = confirm(message);
	}
	
	if (sure !== false){
		$id("memberList").style.display='none';
		$id("showmemberList").style.border="2px solid black";
		$id("myEdit").style.display='none';
		$id("showmyEdit").style.border="2px solid black";

			if (permission == 1){
				$id("editMember").style.display='none';
				$id("showeditMember").style.border="2px solid black";
				$id("addMember").style.display='none';
				$id("showaddMember").style.border="2px solid black";
				$id("mail").style.display='none';
				$id("showmail").style.border="2px solid black";			

			}	
	
		$id(item).style.display='block';
		$id("show"+item).style.border="2px solid white";
	}
}


function deleteEntry(username, firstname, number){
	if(confirm("Are you sure you would like to delete "+firstname+"'s entry, user ID " + username + '?')){
		$id("hidden_delete_input_"+number).checked = true;
		$id("deleteForm").submit();
	}
}

function selfDelete(){
	if(confirm('Are you sure you would like to delete your account? If you are an admin you will lose your admin privledges, and you will no longer get any emails from the club')){
		$id("selfDelete").submit();
	}
}

function detailedTo(item){
	if (item == "select"){
		$id("detailedTo").style.display = "";
	}
	else {
		$id("detailedTo").style.display = "none";
	}
}



function editMemberConfirm (){
return confirm('Are you sure you have not made any undesireable changes?\n\nAll changes are permanent\n\nClick "OK" to continue with changes.');
}

</script>

<style type="text/css"> 
	.hidden {
		display:none;
	}
	
	#menu a{
		padding:0 8px;
		margin:0 2px;
		border:0px solid black;
		background:#f36e21;
		color:#513127;
		text-decoration:none;
		font-weight:bold;
	}
	
	#menu a:hover {
		color:#003907;
		border:2px solid white !important;
	}
</style>