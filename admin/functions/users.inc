<?php

    function GetUsers() {
        global $mysqli;
        
        $users = array();
        
        $query = "
            SELECT * 
            FROM `users` 
            ORDER BY `firstname`
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        for ($i = 0; $i < $num_results; $i++) {
            $users[] = $result->fetch_assoc();
        }
        
        return $users;
    }
    
    function GetUserByID($user_id) {
        global $mysqli;
        
        $query = "
            SELECT * 
            FROM `users` 
            WHERE `user_id`=$user_id
        ";
        
        $result = $mysqli->query($query);
        if ($result->num_rows) {
            return $result->fetch_assoc();
        }
        
        return false;
    }
    
    function GetStudents() {
        global $mysqli;
        
        $sudents = array();
        
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
        
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $mobile = $data['mobile'];
        $email = $data['email'];
        $dob = $data['dob'];
        $address_line_1 = $data['address_line_1'];
        $address_line_2 = $data['address_line_2'];
        $postal_code  = $data['postal_code'];
        
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
        
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $legalname = $data['legalname'];
        $display_name = $data['display_name'];
        $mobile = $data['mobile'];
        $email = $data['email'];
        $dob = $data['dob'];
        $year = $data['year'];
        
        $query = "
            INSERT INTO `users`
            SET `firstname`='$firstname',
                `lastname`='$lastname',
                `legalname`='$legalname',
                `display_name`='$display_name',
                `mobile`='$mobile',
                `email`='$email',
                `dob`='$dob'
        ";
        
        // print "$query<br><br>";
        
        $result = $mysqli->query($query);
        $user_id = $mysqli->insert_id;
        
        $query = "
            INSERT INTO `students`
            SET `user_id`='$user_id',
                `year`='$year'
        ";
        
        $result = $mysqli->query($query);
        $student_id = $mysqli->insert_id;
        $student = GetTeacherByID($student_id);
        
        return $student;
    }
    
    function UpdateStudent($student_id, $data) {
        global $mysqli;
        
        $student = GetStudentByID($student_id);
        $user_id = $student['user_id'];
        $user = GetUserByID($user_id);
        
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $mobile = $data['mobile'];
        $email = $data['email'];
        $dob = $data['dob'];
        $address_line_1 = $data['address_line_1'];
        $address_line_2 = $data['address_line_2'];
        $postal_code  = $data['postal_code'];
        
        $year = $data['year'];
        $class_of = $data['class_of'];
        
        $query1 = "
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