<?php

	// error_reporting(E_ALL | E_WARNING | E_NOTICE);
	// ini_set('display_errors', TRUE);

	// Start the Session
	@session_start();
	
	
	// Include Classes/Data/Lib
	include_once 'data.inc.php';
	include_once 'func.inc.php';
	include_once 'jsonconvertor.inc.php';


	// Init
	init_get_post_arrays();
	
?>