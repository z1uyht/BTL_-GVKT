<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- theme meta -->
    <meta name="theme-name" content="HelloStore's" />

    <title>City Cycle Admin</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="public/images/favicon-admin.png">
    <script src="public/plugins/jquery/jquery.min.js"></script>
    <!-- Pignose Calender -->
    <link href="public/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <link href="public/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="public/plugins/sweetalert/css/sweetalert.css" rel="stylesheet">
    <link href="public/plugins/summernote/dist/summernote.css" rel="stylesheet">
    <link href="public/plugins/select2/css/select2.min.css" rel="stylesheet">
    <link href="public/plugins/toastr/css/toastr.min.css" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link href="public/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css"
        rel="stylesheet">
    <!-- Page plugins css -->
    <link href="public/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="public/plugins/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="public/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- Daterange picker plugins css -->
    <link href="public/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="public/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <link href="public/css/style.css" rel="stylesheet">
</head>

<body>
    <?php
    include 'app/Controllers/Controller.php';
    include 'app/Models/Eloquent.php';
    ?>


    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="dashboard.php">
                    <b class="logo-abbr"><img src="images/small-logo.png" alt=""> </b>
                    <span class="logo-compact"><img src="public/images/logo-compact.png" alt=""></span>
                    <span class="brand-title">
                        <img class="img-fluid mb-20" src="images/logoshop2023.png" alt="">
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content clearfix">

                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">
                    <div class="input-group icons">
                        <div class="input-group-prepend">
                            <!-- <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"><i
                                    class="mdi mdi-magnify"></i></span>   nút tìm kiếm -->
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img class="img-fluid" style="object-fit: cover;" src="images/hieu-admin.jpg"
                                    height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="logout.php"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>