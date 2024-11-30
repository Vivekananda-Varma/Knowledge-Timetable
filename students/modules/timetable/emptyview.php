<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('templates/head.html'); ?>
</head>

<body>
    <div class="content-wrapper">
        <?php include('students/templates/header.html'); ?>

        <section id="empty-courses" class="wrapper bg-light wrapper-border">
            <div class="container pt-15 pt-md-17 pb-13 pb-md-15 text-center">
                <div class="row">
                    <div class="col-md-9 col-lg-7 col-xl-7 mx-auto text-center">
                        <img src="/frontend/assets/img/illustrations/3d8.png" width="300" />
                        <!-- <i class="uil uil-list-ul" style="font-size: 5rem;"></i> -->
                        <h2 class="display-4 my-3">Timetable</h2>
                        <p class="lead fs-md mb-6 px-xl-10 px-xxl-15">There is no way around this. You have to first pick the courses you want to join.</p>
                        <a href="/students/courses/select/" class="btn btn-primary rounded">Select Courses</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include('templates/footer.html'); ?>
    <?php include('templates/foot.html'); ?>
</body>

</html>