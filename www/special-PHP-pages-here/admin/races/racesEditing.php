<script type="text/javascript">
<!--
	function deleteFunction(race, date, id){
		if (confirm("Are you sure you want to delete the "+race+" race on "+date+"?")){
			document.getElementById("hidden_delete_input_"+id).checked = true;
			document.getElementById("deleteForm").submit();
		}
	}
//-->
</script>
<?php

	include ("mysql_commands.php");
	include ("date_function.php");//this include file has a function(s) in it that display the date
	//begin add Race
	echo '<h2>Add a Race</h2>';
	echo '<form action="" method="post"><table border="1">';
	echo '<tr><td>Date</td><td>Title</td><td>Location</td><td>URL</td></tr>';
	
	//inputs
	echo '<tr>
		<td>';dateDisplay();echo '</td>
		
		<td><input type="text" name="title" /></td>
		
		<td><input type="text" name="location" /></td>
		
		<td><input type="text" name="url" value="http://" /></td>
		</tr>';
	
	//which form is it?
	echo '</table><input type="hidden" name="form" value="add" />';
	
	echo '<input type="submit" value="Add Race" /></form>';
	//end add Race
	
	
	//start edit MySQL
	//opening tag to table and form
	echo '<h2>Edit Races</h2>';
	echo '<form action="" method="post" onsubmit="return confirm(\'Be sure you did not make any mistakes. You could overwrite irreplaceable data! Click OK to continue\')"><table border="1">';
	echo '<tr><td></td><td>Date</td><td>Title</td><td>Location</td><td>URL</td></tr>';
	//end opening tags

	$racesmysql = mysql_query("SELECT * from `races` ORDER BY `date` DESC");
	$i=0;
	while ($racevar = mysql_fetch_array($racesmysql)){
		$racearray[$i] = $racevar;
		$i++;
	}
	foreach($racearray as $race){
		echo '<tr>
			<td><a href="javascript:deleteFunction(\''.addslashes($race['linkText']).'\', \''.$race['date'].'\', '.$race['id'].');"><div class="delete_button"></div></a></td>
		
			<td>';dateDisplay($race['id'], $race['date']);echo'</td>
			
			<td><input type="text" name="title'.$race['id'].'" value="'.$race['linkText'].'" /></td>
			
			<td><input type="text" name="location'.$race['id'].'" value="'.$race['location'].'" /></td>
			
			<td><input type="text" name="url'.$race['id'].'" value="'.$race['url'].'" /></td>
			</tr>';
	}
	
	//which form is it?
	echo '</table><input type="hidden" name="form" value="edit" />';
	
	echo '<input type="submit" value="Update Races" /></form>';
	//end edit MySQL
	
	// this part prints invisible forms to tell the page using
	// POST method to delete the entry
	echo '<form id="deleteForm" method="post" action="">';
	$result = mysql_query("SELECT * from `races`"); //selects entire table
	while ($row = mysql_fetch_array($result)){
		echo '<input type="radio" class="hidden" value="'.$row["id"].'"  id="hidden_delete_input_'.$row["id"].'" name="deleteradio" />';
	}
		echo '<input type="hidden" name="form" value="delete" />';
		echo "</form>";
	
?>