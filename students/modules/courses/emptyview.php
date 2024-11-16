<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('templates/head.html'); ?>
</head>

<body>
    <div class="content-wrapper">
        <?php include('students/templates/header.html'); ?>

        <section id="snippet-2" class="wrapper bg-light wrapper-border">
            <div class="container pt-2 pt-md-17 pb-md-14">
                <div class="row">
                    <div class="col-xl-10 mx-auto">
                        <div class="d-flex justify-content-between align-items-center mb-4">                             
                            <h3 class="mb-0 text-center">Courses</h3>
                            <div>
                                <a href="remove-courses-view.html" class="btn btn-soft-primary" style="padding: 5px 10px; white-space: nowrap; font-weight: bold;">Edit</a>
                                <a href="add-courses-view.html" class="btn btn-circle btn-primary btn-sm"><i class="uil uil-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Centered icon and text -->
                <div class="row">
                    <div class="col-12 d-flex flex-column justify-content-center align-items-center" style="height: 50vh; text-align: center;">
                        <i class="uil uil-books" style="font-size: 80px; color: #6c757d;"></i>
                        <span class="text-body fw-bold text-start">No Courses</span>
                        <span class="text-muted text-start">Tap the + button to add one </span>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include('templates/foot.html'); ?>
</body>

</html>