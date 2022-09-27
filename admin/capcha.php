<?php
session_start();

define('SECURE_CHECK', true);
include dirname(dirname(__FILE__)) . '/config.php';

$capcha = random_string();
$_SESSION['capcha'] = $capcha;
// Create a 100*30 image
$im = imagecreate(90, 28);

// White background and blue text
$bg = imagecolorallocate($im, 84, 158 , 214);
$textcolor = imagecolorallocate($im, 255, 255, 255);

// Write the string at the top left
imagestring($im, 5, 11, 6, $capcha, $textcolor);

// Output the image
header('Content-type: image/png');

imagepng($im);
imagedestroy($im);

?>