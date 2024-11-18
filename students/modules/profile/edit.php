<?php

    include('admin/functions/students.inc');
    
    $student = GetStudentByID($student_id);
                    
    $firstname = $student['firstname'];
    $lastname = $student['lastname'];
    $fullname = "$firstname $lastname";
    
    $mobile = $student['mobile'];
    $email = $student['email'];
    $dob = MySQLDateToDate($student['dob']);
    $class_of = $student['class_of'];
    $year = $student['year'] ?? '1';
    $last_login = $student['last_login'];
    
    $address_1 = $student['address_line_1'] ?? 'No. 15, Rue Suffren Street';
    $address_2 = $student['address_line_2'] ?? 'White Town';
    $postal_code = $student['postal_code'] ?? '605001';
    
    $address = "$address_1, $address_2, Pondicherry $postal_code";
    
    if ($class_of == '') {
        $class_of = date('Y') - $year + 3;
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
                        <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                            <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
                                <h4 class="card-title mb-0">Edit Profile</h4>
                                <div class="d-flex">
                                    <a href="/students/profile/" class="btn btn-outline-secondary btn-sm px-3 py-1 me-2">Cancel</a>
                                    <a href="/students/profile/editpost/" class="btn btn-primary btn-sm px-3 py-1">Save</a>
                                </div>
                            </div>                            
                            <div class="card mb-3">
                                <div class="card-body text-center">
                                    <img src="/admin/images/user-default-profile-pic.jpg" alt="User Profile" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                                    <h5 class="card-title mb-0"><?= $fullname ?></h5>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="mb-3 position-relative">
                                            <label for="dob" class="form-label">DOB</label>
                                            <div class="input-with-icon">
                                                <input type="text" class="form-control" id="dob" value="<?= $dob ?>" disabled />
                                                <i class="uil uil-exclamation-circle icon"></i>
                                            </div>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="year" class="form-label">Year</label>
                                            <div class="input-with-icon">
                                                <input type="text" class="form-control" id="year" value="HC-<?= $year ?>" disabled />
                                                <i class="uil uil-exclamation-circle icon"></i>
                                            </div>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="classOf" class="form-label">Class of</label>
                                            <div class="input-with-icon">
                                                <input type="text" class="form-control" id="classOf" value="<?= $class_of ?>" disabled />
                                                <i class="uil uil-exclamation-circle icon"></i>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" value="<?= $email ?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="phone" value="<?= $mobile ?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" value="<?= $address ?>"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="alert alert-info alert-icon" role="alert">
                                <i class="uil uil-exclamation-circle"></i><a href="/students/modules/contact-admin/" class="alert-link hover">Contact App Admin</a> to change information in the disabled fields.
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
