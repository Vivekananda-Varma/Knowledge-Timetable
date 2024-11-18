<?php

    include_once('admin/functions/categories.inc');
    include_once('admin/functions/courses.inc');
    
    $courses = GetCourses($filter);
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
                                <h3 class="mb-0 text-center w-100">My Courses</h3>
                                <a href="/students/courses/select/" class="btn btn-soft-primary btn-sm px-3 py-1">Edit</a>
                            </div>
                            <div class="job-list mb-10">
                        <?php
                        
                            $previous_cat_id = '';
                        
                            foreach($courses as $course) {
                                $course_id = $course['course_id'];
                                $checked = in_array($course_id,  $selected_courses) ? 'checked' : '';
                                
                                if ($checked == '') {
                                    continue;
                                }
                                
                                $category_id = $course['category_id'];
                                $subject_id = $course['subject_id'];
                                $teacher_id = $course['teacher_id'];
                                $place_id = $course['default_place_id'] ?? '';
                                $place_name = $course['place_name'] ?? '';
                                
                                $subject_name = $course['subject_name'];
                                $course_name = $course['course_name'];
                                $display_name = $course['display_name'];
                                
                                $firstname = $course['firstname'];
                                $lastname = $course['lastname'];
                                $fullname = "$firstname $lastname";
                                
                                // if ($display_name != '') {
                                //     $course_name = $display_name;
                                // }
                                
                                if ($place_name !== '') {
                                    $fullname = "$fullname, $place_name";
                                }
                                
                                $color_index = ($category_id - 11) % 14;
                                $color = $colors[$color_index];
                                
                                if ($category_id != $previous_cat_id) {
                                    $previous_cat_id = $category_id;
                                    $category = GetCategoryByID($category_id);
                                    $category_name = $category['category_name'];
                                    
                                    print "<br><h5 class=\"text-$color\">$category_name</h5>";
                                }
                                
                                
                        ?>    
                                <div class="card mb-3 lift bg-soft-<?= $color ?>" data-href="/students/courses/id/<?= $course_id ?>/">
                                    <div class="card-body p-5">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <!-- <div class="form-check me-2">
                                                    <input class="form-check-input" type="checkbox" value="" id="checkbox-<?= $course_id ?>" onClick=" return ToggleCourse(<?= $course_id ?>)" <?= $checked ?>>
                                                </div> -->
                                                <div class="d-flex flex-column">
                                                    <span class="text-<?= $color ?> fw-bold text-start"><?= $course_name ?></span>
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
        <?php include('templates/footer.html'); ?>
        <?php include('templates/foot.html'); ?>
    </body>

</html>