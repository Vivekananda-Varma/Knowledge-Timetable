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

?>