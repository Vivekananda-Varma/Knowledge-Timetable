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
                        <div class="col-md-6 col-lg-4 col-xl-3 mx-auto">
                            <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
                                <h3 class="card-title mb-0">Profile</h3>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body text-center position-relative">
                                    <a href="/students/modules/profile/" 
                                       class="btn btn-circle btn-primary position-absolute top-0 end-0 m-2">
                                        <i class="uil uil-pen"></i>
                                    </a>
                                    <img src="/admin/images/user-default-profile-pic.jpg" 
                                         alt="User Profile" class="img-fluid rounded-circle mb-2" 
                                         width="128" height="128" />
                                    <h5 class="card-title mb-0">Aadya Ramswaroop</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm my-2">
                                        <tbody>
                                            <tr>
                                                <td class="text-muted text-end">DOB</td>
                                                <td>01/05/2025</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted text-end">Year</td>
                                                <td>K3</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted text-end">Class of</td>
                                                <td>2025</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted text-end">Email</td>
                                                <td>aadyaramswaroop.com</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted text-end">Phone</td>
                                                <td>+123456789</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted text-end">Address</td>
                                                <td>123 Main St, City, Country</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container py-4">
                    <div class="row">
                        <div class="col-12 mx-auto">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-6">
                                    <div class="card p-2 text-center">
                                        <div class="card-body p-3">
                                            <div class="icon btn btn-circle btn-lg btn-soft-red mx-auto mb-3">
                                                <i class="uil uil-server"></i>
                                            </div>
                                            <h4 class="counter mb-1">24</h4>
                                            <p class="mb-0 small">Periods</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card p-2 text-center">
                                        <div class="card-body p-3">
                                            <div class="icon btn btn-circle btn-lg btn-soft-leaf mx-auto mb-3">
                                                <i class="uil uil-books"></i>
                                            </div>
                                            <h4 class="counter mb-1">11</h4>
                                            <p class="mb-0 small">Courses</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
        </div>

        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div>
        <script src="/frontend/assets/js/plugins.js"></script>
        <script src="/frontend/assets/js/theme.js"></script>
    </body>
</html>
