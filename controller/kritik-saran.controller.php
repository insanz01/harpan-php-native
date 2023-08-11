<?php
session_start();
include "helper/util.php";

$code = acakCaptcha();

//kode acak disimpan di dalam session agar data dapat dipassing ke halaman lain
$_SESSION["code"] = $code;


//membuat background
$wh = imagecreatetruecolor(173, 50);

$bgc = imagecolorallocate($wh, 22, 86, 165);

//membuat text warna 
$fc = imagecolorallocate($wh, 223, 230, 233);
imagefill($wh, 0, 0, $bgc);

imagestring($wh, 10, 50, 15,  $code, $fc);


//membuat gambar
header('content-type: image/jpg');

imagejpeg($wh);

imagedestroy($wh);