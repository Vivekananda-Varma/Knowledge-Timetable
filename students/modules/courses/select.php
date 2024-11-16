<?php

    include_once('admin/functions/courses.inc');
    
    $courses = GetCourses();
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
                            <a href="/students/courses/" class="d-flex align-items-center text-primary" style="font-weight: bold; text-decoration: none; cursor: pointer;">
                                <i class="uil uil-angle-left" style="font-size: 1.5rem; margin-right: -2px;"></i>Back
                            </a>                               
                            <h3 class="mb-0 text-center w-100">Courses</h3>
                            <a href="#" class="text-primary ms-3" style="white-space: nowrap; font-weight: bold; text-decoration: none;">Done</a>
                        </div>
                        <form class="filter-form mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="uil uil-search" style="font-size: 1.2rem;"></i>
                                </span>
                                <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Search for courses or teachers...">
                            </div>
                        </form>
                        <div class="job-list mb-10">
                    <?php
                    
                        foreach($courses as $course) {
                            $course_id = $course['course_id'];
                            $category_id = $course['category_id'];
                            $subject_id = $course['subject_id'];
                            $teacher_id = $course['teacher_id'];
                            $place_id = $course['default_place_id'] ?? '';
                            
                            $subject_name = $course['subject_name'];
                            $course_name = $course['course_name'];
                            $display_name = $course['display_name'];
                            
                            $firstname = $course['firstname'];
                            $lastname = $course['lastname'];
                            $fullname = "$firstname $lastname";
                            
                            if ($display_name != '') {
                                $course_name = $display_name;
                            }
                    ?>    
                            <div class="card mb-3 lift" data-href="">
                                <div class="card-body p-5">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-2">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="text-body fw-bold text-start"><?= $course_name ?></span>
                                                <span class="text-muted text-start"><?= $fullname ?></span>
                                            </div>
                                        </div>
                                        <i class="uil uil-angle-right-b"></i>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include('templates/foot.html'); ?>
</body>

</html>