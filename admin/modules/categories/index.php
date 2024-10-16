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
				
							 <tr data-href="/admin/categories/<?= $category_id ?>/edit/">
								<td><?= $category_name ?></td>
								<td></td>
								<td class="d-none d-md-table-cell"></td>
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