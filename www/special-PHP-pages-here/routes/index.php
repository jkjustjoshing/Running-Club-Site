<?php 
	require('insertintodb.php');
	
	$query = 'SELECT name, description, date, movingTime, distance, distanceUnit, 
			  averageMovingSpeed, speedUnit, map, visible FROM routes ORDER BY date DESC';
	$db_data = mysql_query($query);
	
	while ($line = mysql_fetch_array($db_data)){
		if ($line['visible'] == 1)
			$linearr[] = $line;
	}
?>
	<iframe width="400" id="routeframe" height="250" frameborder="0" scrolling="no" 
	marginheight="0" marginwidth="0" src="<?php echo $webDir;?>/preloaded_iframe_text.html">
	</iframe>


<?php	


	foreach($linearr as $line){
		$hour = intval(substr($line['movingTime'], 0, 2));
		$minute = intval(substr($line['movingTime'], 3, 2));
		$second = intval(substr($line['movingTime'], 6, 2));
		$second = $second+(60*$minute)+(3600*$hour);
		$paceminute = ($second/$line['distance'])/60;
		$pacesecond = ($second/$line['distance'])%60;
		if (strlen($pacesecond) == 1) $pacesecond = '0'.$pacesecond;
		else if (strlen($pacesecond) == 0) $pacesecond = '00';
		
		while(substr($line['movingTime'], 0, 1) == '0' || substr($line['movingTime'], 0, 1) == ':'){
			$line['movingTime'] = substr($line['movingTime'], 1, strlen($line['movingTime'])-1);
		}
		echo '<div class="infobox" style="display:none;" id="'.$line['name'].'">';
		echo '<span class="name">'.$line['name'].'</span> - '.date('F j, Y', strtotime($line['date'])).'<br />';
		if ($line['description'] != '')
			echo '<span class="description">'.$line['description'].'</span><br />';
		echo '<br />Distance: '.$line['distance'].' '.$line['distanceUnit'].'<br />';
		echo 'Time: '.$line['movingTime'].'<br />';
		echo 'Average Pace: '.floor($paceminute).':'.$pacesecond.' per '.$line['distanceUnit'].'*';
		echo '</div>';
	}

	echo '<div id="routesList"><label>';
	
	foreach($linearr as $line){
		$link = '<a class="nolink" href="javascript:selectRoute(\''.$line['name'].'\', \''.$line['map'].'\')">';
		$end_link = '</a>';
		echo $link;
		echo '<div>'.$link.'<div class="date">'.date('n/j/y', strtotime($line['date'])).'</div>'.$end_link;
		echo $link.'<div class="routeTitle">'.$line['name'].'</div>'.$end_link;
		echo $link.'<div class="distance">'.$line['distance'].' '.$line['distanceUnit'].'</div>'.$end_link;
		echo '</div>'.$end_link;
		echo '<div style="clear:both"></div>';
	}
	echo '</label></div>';

?>
<div id="paceDisclaimer" style="display:none;">*Pace is that of the person holding the phone recording the GPS data.</div>

</div>