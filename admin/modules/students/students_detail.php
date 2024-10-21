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
											<h5 class="card-title mb-0">User Name</h5>
										</div>
										<table class="table table-sm my-2">
											<tbody>
												<tr>
													<th>DOB</th>
													<td>2005</td>
												</tr>
												<tr>
													<th>Year</th>
													<td>K1</td>
												</tr>
												<tr>
													<th>Class of</th>
													<td>2026</td>
												</tr>
												<tr>
													<th>Email</th>
													<td>user@gmail.com</td>
												</tr>
												<tr>
													<th>Phone</th>
													<td>+9876543210</td>
												</tr>
												<tr>
													<th>Address</th> 
													<td>No. 15, Rue Suffren Street, White Town, Pondicherry, 605001</td> 
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
													<div class="mb-3 col-md-6">
														<label class="form-label" for="inputFirstName">First Name</label>
														<input type="text" class="form-control" id="inputFirstName" placeholder="First Name" />
													</div>
													<div class="mb-3 col-md-6">
														<label class="form-label" for="inputLastName">Last Name</label>
														<input type="text" class="form-control" id="inputLastName" placeholder="Last Name" />
													</div>
												</div>
												<div class="row">
													<div class="mb-3 col-md-4">
														<label class="form-label" for="inputDateOfBirst">Date of Birth</label>
														<input type="text" class="form-control" id="inputDateOfBirth" placeholder="DD/MM/YYYY" />
													</div>
													<div class="mb-3 col-md-4">
														<label class="form-label" for="inputYear">Year</label>
														<select id="inputYear" class="form-control">
															<option selected>Select...</option>
															<option>1</option>
															<option>2</option>
															<option>3</option>
															<option>4</option>
															<option>5</option>
														</select>
													</div>
													<div class="mb-3 col-md-4">
														<label class="form-label" for="inputDateOfBirst">Class of</label>
														<input type="text" class="form-control" id="inputDateOfBirth" placeholder="Year of graduation " />
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
												<div class="mb-3 cold-md-8">
													<label class="form-label" for="inputAddressLine1">Address Line 1</label>
													<input type="text" class="form-control" id="inputAddressLine1" placeholder="Apartment, studio, or floor" />
												</div>
												<div class="row">
													<div class="mb-3 col-md-8">
													<label class="form-label" for="inputAddressLine2">Address Line 2</label>
														<input type="text" class="form-control" id="inputAddressLine2" placeholder="Street Name" />
													</div>
													<div class="mb-3 col-md-4">
														<label class="form-label" for="inputPincode">Pincode</label>
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