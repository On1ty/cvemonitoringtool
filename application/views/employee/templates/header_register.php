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

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/select2/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <style>
        .navbar {
            border-top-width: 2px !important;
        }
    </style>
</head>

<body class="hold-transition layout-top-nav sidebar-collapse">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light border border-danger border-bottom-0 border-left-0 border-right-0">
            <div class="container">
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
                                <a href="<?= base_url(); ?>employee/users" class="nav-link">
                                    Users
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($this->session->employee_role == 1 || $this->session->employee_role == 4) : ?>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>employee/clients/register" class="
                                nav-link <?php if ($this->uri->segment(2) == 'clients' && $this->uri->segment(3) == 'register') : ?>
                                active
                                <?php endif; ?>">
                                    Client Registration
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>employee/employee/register" class="
                                nav-link <?php if ($this->uri->segment(2) == 'employee' && $this->uri->segment(3) == 'register') : ?>
                                active
                                <?php endif; ?>">
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
                                <a href="<?= base_url() ?>2/import-csv" class="nav-link <?php if ($this->uri->segment(2) == 'import-csv') : ?>active<?php endif; ?>">
                                    Import CSV
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