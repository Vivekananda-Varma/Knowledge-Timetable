<?php

    function GetCourses() {
        global $mysqli;
        
        $courses = array();
        
        $query = "
            SELECT `courses`.*, `subjects`.*, `teachers`.*, `users`.*
            FROM `courses`
            LEFT JOIN `subjects` 
            ON `courses`.`subject_id`=`subjects`.`subject_id`
            LEFT JOIN `teachers` 
            ON `courses`.`teacher_id`=`teachers`.`teacher_id`
            LEFT JOIN `users` 
            ON `teachers`.`user_id`=`users`.`user_id`
            ORDER BY `course_name`
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        for ($i = 0; $i < $num_results; $i++) {
            $courses[] = $result->fetch_assoc();
        }
        
        return $courses;
    }
    
    function GetCourseByID($course_id) {
        global $mysqli;
        
        $query = "
            SELECT `courses`.*, `subjects`.* 
            FROM `courses`
            LEFT JOIN `subjects` 
            ON `courses`.`subject_id`=`subjects`.`subject_id`
            WHERE `course_id`=$course_id
        ";
        
        $result = $mysqli->query($query);
        if ($result->num_rows) {
            return $result->fetch_assoc();
        }
        
        return false;
    }
    
    // function CreateCourse($data) {
    //     global $mysqli;
    //     
    //     $subject_name = $data['subject_name'];
    //     $category_id = $data['category_id'];
    //     $is_academic = $data['is_academic'];
    //     
    //     $query = "
    //         INSERT INTO `subjects`
    //         SET `category_id`='$category_id',
    //             `subject_name`='$subject_name',
    //             `is_academic`=$is_academic
    //     ";
    //     
    //     $result = $mysqli->query($query);
    //     $subject_id = $mysqli->insert_id;
    //     $subject = GetSubjectByID($subject_id);
    //     
    //     return $subject;
    // }


?>