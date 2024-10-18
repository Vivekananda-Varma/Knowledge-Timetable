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
					<div class="d-flex justify-content-between align-items-center mb-3">
						<h1 class="h1"><?= $page_title ?></h1>
					</div>
					
					<div class="row">
						<div class="container-fluid p-0">
							<div class="row">
								<div class="col-md-4 col-xl-3">
									<div class="card mb-3">
										<div class="card-header d-flex justify-content-between align-items-center">
											<h5 class="card-title mb-0">Profile Details</h5>
											<button class="btn btn-secondary rounded-circle" type="button" data-bs-toggle="collapse" data-bs-target="#editProfileCard" aria-expanded="false" aria-controls="editProfileCard" title="Edit Profile" style="width: 40px; height: 40px; display: flex; justify-content: center; align-items: center;">
												<i class="align-middle" data-feather="edit-2"></i>
											</button>
										</div>
										<div class="card-body text-center">
											<img src="../../dist/img/avatars/avatar-4.jpg" alt="Stacie Hall" class="img-fluid rounded-circle mb-2" width="128" height="128" />
											<h5 class="card-title mb-0">User Name</h5>
										</div>
										<table class="table table-sm my-2">
											<tbody>
												<tr>
													<th>DOB</th>
													<td>2005</td>
												</tr>
												<tr>
													<th>Section</th>
													<td>K1</td>
												</tr>
												<tr>
													<th>Email</th>
													<td>user@gmail.com</td>
												</tr>
												<tr>
													<th>Phone</th>
													<td>+9876543210</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>

								<!-- Edit Profile Card Popup -->
								<div class="col-md-4 col-xl-3 collapse" id="editProfileCard">
									<div class="card mb-3">
										<div class="card-header">
											<h5 class="card-title mb-0">Edit Profile</h5>
										</div>
										<div class="card-body text-center">
											<img src="../../images/user-default-profile-pic.jpg" alt="User Default Profile Pic" class="img-fluid rounded-circle mb-2" width="128" height="128">
											<h5 class="card-title mb-0">User Name</h5>
										</div>
										<table class="table table-sm my-2">
											<tbody>
												<tr>
													<th class="align-middle">DOB</th>
													<td>
														<div class="col-sm-12">
															<input type="text" class="form-control" name="dob" value="" placeholder="DOB" />
														</div>
													</td>
												</tr>
												<tr>
													<th class="align-middle">Section</th>
													<td>
														<div class="col-sm-12">
															<select class="form-control" name="section">
																<option value="" disabled selected>Select Section</option>
																<option value="K1">K1</option>
																<option value="K2">K2</option>
																<option value="K3">K3</option>
															</select>
														</div>
													</td>
												</tr>
												<tr>
													<th class="align-middle">Email</th>
													<td>
														<div class="col-sm-12">
															<input type="email" class="form-control" name="email" value="" placeholder="Email" />
														</div>
													</td>
												</tr>
												<tr>
													<th class="align-middle">Phone</th>
													<td>
														<div class="col-sm-12">
															<input type="tel" class="form-control" name="phone" value="" placeholder="Phone" />
														</div>
													</td>
												</tr>
											</tbody>
										</table>
										<div class="modal-footer m-3">
											<button type="button" class="btn btn-danger">Delete</button>
											<div class="ms-auto">
												<button type="button" class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#editProfileCard" style="margin-right: 10px;">Close</button>
												<button type="button" class="btn btn-primary">Save</button>
											</div>
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