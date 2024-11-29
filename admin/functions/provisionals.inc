<?php

    function GetCoursesForStudent($student_id) {
        global $mysqli;
        
        $query = "
            SELECT *
            FROM xref_students_courses
            WHERE `student_id`='$student_id'
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        $courses = array();
        
        for ($i = 0; $i < $num_results; $i++) {
            $row = $result->fetch_assoc();
            $courses[] = $row['course_id'];
        }
        
        return $courses;
    }
    
    function ToggleCourseForStudent($student_id, $course_id) {
        global $mysqli;
        
        $query = "
            SELECT *
            FROM xref_students_courses
            WHERE `student_id`='$student_id' AND `course_id`='$course_id'
        ";
        
        // print $query;
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        if ($num_results > 0) {
            $query = "
                DELETE FROM xref_students_courses
                WHERE `student_id`='$student_id' AND `course_id`='$course_id'
            ";
            
            $result = $mysqli->query($query);
            
            return 0;
        } else {
            $query = "
                INSERT INTO xref_students_courses
                SET `student_id`='$student_id',
                    `course_id`='$course_id'
            ";
            
            $result = $mysqli->query($query);
        }
        
        return 1;
    }
    
    function GetTeachersForStudent($student_id) {
        global $mysqli;
        
        $query = "
            SELECT courses.*, users.*, subjects.category_id
            FROM xref_students_courses AS map
            LEFT JOIN courses ON courses.course_id=map.course_id
            LEFT JOIN subjects ON subjects.subject_id=courses.subject_id
            LEFT JOIN teachers ON teachers.teacher_id=courses.teacher_id
            LEFT JOIN users ON users.user_id=teachers.user_id
            WHERE `student_id`='$student_id'
            ORDER  BY users.firstname, courses.course_name
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        $teachers = array();
        
        for ($i = 0; $i < $num_results; $i++) {
            $teachers[] = $result->fetch_assoc();
        }
        
        return $teachers;
    }
    
    function AssignCourseToPeriod($student_id, $course_id, $day, $period_no) {
        global $mysqli;
        
        $query = "
            INSERT INTO `xref_students_courses_periods`
            SET `student_id`=$student_id,
                `course_id`=$course_id,
                `day`=$day,
                `period_no`=$period_no
        ";
        
        $result = $mysqli->query($query);
    }
    
    function GetProvisionalPeriodDetailsForStudent($student_id, $day, $period_no) {
        global $mysqli;
        
        $query = "
            SELECT courses.course_id, courses.course_name, courses.display_name, subjects.category_id, teachers.teacher_id, users.firstname, users.lastname, places.place_id, places.place_name, temp.status
            FROM `xref_students_courses_periods` AS temp
            LEFT JOIN courses ON courses.course_id=temp.course_id
            LEFT JOIN places ON places.place_id=courses.default_place_id
            LEFT JOIN subjects ON subjects.subject_id=courses.subject_id
            LEFT JOIN teachers ON teachers.teacher_id=courses.teacher_id
            LEFT JOIN users ON users.user_id=teachers.user_id
            WHERE student_id=$student_id AND temp.`day`=$day AND temp.`period_no`=$period_no
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        $period = array();
        
        if ($num_results) {
            $row = $result->fetch_assoc();
            $period = array(
                'course_id' => $row['course_id'],
                'course_name' => $row['course_name'],
                'display_name' => $row['display_name'],
                'category_id' => $row['category_id'],
                'place_id' => $row['place_id'],
                'place_name' => $row['place_name'],
                'teacher_id' => $row['teacher_id'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'status' => $row['status']
            );
        }
        
        return $period;
    }
    
    function GetProvisionalAttendeesForPeriod($student_id, $course_id, $day, $period_no) {
        global $mysqli;
        
        $query = "
            SELECT students.student_id, users.*, temp.status
            FROM `xref_students_courses_periods` AS temp
            LEFT JOIN students ON students.student_id=temp.student_id
            LEFT JOIN users ON users.user_id=students.user_id
            WHERE course_id=$course_id AND temp.`day`=$day AND temp.`period_no`=$period_no
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        $attendees = array();
        
        for ($i = 0; $i < $num_results; $i++) {
            $row = $result->fetch_assoc();
            
            if ($row['student_id'] != $student_id) {
                $attendees[] = $row;
            }
        }
        
        return $attendees;
    }
    
    function GetProvisionalTimetableForTeacherId($teacher_id) {
            global $mysqli;
           
            $timetable = array();
           
            $query = "
                SELECT temp.day, temp.period_no, students.student_id, users.*, temp.status, courses.course_id, courses.course_name, categories.category_id, places.*
                FROM `xref_students_courses_periods` AS temp
                LEFT JOIN students ON students.student_id=temp.student_id
                LEFT JOIN users ON users.user_id=students.user_id
                LEFT JOIN courses ON courses.course_id=temp.course_id
                LEFT JOIN subjects ON subjects.subject_id=courses.subject_id
                LEFT JOIN categories ON categories.category_id=subjects.category_id
                LEFT JOIN places ON places.place_id=courses.default_place_id
                WHERE courses.teacher_id=$teacher_id
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
                    
                    if (empty($timetable[$day][$period_no][$course_id])) {
                        $course = array(
                           'course_id' => $course_id,
                           'course_name' => $row['course_name'],
                           'category_id' => $row['category_id'],
                           'place_id' => $row['place_id'],
                           'place_name' => $row['place_name']
                        );
                        
                        $timetable[$day][$period_no][$course_id]['details'] = $course;
                    }
                    
                    $student = array(
                        'student_id' => $row['student_id'],
                        'firstname' => $row['firstname'],
                        'lastname' => $row['lastname'],
                        'display_name' => $row['display_name']
                    );
                    
                    $timetable[$day][$period_no][$course_id]['attendees'][] = $student;
                }
            }
           
            return $timetable;
       }
    
    function GetStudentsForTeacher($student_id) {
    global $mysqli;
    
        return array();
    }
    
    function BadgeColorForStatus($status) {
        switch ($status) {
        case 'pending':
            $status_color = 'yellow';
            break;
            
        case 'confirmed':
            $status_color = 'green';
            break;
            
        case 'denied':
            $status_color = 'red';
            break;
            
        case 'on_hold':
            $status_color = 'sky';
            break;
            
        default:
            $status_color = '';
        }
        
        return $status_color;
    }
?>