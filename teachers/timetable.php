<?php
    
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // ini_set('pcre.jit', '0');
    // ini_set('error_reporting', E_ALL ^ E_WARNING);
    
    error_reporting(E_ALL);
    
    $name = $_GET['name'];
    $json_filename = "json/$name.json";
    
    $json = file_get_contents($json_filename);
    $timetable = json_decode($json, true);

    // print_r($timetable); exit;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 5 Admin &amp; Dashboard Template">
    <meta name="author" content="Bootlab">

    <title>Timetable</title>

    <link rel="canonical" href="https://appstack.bootlab.io/calendar.html" />
    <link rel="shortcut icon" href="img/favicon.ico">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link class="js-stylesheet" href="css/light.css" rel="stylesheet">
    <link href="css/timetable.css" rel="stylesheet">    
    <script src="js/settings.js"></script>
    

</head>


<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.html">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve">
                        <path d="M19.4,4.1l-9-4C10.1,0,9.9,0,9.6,0.1l-9,4C0.2,4.2,0,4.6,0,5s0.2,0.8,0.6,0.9l9,4C9.7,10,9.9,10,10,10s0.3,0,0.4-0.1l9-4
                            C19.8,5.8,20,5.4,20,5S19.8,4.2,19.4,4.1z" />
                        <path d="M10,15c-0.1,0-0.3,0-0.4-0.1l-9-4c-0.5-0.2-0.7-0.8-0.5-1.3c0.2-0.5,0.8-0.7,1.3-0.5l8.6,3.8l8.6-3.8c0.5-0.2,1.1,0,1.3,0.5
                            c0.2,0.5,0,1.1-0.5,1.3l-9,4C10.3,15,10.1,15,10,15z" />
                        <path d="M10,20c-0.1,0-0.3,0-0.4-0.1l-9-4c-0.5-0.2-0.7-0.8-0.5-1.3c0.2-0.5,0.8-0.7,1.3-0.5l8.6,3.8l8.6-3.8c0.5-0.2,1.1,0,1.3,0.5
                            c0.2,0.5,0,1.1-0.5,1.3l-9,4C10.3,20,10.1,20,10,20z" />
                    </svg>

                    <span class="align-middle me-3">AppStack</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a data-bs-target="#users" data-bs-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="users"></i>
                            <span class="align-middle">Users</span>
                        </a>
                        <ul id="users" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="users.html">All</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="users.html">Students</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="users.html">Teachers</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="calendar.html">
                            <i class="align-middle" data-feather="book"></i>
                            <span class="align-middle">Categories</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="calendar.html">
                            <i class="align-middle" data-feather="book-open"></i>
                            <span class="align-middle">Subjects</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="calendar.html">
                            <i class="align-middle" data-feather="map-pin"></i>
                            <span class="align-middle">Places</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <form class="d-none d-sm-inline-block">
                    <div class="input-group input-group-navbar">
                        <input type="text" class="form-control" placeholder="Search projects…" aria-label="Search">
                        <button class="btn" type="button">
                            <i class="align-middle" data-feather="search"></i>
                        </button>
                    </div>
                </form>

                <ul class="navbar-nav">
                    <li class="nav-item px-2 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Mega menu
                        </a>
                        <div class="dropdown-menu dropdown-menu-start dropdown-mega" aria-labelledby="servicesDropdown">
                            <div class="d-md-flex align-items-start justify-content-start">
                                <div class="dropdown-mega-list">
                                    <div class="dropdown-header">UI Elements</div>
                                    <a class="dropdown-item" href="#">Alerts</a>
                                    <a class="dropdown-item" href="#">Buttons</a>
                                    <a class="dropdown-item" href="#">Cards</a>
                                    <a class="dropdown-item" href="#">Carousel</a>
                                    <a class="dropdown-item" href="#">General</a>
                                    <a class="dropdown-item" href="#">Grid</a>
                                    <a class="dropdown-item" href="#">Modals</a>
                                    <a class="dropdown-item" href="#">Tabs</a>
                                    <a class="dropdown-item" href="#">Typography</a>
                                </div>
                                <div class="dropdown-mega-list">
                                    <div class="dropdown-header">Forms</div>
                                    <a class="dropdown-item" href="#">Layouts</a>
                                    <a class="dropdown-item" href="#">Basic Inputs</a>
                                    <a class="dropdown-item" href="#">Input Groups</a>
                                    <a class="dropdown-item" href="#">Advanced Inputs</a>
                                    <a class="dropdown-item" href="#">Editors</a>
                                    <a class="dropdown-item" href="#">Validation</a>
                                    <a class="dropdown-item" href="#">Wizard</a>
                                </div>
                                <div class="dropdown-mega-list">
                                    <div class="dropdown-header">Tables</div>
                                    <a class="dropdown-item" href="#">Basic Tables</a>
                                    <a class="dropdown-item" href="#">Responsive Table</a>
                                    <a class="dropdown-item" href="#">Table with Buttons</a>
                                    <a class="dropdown-item" href="#">Column Search</a>
                                    <a class="dropdown-item" href="#">Muulti Selection</a>
                                    <a class="dropdown-item" href="#">Ajax Sourced Data</a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="message-circle"></i>
                                    <span class="indicator">4</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
                                <div class="dropdown-menu-header">
                                    <div class="position-relative">
                                        4 New Messages
                                    </div>
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" alt="Ashley Briggs">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Ashley Briggs</div>
                                                <div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu tortor.</div>
                                                <div class="text-muted small mt-1">15m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-2.jpg" class="avatar img-fluid rounded-circle" alt="Carl Jenkins">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Carl Jenkins</div>
                                                <div class="text-muted small mt-1">Curabitur ligula sapien euismod vitae.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-4.jpg" class="avatar img-fluid rounded-circle" alt="Stacie Hall">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Stacie Hall</div>
                                                <div class="text-muted small mt-1">Pellentesque auctor neque nec urna.</div>
                                                <div class="text-muted small mt-1">4h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-3.jpg" class="avatar img-fluid rounded-circle" alt="Bertha Martin">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Bertha Martin</div>
                                                <div class="text-muted small mt-1">Aenean tellus metus, bibendum sed, posuere ac, mattis non.</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all messages</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="bell-off"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                                <div class="dropdown-menu-header">
                                    4 New Notifications
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-danger" data-feather="alert-circle"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Update completed</div>
                                                <div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-warning" data-feather="bell"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Lorem ipsum</div>
                                                <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
                                                <div class="text-muted small mt-1">6h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-primary" data-feather="home"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Login from 192.186.1.1</div>
                                                <div class="text-muted small mt-1">8h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-success" data-feather="user-plus"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">New connection</div>
                                                <div class="text-muted small mt-1">Anna accepted your request.</div>
                                                <div class="text-muted small mt-1">12h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all notifications</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-flag dropdown-toggle" href="#" id="languageDropdown" data-bs-toggle="dropdown">
                                <img src="img/flags/us.png" alt="English" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                                <a class="dropdown-item" href="#">
                                    <img src="img/flags/us.png" alt="English" width="20" class="align-middle me-1" />
                                    <span class="align-middle">English</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <img src="img/flags/es.png" alt="Spanish" width="20" class="align-middle me-1" />
                                    <span class="align-middle">Spanish</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <img src="img/flags/de.png" alt="German" width="20" class="align-middle me-1" />
                                    <span class="align-middle">German</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <img src="img/flags/nl.png" alt="Dutch" width="20" class="align-middle me-1" />
                                    <span class="align-middle">Dutch</span>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded-circle me-1" alt="Chris Wood" />
                                <span class="text-dark">Chris Wood</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="pages-profile.html">
                                    <i class="align-middle me-1" data-feather="user"></i> Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="align-middle me-1" data-feather="pie-chart"></i> Analytics
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="pages-settings.html">Settings &amp; Privacy</a>
                                <a class="dropdown-item" href="#">Help</a>
                                <a class="dropdown-item" href="#">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

			<main class="content">
                <div class="container-fluid p-8">
                    <h1 class="h3 mb-3">Timetable</h1>
                    <div class="card">
                        <div class="container text-left text-lg-center py-2">
                            <div class="row row-cols-lg-8 row-cols-1">
                                <div class="col d-none d-lg-block"></div>
                                <div class="col period-header d-none d-lg-block">1</div>
                                <div class="col period-header d-none d-lg-block">2</div>
                                <div class="col period-header d-none d-lg-block">3</div>
                                <div class="col period-header d-none d-lg-block">4</div>
                                <div class="col period-header d-none d-lg-block">5</div>
                                <div class="col period-header d-none d-lg-block">6</div>
                                <div class="col period-header d-none d-lg-block">7</div>
    <?php    
                            for($i = 0; $i < count($timetable); $i++) {
                                $row = $timetable[$i];
                                $day = $row['day'];
                                $periods = $row['periods'];
    ?>
                                <div class="col day"><?= $day ?></div>
    <?php    
                                for ($j = 0; $j < count($periods); $j++) {
                                    $period = $periods[$j];
                                    $category = $period['category'];
                                    $subject = $period['subject'] != '' ? $period['subject'] : '&nbsp;';
                                    $teacher = $period['teacher'] != '' ? $period['teacher'] : '&nbsp;';
                                    $place = $period['place'];
    ?>
                                <div class="col">
                                    <span class="period">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16"><path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.27 3.27a.997.997 0 0 0 1.414 0l1.586-1.586a.997.997 0 0 0 0-1.414l-3.27-3.27a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0Zm9.646 10.646a.5.5 0 0 1 .708 0l2.914 2.915a.5.5 0 0 1-.707.707l-2.915-2.914a.5.5 0 0 1 0-.708ZM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11Z"/></svg>
                                    </span>
                                    <div class="subject"><?= $subject ?></div><div class="teacher"><?= $teacher ?></div>
                                </div>
    <?php
                                }
                            }
    ?>
                            </div>
                        </div>    
                    </div>
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

    <script src="js/app.js"></script>

</body>

</html>
