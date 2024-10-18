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
						<h1 class="h1">Categories</h1>
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
					foreach($categories as $category) {
						$category_id = $category['category_id'];
						$category_name = $category['category_name']; 
				?>
				
				<tr data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">
								<td><?= $category_name ?></td>
								<td></td>
								<td class="d-none d-md-table-cell"></td>
							</tr>
				<?php
					}
				?>
						<div class="modal fade" id="defaultModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Category</h5>
										</div>
										<div class="modal-body m-3">
											<div class="col-sm-12">
												<input type="text" class="form-control" placeholder="Name">
											</div>
										</div>
										<div class="modal-footer">
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

</body>

</html>