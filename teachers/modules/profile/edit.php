<?php

    $mobile = $teacher['mobile'];
    $email = $teacher['email'];
    $dob = MySQLDateToDate($teacher['dob']);
    $last_login = $teacher['last_login'];
    
    $address_1 = $teacher['address_line_1'] ?? 'No. 15, Rue Suffren Street';
    $address_2 = $teacher['address_line_2'] ?? 'White Town';
    $postal_code = $teacher['postal_code'] ?? '605001';
    
    $profile_image_url = GetProfileImagePathForUID($uid);
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
                        <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                            <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
                                <h4 class="card-title mb-0">Edit Profile</h4>
                                <div class="d-flex">
                                    <a href="/teachers/profile/" class="btn btn-outline-secondary btn-sm px-3 py-1 me-2">Cancel</a>
                                    <a href="/teachers/profile/editpost/" class="btn btn-primary btn-sm px-3 py-1">Save</a>
                                </div>
                            </div>                            
                            <div class="card mb-3">
                                <div class="card-body text-center">
                                    <img src="<?= $profile_image_url ?>" alt="User Profile" class="img-fluid rounded-circle mb-2" width="200" height="200" />
                                    <h5 class="card-title mb-0"><?= $fullname ?></h5>
                                </div>
                                <div class="card-body">
                                    <form name="profile-form" method="post" action="/teachers/profile/editpost/">
                                        <div class="mb-3 position-relative">
                                            <label for="dob" class="form-label">DOB</label>
                                            <div class="input-with-icon">
                                                <input type="text" class="form-control" id="dob" value="<?= $dob ?>" />
                                                <i class="uil uil-exclamation-circle icon"></i>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" value="<?= $email ?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Mobile</label>
                                            <input type="text" class="form-control" id="phone" value="<?= $mobile ?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address Line 1</label>
                                            <input type="text" class="form-control" id="address_line_1" value="<?= $address_1 ?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address Line 2</label>
                                            <input type="text" class="form-control" id="address_line_2" value="<?= $address_2 ?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address Line 1</label>
                                            <input type="text" class="form-control" id="postal_code" value="<?= $postal_code ?>"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="alert alert-info alert-icon" role="alert">
                                <i class="uil uil-exclamation-circle"></i><a href="/teachers/modules/contact-admin/" class="alert-link hover">Contact App Admin</a> to change information in the disabled fields.
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
