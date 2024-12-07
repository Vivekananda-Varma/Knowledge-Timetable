<?php

    $uid = $teacher['uid'];
    
    $firstname = $teacher['firstname'];
    $lastname = $teacher['lastname'];
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
        
        <!-- Filepond stylesheets -->
        <link rel="stylesheet" href="/admin/styles/filepond.css">
        
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
        <link href="https://pqina.nl/filepond/static/assets/filepond-plugin-image-preview.min.css?1729244956" rel="stylesheet">
        <link href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css" rel="stylesheet">
    </head>
    
    <body>
        <div class="content-wrapper">
            <?php include('teachers/templates/header.html'); ?>

            <section id="snippet-2" class="wrapper bg-light wrapper-border">
                <div class="container pt-2 pt-md-17 pb-md-14">
                    <div class="row">
                        <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                            <form name="profile-form" method="post" action="/teachers/profile/editpost/">
                                <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
                                    <h4 class="card-title mb-0">Edit Profile</h4>
                                    <div class="d-flex">
                                        <a href="/teachers/profile/" class="btn btn-outline-secondary btn-sm px-3 py-1 me-2">Cancel</a>
                                        <input type="submit" class="btn btn-primary btn-sm px-3 py-1" value="Save">
                                    </div>
                                </div>                            
                                <div class="card mb-3">
                                    <div class="card-body text-center">
                                        <input type="file" class="filepond" name="filepond[]" data-max-file-size="3MB" data-max-files="1" accepted-file-types="image/*">
                                        <!-- <img src="<?= $profile_image_url ?>" alt="User Profile" class="img-fluid rounded-circle mb-2" width="200" height="200" /> -->
                                        <h5 class="card-title mb-0"><?= $loggedin_user_fullname ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="dob" class="form-label">Firstname</label>
                                            <div class="input-with-icon">
                                                <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $firstname ?>" />
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="dob" class="form-label">Lastname</label>
                                            <div class="input-with-icon">
                                                <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $lastname ?>" />
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="dob" class="form-label">DOB</label>
                                            <div class="input-with-icon">
                                                <input type="text" class="form-control" id="dob" name="dob" value="<?= $dob ?>" />
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" value="<?= $email ?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Mobile</label>
                                            <input type="text" class="form-control" id="phone" name="mobile" value="<?= $mobile ?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address Line 1</label>
                                            <input type="text" class="form-control" name="address_line_1" value="<?= $address_1 ?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address Line 2</label>
                                            <input type="text" class="form-control" name="address_line_2" value="<?= $address_2 ?>"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Postal Code</label>
                                            <input type="text" class="form-control" name="postal_code" value="<?= $postal_code ?>"/>
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
        <?php include('admin/templates/filepondprofileimageuploader.html'); ?>
    </body>
</html>
