<?php

    function GetSubjects() {
        global $mysqli;
        
        $subjects = array();
        
        $query = "
            SELECT `subjects`.*, `categories`.`category_name`, 
            COUNT(courses.course_id) AS num_courses, 
            COUNT(courses.teacher_id) AS num_teachers
            FROM `subjects`
            LEFT JOIN `categories` ON `subjects`.`category_id`=`categories`.`category_id`
            LEFT JOIN courses ON courses.subject_id=subjects.subject_id
            GROUP BY subjects.subject_id
            ORDER BY `subject_name`
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        for ($i = 0; $i < $num_results; $i++) {
            $subjects[] = $result->fetch_assoc();
        }
        
        return $subjects;
    }
    
    function GetSubjectsForCategory($category_id) {
        global $mysqli;
        
        $subjects = array();
        
        $query = "
            SELECT `subjects`.*, `categories`.`category_name`
            FROM `subjects`
            LEFT JOIN `categories` ON `subjects`.`category_id`=`categories`.`category_id`
            WHERE `subjects`.`category_id`=$category_id
            ORDER BY `subject_name`
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        for ($i = 0; $i < $num_results; $i++) {
            $subjects[] = $result->fetch_assoc();
        }
        
        return $subjects;
    }
    
    function GetSubjectByID($subject_id) {
        global $mysqli;
        
        $query = "
            SELECT * 
            FROM `subjects` 
            WHERE `subject_id`=$subject_id
        ";
        
        $result = $mysqli->query($query);
        if ($result->num_rows) {
            return $result->fetch_assoc();
        }
        
        return false;
    }
    
    function GetSubjectByName($subject_name) {
        global $mysqli;
        
        $query = "
            SELECT * 
            FROM `subjects` 
            WHERE `subject_name`='$subject_name'
        ";
        
        $result = $mysqli->query($query);
        if ($result->num_rows) {
            return $result->fetch_assoc();
        }
        
        return false;
    }
    
    function CreateSubject($data) {
        global $mysqli;
        
        $subject_name = SanitiseUserInput($data['subject_name']);
        $category_id = $data['category_id'];
        // $is_academic = $data['is_academic'];
        
        $query = "
            INSERT INTO `subjects`
            SET `category_id`='$category_id',
                `subject_name`='$subject_name'
        ";
        
        // print $query; exit;
        
        $result = $mysqli->query($query);
        $subject_id = $mysqli->insert_id;
        $subject = GetSubjectByID($subject_id);
        
        return $subject;
    }
    
    function UpdateSubject($subject_id, $data) {
        global $mysqli;
        
        $subject_name = SanitiseUserInput($data['subject_name']);
        $display_name = SanitiseUserInput($data['display_name']);
        $category_id = $data['category_id'];
        
        $query = "
            UPDATE `subjects`
            SET `category_id`='$category_id',
                `subject_name`='$subject_name',
                `display_name`='$display_name'
            WHERE `subject_id`=$subject_id
        ";
        
        $result = $mysqli->query($query);
        $subject = GetSubjectByID($subject_id);
        
        return $subject;
    }
    
    function DeleteSubject($subject_id) {
        global $mysqli;
        
        $query = "
            DELETE FROM `subjects` 
            WHERE `subject_id`=$subject_id
        ";
        
        $result = $mysqli->query($query);
    }

?>