<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

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
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .navbar {
            border-top-width: 2px !important;
        }

        .card-footer {
            position: relative;
            z-index: 1;
        }

        .card-link>.card:hover {
            transform: scale(0.9);
        }

        .card {
            transition: .3s;
        }

        .widget-user-header {
            -webkit-box-shadow: inset 0px 0px 300px -1px rgba(0, 0, 0, 0.53);
            -moz-box-shadow: inset 0px 0px 300px -1px rgba(0, 0, 0, 0.53);
            box-shadow: inset 0px 0px 300px -1px rgba(0, 0, 0, 0.53);
        }
    </style>
</head>

<body class="hold-transition layout-top-nav sidebar-collapse">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light border border-danger border-bottom-0 border-left-0 border-right-0">
            <div class="container">
                <a href="" class="navbar-brand">
                    <img src="<?= base_url(); ?>images/cve_tagline_small.png" alt="Commonwealth Visa Experts The experts you can trust" width="300px">
                </a>
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="<?= base_url() ?>stages" class="nav-link <?php if ($this->uri->segment(2) == 'file') : ?>active<?php endif; ?>">Stages</a>
                        </li>
                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item">
                        <a href="settings" class="nav-link">
                            Manage Account
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-user-circle"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <div class="p-3 box-profile">
                                <h4 class="font-weight-bold text-center">
                                    <?= $this->session->userfirst; ?>
                                    <?= $this->session->userlast; ?>
                                </h4>
                                <p class="text-muted text-center text-sm"><?= $this->session->useremail; ?></p>
                                <div class="dropdown-divider"></div>
                                <?= anchor('logout', 'Sign Out', array('class' => 'btn btn-primary btn-block mt-4')); ?>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->