<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	ini_set('pcre.jit', '0');
	ini_set('error_reporting', E_ALL ^ E_WARNING);
	
	error_reporting(E_ALL);

	session_start();
	
	include_once('functions/config.inc');
	include_once('functions/db.inc');
	include_once('functions/users.inc');
	include_once('functions/misc.inc');
	
	include_once('admin/functions/categories.inc');
	include_once('admin/functions/users.inc');
	include_once('admin/functions/places.inc');
	
	// require_once('filepond/config.php');
	// require_once("filepond/util/read_write_functions.php");
	
	header('Cache-Control: must-revalidate');
	
	DB_Connect();
	
	$gRoot = $_SERVER['DOCUMENT_ROOT'];
	$gUri  = $_SERVER['REQUEST_URI'];
	$gMethod = $_SERVER['REQUEST_METHOD'];
	
	$tokens = explode("/", $gUri);					// tokenize url
	
	// print_r($tokens);
	
	switch ($tokens[1]) {
	case 'login':
		$page_title = 'Sign In';
		include('login/login.php');
		exit;

	case 'loginpost':
		$username = $_POST['email'];
		$password = $_POST['password'];
	
    	if ($username == $admin_username && $password == $admin_password) {
        	$_SESSION['login_user']['is_admin'] = true;
			
			// print "Logged in as admin"; exit;
        	Redirect('/admin/categories/');
    	} else if ($user_id = ValidateLogin($username, $password)) {
			$_SESSION['login_user'] = GetUserById($user_id);
			
			Redirect('/');
		} else {
			Redirect('/login/');	
		} 
		
		break;
		
	case 'logout':
		unset($_SESSION['login_user']);

		Redirect('/login/');
	}
	
	RequiresLogin();
	
	switch ($tokens[1]) {
	case 'admin':
		// RequiresAdminLogin();
		
        $module = $tokens[2];
		
		$categories_active = '';
		$places_active = '';
		$subjects_active = '';
		
		$users_show = '';
		$users_active = '';
		$users_all_active = '';
		$students_active = '';
		$teachers_active = '';

        switch ($module) {
			default:
				// Redirect('/admin/dashboard/');    
				
            case 'categories':
				$page_title = "Categories";
				$categories_active = 'active';
				$categories = GetCategories();
				
                include('admin/modules/categories/index.php');
				
                break;

            case 'places': 
				$page_title = "Places";
				$places_active = 'active';
				$places = GetPlaces();
				
				include('admin/modules/places/index.php');
				
                break;

			case 'subjects':
				$subjects_active = 'active';
				include('admin/modules/subjects/index.php');
				
				break;
			
			case 'users':
				$filter = $tokens[3];
				$users_active = 'active';
				$users_show = 'show';
				
				$action = $tokens[4] ?? '';
				
				if ($action != '') {
					switch($action) {
						case 'edit':
							$page_title = "Edit User";
							$users_all_active = 'active';
							
							Redirect('/admin/modules/users/user_detail.html');
							
							break;
															
						case 'delete':
							
							break;
					}
				} else {
					switch($filter) {
						case 'all':
							$page_title = "All Users";
							$users_all_active = 'active';
							$users = GetUsers();
							
							break;
							
						case 'students':
							$page_title = "Students";
							$students_active = 'active';
							$users = GetUsers('students');
							
							break;
	
						case 'teachers':
							$page_title = "Teachers";
							$teachers_active = 'active';
							$users = GetUsers('teachers');
					
							break;
					}
	
					include('admin/modules/users/index.php');
				}
				
				break;
        }
		
		break;

	default: 
		if ($_SESSION['login_user']['is_admin'] == true) {
			Redirect('/admin/categories/');
		} else {
			print '404';
		}
	}
	
?>
