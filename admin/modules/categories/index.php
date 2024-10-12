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
					
					<table class="table">
						  <tbody>
				<?php
					foreach($categories as $category) {
						$category_id = $category['category_id'];
						$category_name = $category['category_name']; 
				?>
				
							 <tr>
								<td><?= $category_name ?></td>
								<td></td>
								<td class="d-none d-md-table-cell"></td>
								<td class="table-action">
								   <a href="/admin/categories/<?= $category_id ?>/edit/"><i class="align-middle" data-feather="edit-2"></i></a>
								   <a href="/admin/categories/<?= $category_id ?>/delete/"><i class="align-middle" data-feather="trash"></i></a>
								</td>
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