<?php
	$timetable = GetTimetableForTeacherId($teacher_id);
	
	$uid = $teacher['uid'];
	$firstname = $teacher['firstname'];
	$lastname = $teacher['lastname'];
	$legalname = $teacher['legalname'];
	$display_name = $teacher['display_name'];
	
	$fullname = "$firstname $lastname";
	
	$mobile = $teacher['mobile'];
	$email = $teacher['email'];
	$dob = MySQLDateToDate($teacher['dob']);
	$gender = $teacher['gender'];
	$last_login = $teacher['last_login'];
	
	$address_1 = $teacher['address_line_1'] ?? 'No. 15, Rue Suffren Street';
	$address_2 = $teacher['address_line_2'] ?? 'White Town';
	$postal_code = $teacher['postal_code'] ?? '605001';
	
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
        <?php include('admin/templates/head.html'); ?>
    </head>

    <body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
        <div class="wrapper">
            <?php include('admin/templates/sidebar.html'); ?>
            <div class="main">
                <?php include('admin/templates/navbar.html'); ?>

                <main class="content">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="container-fluid p-0">
                                <div class="row">
                                    <!-- Profile Details Card -->
                                    <div class="col-md-4 col-xl-3">
                                        <div class="card mb-3">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h5 class="card-title mb-0">Profile Details</h5>
                                                <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#editProfileCard" aria-expanded="false" aria-controls="editProfileCard" title="Edit Profile">
                                                    Edit
                                                </button>
                                            </div>
                                            <div class="card-body text-center">
                                                <img src="<?= $profile_image_url ?>" alt="Stacie Hall" class="img-fluid rounded-circle mb-2" width="200" height="200" />
                                                <h5 class="card-title mb-0"><?= $fullname ?></h5>
                                            </div>
                                            <!-- <hr class="my-0"> -->
                                            <div class="card-body">
                                                <table class="table table-sm my-2">
                                                    <tbody>
                                                        <tr>
                                                            <th class="text-end">DOB</th>
                                                            <td><?= $dob ?></td>
                                                        </tr>
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

								    <div class="col-md-8 col-xl-9">
									<!-- Profile Card Popup -->
									<div class="collapse" id="editProfileCard">
									    <div class="card">
										    <div class="card-header">
											    <h5 class="card-title">Edit Profile</h5>
										    </div>
										    <div class="card-body">	
											    <div class="card-body text-center">
												    <img src="/admin/images/user-default-profile-pic.jpg" alt="User Default Profile Pic" class="img-fluid rounded-circle mb-2" width="200" height="200">
											    </div>
											    <form name="student-form" method="post" action="/admin/teachers/<?= $teacher_id ?>/editpost/">
												    <div class="row">
													    <div class="mb-3 col-md-3">
															<label class="form-label" for="inputFirstName">First Name</label>
															<input type="text" class="form-control" id="inputFirstName" name="firstname" value="<?= $firstname ?>" placeholder="First Name" />
														</div>
														<div class="mb-3 col-md-3">
															<label class="form-label" for="inputLastName">Last Name</label>
															<input type="text" class="form-control" id="inputLastName" name="lastname" value="<?= $lastname ?>" placeholder="Last Name" />
														</div>
														<div class="mb-3 col-md-3">
															<label class="form-label" for="inputLegalName">Legal Name</label>
															<input type="text" class="form-control" id="inputLegalName" name="legalname" value="<?= $legalname ?>" placeholder="For official purposes" />
														</div>
														<div class="mb-3 col-md-3">
															<label class="form-label" for="inputDisplayName">Display Name</label>
															<input type="text" class="form-control" id="inputDisplayName" name="display_name" value="<?= $display_name ?>" placeholder="Known as" />
														</div>
												    </div>
												    <div class="row">
													    <div class="mb-3 col-md-6">
														    <label class="form-label" for="inputEmail">Email</label>
														    <input type="email" class="form-control" id="inputEmail" name="email" value="<?= $email ?>" placeholder="Email" />
													    </div>
													    <div class="mb-3 col-md-3">
														    <label class="form-label" for="inputMobile">Mobile</label>
														    <input type="text" class="form-control" id="inputMobile" name="mobile" value="<?= $mobile ?>" placeholder="Mobile" />
													    </div>
														<div class="mb-3 col-md-3">
															<label class="form-label" for="inputGender">Gender</label>
															<input type="text" class="form-control" id="inputGender" name="gender" value="<?= $gender ?>" placeholder="Mobile" />
														</div>
												    </div>
												    <div class="row">
													    <div class="mb-3 col-md-8">
														    <label class="form-label" for="inputAddressLine1">Address Line 1</label>
														    <input type="text" class="form-control" id="inputAddressLine1" name="address_line_1" value="<?= $address_1 ?>" placeholder="Apartment, studio, or floor" />
													    </div>
													    <div class="mb-3 col-md-8">
														    <label class="form-label" for="inputAddressLine2">Address Line 2</label>
														    <input type="text" class="form-control" id="inputAddressLine2" name="address_line_2" value="<?= $address_2 ?>" placeholder="Street Name" />
													    </div>
													    <div class="mb-3 col-md-4">
														    <label class="form-label" for="inputPincode">Postal Code</label>
														    <input type="text" class="form-control" id="inputPincode" name="postal_code" value="<?= $postal_code ?>" placeholder="Pincode" />
													    </div>
												    </div>
												    <div class="modal-footer">
													    <button type="button" class="btn btn-danger">Delete</button>
													    <div class="ms-auto">
														    <button class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#editProfileCard" style="margin-right: 10px;">Close</button>
														    <input type="submit" class="btn btn-primary" name="submit" value="Save">
													    </div>
												    </div>
											    </form>
										    </div>
									    </div>
								    </div>
									
									<!-- Timetable -->
									<div id="timetableCard">
										<div class="card">
											<div class="card-header">
												<h5 class="card-title mb-0"><?= $display_name ?>'s Timetable</h5>
											</div>
											<div class="card-body">	
											<table class="timetable">
												<thead>
													<tr>
														<th class="timetable-head">&nbsp;</div>
														<th class="timetable-head">1</th>
														<th class="timetable-head">2</th>
														<th class="timetable-head">3</th>
														<th class="timetable-head">4</th>
														<th class="timetable-head">5</th>
														<th class="timetable-head">6</th>
														<th class="timetable-head">7</th>
													</tr>
												</thead>
												<tbody>
										<?php    
											$day_of_week = array('SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT');
											
												for($i = 1; $i < 7; $i++) {
													$day = $day_of_week[$i];
										?>
													<tr class="timetable-row">
														<td class="day"><?= $day ?></td>
										<?php    
													for ($j = 1; $j < 8; $j++) {
														$period = $timetable[$i][$j] ?? array();
														
														$place = $period['place_name'] ?? '';
														// $category = $period['category'];
														$subject = $period['course_name'] ?? '';
														$place = $period['place_name'] ?? '';
										?>
														<td class="period">
															<div class="subject text-secondary"><?= $subject ?></div>
															<div class="teacher text-primary">&nbsp;</div>
															<div class="place text-sm"><?= $place ?></div>
														</td>
										<?php
													}
										?>
													</tr>
										<?php
												}
										?>
												</tbody>
											</table>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                <?php include('admin/templates/footer.html'); ?>
            </div>
        </div>

        <?php include('admin/templates/foot.html'); ?>
    </body>
</html>
