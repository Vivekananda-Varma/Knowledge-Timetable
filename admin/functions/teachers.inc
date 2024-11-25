<?php

    function GetNumPeriodsForTeacherId($teacher_id) {
        global $mysqli;
        
        $query = "
            SELECT COUNT(periods.course_id) AS num_periods
            FROM `courses`
            LEFT JOIN `periods` ON `periods`.`course_id`=`courses`.`course_id`
            WHERE `courses`.`teacher_id`=$teacher_id
        ";
        
        $result = $mysqli->query($query);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            
            return $row['num_periods'];
        }
        
        return 0;
    }
    
    function GetNumStudentsForTeacherId($teacher_id) {
        global $mysqli;
        
        $query = "
            SELECT COUNT(DISTINCT attendees.student_id) AS num_students
            FROM `periods`
            LEFT JOIN courses ON courses.course_id=periods.course_id
            LEFT JOIN `attendees` ON `attendees`.`period_id`=`periods`.`period_id`
            WHERE courses.teacher_id=$teacher_id
        ";
        
        $result = $mysqli->query($query);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            
            return $row['num_students'];
        }
        
        return 0;
    }

    function GetTeachers() {
        global $mysqli;
        
        $teachers = array();
        
        $query = "
            SELECT `teachers`.`teacher_id`, `teachers`.`is_active`, `users`.*,
            COUNT(courses.teacher_id) AS num_courses
            FROM `teachers` 
            LEFT JOIN `users` ON `users`.`user_id`=`teachers`.`user_id`
            LEFT JOIN `courses` ON `courses`.`teacher_id`=`teachers`.`teacher_id`
            GROUP BY `teachers`.`teacher_id`
            ORDER BY firstname
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        for ($i = 0; $i < $num_results; $i++) {
            $row = $result->fetch_assoc();
            $teacher_id = $row['teacher_id'];
            
            $row['num_periods'] = GetNumPeriodsForTeacherId($teacher_id);
            $row['num_students'] = GetNumStudentsForTeacherId($teacher_id);
            
            $teachers[] = $row;            
        }
        
        return $teachers;
    }
    
    function GetTeacherByID($teacher_id) {
        global $mysqli;
        
        $query = "
            SELECT `users`.*, `teachers`.* 
            FROM `teachers` 
            LEFT JOIN `users` 
            ON `teachers`.`user_id`=`users`.`user_id`
            WHERE `teacher_id`=$teacher_id
        ";
        
        $result = $mysqli->query($query);
        if ($result->num_rows) {
            return $result->fetch_assoc();
        }
        
        return false;
    }
    
    function GetTeacherByDisplayName($display_name) {
        global $mysqli;
        
        $query = "
            SELECT `users`.*, `teachers`.* 
            FROM `teachers` 
            LEFT JOIN `users` 
            ON `teachers`.`user_id`=`users`.`user_id`
            WHERE `display_name`='$display_name'
        ";
        
        $result = $mysqli->query($query);
        if ($result->num_rows) {
            return $result->fetch_assoc();
        }
        
        return false;
    }
    
    function CreateTeacher($data) {
        global $mysqli;
        
        $firstname = SanitiseUserInput($data['firstname']);
        $lastname = SanitiseUserInput($data['lastname']);
        $mobile = SanitiseUserInput($data['mobile']);
        $email = SanitiseUserInput($data['email']);
        $dob = SanitiseUserInput($data['dob']);
        $address_line_1 = SanitiseUserInput($data['address_line_1']);
        $address_line_2 = SanitiseUserInput($data['address_line_2']);
        $postal_code  = SanitiseUserInput($data['postal_code']);
        
        $dob = DateToMySQLDate($dob);
        
        $query = "
            INSERT INTO `users`
            SET `firstname`='$firstname',
                `lastname`='$lastname',
                `mobile`='$mobile',
                `email`='$email',
                `dob`='$dob',
                `address_line_1`='$address_line_1',
                `address_line_2`='$address_line_2',
                `postal_code`='$postal_code'
        ";
        
        $result = $mysqli->query($query);
        $teacher_id = $mysqli->insert_id;
        $teacher = GetTeacherByID($teacher_id);
        
        return $teacher;
    }
    
    function ImportTeacher($data) {
        global $mysqli;
        
       $uid = SanitiseUserInput($data[1]);
        $legalname = SanitiseUserInput($data[2]);
        $firstname = SanitiseUserInput($data[3]);
        $lastname = SanitiseUserInput($data[4]);
        $display_name = SanitiseUserInput($data[5]);
        $gender = SanitiseUserInput($data[6]);
            
        $mobile = SanitiseUserInput($data[7]);
        $email = SanitiseUserInput($data[8]);
        $is_active = SanitiseUserInput($data[9]);
        
        $is_active = $is_active == 'Y' ? 1 : 0;
        
        $query = "
            INSERT INTO `users`
            SET `uid`='$uid',
                `firstname`='$firstname',
                `lastname`='$lastname',
                `legalname`='$legalname',
                `display_name`='$display_name',
                `gender`='$gender',
                `mobile`='$mobile',
                `email`='$email'
            ON DUPLICATE KEY UPDATE
                `firstname`='$firstname',
                `lastname`='$lastname',
                `legalname`='$legalname',
                `display_name`='$display_name',
                `gender`='$gender',
                `mobile`='$mobile',
                `email`='$email'
        ";
        
        // print "$query<br><br>"; return;
        
        $result = $mysqli->query($query);
        $user_id = $mysqli->insert_id;
        
        $query = "
            INSERT INTO `teachers`
            SET `user_id`='$user_id',
                `is_active`='$is_active'
        ";
        
        $result = $mysqli->query($query);
        $teacher_id = $mysqli->insert_id;
        $teacher = GetTeacherByID($teacher_id);
        
        return $teacher;
        
    }
    
    function UpdateTeacher($teacher_id, $data) {
        global $mysqli;
        
        $teacher = GetTeacherByID($teacher_id);
        $user_id = $teacher['user_id'];
        
        $firstname = SanitiseUserInput($data['firstname']);
        $lastname = SanitiseUserInput($data['lastname']);
        $mobile = SanitiseUserInput($data['mobile']);
        $email = SanitiseUserInput($data['email']);
        $dob = SanitiseUserInput($data['dob']);
        $address_line_1 = SanitiseUserInput($data['address_line_1']);
        $address_line_2 = SanitiseUserInput($data['address_line_2']);
        $postal_code  = SanitiseUserInput($data['postal_code']);
        
        $dob = DateToMySQLDate($dob);
        
        $query = "
            UPDATE `users`
            SET `firstname`='$firstname',
                `lastname`='$lastname',
                `mobile`='$mobile',
                `email`='$email',
                `dob`='$dob',
                `address_line_1`='$address_line_1',
                `address_line_2`='$address_line_2',
                `postal_code`='$postal_code'
            WHERE `user_id`='$user_id'
        ";
        
        $result = $mysqli->query($query);
        $teacher = GetTeacherByID($teacher_id);
        
        return $teacher;
    }
?>