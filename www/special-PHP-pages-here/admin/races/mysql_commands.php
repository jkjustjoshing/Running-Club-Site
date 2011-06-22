<?php
	if (isset($_POST['form']) && $_POST['form'] == "add"){
		$date = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
		mysql_query("INSERT INTO `races` VALUES('', '".$_POST['url']."', '".$date."', '".$_POST['title']."', '".$_POST['location']."')");
		echo 'You added '.mysql_affected_rows().' race.';
		
		
	} 
	
	
	else if (isset($_POST['form']) && $_POST['form'] == "edit"){
		//update all the values
		$editracesmysql = mysql_query("SELECT `id` from `races`");
		while ($editraces=mysql_fetch_array($editracesmysql)){
			$i = $editraces['id'];
			
			
			$raceDate = $_POST["year".$i]."-".$_POST["month".$i]."-".$_POST["day".$i];
			
			mysql_query("UPDATE `races` SET `url`='".$_POST["url".$i]."' WHERE id='".$i."'");
			mysql_query("UPDATE `races` SET `date`='".$raceDate."' WHERE id='".$i."'");
			mysql_query("UPDATE `races` SET `linkText`='".$_POST["title".$i]."' WHERE id='".$i."'");
			mysql_query("UPDATE `races` SET `location`='".$_POST["location".$i]."' WHERE id='".$i."'");
		}
	}
	
	else if (isset($_POST['form']) && $_POST['form'] == "delete"){
		mysql_query("DELETE from `races` WHERE `id`='".$_POST["deleteradio"]."'");

	}
?>










