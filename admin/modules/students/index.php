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
							<a class="btn btn-outline-primary" href="/admin/students/export/">Export</a>
							<a class="btn btn-outline-primary" href="/admin/students/import/">Import</a>
							<button class="btn btn-primary">New +</button>
						</div>
					</div>
					
					<table id="datatables-reponsive" class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Name</th>
								<th>Year</th>
								<th>Mobile</th>
								<th>Email</th>
								<th>Periods</th>
							</tr>
						</thead>
						<tbody>
				<?php
					foreach($students as $student) {
						$student_id = $student['student_id'];
						$firstname = $student['firstname'];
						$lastname = $student['lastname'];
						$fullname = "<b>$firstname</b> $lastname";
						$year = $student['year'];
						$class_of = $student['class_of'];
						
						$mobile = $student['mobile'];
						$email = $student['email'];
						$last_login = $student['last_login'];
						
						if ($class_of == '') {
							$class_of = date('Y') - $year + 3;
						}
				?>
							 <tr data-href="/admin/students/<?= $student_id ?>/edit/">
								<td>
									<img src="/admin/images/user-default-profile-pic.jpg" width="36" height="36" class="rounded-circle me-2 align-top" alt="Ashley Briggs">
									<div style="display: inline-block">
										<?= $fullname ?><br>
										<small class="text-muted">Class of <?= $class_of ?></small>
									</div>
								</td>
								<td width="50" class="text-center">K<?= $year ?></td>
								<td><?= $mobile ?></td>
								<td><?= $email ?></td>
								<td width="50" class="text-center"></td>
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