<?php

    function GetCategories() {
        global $mysqli;
        
        $categories = array();
        
        $query = "
            SELECT categories.*, 
            COUNT(subjects.subject_id) as num_subjects, 
            COUNT(courses.teacher_id) as num_teachers
            FROM `categories`
            LEFT JOIN `subjects` ON subjects.category_id=categories.category_id
            LEFT JOIN `courses` ON courses.subject_id=subjects.subject_id
            GROUP BY category_id
            ORDER BY `category_name`
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        for ($i = 0; $i < $num_results; $i++) {
            $categories[] = $result->fetch_assoc();
        }
        
        return $categories;
    }
    
    function GetCategoryByID($category_id) {
        global $mysqli;
        
        $query = "
            SELECT * 
            FROM `categories` 
            WHERE `category_id`=$category_id
        ";
        
        $result = $mysqli->query($query);
        if ($result->num_rows) {
            return $result->fetch_assoc();
        }
        
        return false;
    }
    
    function GetCategoryByName($category_name) {
        global $mysqli;
        
        $query = "
            SELECT * 
            FROM `categories` 
            WHERE `category_name`='$category_name'
        ";
        
        $result = $mysqli->query($query);
        if ($result->num_rows) {
            return $result->fetch_assoc();
        }
        
        return false;
    }
    
    function CreateCategory($data) {
        global $mysqli;
        
        $category_name = SanitiseUserInput($data['category_name']);
        
        $query = "
            INSERT INTO `categories`
            SET `category_name`='$category_name'
        ";
        
        $result = $mysqli->query($query);
        $category_id = $mysqli->insert_id;
        $category = GetCategoryByID($category_id);
        
        return $category;
    }
    
    function UpdateCategory($category_id, $data) {
        global $mysqli;
        
        $category_name = $data['category_name'];
        
        $query = "
            UPDATE `categories`
            SET `category_name`='$category_name'
            WHERE `category_id`=$category_id
        ";
        
        $result = $mysqli->query($query);
        $category = GetCategoryByID($category_id);
        
        return $category;
    }
    
    function DeleteCategory($category_id) {
        global $mysqli;
        
        $query = "
            DELETE FROM `categories` 
            WHERE `category_id`=$category_id
        ";
        
        $result = $mysqli->query($query);
    }

?>