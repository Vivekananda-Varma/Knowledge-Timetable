<?php

    include_once('admin/functions/courses.inc');
    
    $course = GetCourseByID($course_id);
    
    $page_title = $course['course_name'];
    
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

    $color_index = ($category_id - 11) % 14;
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
            <?php include('students/templates/header.html'); ?>

            <section id="snippet-2" class="wrapper bg-light wrapper-border">
                <div class="container pt-2 pt-md-17 pb-md-14">
                    <div class="row">
                        <div class="col-xl-10 mx-auto">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <a href="javascript:history.back()" class="d-flex align-items-center text-primary" style="font-weight: bold; text-decoration: none; cursor: pointer;">
                                    <i class="uil uil-angle-left" style="font-size: 1.5rem; margin-right: -2px;"></i>Back
                                </a>                               
                            </div>
                            <div class="card shadow-none bg-soft-<?= $color ?>">
                                <div class="card-body">
                                    <h4 class="mb-3  text-<?= $color ?>" style="text-align: left; font-weight: bold;">Course Details</h4>
                                    <div class="card-body text-<?= $color ?>">
                                        <table class="table table-sm my-2 text-<?= $color ?>">
                                            <tbody>
                                                <tr>
                                                    <td width="25%" class="align-text-top"><?= $course_name_label ?></td>
                                                    <td class="align-text-top"><?= $course_name ?></td>
                                                </tr>
                                            <?php
                                                if ($course_name != $subject_name) {
                                            ?>
                                                <tr>
                                                    <td class="align-text-top">Subject</td>
                                                    <td class="align-text-top"><?= $subject_name ?></td>
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                                <tr>
                                                    <td class="align-text-top">Category</td>
                                                    <td class="align-text-top"><?= $category_name ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="align-text-top">Teacher</td>
                                                    <td class="align-text-top"><?= $fullname ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="align-text-top">Duration of Course</td>
                                                    <td class="align-text-top">3 years</td>
                                                </tr>
                                                <tr>
                                                    <td class="align-text-top">Requirements</td>
                                                    <td class="align-text-top"><?= $requirements ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="align-text-top">Course Details</td>
                                                    <td class="align-text-top"><?= $blurb ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
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
