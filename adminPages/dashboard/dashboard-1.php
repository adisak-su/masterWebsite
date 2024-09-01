<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-touch-fullscreen" content="yes" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-title" content="AppTitle" />

    
    <link rel="apple-touch-icon" sizes="180x180" href="assets/image/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/image/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/image/favicon-16x16.png">
    
    <link rel="apple-touch-startup-image" href="assets/image/store.png">
    
    <!--
    <link rel="shortcut icon" href="assets/image/favicon.ico">
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    
    <link rel="manifest" href="assets/img/favicons/site.webmanifest?<?php echo time(); ?>">
    
    <link rel="mask-icon" href="assets/img/favicons/safari-pinned-tab.svg" color="#5bbad5">

    
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    
    <link rel="icon" type="image/png" sizes="16x16" href="assets/image/favicons/favicon-16x16.png">
    <link rel="shortcut icon" href="../assets/image/favicons/favicon.ico">
      -->

    <!-- Boxicons -->
    <!-- <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'> -->
    <link href='plugins/boxicons/css/boxicons.min.css' rel='stylesheet'>
    <script src="plugins/boxicons/dist/boxicons.js"></script>

    <!-- My CSS -->
    <link rel="stylesheet" href="styleRoot.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="style.css?<?php echo time(); ?>">

    <title>AdminHub</title>

</head>

<body>
    <!-- SIDEBAR -->
    <?php include "sidebard.php"; ?>

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu bx-md' style="color:var(--blue);"></i>
            <a href="#" class="nav-link">Categories</a>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn" title="xxx"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification">
                <i class='bx bxs-bell bx-tada'></i>
                <span class="num">8</span>
            </a>
            <a href="#" class="profile">
                <img src="img/people.png" alt="">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#">Home</a>
                        </li>
                    </ul>
                </div>
                <a href="#" class="btn-download">
                    <i class='bx bxs-cloud-download'></i>
                    <span class="text">Download PDF</span>
                </a>
            </div>

            <ul class="box-info">
                <li>
                    <i class='bx bxs-calendar-check'></i>
                    <span class="text">
                        <h3>1020</h3>
                        <p>New Order</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-group'></i>
                    <span class="text">
                        <h3>2834</h3>
                        <p>Visitors</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-dollar-circle'></i>
                    <span class="text">
                        <h3>$2543</h3>
                        <p>Total Sales</p>
                    </span>
                </li>
            </ul>


            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Recent Orders</h3>
                        <i class='bx bx-search'></i>
                        <i class='bx bx-filter'></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Date Order</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="img/people.png" alt="">
                                    <p>John Doe</p>
                                </td>
                                <td>01-10-2021</td>
                                <td><span class="status completed">Completed</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="img/people.png" alt="">
                                    <p>John Doe</p>
                                </td>
                                <td>01-10-2021</td>
                                <td><span class="status pending">Pending</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="img/people.png" alt="">
                                    <p>John Doe</p>
                                </td>
                                <td>01-10-2021</td>
                                <td><span class="status process">Process</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="img/people.png" alt="">
                                    <p>John Doe</p>
                                </td>
                                <td>01-10-2021</td>
                                <td><span class="status pending">Pending</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="img/people.png" alt="">
                                    <p>John Doe</p>
                                </td>
                                <td>01-10-2021</td>
                                <td><span class="status completed">Completed</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="todo">
                    <div class="head">
                        <h3>Todos</h3>
                        <i class='bx bx-plus'></i>
                        <i class='bx bx-filter'></i>
                    </div>
                    <ul class="todo-list">
                        <li class="completed">
                            <p>Todo List</p>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </li>
                        <li class="completed">
                            <p>Todo List</p>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </li>
                        <li class="not-completed">
                            <p>Todo List</p>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </li>
                        <li class="completed">
                            <p>Todo List</p>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </li>
                        <li class="not-completed">
                            <p>Todo List</p>
                            <i class='bx bx-dots-vertical-rounded'></i>
                        </li>
                    </ul>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="assets/js/3.6.0.jquery.min.js"></script>

    <script src="scriptSidebar.js?<?php echo time(); ?>"></script>
    <script>
        
    </script>
</body>

</html>