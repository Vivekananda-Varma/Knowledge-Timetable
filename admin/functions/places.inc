<?php

    function GetPlaces() {
        global $mysqli;
        
        $places = array();
        
        $query = "
            SELECT * 
            FROM `places` 
            ORDER BY `place_name`
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        for ($i = 0; $i < $num_results; $i++) {
            $places[] = $result->fetch_assoc();
        }
        
        return $places;
    }

?>