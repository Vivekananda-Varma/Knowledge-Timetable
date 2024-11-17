<?php
    
    include('admin/functions/timetable.inc');
    
    $timetable = GetTimetableForStudentId(7);
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
                            <div id="accordion-1" class="accordion-wrapper">
                    <?php    
                        $day_of_week = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
                        $colors = array('yellow', 'orange', 'red', 'pink', 'violet', 'purple', 'blue', 'aqua', 'green', 'leaf', 'navy', 'fuchsia', 'sky', 'grape');
                        
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
                                                        <div class="card shadow-none">
                                                            <div class="card-header subject px-4 py-2 border-0 bg-ash text-white">&nbsp;</div>
                                                            <div class="card-body p-4 bg-pale-ash text-ash">&nbsp;</div>
                                                            <div class="card-footer place px-4 py-2 border-0 bg-soft-ash text-ash">&nbsp;</div>
                                                        </div>
                                                    </div>
                    <?php				
                                } else {
                                    $place = $period['place_name'] ?? '';
                                    $category_id = $period['category_id'];
                                    $subject = $period['course_name'] ?? '&nbsp;';
                                    $display_name = $period['display_name'] ?? '';
                                    $teacher_id = $period['teacher_id'] ?? '';
                                    $teacher = $period['firstname'] ?? '&nbsp;';
                                    $place = $period['place_name'] ?? '&nbsp;';
                                    
                                    $color = $colors[$category_id % 14];
                                    
                                    if ($display_name == '') {
                                        $display_name = $subject;
                                    }
                                    
                                    $display_name = str_replace(' and ', ' &amp; ', $display_name);
                                    
                                    // if ($teacher_id != '') {
                                    //     $teacher = "<a href=\"/admin/teachers/$teacher_id/edit/\">$teacher</a>";
                                    // }
                    ?>
                                                    <div class="col mb-1">
                                                        <div class="card shadow-none">
                                                            <div class="card-header subject px-4 py-2 border-0 bg-<?= $color ?> text-white"><?= $display_name ?></div>
                                                            <div class="card-body p-4 bg-pale-<?= $color ?> text-<?= $color ?>"><?= $teacher ?></div>
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
            </section>
        </div>
        <?php include('templates/footer.html'); ?>
        <?php include('templates/foot.html'); ?>
    </body>
</html>
