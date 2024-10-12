<?php

    function GetCategories() {
        global $mysqli;
        
        $categories = array();
        
        $query = "
            SELECT * 
            FROM `categories` 
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
            WHERE `category_id`=$$category_id
        ";
        
        $result = $mysqli->query($query);
        if ($result->num_rows) {
            return $result->fetch_assoc();
        }
        
        return false;
    }

?>