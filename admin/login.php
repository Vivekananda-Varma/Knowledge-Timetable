<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('admin/templates/head.html'); ?>
</head>
<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
	<div class="main d-flex justify-content-center w-100">
		<main class="content d-flex p-0">
			<div class="container d-flex flex-column">
				<div class="row h-100">
					<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
						<div class="d-table-cell align-middle">

							<div class="text-center mt-4">
								<h1 class="h2">Admin Login</h1>
								<p class="lead">
									Enter your email address and password.
								</p>
							</div>

							<div class="card">
								<div class="card-body">
									<div class="m-sm-3">
										<form name="login-form" method="post" action="/admin/loginpost/">
											<div class="mb-3">
												<label class="form-label">Email</label>
												<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email or username" />
											</div>
											<div class="mb-3">
												<label class="form-label">Password</label>
												<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
											</div>
											<div class="d-grid gap-2 mt-3">
												<input class="btn btn-lg btn-primary" type="submit" name="signin-button" value="Sign In">
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
	</div>

	<?php include('admin/templates/foot.html'); ?>

</body>

</html>