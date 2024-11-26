<?php

    function ValidateAdminLogin($username, $password) {
    global $admin_username;
    global $admin_password;
        
        return ($username == $admin_username && $password == $admin_password);
    }
    
    function ValidateUserLogin($email, $otp) {
        global $mysqli;
        
        $query = "
            SELECT users.*, students.student_id, teachers.teacher_id
            FROM `users` 
            LEFT JOIN `students`
            ON `students`.user_id=users.user_id
            LEFT JOIN `teachers`
            ON `teachers`.user_id=users.user_id
            WHERE `email`='$email' AND `otp`='$otp'
        ";
        
        $result = $mysqli->query($query);
        $num_results = $result->num_rows;
        
        if ($num_results > 0) {
            $user = $result->fetch_assoc();
            $user_id = $user['user_id'];
            
            $query = "
                UPDATE `users`
                SET `otp`=NULL,
                    `last_login`=NOW()
                WHERE `user_id`=$user_id
            ";
            
            $result = $mysqli->query($query);
            
            return $user;
        }
        
        return false;
    }
    
    function RequiresLogin() {
        if (!isset($_SESSION['login_user'])) {
            Redirect('/login/');
            exit;
        }
        
        return $_SESSION['login_user'];
    }

    function RequiresAdminLogin() {
        if (!isset($_SESSION['login_user'])) {
            Redirect('/admin/login/');
            exit;
        }
        
        if (!isset($_SESSION['login_user']['is_admin'])) {
            Redirect('/admin/login/');
            exit;
        }
        
        return $_SESSION['login_user'];
    }
    
    function GenerateOTPForUser($email) {
        global $mysqli;
        
        $otp = random_int(100000, 999999);
        
        $query = "
            UPDATE `users`
            SET `otp`='$otp'
            WHERE `email`='$email'
        ";
        
        $result = $mysqli->query($query);
        
        return $otp;
    }
?>
