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
            SELECT `users`.*, `students`.* 
            FROM `students` 
            LEFT JOIN `users` 
            ON `students`.`user_id`=`users`.`user_id`
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
    
    function GetTeachers() {
        global $mysqli;
        
        $sudents = array();
        
        $query = "
            SELECT `users`.*, `teachers`.* 
            FROM `teachers` 
            LEFT JOIN `users` 
            ON `teachers`.`user_id`=`users`.`user_id`
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
    

?>