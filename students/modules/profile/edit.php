<?php

    $mobile = $student['mobile'];
    $email = $student['email'];
    $dob = MySQLDateToDate($student['dob']);
    $class_of = $student['class_of'];
    $year = $student['year'] ?? '1';
    $last_login = $student['last_login'];
    
    $address_1 = $student['address_line_1'] ?? '';
    $address_2 = $student['address_line_2'] ?? '';
    $postal_code = $student['postal_code'] ?? '';
    
    if ($class_of == '') {
        $class_of = date('Y') - $year + 3;
    }
    
    $profile_image_url = GetProfileImagePathForUID($loggedin_user_uid);
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
                            <form name="profile-form" method="post" action="/students/profile/editpost/">
                                <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
                                    <h4 class="card-title mb-0">Edit Profile</h4>
                                    <div class="d-flex">
                                        <a href="/students/profile/" class="btn btn-outline-secondary btn-sm px-3 py-1 me-2">Cancel</a>
                                        <input type="submit" class="btn btn-primary btn-sm px-3 py-1" value="Save">
                                    </div>
                                </div>                            
                                <div class="card mb-3">
                                    <div class="card-body text-center">
                                        <img src="<?= $profile_image_url ?>" alt="User Profile" class="img-fluid rounded-circle mb-2" width="200" height="200" />
                                        <h5 class="card-title mb-0"><?= $loggedin_user_fullname ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3 position-relative">
                                            <label for="dob" class="form-label">DOB</label>
                                            <div class="input-with-icon">
                                                <input type="text" class="form-control" id="dob" name="dob" value="<?= $dob ?>" disabled />
                                                <i class="uil uil-exclamation-circle icon"></i>
                                            </div>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="year" class="form-label">Year</label>
                                            <div class="input-with-icon">
                                                <input type="text" class="form-control" id="year" name ="year" value="HC-<?= $year ?>" disabled />
                                                <i class="uil uil-exclamation-circle icon"></i>
                                            </div>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="classOf" class="form-label">Class of</label>
                                            <div class="input-with-icon">
                                                <input type="text" class="form-control" id="classOf" name="class_of" value="<?= $class_of ?>" disabled />
                                                <i class="uil uil-exclamation-circle icon"></i>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="mobile" class="form-label">Mobile</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile" value="<?= $mobile ?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address Line 1</label>
                                            <input type="text" class="form-control" id="address_line_1" name="address_line_1" value="<?= $address_1 ?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address Line 2</label>
                                            <input type="text" class="form-control" id="address_line_2" name="address_line_2" value="<?= $address_2 ?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Postal Code</label>
                                            <input type="text" class="form-control" id="postal_code" name="postal_code" value="<?= $postal_code ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-info alert-icon" role="alert">
                                    <i class="uil uil-exclamation-circle"></i><a href="/students/modules/contact-admin/" class="alert-link hover">Contact App Admin</a> to change information in the disabled fields.
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
