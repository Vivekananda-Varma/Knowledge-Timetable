<?php

    function GetCourses($filter='') {
        global $mysqli;
        
        $courses = array();
         
        if ($filter != '') {
            $where_clause = "WHERE `course_name` LIKE '%$filter%' OR `users`.`firstname` LIKE '%$filter%'";
        } else {
            $where_clause = '';
        }
        
        $query = "
            SELECT `courses`.*, `subjects`.*, `categories`.*, `teachers`.*, `users`.*, `places`.`place_name`
            FROM `courses`
            LEFT JOIN `subjects` 
            ON `courses`.`subject_id`=`subjects`.`subject_id`
            LEFT JOIN `categories`
            ON categories.category_id=subjects.category_id
            LEFT JOIN `teachers` 
            ON `courses`.`teacher_id`=`teachers`.`teacher_id`
            LEFT JOIN `users` 
            ON `teachers`.`user_id`=`users`.`user_id`
            LEFT JOIN `places`
            ON `places`.`place_id`=`courses`.`default_place_id`
            $where_clause
            ORDER BY `subjects`.`category_id`, `course_name`
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        for ($i = 0; $i < $num_results; $i++) {
            $courses[] = $result->fetch_assoc();
        }
        
        return $courses;
    }
    
    function GetCoursesForTeacher($teacher_id) {
        global $mysqli;
        
        $query = "
            SELECT `courses`.*, `subjects`.*, `categories`.*, `teachers`.*, `users`.*, `places`.`place_name`
            FROM `courses`
            LEFT JOIN `subjects` 
            ON `courses`.`subject_id`=`subjects`.`subject_id`
            LEFT JOIN `categories`
            ON categories.category_id=subjects.category_id
            LEFT JOIN `teachers` 
            ON `courses`.`teacher_id`=`teachers`.`teacher_id`
            LEFT JOIN `users` 
            ON `teachers`.`user_id`=`users`.`user_id`
            LEFT JOIN `places`
            ON `places`.`place_id`=`courses`.`default_place_id`
            WHERE `courses`.`teacher_id`='$teacher_id'
            ORDER BY `subjects`.`category_id`, `course_name`
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        $courses = array();
        
        for ($i = 0; $i < $num_results; $i++) {
            $courses[] = $result->fetch_assoc();
        }
        
        return $courses;
    }
    
    function GetTeachersForSubject($subject_id) {
        global $mysqli;
        
        $teachers = array();
         
        $query = "
            SELECT `teachers`.*, `users`.*
            FROM `courses`
            LEFT JOIN `teachers`
            ON `courses`.`teacher_id`=`teachers`.`teacher_id`
            LEFT JOIN `users` 
            ON `teachers`.`user_id`=`users`.`user_id`
            WHERE `courses`.`subject_id`=$subject_id
            ORDER BY `firstname`
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        for ($i = 0; $i < $num_results; $i++) {
            $row = $result->fetch_assoc();
            
            $teacher_id = $row['teacher_id'];
            $firstname = $row['firstname'];
            $salutation = $row['salutation'];
            
            $teachers[] = array('id' => $teacher_id, 'name' => "$firstname $salutation");
        }
        
        return $teachers;
    }
    
    function GetCourseByID($course_id) {
        global $mysqli;
        
        $query = "
            SELECT `courses`.*, `subjects`.*, `categories`.*, `teachers`.*, `users`.*, `places`.`place_name`
            FROM `courses`
            LEFT JOIN `subjects` 
            ON `courses`.`subject_id`=`subjects`.`subject_id`
            LEFT JOIN `categories`
            ON categories.category_id=subjects.category_id
            LEFT JOIN `teachers` 
            ON `courses`.`teacher_id`=`teachers`.`teacher_id`
            LEFT JOIN `users` 
            ON `teachers`.`user_id`=`users`.`user_id`
            LEFT JOIN `places`
            ON `places`.`place_id`=`courses`.`default_place_id`
            WHERE `course_id`=$course_id
        ";
        
        $result = $mysqli->query($query);
        if ($result->num_rows) {
            return $result->fetch_assoc();
        }
        
        return false;
    }
    
    function CreateCourse($data) {
        global $mysqli;
        
        $course_name = $data['course_name'];
        $subject_id = $data['subject_id'];
        $teacher_id = $data['teacher_id'];
        
        $query = "
            INSERT INTO `courses`
            SET `subject_id`=$subject_id,
                `teacher_id`=$teacher_id,
                `course_name`='$course_name'
        ";
        
        // print $query; return;
        
        $result = $mysqli->query($query);
        $course_id = $mysqli->insert_id;
        $course = GetCourseByID($course_id);
        
        return $course;
    }
    
    function UpdateCourse($course_id, $data) {
        global $mysqli;
        
        $course_name = SanitiseUserInput($data['course_name']);
        $blurb = SanitiseUserInput($data['blurb']);
        $requirements = SanitiseUserInput($data['requirements']);
        $default_place_id = $data['default_place_id'] ?? 'NULL';
        
        // $query = "
        //     UPDATE `courses`
        //     SET `course_name`='$course_name',
        //         `blurb`='$blurb',
        //         `default_place_id`=$default_place_id
        //     WHERE `course_id`=$course_id
        // ";
        
        $query = "
            UPDATE `courses`
            SET `course_name`='$course_name',
                `default_place_id`=$default_place_id,
                `blurb`='$blurb',
                `requirements`='$requirements'
            WHERE `course_id`=$course_id
        ";
        
        $result = $mysqli->query($query);
        $course = GetCourseByID($course_id);
        
        return $course;
    }


?>