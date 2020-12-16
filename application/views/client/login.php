<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Commonwealth Visa Experts</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="CommonWealth VISA Tool for clients" />
    <meta name="keywords" content="CommonWealth VISA Tool" />
    <meta name="CommonWealth VISA Tool" content="CommonWealth VISA client File Management" />
    <!-- Favicon -->
    <link rel="icon" href="<?= base_url(); ?>images/site.png" sizes="192x192" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!--         <div class="login-logo">
            <a href="#"><b>CommonWealth</b>VISA</a>
        </div> -->
        <!-- old one -->
        <div id="banner">
            <img src="<?php echo base_url(); ?>images/cve_tagline.png" width="350" height="150">
        </div>
        <!-- /.login-logo -->
        <div class="card elevation-3">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <?php if ($this->session->flashdata('invalid_user')) : ?>
                    <div class="alert alert-danger">
                        <?= $this->session->flashdata('invalid_user'); ?>
                    </div>
                <?php endif; ?>
                <?= form_open(); ?>
                <div class="input-group mb-3">
                    <input type="email" class="form-control <?= form_error('user-email') ? 'is-invalid' : '' ?>" placeholder="User Email" name="user-email" value="<?= set_value('user-email'); ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <?= form_error('user-email') ?>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control <?= form_error('user-pass') ? 'is-invalid' : '' ?>" placeholder="User Password" name="user-pass">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <?= form_error('user-pass') ?>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div style="margin-left: 0.4vw;" class="g-recaptcha" data-sitekey="6LcB27wZAAAAAMpCFED6XUGCXi-66LUMuv6vhPuZ"></div>
                        <?= form_error('g-recaptcha-response') ?>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
            </div>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url(); ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>dist/js/adminlte.min.js"></script>

</body>

</html>