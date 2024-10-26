<?php

    function GetCategories() {
        global $mysqli;
        
        $categories = array();
        
        // $query = "
        //     SELECT * 
        //     FROM `categories` 
        //     ORDER BY `category_name`
        // ";
        
        $query = "
            SELECT categories.*, COUNT(subjects.category_id) AS num_subjects, COUNT(courses.subject_id) AS num_teachers
            FROM `categories`
            LEFT JOIN `subjects` ON categories.category_id=subjects.category_id
            LEFT JOIN `courses` ON subjects.subject_id=courses.subject_id
            GROUP BY subjects.category_id, courses.subject_id
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
    
    function CreateCategory($data) {
        global $mysqli;
        
        $category_name = $data['category_name'];
        
        $query = "
            INSERT INTO `categories`
            SET `category_name`='$category_name',
        ";
        
        $result = $mysqli->query($query);
        $category_id = $mysqli->insert_id;
        $category = GetCategoryByID($category_id);
        
        return $category;
    }
    
    function UpdateCategory($data) {
        global $mysqli;
        
        $category_name = $data['category_name'];
        
        $query = "
            UPDATE `categories`
            SET `category_name`='$category_name',
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