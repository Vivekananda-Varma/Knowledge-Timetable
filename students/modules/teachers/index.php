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
                                    <h3 class="mb-0 text-center w-100">Teachers</h3>
                                </div>
                                <form class="filter-form mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="uil uil-search" style="font-size: 1.2rem;"></i>
                                        </span>
                                        <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Search...">
                                    </div>
                                </form>
                                <div class="job-list mb-10">
                                    <!-- Card 1 -->
                                    <a href="#" class="card mb-3 lift text-decoration-none">
                                        <div class="card-body p-5">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <div class="profile-pic me-4">
                                                        <img src="../../../frontend/images/user-default-profile-pic.jpg" alt="Profile" />
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <span class="text-body fw-bold text-start">Jagadish Bhai</span>
                                                    </div>
                                                </div>
                                                <i class="uil uil-angle-right-b"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- Card 2 -->
                                    <a href="#" class="card mb-3 lift text-decoration-none">
                                        <div class="card-body p-5">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <div class="profile-pic me-4">
                                                        <img src="../../../frontend/images/user-default-profile-pic.jpg" alt="Profile" />
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <span class="text-body fw-bold text-start">Kumar Bhai</span>
                                                    </div>
                                                </div>
                                                <i class="uil uil-angle-right-b"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- Card 3 -->
                                    <a href="#" class="card mb-3 lift text-decoration-none">
                                        <div class="card-body p-5">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <div class="profile-pic me-4">
                                                        <img src="../../../frontend/images/user-default-profile-pic.jpg" alt="Profile" />
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <span class="text-body fw-bold text-start">Devdip Bhai</span>
                                                    </div>
                                                </div>
                                                <i class="uil uil-angle-right-b"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- Card 4 -->
                                    <a href="#" class="card mb-3 lift text-decoration-none">
                                        <div class="card-body p-5">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <div class="profile-pic me-4">
                                                        <img src="../../../frontend/images/user-default-profile-pic.jpg" alt="Profile" />
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <span class="text-body fw-bold text-start">Mrunalini Di</span>
                                                    </div>
                                                </div>
                                                <i class="uil uil-angle-right-b"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- Card 5 -->
                                    <a href="#" class="card mb-3 lift text-decoration-none">
                                        <div class="card-body p-5">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <div class="profile-pic me-4">
                                                        <img src="../../../frontend/images/user-default-profile-pic.jpg" alt="Profile" />
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <span class="text-body fw-bold text-start">Swadesh Da</span>
                                                    </div>
                                                </div>
                                                <i class="uil uil-angle-right-b"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- Pagination -->
                                <div class="d-flex justify-content-center">
                                    <nav class="d-flex" aria-label="pagination">
                                        <ul class="pagination pagination-alt mb-10">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <span aria-hidden="true"><i class="uil uil-arrow-left"></i></span>
                                                </a>
                                            </li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Next">
                                                    <span aria-hidden="true"><i class="uil uil-arrow-right"></i></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
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
    
