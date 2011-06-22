<?php 

function formatDate($string){
	//Fri Apr 30 13:22:15 EDT 2010
	$day_week = substr($string, 0, 3);
	$month = substr($string, 4, stripos($string, ' ', 3));
	$pos_month = stripos($string, $month);
	$pos_end_day = stripos($string, ' ', $pos_month+strlen($month)+1);
	$day = substr($string, $pos_month+strlen($month)+1, 2);
	$time = substr($string, $pos_end_day+1, 8);
	$year = substr($string, strlen($string)-4, strlen($string));
	
	
	switch ($month){
		case 'Jan': $month = '01'; break;
		case 'Feb': $month = '02'; break;
		case 'Mar': $month = '03'; break;
		case 'Apr': $month = '04'; break;
		case 'May': $month = '05'; break;
		case 'Jun': $month = '06'; break;
		case 'Jul': $month = '07'; break;
		case 'Aug': $month = '08'; break;
		case 'Sep': $month = '09'; break;
		case 'Oct': $month = '10'; break;
		case 'Nov': $month = '11'; break;
		case 'Dec': $month = '12'; break;
	}
	return $year.'-'.$month.'-'.$day.' '.$time;
}

$file = 'http://spreadsheets.google.com/pub?key=0AjDmMvH546ogdDRVbW0tRkJ0dFRPLTZNWTR3dVdLdGc&hl=en&single=true&gid=0&output=csv';

$google_table_holding_data = fopen($file, 'r');
if ($google_table_holding_data) {
	$partial_query = "INSERT INTO `routes` (name, description, date, totalTime, movingTime, distance, distanceUnit, averageSpeed, averageMovingSpeed, maxSpeed, speedUnit, elevationGain, minElevation, maxElevation, elevationUnit, map, visible) VALUES ";
	$first_time_through_while = true;
	$titles = array('name','description','date','totalTime','movingTime','distance','distanceUnit','averageSpeed','averageMovingSpeed','maxSpeed','speedUnit','elevationGain','minElevation','maxElevation','elevationUnit','map');
	
	while($table_data_string = fgets($google_table_holding_data)){ //while there still is another line
	if (!$first_time_through_while){
		$query = '(';
		$start_index = 0;
		for($i=0; $i < 16; $i++){
			//if date, parse date
			$end_index = stripos($table_data_string, ',', $start_index);
			if (!$end_index) $end_index = strlen($table_data_string);
			if($titles[$i] == 'description') //if description, save in variable to see what visible value is
				$description = substr($table_data_string, $start_index, $end_index-$start_index);
			if($titles[$i] == 'date'){ //if date, parse date for database
				$query .= "'".formatDate(substr($table_data_string, $start_index, $end_index-$start_index))."', ";
			} else if($titles[$i] == 'map'){ //if map, replace & with &amp;
				$map_i = substr($table_data_string, $start_index, $end_index-$start_index);
				$query .= "'".$map_i."'";
			} else $query .= "'".substr($table_data_string, $start_index, $end_index-$start_index)."', ";
			
			$start_index = $end_index+1;	
		}
		if (stripos($description,'Josh') !== false)
			$query .= ', 0';
		else $query .= ', 1';
		$query .= ')';
		
		$rows = mysql_query("SELECT name FROM routes WHERE map='".$map_i."'");//get row from db where map = map_i
		if (mysql_num_rows($rows) == 0){
			mysql_query($partial_query.$query);//insert into database IF not there already
		}
	}
	$first_time_through_while = false;
	}
 
}
fclose($google_table_holding_data);

?>