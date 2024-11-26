<?php

?>
<!DOCTYPE html>
<html lang="en">
   <head>
       <?php include('templates/head.html'); ?>
   </head>
    
    <body>
        <div class="content-wrapper">
            <?php include('students/templates/header.html'); ?>

            <section id="snippet-2" class="wrapper bg-light wrapper-border">
                <div class="container pt-2 pt-md-17 pb-md-14">
                    <div class="row">
                        <div class="col-xl-10 mx-auto">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="mb-0 text-center w-100">Teachers</h3>
                            </div>
                            <div class="teachers-list mb-10">
                    <?php
                        $previous_teacher_id = '';
                        
                        foreach($teachers as $teacher) {
                            $uid = $teacher['uid'];
                            $teacher_id = $teacher['teacher_id'];
                            $firstname = $teacher['firstname'];
                            $lastname = $teacher['lastname'];
                            $fullname = "<b>$firstname</b> $lastname";
                            $display_name = $teacher['display_name'];
                            
                            $category_id = $teacher['category_id'];
                            $course_id = $teacher['course_id'];
                            $course_name = $teacher['course_name'];
                            
                            $mobile = $teacher['mobile'];
                            $email = $teacher['email'];
                            $otp = $teacher['otp'];
                            $last_login = $teacher['last_login'] ?? 'Today 7:51 pm';
                            
                            // $num_courses = $teacher['num_courses'];
                            // $num_students = $teacher['num_students'];
                            // $num_periods = $teacher['num_periods'];
                            
                            if ($email != '') {
                                $email = "<a href=\"mailto:$email\">$email</a>";
                            }
                            
                            $color_index = $category_id % 14;
                            $color = $colors[$color_index];
                            
                            $profile_image_url = GetProfileImagePathForUID($uid);
                            
                            if ($teacher_id != $previous_teacher_id) {
                                if ($previous_teacher_id != '') {               // only close card html if we are in the middle of the loop 
                    ?>
                                                </div>
                                            </div>
                                            <i class="uil uil-angle-right-b"></i>
                                        </div>
                                    </div>
                                </div>
                    <?php
                                }
                                
                                $previous_teacher_id = $teacher_id;             // begin new card
                    ?> 
                                <div class="card mb-3 lift" data-href="/students/teachers/id/<?= $teacher_id ?>/">
                                    <div class="card-body p-5">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <div class="profile-pic me-4">
                                                    <img src="<?= $profile_image_url ?>" alt="Profile" />
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="text-body fw-bold text-start"><?= $fullname ?></span>
                    <?php
                            }
                    ?>
                                                    <span class="text-<?= $color ?> text-start"><?= $course_name ?></span>
                    <?php
                        }
                    ?>
                                                </div>
                                            </div>
                                            <i class="uil uil-angle-right-b"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include('templates/footer.html'); ?>
        <?php include('templates/foot.html'); ?>
    </body>
</html>
    
