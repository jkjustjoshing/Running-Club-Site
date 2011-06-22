<?php

	function strtohex($string){
		$number = 0;
		for($index = strlen($string)-1; $index>=0; $index--){

			$digit = substr($string,$index,1);
			$multiplier = pow(16,strlen($string)-1-$index);
			if((int)$digit == 0){
				switch($digit){
					case "A":case"a": 
						$number += 10*$multiplier;
						break;
					case "B":case"b": 
						$number += 11*$multiplier;
						break;
					case "C":case"c": 
						$number += 12*$multiplier;
						break;
					case "D":case"d": 
						$number += 13*$multiplier;
						break;
					case "E":case"e": 
						$number += 14*$multiplier;
						break;
					case "F":case"f": 
						$number += 15*$multiplier;
						break;
					default:
						return -1;
						break;
				}
			} else { //the digit is an int
				$number += (int)$digit*$multiplier;
			}
		}
		return $number;
	}

	//absolute path to web directory
	$indexWebPathEnd=0;
	while(strpos($_SERVER['SCRIPT_FILENAME'], '/', $indexWebPathEnd) !== false){
		if (strpos($_SERVER['SCRIPT_FILENAME'], '/', $indexWebPathEnd+1) !== false){
			$indexWebPathEnd = strpos($_SERVER['SCRIPT_FILENAME'], '/', $indexWebPathEnd+1);
		}else {
			break;
		}
	}
	$absolutePath = substr($_SERVER['SCRIPT_FILENAME'], 0, $indexWebPathEnd).'/../../..';
	

	//gets all the required site-specific information
	require ($absolutePath.'/profile.php');
	
	//connect to the database
	require ($absolutePath.'/sitefiles/extras/dbconnect.php');
	
	$query = mysql_query("SELECT * FROM `styleBlocks`");
	for($i=0;$results=mysql_fetch_array($query);$i++){
		if(strpos($results['identifier'],'#pagebackground') !== false){
			break;
		}else{
			$results = null;
		}
	}
	
	$query = mysql_query("SELECT * FROM `styles` WHERE `blockID`='".$results['blockID']."'");
	for($i=0;$results=mysql_fetch_array($query);$i++){
		if(strpos($results['attribute'],'background') !== false){
			break;
		}else{
			$results = null;
		}
	}
	
	$hex = $results['value'];
	
	
	if(substr($hex,0,1) == '#'){
		$hex = substr($hex,1);
	}


	$img = imagecreatetruecolor(1,30);
	$backgroundColor = $hex;//"123456";
	$r = strtohex(substr($backgroundColor, 0,2));
	$rStep = (int) (((255-$r)/30)+10);
	
	$g = strtohex(substr($backgroundColor, 2,2));
	$gStep = (int) (((255-$g)/30)+10);
	
	$b = strtohex(substr($backgroundColor, 4,2));
	$bStep = (int) (((255-$b)/30)+10);

	for($y = 0; $y <= 10; $y++){
		imagesetpixel($img, 0, $y, imagecolorallocate($img, $r,$g,$b));
	}
	
	for($y = 11; $y <=30; $y++){
		imagesetpixel($img, 0, $y, imagecolorallocate($img, $r,$g,$b));
		$r += $rStep;
		$g += $gStep;
		$b += $bStep;
		
		if($r >255){$r = 255;}
		if($g >255){$g = 255;}
		if($b >255){$b = 255;}
	}
	
	header ("Content-type: image/jpeg");
	
	imagejpeg($img, '../bottom_gradient.jpg',99);
	imagedestroy($img);
	
	readfile('../bottom_gradient.jpg');
	
?>