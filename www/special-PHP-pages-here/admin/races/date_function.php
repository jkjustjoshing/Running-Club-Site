<?php

function dateDisplay($id = "", $mysql_date = ""){
	if ($mysql_date != ""){
		$phptime = strtotime($mysql_date);
		$year = (int)date("Y", $phptime);
		$month = (int)date("n", $phptime);
		$day = (int)date("j", $phptime);
	} else {
		$year = "";
		$month = "";
		$day = "";
	}
	
	//month select
	$monthArr = array(" - ", "Jan", "Feb", "March", "April", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec");
	echo '<select name="month'.$id.'">';
	foreach ($monthArr as $num=>$monthstr){
	
		if ($num < 10){
			$numString = "0".((string)$num);
		} else {
			$numString = $num;
		}
	
		echo '<option value="'.$numString.'"';
		if ($month != '' && $num == $month)
			echo ' selected="selected"';
		echo '>'.$monthstr.'</option>';
	}
	echo '</select>';//end month select
		
	//day select	
	echo '<select name="day'.$id.'">
			<option value="0"> - </option>';
	for ($i = 1; $i <=31; $i++){
	
		if ($i < 10){
			$iString = "0".((string)$i);
		} else {
			$iString = $i;
		}
	
		echo '<option value="'.$iString.'"';
		if ($day != '' && $i == $day)
			echo ' selected="selected"';
		echo '>'.$i.'</option>';
	}	
	echo '</select>';//end day select

	//year select
	$curYear=date("Y");
	$curYear = (int)$curYear;
	if ($year != '' && $curYear > ($year+1))
		echo $year;
	else {
		echo '<select name="year'.$id.'">';
		echo '<option value="0"> - </option>';
		for ($i = ($curYear-1); $i <= ($curYear+2); $i++){
			echo '<option value="'.$i.'"';
			if ($year != '' && $i == $year)
				echo ' selected="selected"';
			echo '>'.$i.'</option>';
		}
		echo '</select>';//end year select
	}
}
?>