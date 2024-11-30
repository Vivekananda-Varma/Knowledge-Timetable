<?php
    
    include('admin/functions/timetable.inc');
    
    $timetable = GetProvisionalTimetableForStudentId($student_id);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('templates/head.html'); ?>
    </head>

    <body>
        <div class="content-wrapper">
            <?php include('students/templates/header.html'); ?>
            
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
                                $num_courses_selected = count($selected_courses);
                                $courses_assigned = array();
                                
                                for($i = 1; $i < 7; $i++) {
                                    $day = $day_of_week[$i];
                            ?>
                                        <div class="card plain accordion-item">
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
                                                                <div class="card shadow-none" data-href="/students/timetable/period/<?= $i ?>/<?= $j ?>/">
                                                                    <div class="card-header subject px-4 py-2 border-0 bg-ash text-white">&nbsp;</div>
                                                                    <div class="card-body p-4 bg-pale-ash text-ash">&nbsp;</div>
                                                                    <div class="card-footer place px-4 py-2 border-0 bg-soft-ash text-ash">&nbsp;</div>
                                                                </div>
                                                            </div>
                            <?php				
                                        } else {
                                            $period = $period[array_key_first($period)];      // for now just take the first course if there are more than 1
                                                                            
                                            // $attendees = $period['attendees'];
                                            $period = $period['details'];
                                            
                                            $place = $period['place_name'] ?? '';
                                            $category_id = $period['category_id'];
                                            $course_id = $period['course_id'];
                                            $course_name = $period['course_name'] ?? '&nbsp;';
                                            $teacher_id = $period['teacher_id'] ?? '';
                                            $teacher = $period['teacher_name'] ?? '&nbsp;';
                                            $place = $period['place_name'] ?? '&nbsp;';
                                            $status = str_replace('_', ' ', $period['status']);
                                            $status_color = BadgeColorForStatus($status);
                                            
                                            $color_index = $category_id % 14;
                                            $color = $colors[$color_index];
                                            
                                            if ($status_color != '') {
                                                $status_title = ucwords($status);
                                                $status_label = substr($status_title, 0, 1);
                                                $status_badge = "<div class=\"badge bg-$status_color rounded-pill px-4 \">$status_title</div>";
                                            } else {
                                                $status_badge = '';
                                            }
                                            
                                            $course_name = str_replace(' and ', ' &amp; ', $course_name);
                                            $num_periods++;
                                            
                                            if (!in_array($course_id, $courses_assigned)) {
                                                $courses_assigned[] = $course_id;
                                            }
                            ?>
                                                            <div class="col mb-1 justify-content-center text-center">
                                                                <div class="card shadow-none mb-0" data-href="/students/timetable/period/<?= $i ?>/<?= $j ?>/">
                                                                    <div class="card-header subject px-4 py-2 border-0 bg-<?= $color ?> text-white text-start"><?= $course_name ?></div>
                                                                    <div class="card-body p-4 bg-pale-<?= $color ?> text-<?= $color ?> text-start"><?= $teacher ?></div>
                                                                    <div class="card-footer place px-4 py-2 border-0 bg-soft-<?= $color ?> text-<?= $color ?> text-start"><?= $place ?></div>
                                                                </div>
                                                                <?= $status_badge ?>
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
                    <h5 class="text-center"><?= $num_periods ?> periods, <?= count($courses_assigned) ?> / <?= $num_courses_selected ?> courses assigned.</h5>
                </div>

            </section>
        </div>
        <?php include('templates/footer.html'); ?>
        <?php include('templates/foot.html'); ?>
    </body>
</html>
