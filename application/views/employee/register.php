<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper border border-left-0 border-right-0 border-bottom-0">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Register</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <!-- Main row -->
            <div class="row justify-content-lg-center">
                <!-- Left col -->
                <section class="col-lg-6 col-md-12">
                    <?php if ($this->session->flashdata('registered')) : ?>
                        <div class="alert alert-success">
                            <?= $this->session->flashdata('registered'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card card-danger card-outline">
                        <?= form_open('employee/clients/register', 'id="form"'); ?>
                        <div class="register-card-body">
                            <h5 class="lead mb-4">Client Registration - Assign Counselor</h5>
                            <div class="row">
                                <div class="col-12 col-xl-12">
                                    <div class="form-group">
                                        <label>Select Lead Data</label>
                                        <select class="form-control lead-select <?= form_error('user-select-lead') ? 'is-invalid' : '' ?>" name="user-select-lead">
                                            <option value="<?= set_value('user-select-lead'); ?>"><?= set_value('user-select-lead'); ?></option>
                                        </select>
                                        <?php echo form_error('user-select-lead'); ?>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control <?= form_error('user-first') ? 'is-invalid' : '' ?>" id="first_name" placeholder="First name" name="user-first" value="<?= set_value('user-first'); ?>">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                        <?= form_error('user-first'); ?>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Middle name (Optional)" id="middle_name" name="user-middle" value="<?= set_value('user-middle'); ?>">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-12">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control <?= form_error('user-last') ? 'is-invalid' : '' ?>" id="last_name" placeholder="Last name" name="user-last" value="<?= set_value('user-last'); ?>">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                        <?php echo form_error('user-last'); ?>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-12">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control <?= form_error('user-phone') ? 'is-invalid' : '' ?>" id="phone" placeholder="Mobile Number" name="user-phone" value="<?= set_value('user-phone'); ?>">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-mobile-alt"></span>
                                            </div>
                                        </div>
                                        <?php echo form_error('user-phone'); ?>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-12">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="phone" placeholder="Other Contact Number (Optional)" name="user-other-phone" value="<?= set_value('user-other-phone'); ?>">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-mobile-alt"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control <?= form_error('user-dob') ? 'is-invalid' : '' ?>" placeholder="Date of Birth" name="user-dob" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </div>
                                        </div>
                                        <?php echo form_error('user-dob'); ?>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control <?= form_error('user-email') ? 'is-invalid' : '' ?>" placeholder="Email" id="email" name="user-email" value="<?= set_value('user-email'); ?>">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-at"></span>
                                            </div>
                                        </div>
                                        <?php echo form_error('user-email'); ?>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-12">
                                    <div class="form-group">
                                        <label>Assign Counselor</label>
                                        <select class="form-control employer <?= form_error('user-select-employer') ? 'is-invalid' : '' ?>" name="user-select-employer">
                                        </select>
                                        <?php echo form_error('user-select-employer'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-default" id="reset-fields">Reset</button>
                            <button type="submit" class="btn btn-danger float-right">Create Client</button>
                        </div>
                        <?= form_close(); ?>
                    </div><!-- /.card -->
                </section>
                <!-- /.Left col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->