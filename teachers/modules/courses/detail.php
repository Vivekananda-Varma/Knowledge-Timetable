<?php

    include_once('admin/functions/courses.inc');
    
    $course = GetCourseByID($course_id);
    
    $page_title = $course['course_name'];
    
    $course_id = $course['course_id'];
    $category_id = $course['category_id'];
    $subject_id = $course['subject_id'];
    $teacher_id = $course['teacher_id'];
    $place_id = $course['default_place_id'] ?? '';
    $place_name = $course['place_name'] ?? 'Unspecified';
    
    $requirements = str_replace("\r\n", "<br>", $course['requirements'] ?? 'N/A');
    $blurb = str_replace("\r\n", "<br>", $course['blurb'] ?? 'N/A');
    
    $category_name = $course['category_name'];
    $subject_name = $course['subject_name'];
    $course_name = $course['course_name'];
    $display_name = $course['display_name'];
    
    $firstname = $course['firstname'];
    $lastname = $course['lastname'];
    $fullname = "$firstname $lastname";

    $color_index = $category_id % 14;
    $color = $colors[$color_index];
    
    $course_name_label = $course_name == $subject_name ? "Course / Subject Name" : "Course Name";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('templates/head.html'); ?>
    </head>

    <body>
        <div class="content-wrapper">
            <?php include('teachers/templates/header.html'); ?>

            <section id="snippet-2" class="wrapper bg-light wrapper-border">
                <div class="container pt-2 pt-md-17 pb-md-14">
                    <div class="row">
                        <div class="col-xl-10 mx-auto">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <a href="/teachers/courses/" class="d-flex align-items-center text-primary" style="font-weight: bold; text-decoration: none; cursor: pointer;">
                                    <i class="uil uil-angle-left" style="font-size: 1.5rem; margin-right: -2px;"></i>Back
                                </a>
                                <a href="/teachers/courses/id/<?= $course_id ?>/edit/" class="btn btn-soft-primary btn-sm px-3 py-1">Edit</a>
                            </div>
                            <div class="card shadow-none bg-soft-<?= $color ?>">
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
                        </div>
                    </div>
                </div>
            </section>
            
            
            <!-- /section -->
        </div>

        <?php include('templates/footer.html'); ?>
        <?php include('templates/foot.html'); ?>
    </body>
</html>
