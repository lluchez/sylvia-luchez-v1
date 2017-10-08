<?php

include_once 'PHPMailerAutoload.php';


function init_get_post_arrays() {
	foreach($_POST as $key => $val)
		$_POST[$key] = utf8_decode($val);
	
	// merge the two arrays inside $_GET, so we can only work with $_GET
	$_GET += $_POST;
	
	// do some cleaning if 'get_magic_quotes_gpc' parameter is on, and remove strange keys (starting by '|')
	foreach($_GET as $key => $val) {
		if( is_string($val) && get_magic_quotes_gpc() ) // magic_quotes mode fix
			$_GET[$key] = stripslashes($val);
	}
}

// Retrieve a key in the $_GET array
function get($key, $default_value = null) {
	if( is_defined($key) )
		return $_GET[$key];
	else
		return $default_value;
}

function is_defined($array, $index = null) {
	if( ! is_array($array) ) {
		$array = func_get_args();
		$index = null;
	}
	foreach($array as $key) {
		if( is_array($key) && !is_null($index) ) {
			if( ! is_defined($key[$index]) )
				return false;
		}			
		elseif( is_string($key) ) {
			if( ! isset($_GET[$key]) )
				return false;
		}
	}
	return true;
}

function is_pDefined() {
	$array = func_get_args();
	foreach($array as $key) {
		if( ! isset($_POST[$key]) )
			return false;
	}
	return true;
}


function generate_email_security_code($length) {
	$ciphers = 'abcdefghjkmnpqrstuvwxyz';
	$ciphers = strToUpper($ciphers).'2345689';
	$password = '';
	for($ct=0; $ct<$length; $ct++)
		$password .= $ciphers{mt_rand()%strlen($ciphers)};
	return $password;
}

function create_security_hash($text) {
	return md5("/*-security*/{$text}#--#");
}


function path_combine($path, $file_or_subdir) {
	return $path . DIRECTORY_SEPARATOR . $file_or_subdir;
}


function is_valid_email($email) {
	return preg_match("/^([^@])+@[A-Za-z0-9\-_\.]+\.[a-z]{2,5}$/i", $email);
}


function init_mailer($mailer) {
	$mailer->IsSMTP();
	$mailer->Host       = SMTP_HOST;
	$mailer->Port       = SMTP_PORT;
	$mailer->SMTPAuth   = SMTP_AUTH;
	if( SMTP_AUTH ) {
		$mailer->Username   = SMTP_USER;
		$mailer->Password   = SMTP_PASS;
		if( SMTP_TRANSPORT )
			$mailer->SMTPSecure = SMTP_TRANSPORT;
	}
	return $mailer;
}


// NOTE: using http://www.useragentstring.com/pages/useragentstring.php and http://caniuse.com/
function does_browser_support_most_of_css3_directives() {
	$agent = $_SERVER['HTTP_USER_AGENT']; $matches = Array();
	//$agent = "Mozilla/5.0 (iPhone; CPU iPhone OS 8_1_3 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12B466 Safari/600.1.4";
	//$agent = "Opera/9.80 (X11; Linux x86_64; U; en-GB) Presto/2.2.15 Version/10.01";
	if(preg_match("/ MSIE (\d+)/i", $agent, $matches) && !preg_match("/opera/i", $agent)) {
		return intval($matches[1]) >= 9;
	} elseif(preg_match("/Trident\/(\d+)/i", $agent, $matches)) { // MSIE
		return intval($matches[1]) >= 5;
	} elseif(preg_match("/Chrome\/(\d+)/i", $agent, $matches)) {
		return intval($matches[1]) >= 4;
	} elseif(preg_match("/Firefox\/(\d+)/i", $agent, $matches)) {
		return intval($matches[1]) >= 4;
	} elseif(preg_match("/AppleWebKit\/[0-9\.]+ \([^\)]*\) Version\/(\d+\.\d+)/i", $agent, $matches)) {
		if(preg_match("/BlackBerry/i", $agent))
			return floatval($matches[1]) >= 7.0;
		else // assuming it's an Apple device
			return floatval($matches[1]) >= 3.1;
	} elseif(preg_match("/(?:^|\s)Opera[\s\/]/i", $agent) && preg_match("/(?:Opera\s|Version\/)([0-9\.]+)$/i", $agent, $matches)) {
		return floatval($matches[1]) >= 10.1;
	}
	//die("No match for: $agent");
	return false;
}

