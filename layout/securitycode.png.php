<?php

include '../.private/init.inc.php';

@session_start();

//putenv('GDFONTPATH='.realpath('.'));

define('DEFAULT_CODE_LENGHT', 7);
define('DEFAULT_IMAGES_DIR', 'security_code/');
define('DEFAULT_FONT', path_combine(realpath('.'), 'fonts/harngton.ttf'));



function create_blank_png($w, $h)
{
	$im = imagecreatetruecolor($w, $h);
	imagesavealpha($im, true);
	$transparent = imagecolorallocatealpha($im, 0, 0, 0, 127);
	imagefill($im, 0, 0, $transparent);
	return $im;
}

function image_random_color_allocate($img)
{
	$quota = 350;
	$colors = Array();
	for($i=0; $i<3; $i++)
	{
		$max = ($quota>255) ? 255 : $quota;
		$c = rand(0,$max);
		$quota -= $c;
		$colors[$i] = $c;
	}
	return imagecolorallocate($img, $colors[1], $colors[2], $colors[0]);
}

function generate_security_image(/*$password or $length, $pathimg, $font*/)
{
	$no_args = func_num_args();	$args = func_get_args();
	$password = ''; $length = 0; $pathimg = null; $font = null;
	
	// reading length or password (first arg)
	if( $no_args === 0 ) $length = DEFAULT_CODE_LENGHT;
	elseif( is_string($args[0]) ) $password = $args[0];
	else $length = $args[0];
	if( $password === '' )
		$password = generate_email_security_code($length);
	// reading image path (second arg)
	if( $no_args > 1 ) $pathimg = $args[1];
	else $pathimg = DEFAULT_IMAGES_DIR;
	// reading font file path (third arg)
	if( $no_args > 2 ) $font = $args[2];
	else $font = DEFAULT_FONT;
	
	// select random background image
	$bgurl = $pathimg.'bg'.rand(1,6).'.png';
	$img_bkgd = imagecreatefrompng($bgurl);
	$bckg_info = getimagesize($bgurl);
	
	// create canvas and draw the chars
	$img_ciphers = create_blank_png($bckg_info[0], $bckg_info[1]);
	$offset = 0;
	$size = 18;
	for($i=0; $i<$length; $i++)
	{
		$offset += rand(2,4);
		$textstr = $password{$i};
		$angle = rand(-20, 20);
		$color = image_random_color_allocate($img_ciphers);
		$textsize = imagettfbbox($size, $angle, $font, $textstr);
		$txtW = abs($textsize[2]-$textsize[0]);
		$txtH = abs($textsize[5]-$textsize[3]);
		$marginH = ($bckg_info[1]-$txtH)/2;
		imagettftext($img_ciphers, $size, $angle, $offset,$size+rand(1, $marginH), $color, $font, $textstr);
		$offset += $txtW;
	}
	$marginW = $bckg_info[0]-$offset;
	imagecopy($img_bkgd, $img_ciphers, $marginW/2,0, 0,0, $bckg_info[0],$bckg_info[1]);
	imagedestroy($img_ciphers);
	
	header("Content-type: image/png");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	
	imagepng($img_bkgd);
	imagedestroy($img_bkgd);
	return $password;
}

if( isset($_GET['control']) )
	$pass = generate_security_image($_GET['control']);
else
	$pass = generate_security_image();

if( ! isset($_SESSION['sess_security_code']) )
	$_SESSION['sess_security_code'] = Array();
$_SESSION['sess_security_code'] = md5($pass);

?>