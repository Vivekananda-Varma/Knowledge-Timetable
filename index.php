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
	
	require_once('filepond/config.php');
	require_once('filepond/util/read_write_functions.php');
	
	header('Cache-Control: must-revalidate');
	
	DB_Connect();
	
	$gRoot = $_SERVER['DOCUMENT_ROOT'];
	$gUri  = $_SERVER['REQUEST_URI'];
	$gMethod = $_SERVER['REQUEST_METHOD'];
	
	$tokens = explode("/", $gUri);					// tokenize url
	
	// print_r($tokens);
	
	switch ($tokens[1]) {
	case 'admin':
		include_once('admin/functions/categories.inc');
		include_once('admin/functions/users.inc');
		include_once('admin/functions/students.inc');
		include_once('admin/functions/teachers.inc');
		include_once('admin/functions/places.inc');
		include_once('admin/functions/subjects.inc');
		include_once('admin/functions/courses.inc');
		include_once('admin/functions/timetable.inc');
		
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
			case 'login':
				$page_title = 'Admin Sign In';
				include('admin/login.php');
				exit;
			
			case 'loginpost':
				$username = $_POST['email'];
				$password = $_POST['password'];
			
				if ($username == $admin_username && $password == $admin_password) {
					$_SESSION['login_user']['is_admin'] = true;
					
					// print "Logged in as admin"; exit;
					Redirect('/admin/courses/');
				} else if ($user_id = ValidateAdminLogin($username, $password)) {
					$_SESSION['login_user'] = GetUserById($user_id);
					
					Redirect('/');
				} else {
					Redirect('/admin/login/');
				} 
				
				break;
				
			case 'logout':
				unset($_SESSION['login_user']);
			
				Redirect('/admin/login/');
			
			case 'complete':
				RequiresAdminLogin();
						
				$entities = $tokens[3];				// 	/admin/complete/subjects/cat/" + categoryId
				$id =  $tokens[5];
			
				switch($entities) {
					case 'subjects':
						$subjects = GetSubjectsForCategory($id);
						print json_encode($subjects);
						
						break;
						
					case 'teachers':
						$teachers = GetTeachersForSubject($id);
						print json_encode($teachers);
						
						break;
				}
			
				break;
			
			default:
			// Redirect('/admin/dashboard/');    
				
            case 'categories':
				RequiresAdminLogin();
						
				$action = $tokens[4] ?? '';
				
				if ($action != '') {
					$category_id = $tokens[3];
					
					switch($action) {
						case 'editpost':
							UpdateCategory($category_id, $_POST);
							
							Redirect("/admin/categories/");
							
							break;
				
						case 'delete':
							
							break;
					}
				} else {
					$action = $tokens[3];
					
					$page_title = "Categories";
					$categories_active = 'active';
					
					switch($action) {
						case 'import':
							$page_title = "Import Categories &amp; Subjects";
							
							include('admin/modules/categories/import.php');
							
							break;
						 	
						case 'importpost':
							if (isset($_POST['filepond'])) {
								$uniqueFileID = $_POST['filepond'][0];
								$arrayDBStore = readJsonFile($TS_PARAMS['docroot'] . "filepond/database.json");
								$fileInfoIndex = array_search($uniqueFileID, array_column($arrayDBStore, 'id'));
								
								if (isset($fileInfoIndex)) {
									$fileInfo = $arrayDBStore[$fileInfoIndex];
									$fileName = $fileInfo["name"];
									$source_path = $TS_PARAMS['docroot'] . "filepond/uploads/$fileName";
									
									// print "id: $uniqueFileID, file: $source_path<br>logo path: $destination_path";					
									// rename($source_path, $destination_path);
									
									$previous_category = '';
									$previous_subject = '';
									
									$fileHandle = fopen($source_path, "r");
									$firstline = true;
									while (($row = fgetcsv($fileHandle, 0, ",", "\"")) !== FALSE) {
										if ($firstline == true) {
											$firstline = false;
											
											continue;
										}
										
										$data = array();
										
										$category_name = SanitiseUserInput($row[0]);
										$subject_name = SanitiseUserInput($row[1]);
										$teacher_name = SanitiseUserInput($row[2]);
										
										if ($category_name == '') {
											$category_name = $previous_category;
										} else {
											$previous_category = $category_name;
										}
										
										if ($subject_name == '') {
											$subject_name = $previous_subject;
										} else {
											$previous_subject = $subject_name;
										}
										
										list($firstname, $salutation) = explode(' ', $teacher_name);
										
										print "$category_name, $subject_name, $firstname, $salutation<br>";
										
										$category = GetCategoryByName($category_name);
										$subject = GetSubjectByName($subject_name);
										$teacher = GetTeacherByFirstname($firstname);
										
										if ($category === false) {
											$category = CreateCategory(array('category_name' => $category_name));
										}
										
										if ($subject === false) {
											$subject = CreateSubject(array('subject_name' => $subject_name, 'category_id' => $category['category_id']));
										}
										
										if ($teacher !== false) {
											$data = array();
											
											$data['category_id'] = $category['category_id'];
											$data['subject_id'] = $subject['subject_id'];
											$data['teacher_id'] = $teacher['teacher_id'];
											$data['course_name'] = $subject_name;
											
											CreateCourse($data);
										}
									}
								}
							}
						
							// Redirect('/admin/categories/');
							
							break;
							
						default:						
							$categories = GetCategories();
							
                			include('admin/modules/categories/index.php');
					}
				}
				
                break;

			case 'subjects':
				RequiresAdminLogin();
						
				if ( $tokens[3] == 'create') {
					CreateSubject($_POST);
					Redirect("/admin/subjects/");
				}
				
				$action = $tokens[4] ?? '';
				
				if ($action != '') {
					$subject_id = $tokens[3] ?? '';																
					
					switch($action) {
						case 'editpost':
							UpdateSubject($subject_id, $_POST);
							Redirect("/admin/subjects/");
							
							break;
				
						case 'delete':
							
							break;
					}
				} else {
					$page_title = "Subjects";
					$subjects_active = 'active';
					$subjects = GetSubjects();
					$categories = GetCategories();
					$teachers = GetTeachers();
					
					include('admin/modules/subjects/index.php');
				}
				
				break;

			case 'courses':
				RequiresAdminLogin();
						
				$page_title = "Courses";
				$courses_active = 'active';
				$courses = GetCourses();
				$categories = GetCategories();
				$places = GetPlaces();
				
				include('admin/modules/courses/index.php');
				
				break;

			case 'places':
				RequiresAdminLogin();
						
				if ( $tokens[3] == 'create') {
					CreatePlace($_POST);
					Redirect("/admin/places/");
				}
				
				$action = $tokens[4] ?? '';
				
				if ($action != '') {
					$place_id = $tokens[3] ?? '';																
					
					switch($action) {
						case 'editpost':
							UpdatePlace($place_id, $_POST);
							Redirect("/admin/places/");
							
							break;
				
						case 'delete':
							
							break;
					}
				} else {
					$page_title = "Places";
					$places_active = 'active';
					$places = GetPlaces();
					
					include('admin/modules/places/index.php');
				}
				
                break;

			case 'students':
				RequiresAdminLogin();
						
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
						case '':
							$page_title = "Students";
							$students = GetStudents();
							
							include('admin/modules/students/index.php');
							
							break;
							
						case 'import':
							$page_title = "Import Students";
							
							include('admin/modules/students/import.php');
							
							break;
							
						case 'importpost':
							if (isset($_POST['filepond'])) {
								$uniqueFileID = $_POST['filepond'][0];
								$arrayDBStore = readJsonFile($TS_PARAMS['docroot'] . "filepond/database.json");
								$fileInfoIndex = array_search($uniqueFileID, array_column($arrayDBStore, 'id'));
								
								if (isset($fileInfoIndex)) {
									$fileInfo = $arrayDBStore[$fileInfoIndex];
									$fileName = $fileInfo["name"];
									$source_path = $TS_PARAMS['docroot'] . "filepond/uploads/$fileName";
									
									// print "id: $uniqueFileID, file: $source_path<br>logo path: $destination_path";					
									// rename($source_path, $destination_path);
									
									$fileHandle = fopen($source_path, "r");
									$firstline = true;
									while (($row = fgetcsv($fileHandle, 0, ",", "\"")) !== FALSE) {
										if ($firstline == true) {
											$firstline = false;
											
											continue;
										}
										
										$data = array();
										
										$legalname = $row[1];
										$display_name = $row[2];
										$firstname = $row[3];
										$lastname = $row[4];
										$year = substr($row[5], 0, 1);			// 1st, 2nd, 3rd
										$mobile = $row[6];
										$email = $row[7];
										$dob = $row[8];										
										 
										$data['firstname'] = $firstname;
										$data['lastname'] = $lastname;
										$data['legalname'] = $legalname;
										$data['display_name'] = $display_name;
										$data['mobile'] = $mobile;
										$data['email'] = $email;
										$data['dob'] = DateToMySQLDate($dob);
										$data['year'] = $year;
										
										$student = ImportStudent($data);
									}
								}
							}
						
							Redirect('/admin/students/');
							
							break;
					}
				}
				
				break;
				
			case 'teachers':
				RequiresAdminLogin();
						
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
						case '':
							$page_title = "Teachers";
							$teachers = GetTeachers();
							
							include('admin/modules/teachers/index.php');
							
							break;
							
						case 'import':
							$page_title = "Import Teachers";
							
							include('admin/modules/teachers/import.php');
							
							break;
							
						case 'importpost':
							if (isset($_POST['filepond'])) {
								$uniqueFileID = $_POST['filepond'][0];
								$arrayDBStore = readJsonFile($TS_PARAMS['docroot'] . "filepond/database.json");
								$fileInfoIndex = array_search($uniqueFileID, array_column($arrayDBStore, 'id'));
								
								if (isset($fileInfoIndex)) {
									$fileInfo = $arrayDBStore[$fileInfoIndex];
									$fileName = $fileInfo["name"];
									$source_path = $TS_PARAMS['docroot'] . "filepond/uploads/$fileName";
									
									// print "id: $uniqueFileID, file: $source_path<br>logo path: $destination_path";					
									// rename($source_path, $destination_path);
									
									$fileHandle = fopen($source_path, "r");
									$firstline = true;
									while (($row = fgetcsv($fileHandle, 0, ",", "\"")) !== FALSE) {
										if ($firstline == true) {
											$firstline = false;
											
											continue;
										}
										
										$data = array();
										
										$firstname = $row[1];
										
										if (strpos(' ', $firstname) !== false) {
											list($firstname, $lastname) = explode(' ', $row[1]);
										} else {
											$lastname = '';
										}
										 
										$data['firstname'] = $firstname;
										$data['lastname'] = $lastname;
										
										$data['email'] = $row[2];
										$data['mobile'] = $row[3];
										
										$teacher = CreateTeacher($data);
									}
								}
							}

							Redirect('/admin/teachers/');
							
							break;
				
						case 'export':
					
							break;
					}
				}
			
				break;
        }
		
		break;

	default:
		switch ($tokens[1]) {
		case 'login':
			$page_title = 'Sign In';
			include('login/login.php');
			exit;
			
		case 'verify':
			$email = $_POST['email'];
			$otp = GenerateOTPForUser($email);
			$page_title = "Verify OTP";
			include('login/verifyotp.php');
			exit;
			
		case 'verifypost':
			$email = $_POST['email'];
			$otp = $_POST['otp'];
			
			$user = ValidateUserLogin($email, $otp);
				
			if ($user !== false) {
				$_SESSION['login_user'] = $user;
				Redirect('/students/courses/');
			} else {
				Redirect('/login/');
			}
			
			break;
			
		case 'logout':
			unset($_SESSION['login_user']);
		
			Redirect('/login/');
			
		case 'students':
			RequiresLogin();
			
			$module = $tokens[2];
			
			switch ($module) {
			case 'courses':
				$action = $tokens[3];
				$filter = '';
				
				switch ($action) {
				case 'search':
					$filter = $_GET['q'];
					
				case 'select':
					$page_title = "Select Courses";
					
					include('students/modules/courses/select.php');
					exit;
					
				default:
					$page_title = "Courses";
					
					include('students/modules/courses/emptyview.php');
					exit;		
				}
				
				break;
				
			case 'teachers':
				
				break;
				
			case 'timetable':
				$page_title = "Timetable";
				
				Redirect('/students/modules/timetable/timetable.html');
			}
		}
		
		// if ($_SESSION['login_user']['is_admin'] == true) {
		// 	Redirect('/admin/teachers/');
		// } else {
		// 	print '404';
		// }
	}
	
	RequiresLogin();
?>
