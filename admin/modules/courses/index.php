<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('templates/head.html'); ?>
    </head>

    <body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
        <div class="wrapper">
            <?php include('templates/sidebar.html'); ?>
		    <div class="main">
			    <?php include('templates/navbar.html'); ?>
                
                <main class="content">
                    <div class="container-fluid p-0">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h1 class="h1">Courses</h1>
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <button class="btn btn-outline-primary">New +</button>
                            </div>
                        </div>
                        <!-- First Table -->
                        <table id="datatables-reponsive" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Subjects</th>
                                    <th>Teacher</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Essays on the Gita</td>
                                    <td></td>
                                    <td class="d-none d-md-table-cell"></td>
                                </tr>
                                <tr>
                                    <td>Letters on Yoga</td>
                                    <td></td>
                                    <td class="d-none d-md-table-cell"></td>
                                </tr>
                                <tr>
                                    <td>Savitri</td>
                                    <td></td>
                                    <td class="d-none d-md-table-cell"></td>
                                </tr>
                                <tr>
                                    <td>Foundations of Indian Culture</td>
                                    <td></td>
                                    <td class="d-none d-md-table-cell"></td>
                                </tr>
                            </tbody>
                        </table>
                                
                    </div>
                </main>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row text-muted">
                            <div class="col-6 text-start">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a class="text-muted" href="#">Support</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="text-muted" href="#">Help Center</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="text-muted" href="#">Privacy</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="text-muted" href="#">Terms of Service</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-6 text-end">
                                <p class="mb-0">
                                    &copy; 2023 - <a href="index.html" class="text-muted">AppStack</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <?php include('templates/foot.html'); ?>
    </body>
</html>