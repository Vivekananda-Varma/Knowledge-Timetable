<?php

    include('admin/functions/courses.inc');        
    include('admin/functions/timetable.inc');  
    
    $period = GetPeriodDetailsForStudent($student_id, $day, $period_no);
    $status = '';
    
    if (empty($period)) {
        $period = GetProvisionalPeriodDetailsForStudent($student_id, $day, $period_no);
        $status = str_replace('_', ' ', $period['status'] ?? '');
    }
    
    if (empty($period)) {
        Redirect("/students/timetable/period/$day/$period_no/select/");
    }
    
    $place = $period['place_name'] ?? '';
    $category_id = $period['category_id'] ?? '';
    $course_id = $period['course_id'] ?? '';
    $subject = $period['course_name'] ?? '&nbsp;';
    $course_display_name = $period['display_name'] ?? '';
    $teacher_id = $period['teacher_id'] ?? '';
    $teacher = $period['firstname'] ?? '&nbsp;';
    $place = $period['place_name'] ?? '&nbsp;';
    
    $color_index = $category_id % 14;
    $color = $colors[$color_index];
    
    if ($course_display_name == '') {
        $course_display_name = $subject;
    }
    
    $course_display_name = str_replace(' and ', ' &amp; ', $course_display_name);
    
    $course = GetCourseByID($course_id);
    
    $course_id = $course['course_id'];
    $category_id = $course['category_id'];
    $subject_id = $course['subject_id'];
    $teacher_id = $course['teacher_id'];
    $place_id = $course['default_place_id'] ?? '';
    $place_name = $course['place_name'] ?? '';
    
    $requirements = str_replace("\r\n", "<br>", $course['requirements'] ?? 'N/A');
    $blurb = str_replace("\r\n", "<br>", $course['blurb'] ?? 'N/A');
    
    $category_name = $course['category_name'];
    $subject_name = $course['subject_name'];
    $course_name = $course['course_name'];
    $display_name = $course['display_name'];
    
    $firstname = $course['firstname'];
    $lastname = $course['lastname'];
    $fullname = "$firstname $lastname";
    
    $course_name_label = $course_name == $subject_name ? "Course / Subject Name" : "Course Name";
    
    $status_color = BadgeColorForStatus($status);
    
    if ($status_color != '') {
        $status_title = ucfirst($status);
        $status_label = substr($status_title, 0, 1);
        $status_badge = "<div class=\"badge bg-$status_color rounded-pill ms-2 px-4 \">$status_title</div>";
    } else {
        $status_badge = '';
    }
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
                                <a href="javascript:history.back()" class="d-flex align-items-center text-primary" style="font-weight: bold; text-decoration: none; cursor: pointer;">
                                    <i class="uil uil-angle-left" style="font-size: 1.5rem; margin-right: -2px;"></i>Back
                                </a>
                                <h3 class="card-title mb-0 w-100 text-center"><?= $page_title ?> <?= $status_badge ?></h3>
                                <a href="select.php" class="btn btn-soft-primary px-2 py-1">Change</a>
                            </div>
                            <div class="card shadow-none">
                                <div id="course-header" class="card-header subject px-4 py-2 border-0 bg-<?= $color ?> text-white">
                                    <?= $course_display_name ?>
                                    <a href="" class="float-end mt-2" data-bs-toggle="collapse" data-bs-target="#course-details" aria-expanded="true" aria-controls="course-details">
                                        <i class="uil uil-info-circle text-white fs-24"></i>
                                    </a>
                                </div>
                                <div class="card-body p-4 bg-pale-<?= $color ?> text-<?= $color ?>"><?= $teacher ?></div>
                                <div class="card-footer place px-4 py-2 border-0 bg-soft-<?= $color ?> text-<?= $color ?>"><?= $place ?></div>
                            </div>
                            
                            <div id="course-details" aria-labelledby="course-header" class="accordion-collapse collapse hide card shadow-none mt-4 bg-soft-<?= $color ?>">
                                <div class="card-body text-<?= $color ?>">
                                    <h4 class="mb-3 text-<?= $color ?>" style="text-align: left; font-weight: bold;">Course Details</h4>
                                    <div class="row pt-1 pb-2 border-bottom border-soft-<?= $color ?>">
                                        <div class="col-12 col-md-4 col-lg-3"><?= $course_name_label ?></div>
                                        <div class="col-12 col-md-8 col-lg-9"><?= $course_name ?></div>
                                    </div>
                                <?php
                                    if ($course_name != $subject_name) {
                                ?>
                                    <div class="row pt-1 pb-2 border-bottom border-soft-<?= $color ?>">
                                        <div class="col-12 col-md-4 col-lg-3">Subject</div>
                                        <div class="col-12 col-md-8 col-lg-9"><?= $subject_name ?></div>
                                    </div>   
                                <?php
                                    }
                                ?>
                                    <div class="row pt-1 pb-2 border-bottom border-soft-<?= $color ?>">
                                        <div class="col-12 col-md-4 col-lg-3">Category</div>
                                        <div class="col-12 col-md-8 col-lg-9"><?= $category_name ?></div>
                                    </div> 
                                    <div class="row pt-1 pb-2 border-bottom border-soft-<?= $color ?>">
                                        <div class="col-12 col-md-4 col-lg-3">Teacher</div>
                                        <div class="col-12 col-md-8 col-lg-9"><?= $fullname ?></div>
                                    </div> 
                                    <div class="row pt-1 pb-2 border-bottom border-soft-<?= $color ?>">
                                        <div class="col-12 col-md-4 col-lg-3">Duration of Course</div>
                                        <div class="col-12 col-md-8 col-lg-9">3 years</div>
                                    </div> 
                                    <div class="row pt-1 pb-2 border-bottom border-soft-<?= $color ?>">
                                        <div class="col-12 col-md-4 col-lg-3">Preferred Place</div>
                                        <div class="col-12 col-md-8 col-lg-9"><?= $place_name ?></div>
                                    </div>
                                    <div class="row pt-1 pb-2 border-bottom border-soft-<?= $color ?>">
                                        <div class="col-12 col-md-4 col-lg-3">Description</div>
                                        <div class="col-12 col-md-8 col-lg-9"><?= $blurb ?></div>
                                    </div> 
                                    <div class="row pt-1 pb-2">
                                        <div class="col-12 col-md-4 col-lg-3">Requirements</div>
                                        <div class="col-12 col-md-8 col-lg-9 "><?= $requirements ?></div>
                                    </div>
                                </div>
                            </div>
                            
                            <h3 class="card-title mb-0 w-100 mt-4">Your classmates</h3>
                            <p class="lead mb-4 px-md-16 px-lg-0">Other students who want to sign up for this course in this period.</p>
                            <div class="card shadow-none">
                                <div class="card-body">
                            <?php
                                $attendees = GetProvisionalAttendeesForPeriod($student_id, $course_id, $day, $period_no);
                                $num_attendees = count($attendees);
                                $num_in_summary = $num_attendees < 6 ? $num_attendees : 3;
                                    
                                $i = 0;
                                foreach($attendees as $attendee) {
                                    $uid = $attendee['uid'];
                                    $firstname = $attendee['firstname'];
                                    $lastname = $attendee['lastname'];
                                    
                                    $status = $attendee['status'];
                                    $status_color = BadgeColorForStatus($status);
                                    
                                    $avatar_url = GetProfileImagePathForUID($uid, false);   // failover: false returns ''
                                    
                                    if ($avatar_url == '') {
                                        $f = substr($firstname, 0, 1);
                                        $l = substr($lastname, 0, 1);
                                        
                                        if ($status_color == '') {
                                            $color_index = random_int(0, count($colors) - 1);
                                            $color = $colors[$color_index];
                                        } else {
                                            $color = $status_color;
                                        }
                                        
                                        $avatar = "<span class=\"avatar bg-$color text-white w-12 h-12 fs-17 me-1\">$f$l</span>";
                                    } else {
                                        $avatar = "<img src=\"$avatar_url\" class=\"img-fluid rounded-circle me-1 w-12 h-12\" />";
                                    }
                                    
                                    if ($status_color != '') {
                                        $status = str_replace('_', ' ', $status);
                                        $status_title = ucwords($status);
                                        $status_label = substr($status_title, 0, 1);
                                    } else {
                                        $status_badge = '';
                                    }
                            ?>
                                    <a data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="bottom" title="<?= $firstname ?>" data-bs-content="<?= htmlspecialchars($status_badge, ENT_QUOTES) ?>" data-bs-html="true">
                                        <span class="d-inline-flex position-relative">
                                            <span class="position-absolute bottom-0 end-0 bg-<?= $status_color ?> border border-2 border-light rounded-circle" style="padding: 8px">
                                                <span class="visually-hidden"><?= $status ?></span>
                                            </span>
                                            <?= $avatar ?>
                                        </span>
                                    </a>
                            <?php
                                }
                            ?>
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
