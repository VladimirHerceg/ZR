<?php
session_start();
unset($_SESSION["code"]);
/*
48-57 0 - 9
65-90 A-Z
97-122 a-z

*/

$chars = "1234567890abcdefghijklmnopqrstwyzxu";
$end = strlen($chars) - 1;

$length = mt_rand(5, 7);  // 5
$down = 97;
$up = 122;
$i = 0;
$code = "";

while ($i < $length) {
    $character = $chars[(mt_rand(0, $end))];
    $code .= $character;

    $i++;
}

$_SESSION["code"] = $code;

header("Content-type: image/png");
$im = imagecreatefrompng("captcha.png") or die("Cannot Initialize new GD image stream");
$text_color = imagecolorallocate($im, 0, 0, 0);
imagettftext($im, 11, 3, 5, 20, $text_color, __DIR__ . "/arial.ttf", $code);

imagepng($im);
imagedestroy($im);
unset($code);

?>