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

?>