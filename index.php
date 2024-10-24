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
	include_once('admin/functions/subjects.inc');
	include_once('admin/functions/courses.inc');
	
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
        	Redirect('/admin/users/');
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
		$subjects_active = '';
		$courses_active = '';
		$places_active = '';
		
		$students_show = '';
		$students_active = '';
		$students_all_active = '';
		$students_export_active = '';
		$students_import_active = '';
		
		$teachers_active = '';
		$teachers_all_active = '';
		$teachers_export_active = '';
		$teachers_import_active = '';
		
        switch ($module) {
			default:
				// Redirect('/admin/dashboard/');    
				
            case 'categories':
				$page_title = "Categories";
				$categories_active = 'active';
				$categories = GetCategories();
				
                include('admin/modules/categories/index.php');
				
                break;

			case 'subjects':
				$page_title = "Subjects";
				$subjects_active = 'active';
				$subjects = GetSubjects();

				include('admin/modules/subjects/index.php');
				
				break;

			case 'courses':
				$page_title = "Courses";
				$courses_active = 'active';
				$courses = GetCourses();
				
				include('admin/modules/courses/index.php');
				
				break;

			case 'places': 
				$page_title = "Places";
				$places_active = 'active';
				$places = GetPlaces();
				
				include('admin/modules/places/index.php');
				
                break;

			case 'students':
				$students_show = 'show';
				$students_active = 'active';
				
				$action = $tokens[4] ?? '';
				
				if ($action != '') {
					$student_id = $tokens[3];
					
					switch($action) {
						case 'edit':
							$student = GetStudentByID($student_id);
								
							$page_title = "Edit Student";
							$students_all_active = 'active';
							
							include('admin/modules/students/detail.php');
							
							break;
							
						case 'editpost':
							UpdateStudent($student_id, $_POST);
							
							Redirect("/admin/students/$student_id/edit/");
							
							break;

						case 'delete':
							
							break;
					}
				} else {
					$filter = $tokens[3];

					switch($filter) {
						default:
						case 'all':
							$page_title = "All Students";
							$students_all_active = 'active';
							$students = GetStudents();
							
							break;
							
						case 'import':
							
							break;
	
						case 'export':
					
							break;
					}
	
					include('admin/modules/students/index.php');
				}
				
				break;
				
			case 'teachers':
				$teachers_show = 'show';
				$teachers_active = 'active';
				
				$action = $tokens[4] ?? '';
				
				if ($action != '') {
					$teacher_id = $tokens[3];
					
					switch($action) {
						case 'edit':
							$teacher_id = $tokens[3];
							$teacher = GetTeacherByID($teacher_id);
								
							$page_title = "Edit Teacher";
							$teachers_all_active = 'active';
							
							include('admin/modules/teachers/detail.php');
							
							break;
				
						case 'editpost':
							UpdateTeacher($teacher_id, $_POST);
							
							Redirect("/admin/teachers/$teacher_id/edit/");
							
							break;
						case 'delete':
							
							break;
					}
				} else {
					$filter = $tokens[3];
								
					switch($filter) {
						default:
						case 'all':
							$page_title = "All Teachers";
							$teachers_all_active = 'active';
							$teachers = GetTeachers();
							
							break;
							
						case 'import':
							
							break;
				
						case 'export':
					
							break;
					}
				
					include('admin/modules/teachers/index.php');
				}
			
				break;
			
			case 'tttest':
				$page_title = "Timetable";
				include('admin/modules/timetable/index.php');
        }
		
		break;

	default: 
		if ($_SESSION['login_user']['is_admin'] == true) {
			Redirect('/admin/teachers/');
		} else {
			print '404';
		}
	}
	
?>
