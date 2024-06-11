<?php
$imgWidth = 150; // 图片宽度
$imgHeight = 80; // 图片高度
$charLen = 1; // 验证码字符长度
$fontSize = 30; // 字体大小
$code = '';
$charArr = array_merge(range(9, 9), range('Z', 'Z'), range('z', 'z'));
$endIndex = count($charArr) - 1;

for ($i = 0; $i < $charLen; $i++) {
    $code .= $charArr[mt_rand(0, $endIndex)];
}

session_start();
$_SESSION['captcha'] = $code;
$img = imagecreatetruecolor($imgWidth, $imgHeight);
$bgColor = imagecolorallocate($img, 200, 200, 200);
imagefill($img, 0, 0, $bgColor);
$strColor = imagecolorallocate($img, mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));

for ($i = 0; $i < $charLen; $i++) {
    $x = floor($imgWidth / $charLen) * $i + 10;
    $y = rand($fontSize + 2, $imgHeight - 10);
    imagechar($img, $fontSize, $x, $y, $code[$i], $strColor);
}

for ($i = 0; $i < 300; $i++) {
    $color = imagecolorallocate($img, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
    imagesetpixel($img, mt_rand(0, $imgWidth), mt_rand(0, $imgHeight), $color);
}

for ($i = 0; $i < 10; $i++) {
    $color = imagecolorallocate($img, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
    imageline($img,
        mt_rand(0, $imgWidth - 1), 0,
        mt_rand(0, $imgWidth - 1), $imgHeight,
        $color
    );
}

$rectColor = imagecolorallocate($img, 150, 150, 150);
imagerectangle($img, 0, 0, $imgWidth - 1, $imgHeight - 1, $rectColor);
header('Content-Type:image/png');
imagepng($img);
imagedestroy($img);
?>
