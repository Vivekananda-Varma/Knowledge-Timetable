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
						<h1 class="h1">Courses</h1>
						<button class="btn btn-outline-primary">New +</button>
					</div>
					
					<table id="datatables-reponsive" class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Course</th>
								<th>Subject</th>
								<th>Teacher</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach($courses as $course) {
								$course_id = $course['course_id'];
								$subject_name = $course['subject_name'];
								$course_name = $course['course_name'];
								
								$firstname = $course['firstname'];
								$lastname = $course['lastname'];
								$fullname = "$firstname $lastname";
						?>
							<tr data-bs-toggle="modal" data-bs-target="#defaultModalPrimary" onClick="ShowModal(<?= $course_id ?>, <?= $subject_id ?>, '<?= $course_name ?>')">
								<td><?= $course_name ?></td>
								<td><?= $subject_name ?></td>
								<td><?= $fullname ?></td>
							</tr>
						<?php
							}
						?>
						</tbody>
					</table>
					<div class="modal fade" id="defaultModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<form>
								<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Edit Course</h5>
								</div>
								<div class="card-body">
									<input id="course-name" type="text" class="form-control" value="" placeholder="Course Name"><br>
									<div class="row">
										<div class="mb-3 col-md-6">
											<select id="inputCategory" class="form-control">
												<option selected>Select Category...</option>
												<option>Foreign Languages</option>
												<option>Indian Languages</option>
												<option>Science Subjects</option>
											</select>
										</div>
										<div class="mb-3 col-md-6">
											<select id="inputSubject" class="form-control">
												<option selected>Select Subject...</option>
												<option>English</option>
												<option>French</option>
												<option>German</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="mb-3 col-md-6">
											<select id="inputTeacher" class="form-control">
												<option selected>Select Teacher...</option>
												<option>Nandini</option>
												<option>Avani</option>
												<option>Ragan</option>
											</select>
										</div>
										<div class="mb-3 col-md-6">
											<select id="inputPlace" class="form-control">
												<option selected>Select Place...</option>
												<option>Knowledge</option>
												<option>School</option>
												<option>Miscellaneous</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="mb-3 col-md-4">
											<fieldset class="mb-3">
												<div class="row">
													<label class="col-form-label col-sm-12 text-sm-right pt-sm-0">Duration of the Course</label>
													<div class="col-sm-10">
														<label class="form-check">
															<input name="radio-3" type="radio" class="form-check-input" checked />
															<span class="form-check-label">1 Year</span>
														</label>
														<label class="form-check">
															<input name="radio-3" type="radio" class="form-check-input" />
															<span class="form-check-label">2 Years</span>
														</label>
														<label class="form-check">
															<input name="radio-3" type="radio" class="form-check-input" />
															<span class="form-check-label">3 Years</span>
														</label>
													</div>
												</div>
											</fieldset>
										</div>
										<div class="mb-3 col-md-4">
											<label class="col-form-label col-sm-12 text-sm-right pt-sm-0">Nature of the course</label>
											<div class="col-sm-10">
												<label class="form-check m-0">
													<input type="checkbox" class="form-check-input">
													<span class="form-check-label">Academic</span>
												</label>
											</div>
										</div>
										<div class="mb-3 col-md-4">
											<fieldset class="mb-3">
												<div class="row">
													<label class="col-form-label col-sm-12 text-sm-right pt-sm-0">The course is offered as</label>
													<div class="col-sm-10">
														<label class="form-check">
															<input name="radio-3" type="radio" class="form-check-input" />
															<span class="form-check-label">A Major</span>
														</label>
														<label class="form-check">
															<input name="radio-3" type="radio" class="form-check-input" />
															<span class="form-check-label">A Minor</span>
														</label>
														<label class="form-check">
															<input name="radio-3" type="radio" class="form-check-input" />
															<span class="form-check-label">A Project</span>
														</label>
													</div>
												</div>
											</fieldset>
										</div>
									</div>
									<textarea id="message" type="text"  class="form-control" placeholder="Blurb"></textarea>
								</div>
								<div class="card-footer d-flex module-footer-btn-container">
									<button type="button" class="btn btn-danger">Delete</button>
									<div class="ms-auto">
										<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary">Save</button>
									</div>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</main>

			<?php include('templates/footer.html'); ?>
		</div>
	</div>

	<?php include('templates/foot.html'); ?>

	<script>
		function ShowModal(course_id, subject_id, course_name) {
			$("#course-name").attr('value', course_name);
		}
	</script>
</body>

</html>