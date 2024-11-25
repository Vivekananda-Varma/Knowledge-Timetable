<?php
    include_once('admin/functions/users.inc');
    include_once('admin/functions/teachers.inc');
    
    $teacher = GetTeacherByID($teacher_id);
    
    $firstname = $teacher['firstname'];
    $lastname = $teacher['lastname'];
    $fullname = "$firstname $lastname";
    
    $display_name = $teacher['display_name'];
    
    if ($display_name == '' ) {
        $display_name = $fullname;
    }
    
    $mobile = $teacher['mobile'];
    $email = $teacher['email'];
    $dob = MySQLDateToDate($teacher['dob']);
    $last_login = $teacher['last_login'];
    
    $address_1 = $teacher['address_line_1'] ?? 'No. 15, Rue Suffren Street';
    $address_2 = $teacher['address_line_2'] ?? 'White Town';
    $postal_code = $teacher['postal_code'] ?? '605001';
    
    if ($address_1 != '') {
        $address = "$address_1, $address_2, Pondicherry $postal_code";
    } else {
        $address = 'N/A';
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
                            <div class="d-flex align-items-center mt-5 mb-3  position-relative">
                                <a href="/students/teachers/" class="d-flex align-items-center text-primary position-absolute" style="font-weight: bold; text-decoration: none; cursor: pointer;">
                                    <i class="uil uil-angle-left" style="font-size: 1.5rem; margin-right: -2px;"></i>Back
                                </a>
                                <h3 class="card-title mb-0 w-100 text-center">Profile</h3>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body text-center position-relative">
                                    <img src="/admin/images/user-default-profile-pic.jpg" alt="User Profile" class="img-fluid rounded-circle mb-4" width="200" height="200" />
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