// NOTE: code from http://detectmobilebrowsers.com/
function is_mobile_device() {
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	if( preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)
			|| preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)) )
		return true;
	else
		return false;
}


function send_mail($subject, $message, $to, $from, $options = Array()) {
	// Create and pre-fill the mailer object
	$mailer = init_mailer(new PHPMailer(true));
	
	// Default options
	if( !isset($options) )           $options = Array();
	if( !isset($options['UTF8']) )   $options['UTF8']   = true; // by default use UTF-8 encoding
	if( !isset($options['isHtml']) ) $options['isHtml'] = true; // by default set content type as HTML
	
	// Set the charset
	if( $options['UTF8'] ) {
		$mailer->Charset  = 'UTF-8';
		$subject = "=?utf-8?b?".base64_encode($subject)."?=";
	}
	// Field the different fields
	$mailer->From     = $from['email'];
	$mailer->FromName = $from['name'];
	$mailer->Subject  = $subject;
	$mailer->MsgHTML($message);
	$mailer->AddAddress($to['email'], $to['name']);
	$mailer->AddReplyTo($from['email'], $from['name']);
	$mailer->IsHTML($options['isHtml']); // send as HTML
	
	// Send the email
	$mailer->Send();
}

function clean_text($text)
{
	return preg_replace("#(<|>)#", "", $text);
}

function handle_send_email_request()
{
	// Reading fields
	$name = utf8_encode(trim(get(POST_MAIL_NAME)));
	$phon = utf8_encode(trim(get(POST_MAIL_PHONE)));
	$mail = utf8_encode(trim(get(POST_MAIL_EMAIL)));
	$subj = utf8_encode(trim(get(POST_MAIL_SUBJECT)));
	$text = utf8_encode(trim(get(POST_MAIL_MESSAGE)));
	$code = utf8_encode(trim(get(POST_MAIL_CODE)));
	
	// Verify fields
	if( !$name ) render_json_error('Please indicate your identity');
	if( !$mail ) render_json_error('Please indicate your email address');
	if( !is_valid_email($mail) )
		render_json_error('Please indicate a valid email address');
	if( !$subj ) render_json_error('Please indicate the subject of your inquiry');
	if( !$text ) render_json_error('Please indicate explain why you want to contact the artist');
	if( !$code ) render_json_error('Please copy the code security code');
	if( $_SESSION['sess_security_code'] !== md5($code) )
		render_json_error('Invalid security code');
	
	// Prepare data to be sent
	$subject = $subj . ' - Web site inquiry';
	$content = '<!DOCTYPE html><html><body><p>The following message has been sent via '.$_SERVER['SERVER_NAME'].' on '.date("d-m-Y H:i:s")
		.' by '.htmlspecialchars($name).'.</p><hr /><br />'.nl2br(htmlspecialchars($text), false)
		.'<br /><hr />Name: '.htmlspecialchars($name).'<br />Email: '.htmlspecialchars($mail).'<br />Phone: '.htmlspecialchars($phon).'<br /></body></html>';
	$to =   Array('name' => EMAIL_NAME,   'email' => EMAIL_ADDRESS);
	$from = Array('name' => clean_text($name), 'email' => clean_text($mail));
	
	// Send the email
	try {
		send_mail($subject, $content, $to, $from);
		render_json(Array('success' => true));
	} catch (phpmailerException $e) {
		render_json_error('Unable to sent the email: '.$e->getMessage());
	} catch (Exception $e) {
		render_json_error('Unable to sent the email');
	}
}

?>