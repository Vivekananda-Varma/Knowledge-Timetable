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
<html>
    <head>
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
    <body>
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
    </body>
</html>