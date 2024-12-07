<?php

    $uid = $teacher['uid'];
    
    $mobile = $teacher['mobile'];
    $email = $teacher['email'];
    $dob = MySQLDateToDate($teacher['dob']);
    $last_login = $teacher['last_login'];
    
    $address_1 = $teacher['address_line_1'] ?? 'No. 15, Rue Suffren Street';
    $address_2 = $teacher['address_line_2'] ?? 'White Town';
    $postal_code = $teacher['postal_code'] ?? '605001';
    
    if ($address_1 != '') {
        $address = "$address_1,<br>$address_2,<br>Pondicherry $postal_code";
    } else {
        $address = 'N/A';
    }
    
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
                <div class="container pt-2 pt-md-17">
                    <div class="row">
                        <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                            <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
                                <h3 class="card-title mb-0">My Profile</h3>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body text-center position-relative">
                                    <a href="/teachers/profile/edit/" class="btn btn-circle btn-primary position-absolute top-0 end-0 m-2">
                                        <i class="uil uil-pen"></i>
                                    </a>
                                    <img src="<?= $profile_image_url ?>" 
                                         alt="User Profile" class="img-fluid rounded-circle mb-2" 
                                         width="200" height="200" />
                                    <h5 class="card-title mb-0"><?= $loggedin_user_fullname ?></h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm my-2">
                                        <tbody>
                                            <tr>
                                                <td class="text-muted text-end">DOB</td>
                                                <td><?= $dob ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted text-end">Email</td>
                                                <td><?= $email ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted text-end">Mobile</td>
                                                <td><?= $mobile ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted text-end align-text-top">Address</td>
                                                <td class="align-text-top"><?= $address ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row pt-4 pb-md-14">
                        <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-6">
                                    <div class="card p-2 text-center">
                                        <div class="card-body p-3">
                                            <div class="icon btn btn-circle btn-lg btn-soft-red mx-auto mb-3">
                                                <i class="uil uil-calender"></i>
                                            </div>
                                            <h4 class="counter mb-1">24</h4>
                                            <p class="mb-0 small">Periods</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card p-2 text-center">
                                        <div class="card-body p-3">
                                            <div class="icon btn btn-circle btn-lg btn-soft-leaf mx-auto mb-3">
                                                <i class="uil uil-users-alt"></i>
                                            </div>
                                            <h4 class="counter mb-1">11</h4>
                                            <p class="mb-0 small">Students</p>
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
