<?php

    function ValidateAdminLogin($username, $password) {
    global $admin_username;
    global $admin_password;
        
        return ($username == $admin_username && $password == $admin_password);
    }
    
    function ValidateUserLogin($email, $otp) {
        global $mysqli;
        
        $query = "
            SELECT users.*, students.student_id, teachers.teacher_id
            FROM `users` 
            LEFT JOIN `students`
            ON `students`.user_id=users.user_id
            LEFT JOIN `teachers`
            ON `teachers`.user_id=users.user_id
            WHERE `email`='$email' AND `otp`='$otp'
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        if ($num_results > 0) {
            $user = $result->fetch_assoc();
            $user_id = $user['user_id'];
            
            $query = "
                UPDATE `users`
                SET `otp`=NULL,
                    `last_login`=NOW()
                WHERE `user_id`=$user_id
            ";
            
            $result = $mysqli->query($query);
            
            return $user;
        }
        
        return false;
    }
    
    function RequiresLogin() {
        if (!isset($_SESSION['login_user'])) {
            Redirect('/login/');
            exit;
        }
        
        return $_SESSION['login_user'];
    }

    function RequiresAdminLogin() {
        if (!isset($_SESSION['login_user'])) {
            Redirect('/admin/login/');
            exit;
        }
        
        if (!isset($_SESSION['login_user']['is_admin'])) {
            Redirect('/admin/login/');
            exit;
        }
        
        return $_SESSION['login_user'];
    }
    
    function GenerateOTPForUser($email) {
        global $mysqli;
        
        $otp = random_int(100000, 999999);
        
        $query = "
            UPDATE `users`
            SET `otp`='$otp'
            WHERE `email`='$email'
        ";
        
        $result = $mysqli->query($query);
        
        return $otp;
    }
    
    function GetCoursesForStudent($student_id) {
        global $mysqli;
        
        $query = "
            SELECT *
            FROM xref_students_courses
            WHERE `student_id`='$student_id'
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        $courses = array();
        
        for ($i = 0; $i < $num_results; $i++) {
            $row = $result->fetch_assoc();
            $courses[] = $row['course_id'];
        }
        
        return $courses;
    }
    
    function ToggleCourseForStudent($student_id, $course_id) {
        global $mysqli;
        
        $query = "
            SELECT *
            FROM xref_students_courses
            WHERE `student_id`='$student_id' AND `course_id`='$course_id'
        ";
        
        // print $query;
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        if ($num_results > 0) {
            $query = "
                DELETE FROM xref_students_courses
                WHERE `student_id`='$student_id' AND `course_id`='$course_id'
            ";
            
            $result = $mysqli->query($query);
            
            return 0;
        } else {
            $query = "
                INSERT INTO xref_students_courses
                SET `student_id`='$student_id',
                    `course_id`='$course_id'
            ";
            
            $result = $mysqli->query($query);
        }
        
        return 1;
    }
    
    function GetTeachersForStudent($student_id) {
        global $mysqli;
        
        $query = "
            SELECT courses.*, users.*, subjects.category_id
            FROM xref_students_courses AS map
            LEFT JOIN courses ON courses.course_id=map.course_id
            LEFT JOIN subjects ON subjects.subject_id=courses.subject_id
            LEFT JOIN teachers ON teachers.teacher_id=courses.teacher_id
            LEFT JOIN users ON users.user_id=teachers.user_id
            WHERE `student_id`='$student_id'
            ORDER  BY users.firstname, courses.course_name
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        $teachers = array();
        
        for ($i = 0; $i < $num_results; $i++) {
            $teachers[] = $result->fetch_assoc();
        }
        
        return $teachers;
    }
?>
