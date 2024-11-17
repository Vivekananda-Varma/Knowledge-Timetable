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
                        <i class="uil uil-books" style="font-size: 5rem;"></i>
                        <h2 class="display-4 mb-3">Courses</h2>
                        <p class="lead fs-md mb-6 px-xl-10 px-xxl-15">Start by selecting courses you would like to sign up for in this academic year. They will appear here.</p>
                        <a href="/students/courses/select/" class="btn btn-primary rounded">Select Courses</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include('templates/foot.html'); ?>
</body>

</html>