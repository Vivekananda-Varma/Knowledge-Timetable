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
   
   $requirements = $course['requirements'] ?? '';
   $blurb = $course['blurb'] ?? '';
   
   // $requirements = str_replace("\r\n", "<br>", $requirements);
   // $blurb = str_replace("\r\n", "<br>", $requirements);
   
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
                            <form name="profile-form" method="post" action="/teachers/courses/id/<?= $course_id ?>/editpost/">
                                <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
                                    <h4 class="card-title mb-0">Edit Course Details</h4>
                                    <div class="d-flex">
                                        <a href="/teachers/courses/id/<?= $course_id ?>" class="btn btn-outline-secondary btn-sm px-3 py-1 me-2">Cancel</a>
                                        <input type="submit" href="/teachers/profile/editpost/" class="btn btn-primary btn-sm px-3 py-1" value="Save">
                                    </div>
                                </div>                            
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="dob" class="form-label">Course Name</label>
                                            <div class="input-with-icon">
                                                <input type="text" class="form-control" id="course_name" name="course_name" value="<?= $course_name ?>" />
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="dob" class="form-label">Subject Name</label>
                                            <div class="input-with-icon">
                                                <input type="text" class="form-control" id="subject_name" name="subject_name" value="<?= $subject_name ?>" disabled />
                                                <i class="uil uil-exclamation-circle icon"></i>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="dob" class="form-label">Category</label>
                                            <div class="input-with-icon">
                                                <input type="text" class="form-control" id="category_name" name="category_name" value="<?= $category_name ?>" disabled />
                                                <i class="uil uil-exclamation-circle icon"></i>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="duration" class="form-label">Duration of Course</label>
                                            <input type="text" class="form-control" id="duration" name="duration" value="3 years"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Description</label>
                                            <textarea id="blurb" name="blurb" class="form-control" placeholder="Let your students know what will be covered in this course" style="height: 150px">
                                                <?= $blurb ?>
                                            </textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Requirements</label>
                                            <textarea id="requirements" name="requirements" class="form-control" placeholder="Any prerequisites for this course?" style="height: 150px">
                                                <?= $requirements ?>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>            
        </div>
        <?php include('templates/footer.html'); ?>
        <?php include('templates/foot.html'); ?>
    </body>
</html>
