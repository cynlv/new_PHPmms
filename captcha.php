<?php
session_start();
$image=imagecreatetruecolor(120, 50); //创建一个区域
$bgColor=imagecolorallocate($image, rand(200,255), rand(200,255), rand(200,255));//让颜色随机出现
imagefill($image, 0, 0, $bgColor);
$str="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
$temp=null;
for ($i=0;$i<4;$i++){
	$temp.=$str[rand(0,strlen($str)-1)];  // .点:代表连接符
}
$textColor=imagecolorallocate($image, rand(0,150), rand(0,150), rand(0,150));
//把$temp中的字符分别写入到图片中
//循环让每个字符都是独立的
//把验证码保存到session中
$_SESSION["captcha"]=$temp;
for($j=0;$j<4;$j++){
	$size=rand(10,25);
	$angle=rand(-10,10);
	$x=floor(120/4)*$j+8;//公式：(120/4)宽度除以字符长，
	$y=rand(20,30);
	$fontfile="georgiab.ttf";
	imagettftext($image, $size, $angle, $x, $y, $textColor, $fontfile, $temp[$j]);
}
imagepng($image);


?>