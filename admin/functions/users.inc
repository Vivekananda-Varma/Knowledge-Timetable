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
?>