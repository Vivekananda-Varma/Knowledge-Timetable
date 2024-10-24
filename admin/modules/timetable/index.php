<?php

	$name = $_GET['name'];
	$json_filename = "admin/modules/timetable/json/$name.json";

	$json = file_get_contents($json_filename);
	$timetable = json_decode($json, true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'templates/head.html'; ?>
	<style>
		table {
			border-collapse: collapse;
		}
		
		td {
			border: 1px #ccc solid;
			padding: 2px 5px;
		}
    </style>
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
	<div class="wrapper">
		<?php include 'templates/sidebar.html'; ?>
		<div class="main">
			<?php include 'templates/navbar.html'; ?>
			
			<main class="content">
				<div class="container-fluid p-0">					
					<div class="row">
						<div class="container-fluid p-0">
							<div class="row">
								<!-- Profile Details Card -->
								<div class="col-md-4 col-xl-3">
									<div class="card mb-3">
										<div class="card-header d-flex justify-content-between align-items-center">
											<h5 class="card-title mb-0">Profile Details</h5>
											<button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#editProfileCard" aria-expanded="false" aria-controls="editProfileCard" title="Edit Profile">
												Edit
											</button>
										</div>
										<div class="card-body text-center">
											<img src="/admin/images/user-default-profile-pic.jpg" alt="Stacie Hall" class="img-fluid rounded-circle mb-2" width="128" height="128" />
											<h5 class="card-title mb-0">Test</h5>
										</div>
										
									</div>
								</div>



								<!-- Profile Card Popup -->
								<div class="col-md-8 col-xl-9" id="timetableCard">
									<div class="card">
										<div class="card-header">
											<h5 class="card-title">Timetable</h5>
										</div>
										<div class="card-body">	
										<table>
									<?php    
											for($i = 0; $i < count($timetable); $i++) {
												$row = $timetable[$i];
												$day = $row['day'];
												$periods = $row['periods'];
									?>
												<tr>
													<td><?= $day ?></td>                
									<?php    
												for ($j = 0; $j < count($periods); $j++) {
													$period = $periods[$j];
													$category = $period['category'];
													$subject = $period['subject'];
													$teacher = $period['teacher'];
													$place = $period['place'];
									?>
													<td>
														<?= $category ?><br>
														<?= $subject ?><br>
														<?= $teacher ?><br>
														<?= $place ?>   
													</td>
									<?php
												}
									?>
												</tr>
									<?php
											}
									?>
											</table>
										</div>
									</div>
								</div>


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