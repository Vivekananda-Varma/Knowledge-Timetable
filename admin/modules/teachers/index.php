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
					<div class="d-flex justify-content-between align-items-center mb-3">
						<h1 class="h1"><?= $page_title ?></h1>
						<div>
							<a class="btn btn-outline-primary" href="/admin/teachers/export/">Export</a>
							<a class="btn btn-outline-primary" href="/admin/teachers/import/">Import</a>
							<button class="btn btn-primary">New +</button>
						</div>
					</div>
					
					<table id="datatables-reponsive" class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Name</th>
								<th>AKA</th>
								<th>Mobile</th>
								<th>Email</th>
								<th>Courses</th>
								<th>Students</th>
								<th>Periods</th>
								<th>Active</th>
							</tr>
						</thead>
					<tbody>
				<?php
					foreach($teachers as $teacher) {
						$teacher_id = $teacher['teacher_id'];
						$uid = $teacher['uid'];
						
						$firstname = $teacher['firstname'];
						$lastname = $teacher['lastname'];
						$fullname = "<b>$firstname</b> $lastname";
						$display_name = $teacher['display_name'];
						
						$mobile = $teacher['mobile'];
						$email = $teacher['email'];
						$otp = $teacher['otp'];
						$last_login = $teacher['last_login'] ?? 'Today 7:51 pm';
						
						$num_courses = $teacher['num_courses'];
						$num_students = $teacher['num_students'];
						$num_periods = $teacher['num_periods'];
						
						$is_active = $teacher['is_active'];
						$active_check = $is_active == 1 ? '<i class="fas fa-fw fa-check text-success"></i>' : '';
						
						if ($email != '') {
							$email = "<a href=\"mailto:$email\">$email</a>";
						}
						
						if ($num_courses == 0) {
							$num_courses = '';
						}
						
						if ($num_students == 0) {
							$num_students = '';
						}
						
						if ($num_periods == 0) {
							$num_periods = '';
						}
						
						$profile_image_url = GetProfileImagePathForUID($uid);
				?>
				
							 <tr data-href="/admin/teachers/<?= $teacher_id ?>/edit/">
								<td>
									<img src="<?= $profile_image_url ?>" width="36" height="36" class="rounded-circle me-2 align-top">
									<span class="d-inline-block text-muted"><?= $fullname ?><br><?= $last_login ?></span>
								</td>
								<td><?= $display_name ?></td>
								<td><?= $mobile ?></td>
								<td><?= $email ?></td>
								<td width="50" class="text-center"><?= $num_courses ?></td>
								<td width="50" class="text-center"><?= $num_students ?></td>
								<td width="50" class="text-center"><?= $num_periods ?></td>
								<td width="50" class="text-center"><?= $active_check ?></td>
							 </tr>
				<?php
					}
				?>			 
						</tbody>
					</table>
				</div>
			</main>

			<?php include('admin/templates/footer.html'); ?>
		</div>
	</div>

	<?php include('admin/templates/foot.html'); ?>

</body>

</html>