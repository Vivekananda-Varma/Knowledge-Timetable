<?php

    include('admin/functions/courses.inc');        
    include('admin/functions/timetable.inc');        

    $period = GetPeriodDetailsForStudent($student_id, $day, $period_no);
    
    $place = $period['place_name'] ?? '';
    $category_id = $period['category_id'];
    $course_id = $period['course_id'];
    $subject = $period['course_name'] ?? '&nbsp;';
    $course_display_name = $period['display_name'] ?? '';
    $teacher_id = $period['teacher_id'] ?? '';
    $teacher = $period['firstname'] ?? '&nbsp;';
    $place = $period['place_name'] ?? '&nbsp;';
    
    $color_index = ($category_id - 11) % 14;
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
                                <h3 class="card-title mb-0 w-100 text-center"><?= $page_title ?></h3>
                                <a href="select.php" class="btn btn-soft-primary p-1">Choose</a>
                            </div>
                            <div class="card shadow-none">
                                <div class="card-header subject px-4 py-2 border-0 bg-<?= $color ?> text-white"><?= $course_display_name ?></div>
                                <div class="card-body p-4 bg-pale-<?= $color ?> text-<?= $color ?>"><?= $teacher ?></div>
                                <div class="card-footer place px-4 py-2 border-0 bg-soft-<?= $color ?> text-<?= $color ?>"><?= $place ?></div>
                            </div>
                            
                            <div class="card shadow-none mt-4 bg-soft-<?= $color ?>">
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
                                        <div class="col-12 col-md-4 col-lg-3">Description</div>
                                        <div class="col-12 col-md-8 col-lg-9"><?= $blurb ?></div>
                                    </div> 
                                    <div class="row pt-1 pb-2">
                                        <div class="col-12 col-md-4 col-lg-3">Requirements</div>
                                        <div class="col-12 col-md-8 col-lg-9 "><?= $requirements ?></div>
                                    </div>
                                </div>
                            </div>
                            
                            <h3 class="card-title mb-0 w-100 text-center mt-4">Classmates</h3>
                            <p class="lead text-center mb-10 px-md-16 px-lg-0">Others who have signed up for this course on this period.</p>
                            <div id="accordion-1" class="accordion-wrapper">
                                <div class="card shadow-none accordion-item">
                                    <div class="card-header" id="accordion-heading-1-1">
                                        <button class="collapsed d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-1-1" aria-expanded="false" aria-controls="accordion-collapse-1-1">
                                            <span class="avatar bg-red text-white w-9 h-9 fs-17 me-1">AR</span>
                                            <span class="avatar bg-green text-white w-9 h-9 fs-17 me-1">A</span>
                                            <span class="avatar bg-blue text-white w-9 h-9 fs-17 me-1">AD</span>
                                            <span class="avatar bg-yellow text-white w-9 h-9 fs-17 me-1">CS</span>
                                            <span class="avatar bg-purple text-white w-9 h-9 fs-17 me-1">HS</span>
                                            <span class="ms-2">+3</span>
                                        </button>
                                    </div>                                    
                                    <div id="accordion-collapse-1-1" class="collapse" aria-labelledby="accordion-heading-1-1" data-bs-target="#accordion-1">
                                        <div class="card-body">
                                            <span class="col-md-5 mb-2 mb-md-0 d-flex align-items-center text-body">
                                                <span class="avatar bg-red text-white w-9 h-9 fs-17 me-3">AR</span>Aadya Ramswaroop</span>
                                            <span class="col-md-5 mb-2 mb-md-0 d-flex align-items-center text-body">
                                                <span class="avatar bg-green text-white w-9 h-9 fs-17 me-3">A</span>Agastya</span>
                                            <span class="col-md-5 mb-2 mb-md-0 d-flex align-items-center text-body">
                                                <span class="avatar bg-blue text-white w-9 h-9 fs-17 me-3">AD</span>Arunaditya Das</span>
                                            <span class="col-md-5 mb-2 mb-md-0 d-flex align-items-center text-body">
                                                <span class="avatar bg-yellow text-white w-9 h-9 fs-17 me-3">CS</span>Chaitanya Sharma</span>
                                            <span class="col-md-5 mb-2 mb-md-0 d-flex align-items-center text-body">
                                                <span class="avatar bg-purple text-white w-9 h-9 fs-17 me-3">HS</span>Harshit Somani</span>
                                            <span class="col-md-5 mb-2 mb-md-0 d-flex align-items-center text-body">
                                                <span class="avatar bg-pink text-white w-9 h-9 fs-17 me-3">HM</span>Harumi Mima</span>
                                            <span class="col-md-5 mb-2 mb-md-0 d-flex align-items-center text-body">
                                                <span class="avatar bg-<?= $color ?> text-white w-9 h-9 fs-17 me-3">RM</span>Ritaja Mishra</span>
                                            <span class="col-md-5 mb-2 mb-md-0 d-flex align-items-center text-body">
                                                <span class="avatar bg-orange text-white w-9 h-9 fs-17 me-3">VG</span>Vivekananda Gokaraju</span>
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
