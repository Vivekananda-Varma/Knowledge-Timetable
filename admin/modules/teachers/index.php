<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('templates/head.html'); ?>
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
	<div class="wrapper">
		<?php include('templates/sidebar.html'); ?>
		<div class="main">
			<?php include('templates/navbar.html'); ?>
			
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
							</tr>
						</thead>
					<tbody>
				<?php
					foreach($teachers as $teacher) {
						$teacher_id = $teacher['teacher_id'];
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
				?>
				
							 <tr data-href="/admin/teachers/<?= $teacher_id ?>/edit/">
								<td>
									<img src="/admin/images/user-default-profile-pic.jpg" width="36" height="36" class="rounded-circle me-2 align-top" alt="Ashley Briggs">
									<?= $fullname ?>
								</td>
								<td><?= $display_name ?></td>
								<td><?= $mobile ?></td>
								<td><?= $email ?></td>
								<td width="50" class="text-center"><?= $num_courses ?></td>
								<td width="50" class="text-center"><?= $num_students ?></td>
								<td width="50" class="text-center"><?= $num_periods ?></td>
							 </tr>
				<?php
					}
				?>			 
						</tbody>
					</table>
				</div>
			</main>

			<?php include('templates/footer.html'); ?>
		</div>
	</div>

	<?php include('templates/foot.html'); ?>

</body>

</html>