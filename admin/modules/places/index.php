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
						<h1 class="h1">Places</h1>
						<button class="btn btn-outline-primary" onClick="ShowModal('', '')">New +</button>
					</div>
					
					<table id="datatables-reponsive" class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Name</th>
								<th>Subjects</th>
								<th>Teachers</th>
								<th>Students</th>
								<th>Periods</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach($places as $place) {
								$place_id = $place['place_id'];
								$place_name = $place['place_name']; 
								$num_periods = $place['num_periods'];
								
								if ($num_periods == 0) {
									$num_periods = '';
								}
						?>
						
							<tr data-bs-toggle="modal" data-bs-target="#modal-alert" onClick="ShowModal(<?= $place_id ?>, '<?= $place_name ?>')">
								<td><?= $place_name ?></td>
								<td width="50" class="text-center"></td>
								<td width="50" class="text-center"></td>
								<td width="50" class="text-center"></td>
								<td width="50" class="text-center"><?= $num_periods ?></td>
							</tr>
						<?php
							}
						?>			 							
						</tbody>
					</table>
					
					<div class="modal fade" id="modal-alert" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
						<form class="modal-dialog" id="place-form" name="place-form" method="post" action="">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" id="modal-title">Edit Place</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<input id="place-name" type="text" class="form-control" name="place_name" value="" placeholder="Name">
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
				$("#modal-title").html("New Place");
				$("#place-form").attr("action", "/admin/places/create/");
				
				$('#modal-alert').modal('toggle');
			} else {
				$("#modal-title").html("Edit Place");
				
				$("#place-name").attr('value', name);
				$("#place-form").attr("action", "/admin/places/" + id + "/editpost/");
			}
		}
	</script>
</body>

</html>