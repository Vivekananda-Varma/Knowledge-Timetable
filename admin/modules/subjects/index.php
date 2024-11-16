<?php
	$js_categories = json_encode($categories);
	$js_teachers = json_encode($teachers);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('admin/templates/head.html'); ?>
	<script>
		var categories = <?= $js_categories ?>;
		var teachers = <?= $js_teachers ?>;
	</script>
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
	<div class="wrapper">
		<?php include('admin/templates/sidebar.html'); ?>
		<div class="main">
			<?php include('admin/templates/navbar.html'); ?>
			
			<main class="content">
				<div class="container-fluid p-0">
					<div class="d-flex justify-content-between align-items-center mb-3">
						<h1 class="h1">Subjects</h1>
						<div>
							<a class="btn btn-outline-primary" href="">Export</a>
							<a class="btn btn-outline-primary" href="/admin/categories/import/">Import</a>
							<button class="btn btn-primary" onClick="ShowModal('', '', '')">New +</button>
						</div>
					</div>
					
					<table id="datatables-reponsive" class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Subject</th>
								<th>Display Name</th>
								<th>Category</th>
								<th class="text-center">Courses</th>
								<th class="text-center">Teachers</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach($subjects as $subject) {
								$category_id = $subject['category_id'];
								$category_name = $subject['category_name'];
								$subject_id = $subject['subject_id'];
								$subject_name = $subject['subject_name'];
								$display_name = $subject['display_name'] ?? '';
								
								$num_courses = $subject['num_courses']; 
								$num_teachers = $subject['num_teachers'];
								
								if ($num_courses == 0) {
									$num_courses = '-';
								}
								
								if ($num_teachers == 0) {
									$num_teachers = '-';
								}
						?>
						
							<tr data-bs-toggle="modal" data-bs-target="#modal-alert" onClick="ShowModal(<?= $category_id ?>, <?= $subject_id ?>, '<?= $subject_name ?>', '<?= $display_name ?>')">
								<td><?= $subject_name ?></td>
								<td><?= $display_name ?></td>
								<td><?= $category_name ?></td>
								<td width="50" class="text-center"><?= $num_courses ?></td>
								<td width="50" class="text-center"><?= $num_teachers ?></td>
							</tr>
						<?php
							}
						?>							
						</tbody>
					</table>
					
					<div class="modal fade" id="modal-alert" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
						<form class="modal-dialog modal-lg" id="subject-form" name="subject-form" method="post" action="">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" id="modal-title">Edit Subject</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="row mb-2">
										<div class="col-6">
											<label class="form-label">Subject Name</label>
											<input id="subject-name" type="text" class="form-control" name="subject_name" value="" placeholder="Name">
										</div>
										<div class="col-6">
											<label class="form-label">Display Name</label>
											<input id="display-name" type="text" class="form-control" name="display_name" value="" placeholder="What to display if name is too long">
										</div>
									</div>
									<select id="inputCategory" class="form-select mb-3" name="category_id">
										<option>Select Category...</option>
									</select>	
									<div id="teachers-list" class="row">
										<!-- <div class="mb-3 col-md-3">
											<label class="form-check">
												<input type="checkbox" class="form-check-input">
												<span class="form-check-label">Teacher 1</span>
											</label>
										</div>
										<div class="mb-3 col-md-3">
											<label class="form-check">
												<input type="checkbox" class="form-check-input">
												<span class="form-check-label">Teacher 2</span>
											</label>
										</div>
										<div class="mb-3 col-md-3">
											<label class="form-check">
												<input type="checkbox" class="form-check-input">
												<span class="form-check-label">Teacher 3</span>
											</label>
										</div>
										<div class="mb-3 col-md-3">
											<label class="form-check">
												<input type="checkbox" class="form-check-input">
												<span class="form-check-label">Teacher 4</span>
											</label>
										</div> -->
									</div>
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

			<?php include('admin/templates/footer.html'); ?>
		</div>
	</div>

	<?php include('admin/templates/foot.html'); ?>

	<script>
		function ShowModal(catId, subjectId, subjectName, displayName) {
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
			
			if (subjectName == '') {
				$("#modal-title").html("New Subject");
				$("#subject-form").attr("action", "/admin/subjects/create/");
				
				$('#modal-alert').modal('toggle');
			} else {
				$("#modal-title").html("Edit Subject");
				
				$("#subject-name").attr("value", subjectName);
				$("#display-name").attr("value", displayName);
				$("#subject-form").attr("action", "/admin/subjects/" + subjectId + "/editpost/");
			}
			
			var teachersListContainer = $("#teachers-list");
			
			teachersListContainer.empty();
			
			for(var i = 0; i < teachers.length; i++) {
				var teacher_id = teachers[i]['teacher_id'];
				var name = teachers[i]['firstname'];
				
				var div = $("<div class='mb-3 col-md-2'></div>");
				var label = $("<label class='form-check'></label>");
				var checkbox = $("<input type='checkbox' class='form-check-input' />");
				var checkboxLabel = $("<span class='form-check-label'></span>");
				
				checkboxLabel.html(name);
				
				label.append(checkbox);
				label.append(checkboxLabel);
				
				div.append(label);
				
				teachersListContainer.append(div);
				
				// <div class="mb-3 col-md-3">
				// 	<label class="form-check">
				// 		<input type="checkbox" class="form-check-input">
				// 		<span class="form-check-label">Teacher 1</span>
				// 	</label>
				// </div>
				
			}
		}
	</script>
</body>

</html>