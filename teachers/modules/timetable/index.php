<?php
    
    include('admin/functions/timetable.inc');
    include('admin/functions/provisionals.inc');
    
    // TODO: merge timetable data with provisional data
    // $timetable = GetTimetableForTeacherId($teacher_id);
    $timetable = GetProvisionalTimetableForTeacherId($teacher_id);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('templates/head.html'); ?>
    </head>

    <body>
        <div class="content-wrapper">
            <?php include('teachers/templates/header.html'); ?>
            
            <section id="timetable" class="wrapper bg-light">
                <div class="container pt-10 pt-md-17 pb-13 pb-md-15">
                    <h2 class="display-4 mb-3 text-center">Timetable</h2>
                    <div class="row justify-content-center">
                        <div class="col-lg-12 col-md-8 col-sm-10 mb-0 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div id="accordion-1" class="accordion-wrapper">
                            <?php    
                                $num_periods = 0;
                                
                                for($i = 1; $i < 7; $i++) {
                                    $day = $day_of_week[$i];
                            ?>
                                        <div class="card accordion-item">
                                            <div class="card-header" id="accordion-heading-1-<?= $i ?>">
                                                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-1-<?= $i ?>" aria-expanded="false" aria-controls="accordion-collapse-1-<?= $i ?>"><?= $day ?></button>
                                            </div>
                                            <div id="accordion-collapse-1-<?= $i ?>" class="collapse" aria-labelledby="accordion-heading-1-<?= $i ?>" data-bs-target="#accordion-1">
                                                <div class="card-body px-3">
                                                    <div class="container">
                                                        <div class="row row-cols-1 row-cols-lg-7 mb-lg-1 mx-lg-n4 gx-1">
                            <?php    
                                    for ($j = 1; $j < 8; $j++) {
                                        $period = $timetable[$i][$j] ?? array();
                                        
                                        if (empty($period)) {
                            ?>
                                                            <div class="col mb-1">
                                                                <!-- <div class="card shadow-none" data-href="/teachers/timetable/period/<?= $i ?>/<?= $j ?>/"> -->
                                                                <div class="card shadow-none">
                                                                    <div class="card-header subject px-4 py-2 border-0 bg-ash text-white">&nbsp;</div>
                                                                    <div class="card-body p-4 bg-pale-ash text-ash">&nbsp;</div>
                                                                    <div class="card-footer place px-4 py-2 border-0 bg-soft-ash text-ash">&nbsp;</div>
                                                                </div>
                                                            </div>
        
                            <?php				
                                        } else {
                                            $period = $period[array_key_first($period)];      // for now just take the first course if there are more than 1
                                                                            
                                            $attendees = $period['attendees'];
                                            $period = $period['details'];
        
                                            $place = $period['place_name'] ?? '';
                                            $category_id = $period['category_id'];
                                            $course_id = $period['course_id'];
                                            $course_name = $period['course_name'] ?? '&nbsp;';
                                            $place = $period['place_name'] ?? '&nbsp;';
                                            
                                            $color_index = $category_id % 14;
                                            $color = $colors[$color_index];
                                            
                                            $course_name = str_replace(' and ', ' &amp; ', $course_name);
                                            
                                            $firstnames = [];
                                            $num_attendees = count($attendees);
                                            
                                            foreach($attendees as $student) {
                                                $display_name = $student['display_name'];
                                                $status = str_replace('_', ' ', $student['status']);
                                                $status_color = BadgeColorForStatus($status);
                                                
                                                
                                                if ($display_name == '') {
                                                    $display_name = $student['firstname'];
                                                }
                                                
                                                $firstnames[] = $display_name;
                                            }
                                            
                                            $students = $firstnames[0];
                                            
                                            if ($num_attendees > 1) {
                                                $minus_1 = $num_attendees - 1;
                                                $students = "$students and $minus_1 more";
                                            }
                                            
                                            $num_periods++;
                            ?>
                                                            <div class="col mb-1">
                                                                <div class="card shadow-none" data-href="/teachers/timetable/period/<?= $i ?>/<?= $j ?>/">
                                                                    <div class="card-header subject px-4 py-2 border-0 bg-<?= $color ?> text-white"><?= $course_name ?></div>
                                                                    <div class="card-body p-4 bg-pale-<?= $color ?> text-<?= $color ?>"><?= $students ?></div>
                                                                    <div class="card-footer place px-4 py-2 border-0 bg-soft-<?= $color ?> text-<?= $color ?>"><?= $place ?></div>
                                                                </div>
                                                            </div>
                            <?php
                                        }
                                    }
                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            <?php
                                }
                            ?>          
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h5 class="text-center"><?= $num_periods ?> periods</h5>
                </div>

            </section>
        </div>
        <?php include('templates/footer.html'); ?>
        <?php include('templates/foot.html'); ?>
    </body>
</html>
