<?php
    
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // ini_set('pcre.jit', '0');
    // ini_set('error_reporting', E_ALL ^ E_WARNING);
    
    error_reporting(E_ALL);
    
    $name = $_GET['name'];
    $json_filename = "json/$name.json";
    
    $json = file_get_contents($json_filename);
    $timetable = json_decode($json, true);

    // print_r($timetable); exit;
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Time Table 2023</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
	<link href="styles/timetable.css" rel="stylesheet">
</head>

    
    <h1>TIMETABLE</h1>
	<div class="container text-left text-lg-center py-2">
		<div class="row row-cols-lg-8 row-cols-1">
			<div class="col d-none d-lg-block"></div>
			<div class="col period-header d-none d-lg-block">1</div>
			<div class="col period-header d-none d-lg-block">2</div>
			<div class="col period-header d-none d-lg-block">3</div>
			<div class="col period-header d-none d-lg-block">4</div>
			<div class="col period-header d-none d-lg-block">5</div>
			<div class="col period-header d-none d-lg-block">6</div>
			<div class="col period-header d-none d-lg-block">7</div>

<?php    
        for($i = 0; $i < count($timetable); $i++) {
            $row = $timetable[$i];
            $day = $row['day'];
            $periods = $row['periods'];
?>
			<div class="col day"><?= $day ?></div>
<?php    
            for ($j = 0; $j < count($periods); $j++) {
                $period = $periods[$j];
                $category = $period['category'];
                $subject = $period['subject'] != '' ? $period['subject'] : '&nbsp;';
                $teacher = $period['teacher'] != '' ? $period['teacher'] : '&nbsp;';
                $place = $period['place'];
?>
			<div class="col">
				<span class="period">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16"><path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.27 3.27a.997.997 0 0 0 1.414 0l1.586-1.586a.997.997 0 0 0 0-1.414l-3.27-3.27a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0Zm9.646 10.646a.5.5 0 0 1 .708 0l2.914 2.915a.5.5 0 0 1-.707.707l-2.915-2.914a.5.5 0 0 1 0-.708ZM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11Z"/></svg>
                </span>
                <div class="subject"><?= $subject ?></div><div class="teacher"><?= $teacher ?></div>
			</div>
<?php
            }
		}
?>


		</div>
	</div>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>