<?php 

session_start();

include_once("../includes/function.php");
$font = "arial.ttf";
$bg = rand(1, 3);
$im = ImageCreateFromPNG("../images/gd2/".$bg.".png");
if(isset($_SESSION["security"])){
	unset($_SESSION["security"]);
}

$textstr = randomstring(6);

$_SESSION["textstr"] = $textstr;

$size = rand(18, 16);
$angle = rand(-5, 5);
$color = ImageColorAllocate($im, rand(0, 100), rand(0, 100), rand(0, 100));
$textsize = imagettfbbox($size, $angle, $font, $textstr);
$twidth = abs($textsize[2]-$textsize[0]);
$theight = abs($textsize[5]-$textsize[3]);
$x = (imagesx($im)/2)-($twidth/2)+(rand(-20, 20));
$y = (imagesy($im))-($theight/2);
ImageTTFText($im, $size, $angle, $x, $y, $color, $font, $textstr);
header("Content-Type: image/png");
ImagePNG($im);
imagedestroy($im);

?> 