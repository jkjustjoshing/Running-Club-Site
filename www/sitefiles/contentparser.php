<?php
if (!function_exists(parseContent)){
//if function doesn't yet exist, make it!

function parseContent($content){

	//puts in an image
	$content = str_replace('[img]', '<img src="', $content);
	$content = str_replace('[/img]', '" alt="img" style="border-width:0px" />', $content);
	
	//h2
	$content = str_replace('[big]', '<h2 style="display:inline;">', $content);
	$content = str_replace('[/big]', '</h2>', $content);
	
	//h3
	$content = str_replace('[medium]', '<h3 style="display:inline;">', $content);
	$content = str_replace('[/medium]', '</h3>', $content);
	
	//lists
	$content = str_replace('[bullet1]', '<ul><li>', $content);
	$end_bullet1 = array ("[/bullet1]\r\n", "[/bullet1]\r", "[/bullet1]\n", "[/bullet1]");
	$content = str_replace($end_bullet1, '</li>', $content, $count);
	
	$content = str_ireplace('[bulletL]', '<li>', $content);
	$end_bullet1 = array ("[/bulletL]\r\n", "[/bulletL]\r", "[/bulletL]\n", "[/bulletL]");
	$content = str_ireplace($end_bullet1, '</li></ul>', $content, $count);
	
	$content = str_replace('[bullet]', '<li>', $content);
	$end_bulletn = array ("[/bullet]\r\n", "[/bullet]\r", "[/bullet]\n", "[/bullet]");
	$content = str_replace($end_bulletn, '</li>', $content);


	//breaks
	$line_break = array ("\r\n", "\r", "\n");
	$content = str_replace($line_break, "<br />", $content);
	
	//replace opening links with a tags
	$start = 0;
	while ($position = strpos($content, '[link url="', $start)){
		$position = $position + 11;
		$endPosition = strpos($content, '"]', $position);
		$string = substr($content, $position, ($endPosition - $position));
		$start = $endPosition;
		$content = str_replace('[link url="'.$string.'"]', '<a href="'.$string.'">', $content);
	}
	
	//replace closing link tags with closing a tags
	$content = str_replace('[/link]', '</a>', $content);

	//quotes and double quotes
	$content = str_replace('\\\"', '"', $content);
	$content = str_replace('\\\'', '\'', $content);

	return $content;
}

}//end if statement to test if we are including this function multiple times

if (!function_exists(preview)){
//if function doesn't yet exist, make it!

function preview($content, $length=160){
	
	$pos = 0;
	//while ($pos < strlen($content)){
		//strpos()
	//}
	
	return $content;
}

}//end if statement to test if we are including this function multiple times
?>