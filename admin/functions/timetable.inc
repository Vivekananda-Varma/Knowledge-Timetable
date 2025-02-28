<?php

    function GetTimetableForStudentId($student_id) {
        global $mysqli;
        
        $timetable = array();
        
        $query = "
            SELECT periods.*, places.place_name, courses.course_name, courses.display_name, subjects.category_id, teachers.teacher_id, users.firstname, users.lastname
            FROM `attendees`
            LEFT JOIN `periods` ON periods.period_id=attendees.period_id
            LEFT JOIN places ON places.place_id=periods.place_id
            LEFT JOIN courses ON courses.course_id=periods.course_id
            LEFT JOIN subjects ON subjects.subject_id=courses.subject_id
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
                $display_name = $row['display_name'];
                $category_id = $row['category_id'];
                $place_id = $row['place_id'];
                $place_name = $row['place_name'];
                $teacher_id = $row['teacher_id'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                
                $peroid = array(
                    'course_id' => $course_id,
                    'course_name' => $course_name,
                    'display_name' => $display_name,
                    'category_id' => $category_id,
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
    
    function GetPeriodDetailsForStudent($student_id, $day, $period_no) {
        global $mysqli;
        
        $timetable = array();
        
        $query = "
            SELECT periods.*, places.place_name, courses.course_name, courses.display_name, subjects.category_id, teachers.teacher_id, users.firstname, users.lastname
            FROM `attendees`
            LEFT JOIN `periods` ON periods.period_id=attendees.period_id
            LEFT JOIN places ON places.place_id=periods.place_id
            LEFT JOIN courses ON courses.course_id=periods.course_id
            LEFT JOIN subjects ON subjects.subject_id=courses.subject_id
            LEFT JOIN teachers ON teachers.teacher_id=courses.teacher_id
            LEFT JOIN users ON users.user_id=teachers.user_id
            WHERE student_id=$student_id AND `periods`.`day`=$day AND `periods`.`period_no`=$period_no
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        $period = array();
        
        if ($num_results) {
            $row = $result->fetch_assoc();
            
            $day = $row['day'];
            $period_no = $row['period_no'];
            
            $course_id = $row['course_id'];
            $course_name = $row['course_name'];
            $display_name = $row['display_name'];
            $category_id = $row['category_id'];
            $place_id = $row['place_id'];
            $place_name = $row['place_name'];
            $teacher_id = $row['teacher_id'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            
            $period = array(
                'course_id' => $course_id,
                'course_name' => $course_name,
                'display_name' => $display_name,
                'category_id' => $category_id,
                'place_id' => $place_id,
                'place_name' => $place_name,
                'teacher_id' => $teacher_id,
                'firstname' => $firstname,
                'lastname' => $lastname
            );
        }
        
        return $period;
    }
   
    function GetTimetableForTeacherId($teacher_id) {
        global $mysqli;
       
        $timetable = array();
       
        $query = "
            SELECT periods.*, places.*, courses.*
            FROM `courses`
            LEFT JOIN `periods` ON periods.course_id=courses.course_id
            LEFT JOIN places ON places.place_id=periods.place_id
            WHERE teacher_id=$teacher_id
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
                
                $peroid = array(
                   'course_id' => $course_id,
                   'course_name' => $course_name,
                   'place_id' => $place_id,
                   'place_name' => $place_name,
                );
                
                $timetable[$day][$period_no] = $peroid;
            }
        }
       
        return $timetable;
   }
   
?>