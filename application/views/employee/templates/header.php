<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="description" content="CommonWealth VISA Tool for clients" />
    <meta name="keywords" content="CommonWealth VISA Tool" />
    <meta name="CommonWealth VISA Tool" content="CommonWealth VISA client File Management" />
    <!-- Favicon -->
    <link rel="icon" href="<?= base_url(); ?>images/site.png" sizes="192x192" />

    <title>Commonwealth Visa Experts</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">

    <style>
        tr.group,
        tr.group:hover {
            background-color: #ddd !important;
        }

        .navbar {
            border-top-width: 2px !important;
        }

        .custom-file-label {
            overflow: hidden !important;
        }

        .dt-button {
            border-radius: 3px !important;
            border-color: #007bff !important;
            color: #fff !important;
            background: #007bff !important;
            box-shadow: none !important;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out !important;
        }

        .dt-button:hover {
            background: #056ad7 !important;
            text-decoration: none !important;
        }

        #file_tbl tr.odd td:first-child,
        #file_tbl tr.even td:first-child {
            padding-left: 4em;
        }

        .counselor:hover {
            cursor: pointer;
        }

        .select2-selection__rendered {
            line-height: 31px !important;
        }

        .select2-container .select2-selection--single {
            height: 40px !important;
        }

        .select2-selection__arrow {
            height: 34px !important;
        }

        .widget-user-header {
            -webkit-box-shadow: inset 0px 0px 300px -1px rgba(0, 0, 0, 0.53);
            -moz-box-shadow: inset 0px 0px 300px -1px rgba(0, 0, 0, 0.53);
            box-shadow: inset 0px 0px 300px -1px rgba(0, 0, 0, 0.53);
        }

        .card-footer {
            position: relative;
        }

        .custom-file-label {
            overflow: hidden !important;
        }
    </style>
</head>

<body class="hold-transition layout-top-nav sidebar-collapse">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light border border-danger border-bottom-0 border-left-0 border-right-0">
            <div class="container-fluid">
                <a href="" class="navbar-brand">
                    <img src="<?= base_url() ?>images/cve_tagline_small.png" alt="Commonwealth Visa Experts The experts you can trust" width="300px">
                </a>
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>employee/clients" class="
                                nav-link
                                <?php if ($this->uri->segment(2) == 'clients' && $this->uri->segment(3) == '') : ?>
                                active
                                <?php endif; ?>">
                                Clients
                            </a>
                        </li>
                        <?php if ($this->session->employee_role == 4) : ?>
                            <li class="nav-item">
                                <a href="<?= base_url(); ?>employee/users" class="nav-link
                            <?php if ($this->uri->segment(2) == 'users' && $this->uri->segment(3) == '') : ?>
                                active
                                <?php endif; ?>">
                                    Users
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($this->session->employee_role == 1 || $this->session->employee_role == 4) : ?>
                            <li class=" nav-item">
                                <a href="<?= base_url() ?>employee/clients/register" class="nav-link">
                                    Client Registration
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>employee/employee/register" class="nav-link">
                                    Employee Registration
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($this->session->employee_role != 3) : ?>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>employee/list/prospect" class="nav-link <?php if ($this->uri->segment(3) == 'prospect') : ?>active<?php endif; ?>">
                                    Prospect List
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($this->session->employee_role == 2 || $this->session->employee_role == 4) : ?>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>employee/import/csv" class="nav-link <?php if ($this->uri->segment(3) == 'csv') : ?>active<?php endif; ?>">
                                    Import CSV
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($this->session->employee_role == 4) : ?>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>employee/set" class="nav-link <?php if ($this->uri->segment(2) == 'set') : ?>active<?php endif; ?>">
                                    Set ID MMYY
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-user-circle"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <div class="p-3 box-profile">
                                <div class="text-center">
                                    <span class="badge badge-danger">
                                        <?php if ($this->session->employee_role == 1) : ?>
                                            Administrator
                                        <?php elseif ($this->session->employee_role == 2) : ?>
                                            Marketing
                                        <?php elseif ($this->session->employee_role == 3) : ?>
                                            Documentation
                                        <?php elseif ($this->session->employee_role == 4) : ?>
                                            Super User
                                        <?php elseif ($this->session->employee_role == 5) : ?>
                                            Approver
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <h5 class="font-weight-bold text-center">
                                    <?= $this->session->employee_first; ?>
                                    <?= $this->session->employee_last; ?>
                                </h5>
                                <p class="text-muted text-center text-sm"><?= $this->session->employee_realid; ?></p>
                                <div class="text-center mt-2">
                                    <?= anchor('employee/settings', 'Manage your Account'); ?>
                                </div>
                                <div class="dropdown-divider"></div>
                                <?= anchor('employee/logout', 'Sign Out', array('class' => 'btn btn-primary btn-block mt-4')); ?>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->