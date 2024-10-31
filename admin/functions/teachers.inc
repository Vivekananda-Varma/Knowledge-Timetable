<?php

    function GetTeachers() {
        global $mysqli;
        
        $sudents = array();
        
        $query = "
            SELECT `users`.*, `teachers`.*, 
            COUNT(courses.course_id) AS num_subjects
            FROM `teachers` 
            LEFT JOIN `users` 
            ON `teachers`.`user_id`=`users`.`user_id`
            LEFT JOIN courses
            ON courses.teacher_id=teachers.teacher_id
            GROUP BY teachers.teacher_id
            ORDER BY `firstname`
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        for ($i = 0; $i < $num_results; $i++) {
            $teachers[] = $result->fetch_assoc();
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
    
    function GetTeacherByFirstname($firstname) {
        global $mysqli;
        
        $query = "
            SELECT `users`.*, `teachers`.* 
            FROM `teachers` 
            LEFT JOIN `users` 
            ON `teachers`.`user_id`=`users`.`user_id`
            WHERE `firstname`='$firstname'
        ";
        
        $result = $mysqli->query($query);
        if ($result->num_rows) {
            return $result->fetch_assoc();
        }
        
        return false;
    }
    
    function CreateTeacher($data) {
        global $mysqli;
        
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $salutation = '';
                
        $mobile = $data['mobile'];
        $email = $data['email'];
        $dob = $data['dob'] ?? '';
        $address_line_1 = $data['address_line_1'] ?? '';
        $address_line_2 = $data['address_line_2'] ?? '';
        $postal_code  = $data['postal_code'] ?? '';
        
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
        $user_id = $mysqli->insert_id;
        
        $query = "
            INSERT INTO `teachers`
            SET `user_id`='$user_id',
                `salutation`='$salutation'
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
        
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $mobile = $data['mobile'];
        $email = $data['email'];
        $dob = $data['dob'];
        $address_line_1 = $data['address_line_1'];
        $address_line_2 = $data['address_line_2'];
        $postal_code  = $data['postal_code'];
        
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