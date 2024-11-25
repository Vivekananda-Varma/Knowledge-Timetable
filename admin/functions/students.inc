<?php

    function GetStudents() {
        global $mysqli;
        
        $students = array();
        
        $query = "
            SELECT `users`.*, `students`.*, 
            COUNT(attendees.student_id) AS num_periods
            FROM `students` 
            LEFT JOIN `users` 
            ON `students`.`user_id`=`users`.`user_id`
            LEFT JOIN `attendees`
            ON attendees.student_id=students.student_id
            GROUP BY students.student_id
            ORDER BY `firstname`
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        for ($i = 0; $i < $num_results; $i++) {
            $students[] = $result->fetch_assoc();
        }
        
        return $students;
    }
    
    function GetStudentByID($student_id) {
        global $mysqli;
        
        $query = "
            SELECT `users`.*, `students`.* 
            FROM `students` 
            LEFT JOIN `users` 
            ON `students`.`user_id`=`users`.`user_id`
            WHERE `student_id`=$student_id
        ";
        
        $result = $mysqli->query($query);
        if ($result->num_rows) {
            return $result->fetch_assoc();
        }
        
        return false;
    }
    
    function CreateStudent($data) {
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
        $student_id = $mysqli->insert_id;
        $student = GetStudentByID($student_id);
        
        return $student;
    }
    
    function ImportStudent($data) {
        global $mysqli;
        
        $uid = SanitiseUserInput($data[1]);
        $legalname = SanitiseUserInput($data[2]);
        $display_name = SanitiseUserInput($data[3]);
        $firstname = SanitiseUserInput($data[4]);
        $lastname = SanitiseUserInput($data[5]);
        $dob = SanitiseUserInput($data[6]);
        $gender = SanitiseUserInput($data[7]);
        $mobile = SanitiseUserInput($data[8]);
        $email = SanitiseUserInput($data[9]);
        $year = SanitiseUserInput($data[10]);
        
        $gender = strtoupper($gender);                   // M, F
        $dob = DateToMySQLDate($dob);
        $year = substr($year, 3, 1);			         // HC-1, HC-2, HC-3
        
        $query = "
            INSERT INTO `users`
            SET `uid`='$uid',
                `firstname`='$firstname',
                `lastname`='$lastname',
                `legalname`='$legalname',
                `display_name`='$display_name',
                `gender`='$gender',
                `mobile`='$mobile',
                `email`='$email',
                `dob`='$dob'
            ON DUPLICATE KEY UPDATE
                `firstname`='$firstname',
                `lastname`='$lastname',
                `legalname`='$legalname',
                `display_name`='$display_name',
                `gender`='$gender',
                `mobile`='$mobile',
                `email`='$email',
                `dob`='$dob'
        ";
        
        // print "$query<br><br>"; return;
        
        $result = $mysqli->query($query);
        $user_id = $mysqli->insert_id;
        
        $query = "
            INSERT INTO `students`
            SET `user_id`='$user_id',
                `year`='$year'
        ";
        
        $result = $mysqli->query($query);
        $student_id = $mysqli->insert_id;
        $student = GetStudentByID($student_id);
        
        return $student;
    }
    
    function UpdateStudent($student_id, $data) {
        global $mysqli;
        
        $student = GetStudentByID($student_id);
        $user_id = $student['user_id'];
        $user = GetUserByID($user_id);
        
        $uid = SanitiseUserInput($data['uid'] ?? '');
        $firstname = SanitiseUserInput($data['firstname']);
        $lastname = SanitiseUserInput($data['lastname']);
        $legalname = SanitiseUserInput($data['legal_name'] ?? '');
        $display_name = SanitiseUserInput($data['display_name'] ?? '');
        $gender = SanitiseUserInput($data['gender'] ?? '');
        $mobile = SanitiseUserInput($data['mobile']);
        $email = SanitiseUserInput($data['email']);
        $dob = SanitiseUserInput($data['dob']);
        $address_line_1 = SanitiseUserInput($data['address_line_1']);
        $address_line_2 = SanitiseUserInput($data['address_line_2']);
        $postal_code  = SanitiseUserInput($data['postal_code']);
        
        $dob = DateToMySQLDate($dob);
        
        $year = $data['year'];
        $class_of = SanitiseUserInput($data['class_of']);
        
        $query1 = "
            UPDATE `users`
            SET `firstname`='$firstname',
                `lastname`='$lastname',
                `legalname`='$legalname',
                `display_name`='$display_name',
                `gender`='$gender',
                `mobile`='$mobile',
                `email`='$email',
                `dob`='$dob',
                `address_line_1`='$address_line_1',
                `address_line_2`='$address_line_2',
                `postal_code`='$postal_code'
            WHERE `user_id`='$user_id'
        ";
        
        $query2 = "
            UPDATE `students`
            SET `year`='$year',
                `class_of`='$class_of'
            WHERE `student_id`='$student_id'
        ";
        
        $result = $mysqli->query($query1);
        $result = $mysqli->query($query2);
        
        $student = GetStudentByID($student_id);
        
        return $student;
    }
?>