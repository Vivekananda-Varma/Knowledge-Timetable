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
								<th>Name</th>
								<th>Subjects</th>
								<th>Teacher</th>
							</tr>
						</thead>
						<tbody>
				<?php
					foreach($subjects as $subject) {
						$subject_id = $subject['subject_id'];
						$subject_name = $subject['subject_name']; 
				?>
				
					<tr data-bs-toggle="modal" data-bs-target="#defaultModalPrimary" onClick="ShowModal(<?= $subject_id ?>, '<?= $subject_name ?>')">
						<td><?= $subject_name ?></td>
						<td></td>
						<td class="d-none d-md-table-cell"></td>
					</tr>
				<?php
					}
				?>
							<div class="modal fade" id="defaultModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="card">
										<div class="card-header">
											<h5 class="card-title mb-0">Course</h5>
										</div>
										<div class="card-body">
											<input id="subject-name" type="text" class="form-control" value="" placeholder="Name"><br>
                                            <input id="" type="text" class="form-control" value="" placeholder="Category"><br>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Academic
                                                </label>
                                            </div>
										</div>
										<div class="card-footer d-flex module-footer-btn-container">
											<button type="button" class="btn btn-danger">Delete</button>
											<div class="ms-auto">
												<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
												<button type="button" class="btn btn-primary">Save</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</tbody>
					</table>
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