<?php

$string = $_GET['name'];
$test_string_height = "gal";
$font = 'TimesNewRoman.ttf';
$size = 27;
$padding_h = 12;
$padding_v = 5;
$arr_height = imageTTFBBox($size, 0, $font, $test_string_height);
$arr_width = imageTTFBBox($size, 0, $font, $string);

$box_height = abs($arr_height[1] - $arr_height[7]);
$y = ($box_height*.9);
$img_height = $box_height + ($padding_v*2);
$img_width = ($arr_width[2] - $arr_width[0]) + (2 * $padding_h);

$img = imagecreate($img_width,$img_height);

$brown = imagecolorallocate($img, 81, 49, 39); //   #513127
$orange = imagecolorallocate($img, 243, 105, 33);// #f36e21
$white = imagecolorallocate($img, 255, 255, 255);

if ($_GET['num'] == 1){
	$one = $white;
	$two = $orange;
} else if ($_GET['num'] == 2){
	$one = $orange;
	$two = $white;
}

$x = $padding_h+2;
$stroke = 1;

imageTTFText($img, $size, 0, $x, $y-$stroke, $one, $font, $string);
imageTTFText($img, $size, 0, $x+($stroke/2), $y-($stroke/2), $one, $font, $string);
imageTTFText($img, $size, 0, $x+($stroke/2), $y+($stroke/2), $one, $font, $string);
imageTTFText($img, $size, 0, $x-($stroke/2), $y-($stroke/2), $one, $font, $string);
imageTTFText($img, $size, 0, $x-($stroke/2), $y+($stroke/2), $one, $font, $string);
imageTTFText($img, $size, 0, $x, $y+$stroke, $one, $font, $string);
imageTTFText($img, $size, 0, $x-$stroke, $y, $one, $font, $string);
imageTTFText($img, $size, 0, $x+$stroke, $y, $one, $font, $string);
imageTTFText($img, $size, 0, $x, $y, $two, $font, $string);

header ("Content-type: image/jpeg");
imagejpeg($img);
imagedestroy($img);
//print_r($arr);
?>