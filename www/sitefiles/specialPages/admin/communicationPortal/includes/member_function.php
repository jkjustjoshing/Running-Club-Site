<?php

function memberDropdown($name, $defaultID = "", $id = ""){

	if ($id=="")$id=$name;


	echo '<select name="'.$name.'" id="'.$id.'" style="font-weight:bold;border-color:;" onchange="other_display(\'member\', \''.$id.'\', this.value)">';
	echo '<option ';
	if ($defaultID=="") echo 'selected="selected" ';
	echo 'value="null"> - </option>';
	
	
	
	$currentAdmin = "-1";
	$colors = array("#f36e21", "#513127");
	$admin = array("Non-Admin", "Admin");
	$positionQuery = mysql_query("SELECT * FROM `member_types` ORDER BY `admin` DESC");
	$colorPicker = 0;
	while ($position = mysql_fetch_array($positionQuery)){
//if it's a different type of member
		if ($position["admin"] != $currentAdmin){ 
			$colorPicker++;
			echo '<option value="null" style="color:'.$colors[$colorPicker%2].';text-decoration:underline;">'.$admin[$position["admin"]%2].'</option>';
			$currentAdmin = $position["admin"];
		}

		echo '<option ';
		if ($defaultID == $position['id']) echo 'selected="selected" ';
		echo 'value="'.$position['id'].'" style="color:'.$colors[$colorPicker%2].';font-style:italic;">&nbsp;&nbsp;'.$position['type'].'</option>';
	}
	
//begin other - CURRENTLY DISABLING
//	echo '<option value="null"></option>';//blank line
//	echo '<option value="other" style="color:#60C32F;font-style:italic;">Other</option>';
	echo '</select>';
	
	
//other div	- CURRENTLY DISABLING
/*	echo '<div id="other'.$id.'" style="display:none;width:230px;">
				<span onclick="other_display(\'member\', \''.$id.'\', \'null\')"><img src="'.$GLOBALS['webDir'].'/img/undo.jpg" alt="go back" style="float:left;" /><label>Back</label></span><br />
				<div style="width:70px;float:left;">Type:</div><input type="text" id="newMemberType'.$id.'" name="newMemberType'.$name.'" style="width:152px;"/><br />
				<div style="width:70px;float:left;">Admin:</div>
				<div id="newadmin'.$id.'" style="border:1px solid white;float:left;">
					<label for="yesnewadmin'.$id.'">Yes</label><input id="yesnewadmin'.$id.'" type="radio" name="newAdmin'.$name.'" />
					&nbsp;&nbsp;&nbsp;
					<label for="nonewadmin'.$id.'">No</label><input id="nonewadmin'.$id.'" type="radio" name="newAdmin'.$name.'" />
				</div>';
	echo "</div>";*/
}
?>
