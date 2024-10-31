<?php

    function GetTimetableForStudentId($student_id) {
        global $mysqli;
        
        $timetable = array();
        
        $query = "
            SELECT periods.*, places.place_name, courses.course_name, teachers.teacher_id, users.firstname, users.lastname FROM `attendees`
            LEFT JOIN `periods` ON periods.period_id=attendees.period_id
            LEFT JOIN places ON places.place_id=periods.place_id
            LEFT JOIN courses ON courses.course_id=periods.course_id
            LEFT JOIN teachers ON teachers.teacher_id=courses.teacher_id
            LEFT JOIN users ON users.user_id=teachers.user_id
            WHERE student_id=$student_id
            ORDER BY day, period_no
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        if ($num_results == 0) {
            
        } else {
            for ($i = 0; $i < $num_results; $i++) {
                $row = $result->fetch_assoc();
                
                $day = $row['day'];
                $period_no = $row['period_no'];
                
                $course_id = $row['course_id'];
                $course_name = $row['course_name'];
                $place_id = $row['place_id'];
                $place_name = $row['place_name'];
                $teacher_id = $row['teacher_id'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                
                $peroid = array(
                    'course_id' => $course_id,
                    'course_name' => $course_name,
                    'place_id' => $place_id,
                    'place_name' => $place_name,
                    'teacher_id' => $teacher_id,
                    'firstname' => $firstname,
                    'lastname' => $lastname
                );
                
                $timetable[$day][$period_no] = $peroid;
            }
        }
        
        return $timetable;
    }
   
?>