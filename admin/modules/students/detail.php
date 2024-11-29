<?php

	$timetable = GetTimetableForStudentId($student_id);

	$uid = $student['uid'];
	$firstname = $student['firstname'];
	$lastname = $student['lastname'];
	$legalname = $student['legalname'];
	$display_name = $student['display_name'];
	
	$fullname = "$firstname $lastname";
	
	$mobile = $student['mobile'];
	$email = $student['email'];
	$dob = MySQLDateToDate($student['dob']);
	$gender = $student['gender'];
	$class_of = $student['class_of'];
	$year = $student['year'] ?? '1';
	$last_login = $student['last_login'];
	
	$address_1 = $student['address_line_1'] ?? '';
	$address_2 = $student['address_line_2'] ?? '';
	$postal_code = $student['postal_code'] ?? '';
	
	if ($address_1 != '') {
		$address = "$address_1, $address_2, Pondicherry $postal_code";
	} else {
		$address = 'N/A';
	}
	
	if ($class_of == '') {
		$class_of = date('Y') - $year + 3;
	}
	
	$profile_image_url = GetProfileImagePathForUID($uid);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'admin/templates/head.html'; ?>
	<link rel="stylesheet" href="/admin/styles/filepond.css">
	<!-- <link rel="stylesheet" href="/admin/styles/imageuploader.css"> -->
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
	<div class="wrapper">
		<?php include 'admin/templates/sidebar.html'; ?>
		<div class="main">
			<?php include 'admin/templates/navbar.html'; ?>
			
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
											<h5 class="card-title mt-4 mb-0"><?= $fullname ?></h5>
										</div>
										<div class="card-body">
											<table class="table table-sm my-2">
												<tbody>
													<tr>
														<td class="text-muted text-end">DOB</td>
														<td><?= $dob ?></td>
													</tr>
													<tr>
														<td class="text-muted text-end">Year</td>
														<td>HC-<?= $year ?></td>
													</tr>
													<tr>
														<td class="text-muted text-end">Class of</td>
														<td><?= $class_of ?></td>
													</tr>
													<tr>
														<td class="text-muted text-end">Email</td>
														<td><?= $email ?></td>
													</tr>
													<tr>
														<td class="text-muted text-end">Phone</td>
														<td><?= $mobile ?></td>
													</tr>
													<tr>
														<td class="text-muted text-end">Address</td> 
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
										<form name="student-form" method="post" action="/admin/students/<?= $student_id ?>/editpost/">
											<div class="card">
												<div class="card-header">
													<h5 class="card-title">Edit Profile</h5>
												</div>
												<div class="card-body">	
													<div class="card-body text-center">
															<input type="file" class="filepond" name="filepond[]" data-max-file-size="3MB" data-max-files="1" accepted-file-types="image/*">
														<!-- <a href="#" class="profile-container">
															<img src="/admin/images/user-default-profile-pic.jpg" alt="User Default Profile Pic" class="profile-pic img-fluid mb-2">
															<div class="profile-pic-edit-icon">
																<i data-feather="edit-2"></i>
															</div>
														</a> -->
													</div>
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
														<div class="mb-3 col-md-3">
															<label class="form-label" for="inputDateOfBirth">Date of Birth</label>
															<input type="text" class="form-control" id="inputDateOfBirth" name="dob" placeholder="DD/MM/YYYY" value="<?= $dob ?>" />
														</div>
														<div class="mb-3 col-md-3">
															<label class="form-label" for="inputGender">Gender</label>
															<input type="text" class="form-control" id="inputGender" name="gender" placeholder="" value="<?= $gender ?>" />
														</div>
														<div class="mb-3 col-md-3">
															<label class="form-label" for="inputYear">Year</label>
															<select id="inputYear" class="form-select" name="year">
																<option>Select...</option>
															<?php
																for($i = 1; $i < 5; $i++) {
																	$display = "HC-$i";
	
																	if ($i == $year) {
																		$selected = 'selected';
																	} else {
																		$selected = '';
																	}
															?>
																<option value="<?= $i ?>" <?= $selected ?>><?= $display ?></option>
															<?php
																}
															?>
															</select>
														</div>
														<div class="mb-3 col-md-3">
															<label class="form-label" for="inputClassOf">Class of</label>
															<input type="text" class="form-control" id="inputClassOf" name="class_of" value="<?= $class_of ?>" placeholder="Year of graduation" />
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
													</div>
													<div class="row">
														<div class="mb-3 col-md-6">
															<label class="form-label" for="inputAddressLine1">Address Line 1</label>
															<input type="text" class="form-control" id="inputAddressLine1" name="address_line_1" value="<?= $address_1 ?>" placeholder="Apartment, studio, or floor" />
														</div>
													</div>
													<div class="row">
														<div class="mb-3 col-md-6">
															<label class="form-label" for="inputAddressLine2">Address Line 2</label>
															<input type="text" class="form-control" id="inputAddressLine2" name="address_line_2" value="<?= $address_2 ?>" placeholder="Street Name" />
														</div>
													</div>
													<div class="row">
														<div class="mb-3 col-md-3">
															<label class="form-label" for="inputPincode">Postal Code</label>
															<input type="text" class="form-control" id="inputPincode" name="postal_code" value="<?= $postal_code ?>" placeholder="Pincode" />
														</div>
													</div>
													<div class="modal-footer">
														<!-- <button type="button" class="btn btn-danger">Delete</button> -->
														<div class="ms-auto">
															<a class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#editProfileCard" style="margin-right: 10px;">Cancel</a>
															<input type="submit" class="btn btn-primary" name="submit" value="Save">
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>
									
									<!-- Timetable -->
									<div id="timetableCard">
										<div class="card">
											<div class="card-header">
												<h5 class="card-title mb-0"><?= $firstname ?>'s Timetable</h5>
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
													
													if (empty($period)) {
										?>
														<td class="period" data-bs-toggle="modal" data-bs-target="#modal-alert">
															<i class="align-middle me-2 fas fa-2x fa-plus-circle"></i>
														</td>
										<?php				
													} else {
														
														$place = $period['place_name'] ?? '';
														// $category = $period['category'];
														$subject = $period['course_name'] ?? '&nbsp;';
														$display_name = $period['display_name'] ?? '';
														$teacher_id = $period['teacher_id'] ?? '';
														$teacher = $period['firstname'] ?? '&nbsp;';
														$place = $period['place_name'] ?? '&nbsp;';
														
														if ($display_name == '') {
															$display_name = $subject;
														}
														
														if ($teacher_id != '') {
															$teacher = "<a href=\"/admin/teachers/$teacher_id/edit/\">$teacher</a>";
														}
										?>
														<td class="period" data-href="">
															<div class="subject"><?= $display_name ?></div>
															<div class="teacher"><?= $teacher ?></div>
															<div class="place"><?= $place ?></div>
															<i class="fas fa-edit"></i>
														</td>
										<?php
													}
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

									<!-- Edit Period Modal -->
									<div class="modal fade" id="modal-alert" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
										<form class="modal-dialog" id="course-form" name="course-form" method="post" action="">
											<div class="modal-content">
												<div class="modal-header">
													<h1 class="modal-title fs-5" id="modal-title">Edit Period</h1>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													<label class="form-label">Course Name</label>
													<input id="course-name" type="text" class="form-control" name="course_name" value="" placeholder="Course name"><br>
													<div class="row">
														<div class="mb-3 col-md-6">
															<label class="form-label">Category</label>
															<select id="inputCategory" class="form-select"  onchange="HandleCategoryChanged()">
																<option selected>Select Category...</option>
															</select>
														</div>
														<div class="mb-3 col-md-6">
															<label class="form-label">Subject</label>
															<select id="inputSubject" class="form-select" onchange="HandleSubjectChanged()">
																<option selected>Select Subject...</option>
															</select>
														</div>
													</div>
													<div class="row">
														<div class="mb-3 col-md-6">
															<label class="form-label">Teacher</label>
															<select id="inputTeacher" class="form-select">
																<option selected>Select Teacher...</option>
															</select>
														</div>
														<div class="mb-3 col-md-6">
															<label class="form-label">Place</label>
															<select id="inputPlace" class="form-select">
																<option selected>Select Place...</option>
															</select>
														</div>
													</div>
													<div class="row">
														<div class="mb-3 col-md-6">
															<label class="form-label">Students</label>
															<div class="d-flex align-items-center">
																<a href="#" class="me-2">
																	<img src="/admin/images/user-default-profile-pic.jpg" alt="Student 1" class="img-fluid rounded-circle" width="40" height="40" />
																</a>
																<a href="#" class="me-2">
																	<img src="/admin/images/user-default-profile-pic.jpg" alt="Student 2" class="img-fluid rounded-circle" width="40" height="40" />
																</a>
																<a href="#" class="me-2">
																	<img src="/admin/images/user-default-profile-pic.jpg" alt="Student 3" class="img-fluid rounded-circle" width="40" height="40" />
																</a>
															</div>
														</div>
													</div>
																					
												</div>
												<div class="modal-footer justify-content-between">
													<button type="button" class="btn btn-danger mr-auto">Delete</button>
													<div>
														<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
														<input type="submit" class="btn btn-primary" value="Save">
													</div>
												</div>
											</div>
										</form>
									</div>

									<!-- Edit Period Modal 2 -->
									<div class="modal fade" id="modal-alert" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
									<form class="modal-dialog modal-sm" id="course-form" name="course-form" method="post" action="">
											<div class="modal-content">
												<div class="modal-header">
													<h1 class="modal-title fs-5" id="modal-title">Edit Period</h1>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													<table class="table table-sm my-2">
														<tbody>
															<tr>
																<td class="text-muted text-end">Course Name</td>
																<td>Biology and Related Subjects</td>
															</tr>
															<tr>
																<td class="text-muted text-end">Category</td>
																<td>Science Subjects</td>
															</tr>
															<tr>
																<td class="text-muted text-end">Subject</td>
																<td>Biology and Related Subjects</td>
															</tr>
															<tr>
																<td class="text-muted text-end">Teacher</td>
																<td>Madhumita Di</td>
															</tr>
															<tr>
																<td class="text-muted text-end">Place</td> 
																<td>Knowledge</td> 
															</tr>
														</tbody>
													</table>
												</div>
												<div class="modal-footer justify-content-between">
													<button type="button" class="btn btn-danger mr-auto">Delete</button>
													<div>
														<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
														<input type="submit" class="btn btn-primary" value="Save" />
													</div>
												</div>
											</div>
										</form>
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
	<?php include('admin/templates/filepondprofileimageuploader.html'); ?>
</body>

</html>