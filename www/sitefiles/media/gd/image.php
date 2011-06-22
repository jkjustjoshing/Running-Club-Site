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


	$img = imagecreate(600,100);
	$backgroundColor = $_GET["backgroundColor"];
	$r = strtohex(substr($backgroundColor, 0,2));
	$g = strtohex(substr($backgroundColor, 2,2));
	$b = strtohex(substr($backgroundColor, 4,2));
	$backgroundcolor = imagecolorallocate($img, $r, $g, $b);

	$textColor = $_GET["textColor"];
	$r = strtohex(substr($textColor, 0,2));
	$g = strtohex(substr($textColor, 2,2));
	$b = strtohex(substr($textColor, 4,2));
	$textColor = imagecolorallocate($img, $r, $g, $b);
	
$string = $_GET['text'];

$font = 'TimesNewRoman.ttf';

imageTTFText($img, 30, 0, 100, 50, $textColor, $font, $string);
	
	header ("Content-type: image/jpeg");
	if(@isset($_GET["save"])){
		imagejpeg($img, 'bottom_gradient.jpg',100);
	} else {
		imagejpeg($img);
	}
	imagedestroy($img);
?>
