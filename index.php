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
	
	$day_of_week = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');							
	$colors = array('yellow', 'orange', 'red', 'pink', 'violet', 'purple', 'blue', 'aqua', 'green', 'leaf', 'navy', 'fuchsia', 'sky', 'grape');
	
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
									
									$previous_category = '';
									$previous_subject = '';
									
									$sl_no = 1;
									
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
										
										$category = GetCategoryByName($category_name);
										$subject = GetSubjectByName($subject_name);
										$teacher = GetTeacherByDisplayName($teacher_name);
										
										// print "<br><br>$sl_no. $category_name, $subject_name, $teacher_name,"; $sl_no++;
										
										// if ($category === false) {
										// 	$category = CreateCategory(array('category_name' => $category_name));
										// }
										// 
										// if ($subject === false) {
										// 	$subject = CreateSubject(array('subject_name' => $subject_name, 'category_id' => $category['category_id']));
										// }
										
										if ($teacher !== false) {
											$data = array();
											
											$data['category_id'] = $category['category_id'];
											$data['subject_id'] = $subject['subject_id'];
											$data['teacher_id'] = $teacher['teacher_id'];
											$data['course_name'] = $subject_name;
											
											$course = CreateCourse($data);
											
											// print $course['course_id'] . '<br>';
										}
									}
								}
							}
						
							Redirect('/admin/courses/');
							
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
						
				$action = $tokens[4] ?? '';
				
				if ($action != '') {
					$course_id = $tokens[3] ?? '';																
					
					switch($action) {
						case 'editpost':
							UpdateCourse($course_id, $_POST);
							Redirect("/admin/courses/");
							
							break;
				
						case 'delete':
							
							break;
					}
				} else {
					$page_title = "Courses";
					$courses_active = 'active';
					$courses = GetCourses();
					$categories = GetCategories();
					$places = GetPlaces();
					
					include('admin/modules/courses/index.php');
				}
				
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
							$student = GetStudentByID($student_id);
							$uid = $student['uid'];
							$profilepic_path = "images/profilepics/$uid.jpg";								
																
							if (isset($_POST['filepond'])) {
								$uniqueFileID = $_POST['filepond'][0];
								$arrayDBStore = readJsonFile($TS_PARAMS['docroot'] . "filepond/database.json");
								$imageInfoIndex = array_search($uniqueFileID, array_column($arrayDBStore, 'id'));
								
								if (isset($imageInfoIndex)) {
									$imageInfo = $arrayDBStore[$imageInfoIndex];
									$imageName = $imageInfo["name"];
									$source_path = $TS_PARAMS['docroot'] . "filepond/uploads/$imageName";
									$destination_path = $TS_PARAMS['docroot'] . $profilepic_path;
							
									// print "id: $uniqueFileID, file: $source_path<br>logo path: $destination_path";					
									@rename($source_path, $destination_path);
									
									$_POST['profile_image_path'] = "/$profilepic_path";
								}
							}
							
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
							$students = GetStudents();
							
							if (count($students)) {
								$page_title = "Students";
								include('admin/modules/students/index.php');
							} else {
								$page_title = "Import Students";
								include('admin/modules/students/import.php');
							}
							
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
									
									$fileHandle = fopen($source_path, "r");
									$firstline = true;
									while (($row = fgetcsv($fileHandle, 0, ",", "\"")) !== FALSE) {
										if ($firstline == true) {
											$firstline = false;
											
											continue;
										}
										
										$student = ImportStudent($row);
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
										
										$teacher = ImportTeacher($row);
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
			
		case 'resendotp':
			exit;
			
		case 'verify':
			$email = $_POST['email'];
			$otp = GenerateOTPForUser($email);
			$from_name = 'K Timetable App';
			$from_email = 'noreply@slaice.in';
			$subject = 'Your One time password';
			$message = "$otp is your one time password to access the K Timetable App";
			
			email($from_name, $from_email, $email, $from_email, $subject, $message);
			$page_title = "Verify OTP";
			include('login/verifyotp.php');
			exit;
			
		case 'verifypost':
			$email = $_POST['email'];
			$otp = $_POST['otp'];
			
			$user = ValidateUserLogin($email, $otp);
				
			if ($user !== false) {
				$_SESSION['login_user'] = $user;
				
				if (!empty($user['teacher_id'])) {
					$_SESSION['login_user']['is_teacher'] = true;
					
					Redirect('/teachers/courses/');
				} else {
					$_SESSION['login_user']['is_student'] = true;
					
					Redirect('/students/courses/');
				}
			} else {
				Redirect('/login/');
			}
			
			break;
			
		case 'logout':
			unset($_SESSION['login_user']);
		
			Redirect('/login/');
			
		case 'students':
			RequiresLogin();
			
			include('admin/functions/students.inc');
			
			$loggedin_user = $_SESSION['login_user'];
			$is_student = $loggedin_user['is_student'] ?? false;
			$student_id = $loggedin_user['student_id'];
			
			$student = GetStudentByID($student_id);
			$uid = $student['uid'];
			$firstname = $student['firstname'];
			$lastname = $student['lastname'];
			$fullname = "$firstname $lastname";
			
			$profile_image_url = GetProfileImagePathForUID($uid);
			
			$selected_courses = GetCoursesForStudent($student_id);
			
			$module = $tokens[2];
			
			switch ($module) {
			case 'complete':								// 	/students/complete/courses/toggle/<id>
				$entity = $tokens[3];
				$action = $tokens[4];
				$id = $tokens[5];
				
				if ($entity == 'courses' && $action == 'toggle') {
					$state = ToggleCourseForStudent($student_id, $id);
					
					print $state;
					
					exit;
				}
				
				break;
				
			case 'profile':
				$action = $tokens[3];
				
				switch ($action) {
				case 'edit':
					$page_title = "Edit Profile";
					
					include('students/modules/profile/edit.php');
					exit;
					
				case 'editpost':
					
				default:
					$page_title = "My Profile";
					
					include('students/modules/profile/index.php');
					exit;
				}
				
				break;
				
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
					
				case 'id':
					$course_id = $tokens[4];
					
					include('students/modules/courses/detail.php');
					exit;
					
				default:
					$page_title = "My Courses";
					
					if (count($selected_courses)) {
						include('students/modules/courses/index.php');
					} else {
						include('students/modules/courses/emptyview.php');
					}
					
					exit;		
				}
				
				break;
				
			case 'teachers':
				$page_title = "My Teachers";
				
				if (count($selected_courses)) {
					if ($tokens[3] == 'id') {
						$teacher_id = $tokens[4];
						include('students/modules/teachers/profile.php');
						exit;
					}
					
					$teachers = GetTeachersForStudent($student_id);
					include('students/modules/teachers/index.php');
				} else {
					include('students/modules/courses/emptyview.php');
				}
				exit;
				
			case 'timetable':
				$action = $tokens[3];
				
				switch ($action) {
				case 'period':
					$day = $tokens[4];
					$period_no = $tokens[5];
					$day_name = $day_of_week[$day];
					
					switch ($tokens[6]) {
					case 'select':
						$page_title = "Select Course";
						
						include('students/modules/timetable/assign.php');
						exit;
						
					case 'assign':
						$course_id = $tokens[7];
						
						print "course $course_id needs to be assigned";
						break;
					
					default:
					 	$page_title = "$day_name $period_no Period";
						
						include('students/modules/timetable/period.php');
						exit;
					}
					
					break;
				
				default:
					$page_title = "My Timetable";
					
					if (count($selected_courses)) {
						include('students/modules/timetable/index.php');
					} else {
						include('students/modules/courses/emptyview.php');
					}
					
					exit;
				}
			}
			
			break;
			
		case 'teachers':
			RequiresLogin();
			
			include('admin/functions/courses.inc');
			include('admin/functions/teachers.inc');
			
			$loggedin_user = $_SESSION['login_user'];
			$is_teacher = $loggedin_user['is_teacher'] ?? false;
			
			$teacher_id = $loggedin_user['teacher_id'];
			
			$teacher = GetTeacherByID($teacher_id);
			$uid = $teacher['uid'];
			$firstname = $teacher['firstname'];
			$lastname = $teacher['lastname'];
			$fullname = "$firstname $lastname";
			
			$profile_image_url = GetProfileImagePathForUID($uid);
			
			$module = $tokens[2];
			
			switch ($module) {
			case 'profile':
				$action = $tokens[3];
				
				switch ($action) {
				case 'edit':
					$page_title = "Edit Profile";
					
					include('teachers/modules/profile/edit.php');
					exit;
					
				case 'editpost':
					
				default:
					$page_title = "My Profile";
					
					include('teachers/modules/profile/index.php');
					exit;
				}
				
				break;
				
			case 'courses':
				$action = $tokens[3];
				$filter = '';
				
				switch ($action) {
				case 'id':
					$course_id = $tokens[4];
					
					include('teachers/modules/courses/detail.php');
					exit;
					
				default:
					$page_title = "My Courses";
					
					$courses = GetCoursesForTeacher($teacher_id);
									
					if (count($courses)) {
						include('teachers/modules/courses/index.php');
					} else {
						include('teachers/modules/courses/emptyview.php');
					}
					
					exit;		
				}
				
				break;
				
			case 'students':
				$page_title = "My Teachers";
				
				if (count($selected_courses)) {
					if ($tokens[3] == 'id') {
						$teacher_id = $tokens[4];
						include('students/modules/teachers/profile.php');
						exit;
					}
					
					$teachers = GetTeachersForStudent($student_id);
					include('teachers/modules/students/index.php');
				} else {
					include('students/modules/courses/emptyview.php');
				}
				exit;
				
			case 'timetable':
				$action = $tokens[3];
				
				switch ($action) {
				case 'period':
					$day = $tokens[4];
					$period_no = $tokens[5];
					$day_name = $day_of_week[$day];
					
					switch ($tokens[6]) {
					case 'select':
						$page_title = "Select Course";
						
						include('teachers/modules/timetable/assign.php');
						exit;
						
					case 'assign':
						$course_id = $tokens[7];
						
						print "course $course_id needs to be assigned";
						break;
					
					default:
					 	$page_title = "$day_name $period_no Period";
						
						include('teachers/modules/timetable/period.php');
						exit;
					}
					
					break;
				
				default:
					$page_title = "My Timetable";
					
					include('teachers/modules/timetable/index.php');
					
					exit;
				}
			}
			
			break;
			
		default:
			if (isset($_SESSION['login_user'])) {
				if (isset($_SESSION['login_user']['is_admin'])) {
					Redirect('/admin/teachers/');
				} else {
					if (isset($_SESSION['login_user']['is_teacher'])) {
						print "Teachers coming soon.";
						
						exit;
						// Redirect('/teachers/courses/');
					} else if (isset($_SESSION['login_user']['is_student'])) {
						Redirect('/students/courses/');
					} else {
						print '404';
					}
				}
			}
		}
	}
	
	RequiresLogin();
?>
