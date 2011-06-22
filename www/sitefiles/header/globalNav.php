<?php
//PAGE WIDTH IS ASSUMED TO BE 964px!!!
$pageWidth = 964;

//this function acts as a loop to echo the menu items

//check http://stackoverflow.com/questions/2452820/how-caching-is-implemented-using-php-gd 
//for caching technique

function global_rollover($item){
	global $webDir, $page, $pic;
	echo '<a href="'.$webDir.'/'.$item.'">';

	if (stripos($page, $item) !== false){
		echo '<img id="'.strtolower($item).'" src="'.$webDir.'/sitefiles/media/nav_static/'.strtolower($item).'2.jpg"';
	}
	else {
		echo '<img id="'.strtolower($item).'" src="'.$webDir.'/sitefiles/media/nav_static/'.strtolower($item).'1.jpg" ';
		echo 'onmouseover="this.src=\''.$webDir.'/sitefiles/media/nav_static/'.strtolower($item).'2.jpg\'" ';
		echo 'onmouseout="this.src=\''.$webDir.'/sitefiles/media/nav_static/'.strtolower($item).'1.jpg\'"';
	}
		
	echo ' alt="'.$item.'" style="border-style:none;padding:0 6px;" /></a>';
}

	echo '<ul id="globalNavContainer">';
	//global_rollover('main');
	//global_rollover('schedule');
	//global_rollover('races');
	//global_rollover('contact');
	//global_rollover('members');
	//global_rollover('gallery');
	//global_rollover('routes');
	$query=mysql_query("SELECT `navIndex`, `page` FROM `page_data` ORDER BY `navIndex`");
	$count = mysql_num_rows($query);
	for(;$result=mysql_fetch_array($query);$result=null){
		if($result['navIndex'] >=0){
			//this assumes an average 100px text width
			$padding = ($pageWidth - ($count*83))/($count*2);
		
			echo '<li class="globalNavIndividual" id="globalNav'.$result['page'].'" style="padding:0 '.$padding.'px;float:left;">';
			echo '<a href="'.$webDir.'/'.$result['page'].'">';
			echo $result['page'];
			echo '</a>';
			echo '</li>';
		}else{
			$count--; //remove the non-visible pages from the global nav page count
		}
	}
	echo '<li style="clear:both;"></li>';
	echo '</ul>';
	
?>