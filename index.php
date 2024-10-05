<?php

	session_start();
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	ini_set('pcre.jit', '0');
	ini_set('error_reporting', E_ALL ^ E_WARNING);
	
	error_reporting(E_ALL);
	
	include_once('functions/config.inc');
	include_once('functions/db.inc');
	include_once('functions/users.inc');
	// include_once('functions/suppliers.inc');
	// include_once('functions/categories.inc');
	// include_once('functions/parts.inc');
	// include_once('functions/rfqs.inc');
	// include_once('functions/misc.inc');
	// include_once('functions/sitemap.inc');
	
	// include_once("strapi/categories.php");
	
	// require_once('filepond/config.php');
	// require_once("filepond/util/read_write_functions.php");
	
	header('Cache-Control: must-revalidate');
	
	DB_Connect();
	
	$gRoot = $_SERVER['DOCUMENT_ROOT'];
	$gUri  = $_SERVER['REQUEST_URI'];
	$gMethod = $_SERVER['REQUEST_METHOD'];
	
	$tokens = explode("/", $gUri);					// tokenize url
	$num_rfqs = GetRFQCount();
	
	if ($tokens[1] == 'login') {
		include('modules/login/login.php');
		exit;
	} else if ($tokens[1] == 'loginpost') {
		$username = $_POST['username'];
		$password = $_POST['password'];
		
        if ($username == $admin_username && $password == $admin_password) {
            $_SESSION['login_user']['is_admin'] = true;

            Redirect('/admin');
            exit;
        }

		if ($user_id = ValidateLogin($username, $password)) {
			$_SESSION['login_user'] = GetUserById($user_id);
			
			Redirect('/');
			exit;
		} else {
			Redirect('/login/');
			exit;
		}
	} else if ($tokens[1] == 'logout') {
		unset($_SESSION['login_user']);
	
		Redirect('/login/');
		exit;
	}
	
	// RequiresAdminLogin();
	
	switch ($tokens[1]) {
	default:
		Redirect('/users/');
		
		break;
		
	
	
    case 'admin':
        $module = $tokens[2];

        switch ($module) {
            case 'categories':
                include('admin/modules/categories/index.php');
                break;

            case 'places'

                break;

            default:
                Redirect('/admin/categories/');
        }

    case 'dashboard':
        include('dashboard.php');
        
        break;
        
    case 'users':
        $user_id = $tokens[2];
        $user = GetUserById($user_id);

        print_r($user);

    
			
	}
	
?>
