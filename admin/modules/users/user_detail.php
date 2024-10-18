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
						<div class="col-md-4 col-xl-3">
							<div class="card mb-3">
							   <div class="card-header">
								  <h5 class="card-title mb-0">Profile Details</h5>
							   </div>
							   <div class="card-body text-center">
								  <img src="../../images/user-default-profile-pic.jpg" alt="User Default Profile Pic" class="img-fluid rounded-circle mb-2" width="128" height="128">
								  <h5 class="card-title mb-0">User Name</h5>
							   </div>
							   <table class="table table-sm my-2">
									<tbody>
										<tr>
											<th>DOB</th>
											<td>
												<div class="col-sm-12">
													<input type="text" class="form-control" name="dob" value="" placeholder="DOB" />
												</div>
											</td>
										</tr>
										<tr>
											<th>Section</th>
											<td>
												<div class="col-sm-12">
													<input type="text" class="form-control" name="section" value="" placeholder="Section" />
												</div>
											</td>
										</tr>
										<tr>
											<th>Email</th>
											<td>
												<div class="col-sm-12">
													<input type="email" class="form-control" name="email" value="" placeholder="Email" />
												</div>
											</td>
										</tr>
										<tr>
											<th>Phone</th>
											<td>
												<div class="col-sm-12">
													<input type="tel" class="form-control" name="phone" value="" placeholder="Phone" />
												</div>
											</td>
										</tr>
										<tr>
											<th>Status</th>
											<td><span class="badge bg-success m-1">Active</span></td>
										</tr>
									</tbody>
								</table>
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