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
						<div>
							<a class="btn btn-outline-primary" href="">Export</a>
							<a class="btn btn-outline-primary" href="">Import</a>
							<button class="btn btn-primary" onClick="ShowModal('', '')">New +</button>
						</div>
					</div>
					
					<table id="datatables-reponsive" class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Category Name</th>
								<th class="text-center">Subjects</th>
								<th class="text-center">Teachers</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach($categories as $category) {
								$category_id = $category['category_id'];
								$category_name = $category['category_name'];
								$num_subjects = ''; // $category['num_subjects']; 
								$num_teachers = ''; // $category['num_teachers'];
								
								if ($num_subjects == 0) {
									$num_subjects = '';
								}
								
								// if ($num_teachers == 0) {
								// 	$num_teachers = '';
								// }
						?>
						
							<tr data-bs-toggle="modal" data-bs-target="#modal-alert" onClick="ShowModal(<?= $category_id ?>, '<?= $category_name ?>')">
								<td><?= $category_name ?></td>
								<td width="50" class="text-center"><?= $num_subjects ?></td>
								<td width="50" class="text-center"><?= $num_teachers ?></td>
							</tr>
						<?php
							}
						?>
						</tbody>
					</table>
					
					<div class="modal fade" id="modal-alert" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
						<form class="modal-dialog" id="category-form" name="category-form" method="post" action="">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" id="modal-title">Edit Category</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<input id="category-name" type="text" class="form-control" name="category_name" value="" placeholder="Name">
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
		function ShowModal(id, name) {
			if (name == '') {
				$("#modal-title").html("New Category");
				$("#category-form").attr("action", "/admin/categories/create/");
				
				$('#modal-alert').modal('toggle');
			} else {
				$("#modal-title").html("Edit Place");
				
				$("#category-name").attr("value", name);
				$("#category-form").attr("action", "/admin/categories/" + id + "/editpost/");
			}
		}
	</script>
</body>

</html>