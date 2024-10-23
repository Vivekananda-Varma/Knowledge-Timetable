<?php
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
											<button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#editProfileCard" aria-expanded="false" aria-controls="editProfileCard" title="Edit Profile">
												Edit
											</button>
										</div>
										<div class="card-body text-center">
											<img src="/admin/images/user-default-profile-pic.jpg" alt="Stacie Hall" class="img-fluid rounded-circle mb-2" width="128" height="128" />
											<h5 class="card-title mb-0"><?= $fullname ?></h5>
										</div>
										<table class="table table-sm my-2">
											<tbody>
												<tr>
													<th>DOB</th>
													<td><?= $dob ?></td>
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
											<form>
											<div class="row">
													<div class="mb-3 col-md-4">
														<label class="form-label" for="inputFirstName">First Name</label>
														<input type="text" class="form-control" id="inputFirstName" placeholder="First Name" />
													</div>
													<div class="mb-3 col-md-4">
														<label class="form-label" for="inputLastName">Last Name</label>
														<input type="text" class="form-control" id="inputLastName" placeholder="Last Name" />
													</div>
													<div class="mb-3 col-md-4">
														<label class="form-label" for="inputDateOfBirst">Date of Birth</label>
														<input type="text" class="form-control" id="inputDateOfBirth" placeholder="DD/MM/YYYY" value="<?= $dob ?>" />
													</div>
												</div>
												<div class="row">
													<div class="mb-3 col-md-8">
														<label class="form-label" for="inputEmail">Email</label>
														<input type="email" class="form-control" id="inputEmail" placeholder="Email" />
													</div>
													<div class="mb-3 col-md-4">
														<label class="form-label" for="inputMobile">Mobile</label>
														<input type="password" class="form-control" id="inputMobile" placeholder="Mobile" />
													</div>
												</div>
												<div class="row">
													<div class="mb-3 col-md-8">
														<label class="form-label" for="inputAddressLine1">Address Line 1</label>
														<input type="text" class="form-control" id="inputAddressLine1" placeholder="Apartment, studio, or floor" />
													</div>
													<div class="mb-3 col-md-8">
														<label class="form-label" for="inputAddressLine2">Address Line 2</label>
														<input type="text" class="form-control" id="inputAddressLine2" placeholder="Street Name" />
													</div>
													<div class="mb-3 col-md-4">
														<label class="form-label" for="inputPincode">Postal Code</label>
														<input type="text" class="form-control" id="inputPincode" placeholder="Pincode" />
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger">Delete</button>
													<div class="ms-auto">
														<button type="button" class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#editProfileCard" style="margin-right: 10px;">Close</button>
														<button type="button" class="btn btn-primary">Save</button>
													</div>
												</div>
											</form>
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