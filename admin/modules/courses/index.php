<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('templates/head.html'); ?>
	<script>
		var categories = <?= json_encode($categories) ?>;
		var places = <?= json_encode($places) ?>;
	</script>
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
						<div>
							<a class="btn btn-outline-primary" href="">Export</a>
							<a class="btn btn-outline-primary" href="">Import</a>
							<button class="btn btn-primary" onClick="ShowModal('', '', '')">New +</button>
						</div>
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
								$category_id = $course['category_id'];
								$subject_id = $course['subject_id'];
								$teacher_id = $course['teacher_id'];
								$place_id = $course['default_place_id'];
								
								$subject_name = $course['subject_name'];
								$course_name = $course['course_name'];
								
								$firstname = $course['firstname'];
								$lastname = $course['lastname'];
								$fullname = "$firstname $lastname";
						?>
							<tr data-bs-toggle="modal" data-bs-target="#modal-alert" onClick="ShowModal(<?= $course_id ?>, <?= $category_id ?>, <?= $subject_id ?>, <?= $teacher_id ?>, <?= $place_id ?>, '<?= $course_name ?>')">
								<td><?= $course_name ?></td>
								<td><?= $subject_name ?></td>
								<td><?= $fullname ?></td>
							</tr>
						<?php
							}
						?>
						</tbody>
					</table>

					<div class="modal fade" id="modal-alert" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
						<form class="modal-dialog" id="course-form" name="course-form" method="post" action="">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" id="modal-title">Edit Course</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<label class="form-label">Course Name</label>
									<input id="course-name" type="text" class="form-control" name="course_name" value="" placeholder="Course name"><br>
									<div class="row">
										<div class="mb-3 col-md-6">
											<label class="form-label">Category</label>
											<select id="inputCategory" class="form-select">
												<option selected>Select Category...</option>
											</select>
										</div>
										<div class="mb-3 col-md-6">
											<label class="form-label">Subject</label>
											<select id="inputSubject" class="form-select">
												<option selected>Select Subject...</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="mb-3 col-md-6">
											<label class="form-label">Teacher</label>
											<select id="inputTeacher" class="form-select">
												<option selected>Select Teacher...</option>
											</select>
										</div>
										<div class="mb-3 col-md-6">
											<label class="form-label">Preferred Place</label>
											<select id="inputPlace" class="form-select">
												<option selected>Select Place...</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="mb-3 col-md-4">
											<fieldset class="mb-3">
												<div class="row">
													<label class="col-form-label col-sm-12 text-sm-right pt-sm-0">Duration of Course</label>
													<div class="col-md-10">
														<select id="inputYear" class="form-select">
															<option selected>Select...</option>
															<option value="1">1 year</option>
															<option value="2">2 years</option>
															<option value="3">3 years</option>
														</select>
													</div>
												</div>
											</fieldset>
										</div>
										<div class="mb-3 col-md-4">
											<fieldset class="mb-3">
												<div class="row">
													<label class="col-form-label col-sm-12 text-sm-right pt-sm-0">Nature of Course</label>
													<div class="col-md-10">
														<select id="inputCourseNature" class="form-select">
															<option selected>Select...</option>
															<option>Academic</option>
															<option>Non Academic</option>
														</select>
													</div>
												</div>
											</fieldset>
										</div>
										<div class="mb-3 col-md-4">
											<fieldset class="mb-3">
												<div class="row">
													<label class="col-form-label col-sm-12 text-sm-right pt-sm-0">The Course is Offered as</label>
													<div class="col-md-10">
														<select id="inputCourseTrack" class="form-select">
															<option selected>Select...</option>
															<option>A Major</option>
															<option>A Minor</option>
															<option>A Project</option>
														</select>
													</div>
												</div>
											</fieldset>
										</div>
									</div>
									<textarea id="message" type="text"  class="form-control" placeholder="Blurb"></textarea>
									
									
								</div>
								<div class="modal-footer justify-content-between">
									<button type="button" class="btn btn-danger mr-auto">Delete</button>
									<div>
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
										<input type="submit" class="btn btn-primary" value="Save">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</main>

			<?php include('templates/footer.html'); ?>
		</div>
	</div>

	<?php include('templates/foot.html'); ?>	
	<script>
		function ShowModal(courseId, catId, subjectId, teacherId, placeId, courseName) {
			LoadCategories(catId);
			LoadPlaces(placeId);
			
			LoadSubjectsForCategory(catId, subjectId);
			LoadTeachersForSubject(subjectId, teacherId);
			
			if (courseName == '') {
				$("#modal-title").html("New Course");
				$("#course-form").attr("action", "/admin/courses/create/");
				
				$('#modal-alert').modal('toggle');
			} else {
				$("#modal-title").html("Edit Course");
				
				$("#course-name").attr('value', courseName);
				$("#course-form").attr("action", "/admin/courses/" + courseId + "/editpost/");
			}
		}
		
		function LoadCategories(catId) {
			var select = $("#inputCategory");
			
			$('#inputCategory option:not(:first)').remove();
			
			for(var i = 0; i < categories.length; i++) {
				var category_id = categories[i]['category_id'];
				var name = categories[i]['category_name'];
				var option = document.createElement("option");
				
				option.textContent = name;
				option.value = category_id;
				
				if (catId == category_id) {
					option.selected = true;
				}
				
				select.append(option);
			}
		}
		
		function LoadPlaces(placeId) {
			var select = $("#inputPlace");
			
			$('#inputPlace option:not(:first)').remove();
			
			for(var i = 0; i < places.length; i++) {
				var id = places[i]['place_id'];
				var name = places[i]['place_name'];
				var option = document.createElement("option");
				
				option.textContent = name;
				option.value = id;
				
				if (id == placeId) {
					option.selected = true;
				}
				
				select.append(option);
			}
		}
		
		function LoadSubjectsForCategory(categoryId, subjectId) {
			$.ajax({
				type: "POST",
				url: "/admin/complete/subjects/cat/" + categoryId,
				cache: "false",
				dataType: "json",
				success: function(subjects) {
					var select = $("#inputSubject");
					
					$('#inputSubject option:not(:first)').remove();
					
					for(var i = 0; i < subjects.length; i++) {
						var id = subjects[i]['subject_id'];
						var name = subjects[i]['subject_name'];
						var option = document.createElement("option");
						
						option.textContent = name;
						option.value = id;
						
						if (id == subjectId) {
							option.selected = true;
						}
						
						select.append(option);
					}
				}
			});
		}
		
		function LoadTeachersForSubject(subjectId, teacherId) {
			$.ajax({
				type: "POST",
				url: "/admin/complete/teachers/subject/" + subjectId,
				cache: "false",
				dataType: "json",
				success: function(teachers) {
					var select = $("#inputTeacher");
					
					$('#inputTeacher option:not(:first)').remove();
					
					for(var i = 0; i < teachers.length; i++) {
						var id = teachers[i]['id'];
						var name = teachers[i]['name'];
						var option = document.createElement("option");
						
						option.textContent = name;
						option.value = id;
						
						if (id == teacherId) {
							option.selected = true;
						}
						
						select.append(option);
					}
				}
			});
		}
	</script>
</body>

</html>