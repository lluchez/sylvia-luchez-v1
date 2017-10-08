<?php
	
	// - - - - Urls - - - -
	/*$https = $_SERVER['HTTPS']; $host = $_SERVER['HTTP_HOST']; $port = $_SERVER['SERVER_PORT'];
	$full_url = ((!empty($https)) && ($https != 'off')) ? 'https' : 'http';
	$full_url .= '://' . $_SERVER['HTTP_HOST'] . ($port == 80 ? '' : ':'.$port) . '/';
	define('FULL_URL', $full_url);*/
	
	
	//  - - - - Email data - - - - 
	define('EMAIL_ADDRESS',       $_ENV['EMAIL_ADDRESS']);
	define('EMAIL_NAME',          'Sylvia Luchez Art');
	
	
	// - - - - SMTP data - - - -
	if( $_SERVER['SERVER_ADDR'] === '127.0.0.1' )
	{
		define('SMTP_HOST',      'localhost');
		define('SMTP_PORT',      25);
		define('SMTP_AUTH',      false);
	}
	else
	{
		define('SMTP_HOST',      'smtp.gmail.com');
		define('SMTP_PORT',      465);
		define('SMTP_AUTH',      true);
	}
	define('SMTP_USER',      $_ENV[SMTP_USER]);
	define('SMTP_PASS',      $_ENV[SMTP_PASS]); // Generated using https://support.google.com/accounts/answer/185833?hl=en (2-step verification needs to be activated)
	define('SMTP_TRANSPORT', 'ssl');
	
	
	// - - - - Url data - - - - 
	define('URL_PARAM_FOLDER', 'folder');
	define('URL_PARAM_WORK',   'work');
	
	
	// - - - - Contact fields - - - - 
	define('POST_MAIL_NAME',    'name');
	define('POST_MAIL_PHONE',   'phone');
	define('POST_MAIL_EMAIL',   'email');
	define('POST_MAIL_SUBJECT', 'sjp_subject');
	define('POST_MAIL_MESSAGE', 'sjp_message');
	define('POST_MAIL_CODE',    'sjp_code');

?>