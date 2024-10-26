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
						<h1 class="h1">Subjects</h1>
						<button class="btn btn-outline-primary">New +</button>
					</div>
					
					<table id="datatables-reponsive" class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Subject</th>
								<th>Category</th>
								<th>Courses</th>
								<th>Teachers</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach($subjects as $subject) {
								$category_id = $subject['category_id'];
								$category_name = $subject['category_name'];
								$subject_id = $subject['subject_id'];
								$subject_name = $subject['subject_name'];
						?>
						
							<tr data-bs-toggle="modal" data-bs-target="#defaultModalPrimary" onClick="ShowModal(<?= $subject_id ?>, '<?= $subject_name ?>')">
								<td><?= $subject_name ?></td>
								<td><?= $category_name ?></td>
								<td></td>
								<td></td>
							</tr>
						<?php
							}
						?>							
						</tbody>
					</table>
					
					<div class="modal fade" id="defaultModalPrimary" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
						<form class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" id="exampleModalLabel">Edit Subject</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<input id="subject-name" type="text" class="form-control" value="" placeholder="Name"><br>
									<select id="inputCategory" class="form-control" name="category">
										<option>Category...</option>
									<?php
										foreach($categories as $category) {
											$category_id = $category['category_id'];
											$category_name = $category['category_name']; 
									
											// if ($i == $year) {
											// 	$selected = 'selected';
											// } else {
											// 	$selected = '';
											// }
									?>
										<option value="<?= $category_id ?>"><?= $category_name ?></option>
									<?php
										}
									?>
									</select>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
										<label class="form-check-label" for="flexCheckDefault">
											Academic
										</label>
									</div>
								</div>
								<div class="modal-footer justify-content-between">
									<button type="button" class="btn btn-danger mr-auto">Delete</button>
									<div>
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary">Save</button>
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
		function ShowModal(id, name) {
			$("#subject-name").attr('value', name);
		}
	</script>
</body>

</html>