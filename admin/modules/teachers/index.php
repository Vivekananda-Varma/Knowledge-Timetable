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
						<h1 class="h1"><?= $page_title ?></h1>
						<button class="btn btn-outline-primary">New +</button>
					</div>
					
					<table id="datatables-reponsive" class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Name</th>
								<th>Mobile</th>
								<th>Email</th>
								<th>Teacher</th>
								<th>Last Login</th>
							</tr>
						</thead>
						<tbody>
				<?php
					foreach($users as $user) {
						$user_id = $user['user_id'];
						$firstname = $user['firstname'];
						$lastname = $user['lastname'];
						$fullname = "$firstname $lastname";
						
						$mobile = $user['mobile'];
						$email = $user['email'];
						$is_teacher = $user['is_teacher'];
						$otp = $user['otp'];
						$last_login = $user['last_login'];
				?>
				
							 <tr data-href="/admin/users/<?= $user_id ?>/edit/">
								<td><?= $fullname ?></td>
								<td><?= $mobile ?></td>
								<td><?= $email ?></td>
								<td><?= $is_teacher ?></td>
								<td><?= $last_login ?></td>								
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