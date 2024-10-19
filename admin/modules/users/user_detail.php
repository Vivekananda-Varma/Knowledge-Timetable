<?php
	$firstname = $user['firstname'];
	$lastname = $user['lastname'];
	$fullname = "$firstname $lastname";
	
	$mobile = $user['mobile'];
	$email = $user['email'];
	$is_teacher = $user['is_teacher'];
	$last_login = $user['last_login'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'templates/head.html'; ?>
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
	<div class="wrapper">
		<?php include 'templates/sidebar.html'; ?>
		<div class="main">
			<?php include 'templates/navbar.html'; ?>
			
			<main class="content">
				<div class="container-fluid p-0">					
					<div class="row">
											</button>
							</div>
						</div>
					</div>
				</div>
			</main>

			<?php include 'templates/footer.html'; ?>
		</div>
	</div>

	<?php include 'templates/foot.html'; ?>

</body>

</html>