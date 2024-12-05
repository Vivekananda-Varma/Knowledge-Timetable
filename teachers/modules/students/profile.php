<?php
    include_once('admin/functions/users.inc');
    include_once('admin/functions/students.inc');
    
    $student = GetStudentByID($student_id);
    
    $uid = $student['uid'];
    $firstname = $student['firstname'];
    $lastname = $student['lastname'];
    $fullname = "$firstname $lastname";
    
    $display_name = $student['display_name'];
    
    if ($display_name == '' ) {
        $display_name = $fullname;
    }
    
    $mobile = $student['mobile'];
    $email = $student['email'];
    $dob = MySQLDateToDate($student['dob']);
    $last_login = $student['last_login'];
    
    $address_1 = $student['address_line_1'] ?? 'No. 15, Rue Suffren Street';
    $address_2 = $student['address_line_2'] ?? 'White Town';
    $postal_code = $student['postal_code'] ?? '605001';
    
    if ($address_1 != '') {
        $address = "$address_1, $address_2, Pondicherry $postal_code";
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
            <?php include('students/templates/header.html'); ?>

            <section id="snippet-2" class="wrapper bg-light wrapper-border">
                <div class="container pt-2 pt-md-17 pb-md-14">
                    <div class="row">
                        <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                            <div class="d-flex align-items-center mt-5 mb-3  position-relative">
                                <a href="javascript:history.back()" class="d-flex align-items-center text-primary position-absolute" style="font-weight: bold; text-decoration: none; cursor: pointer;">
                                    <i class="uil uil-angle-left" style="font-size: 1.5rem; margin-right: -2px;"></i>Back
                                </a>
                                <h3 class="card-title mb-0 w-100 text-center">Profile</h3>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body text-center position-relative">
                                    <img src="<?= $profile_image_url ?>" alt="User Profile" class="img-fluid rounded-circle mb-4" width="200" height="200" />
                                    <h5 class="card-title mb-0"><?= $fullname ?></h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <tbody>
                                            <!-- <tr>
                                                <th class="text-end">DOB</th>
                                                <td><?= $dob ?></td>
                                            </tr> -->
                                            <tr>
                                                <th class="text-end">Email</th>
                                                <td><?= $email ?></td>
                                            </tr>
                                            <tr>
                                                <th class="text-end">Phone</th>
                                                <td><?= $mobile ?></td>
                                            </tr>
                                            <tr>
                                                <th class="text-end">Address</th>
                                                <td><?= $address ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
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
