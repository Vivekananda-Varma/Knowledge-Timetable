<?php

	$name = $_GET['name'] ?? 'aadya';
	$json_filename = "admin/modules/students/json/$name.json";

	$json = file_get_contents($json_filename);
	$timetable = json_decode($json, true);


	$firstname = $student['firstname'];
	$lastname = $student['lastname'];
	$fullname = "$firstname $lastname";
	
	$mobile = $student['mobile'];
	$email = $student['email'];
	$dob = $student['dob'] ?? '01/01/2000';
	$class_of = $student['class_of'] ?? '2025';
	$year = $student['year'] ?? '1';
	$last_login = $student['last_login'];
	
	$address_1 = $student['address_line_1'] ?? 'No. 15, Rue Suffren Street';
	$address_2 = $student['address_line_2'] ?? 'White Town';
	$postal_code = $student['postal_code'] ?? '605001';
	
	$address = "$address_1, $address_2, Pondicherry $postal_code";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'templates/head.html'; ?>
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
	<div class="wrapper">
		<?php include 'templates/sidebar.html'; ?>
		<div class="main">
			<?php include 'templates/navbar.html'; ?>
			
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
											<img src="/admin/images/user-default-profile-pic.jpg" alt="Stacie Hall" class="img-fluid rounded-circle mb-2" width="128" height="128" />
											<h5 class="card-title mb-0"><?= $fullname ?></h5>
										</div>
										<div class="card-body">
											<table class="table table-sm my-2">
												<tbody>
													<tr>
														<th>DOB</th>
														<td><?= $dob ?></td>
													</tr>
													<tr>
														<th>Year</th>
														<td>K<?= $year ?></td>
													</tr>
													<tr>
														<th>Class of</th>
														<td><?= $class_of ?></td>
													</tr>
													<tr>
														<th>Email</th>
														<td><?= $email ?></td>
													</tr>
													<tr>
														<th>Phone</th>
														<td><?= $mobile ?></td>
													</tr>
													<tr>
														<th>Address</th> 
														<td><?= $address ?></td> 
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>

								<!-- Profile Card Popup -->
								<div class="col-md-4 col-xl-9 collapse" id="editProfileCard">
									<div class="card">
										<div class="card-header">
											<h5 class="card-title">Edit Profile</h5>
										</div>
										<div class="card-body">	
											<div class="card-body text-center">
												<img src="/admin/images/user-default-profile-pic.jpg" alt="User Default Profile Pic" class="img-fluid rounded-circle mb-2" width="128" height="128">
											</div>
											<form name="student-form" method="post" action="/admin/students/<?= $student_id ?>/editpost/">
											<div class="row">
													<div class="mb-3 col-md-6">
														<label class="form-label" for="inputFirstName">First Name</label>
														<input type="text" class="form-control" id="inputFirstName" name="firstname" value="<?= $firstname ?>" placeholder="First Name" />
													</div>
													<div class="mb-3 col-md-6">
														<label class="form-label" for="inputLastName">Last Name</label>
														<input type="text" class="form-control" id="inputLastName" name="lastname" value="<?= $lastname ?>" placeholder="Last Name" />
													</div>
												</div>
												<div class="row">
													<div class="mb-3 col-md-4">
														<label class="form-label" for="inputDateOfBirst">Date of Birth</label>
														<input type="text" class="form-control" id="inputDateOfBirth" name="dob" placeholder="DD/MM/YYYY" value="<?= $dob ?>" />
													</div>
													<div class="mb-3 col-md-4">
														<label class="form-label" for="inputYear">Year</label>
														<select id="inputYear" class="form-control" name="year">
															<option>Select...</option>
														<?php
															for($i = 1; $i < 5; $i++) {
																$display = "K$i";

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
													<div class="mb-3 col-md-4">
														<label class="form-label" for="inputDateOfBirst">Class of</label>
														<input type="text" class="form-control" id="inputDateOfBirth" name="class_of" value="<?= $class_of ?>" placeholder="Year of graduation" />
													</div>
												</div>
												<div class="row">
													<div class="mb-3 col-md-8">
														<label class="form-label" for="inputEmail">Email</label>
														<input type="email" class="form-control" id="inputEmail" name="email" value="<?= $email ?>" placeholder="Email" />
													</div>
													<div class="mb-3 col-md-4">
														<label class="form-label" for="inputMobile">Mobile</label>
														<input type="text" class="form-control" id="inputMobile" name="mobile" value="<?= $mobile ?>" placeholder="Mobile" />
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
														<a class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#editProfileCard" style="margin-right: 10px;">Close</a>
														<input type="submit" class="btn btn-primary" name="submit" value="Save">
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>

								<!-- Timetable -->
								<div class="col-md-8 col-xl-9" id="timetableCard">
									<div class="card">
										<div class="card-header">
											<h5 class="card-title mb-0">Timetable</h5>
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
									<?php    
											for($i = 0; $i < count($timetable); $i++) {
												$row = $timetable[$i];
												$day = $row['day'];
												$periods = $row['periods'];
									?>
												<tr class="timetable-row">
													<td class="timetable-day"><?= substr($day, 0, 3) ?></td>
									<?php    
												for ($j = 0; $j < count($periods); $j++) {
													$period = $periods[$j];
													$category = $period['category'];
													$subject = $period['subject'];
													$teacher = $period['teacher'];
													$place = $period['place'];
									?>
													<td class="timetable-period">
														<span class="timetable-period-subject"><?= $subject ?></span><br>
														<span class="timetable-period-teacher"><?= $teacher ?></span><br>
														<span class="timetable-period-place"><?= $place ?></span>
													</td>
									<?php
												}
									?>
												</tr>
									<?php
											}
									?>
											</table>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</main>

			<?php include 'templates/footer.html'; ?>
		</div>
	</div>

	<?php include 'templates/foot.html'; ?>

</body>

</html>