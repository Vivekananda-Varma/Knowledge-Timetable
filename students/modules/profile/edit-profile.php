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
                                <h4 class="card-title mb-0">Edit Profile</h4>
                                <div class="d-flex">
                                    <a href="/students/modules/profile/" class="btn btn-outline-secondary btn-sm px-3 py-1 me-2">Cancel</a>
                                    <a href="/students/modules/profile/" class="btn btn-primary btn-sm px-3 py-1">Save</a>
                                </div>
                            </div>                            
                            <div class="card mb-3">
                                <div class="card-body text-center">
                                    <img src="/admin/images/user-default-profile-pic.jpg" alt="User Profile" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                                    <h5 class="card-title mb-0">Aadya Ramswaroop</h5>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="mb-3 position-relative">
                                            <label for="dob" class="form-label">DOB</label>
                                            <div class="input-with-icon">
                                                <input type="text" class="form-control" id="dob" value="01/05/2025" disabled />
                                                <i class="uil uil-exclamation-circle icon"></i>
                                            </div>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="year" class="form-label">Year</label>
                                            <div class="input-with-icon">
                                                <input type="text" class="form-control" id="year" value="K3" disabled />
                                                <i class="uil uil-exclamation-circle icon"></i>
                                            </div>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="classOf" class="form-label">Class of</label>
                                            <div class="input-with-icon">
                                                <input type="text" class="form-control" id="classOf" value="2025" disabled />
                                                <i class="uil uil-exclamation-circle icon"></i>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" value="aadyaramswaroop.com"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="phone" value="+123456789"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" value="123 Main St, City, Country"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="alert alert-info alert-icon" role="alert">
                                <i class="uil uil-exclamation-circle"></i><a href="/students/modules/contact-admin/" class="alert-link hover">Contact Admin</a> to change the data in the disabled forms.
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
