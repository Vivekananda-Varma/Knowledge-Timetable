<?php

    function GetUsers($filter='') {
        global $mysqli;
        
        $users = array();
        $where_clause = '';
        
        switch($filter) {
            case 'students':
                $where_clause = "WHERE `is_teacher`<>1";
                break;
                
            case 'teachers':
                $where_clause = "WHERE `is_teacher`=1";
                break;
                
            default:
                $where_clause = '';  
        }
        
        $query = "
            SELECT * 
            FROM `users` 
            $where_clause
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