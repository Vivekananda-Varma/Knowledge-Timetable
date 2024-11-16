<!DOCTYPE html>
<html lang="en">

<head>
	<?php include('admin/templates/head.html'); ?>
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
	<div class="wrapper">
		<?php include('admin/templates/sidebar.html'); ?>
		<div class="main">
			<?php include('admin/templates/navbar.html'); ?>
			
			<main class="content">
				<div class="container-fluid p-0">
					<div class="d-flex justify-content-between align-items-center mb-3">
						<h1 class="h1"><?= $page_title ?></h1>
					</div>
					
					<form name="upload-form" action="/admin/students/importpost/" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-12">
								<div class="text-center">
									<div class="mt-2" style="width: 300px; margin: 0 auto 40px">
										<!-- We'll transform this input into a pond -->
										<input type="file" class="filepond" name="filepond[]" data-max-file-size="10MB" data-max-files="1">
									</div>
									<a class="btn btn-secondary" href="/admin/students/">Cancel</a>&nbsp;
									<button type="submit" class="btn btn-primary">Import</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</main>

			<?php include('admin/templates/footer.html'); ?>
		</div>
	</div>

	<?php include('admin/templates/foot.html'); ?>
	<?php include('admin/templates/filepond.html'); ?>

</body>

</html>