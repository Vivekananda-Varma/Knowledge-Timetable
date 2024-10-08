<?php
	$dbhost = "mysql.slaice.in";
	$db = "timetabledb";
	$dbuser = "timetabledbadmin";
	$dbpass = "t1m3tab13";
	
	$app_title = "K Timetable";
	
	$admin_username = 'shilpi@gmail.com';
	$admin_password = 'shilpi';
	
	$TS_PARAMS['docroot'] = $_SERVER['DOCUMENT_ROOT'];						// some servers don't add a trailing slash to DOCROOT
	if ($TS_PARAMS['docroot'][strlen($TS_PARAMS['docroot'])-1] != "/")		// so we check if the trailing slash is missing, we add it
	{
		$TS_PARAMS['docroot'] .= "/";
	}
	
	$TS_PARAMS['domain'] = "";
	$TS_PARAMS['docroot'] .= "";
	
	$TS_PARAMS['webroot'] = "/";
	
	$TS_PARAMS['base_path'] = "https://".$_SERVER['HTTP_HOST'].$TS_PARAMS['webroot'];
		
	date_default_timezone_set('Asia/Kolkata');
?>