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
                    <?php if ($this->session->flashdata('registered_emp')) : ?>
                        <div class="alert alert-success">
                            <?= $this->session->flashdata('registered_emp'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card card-danger card-outline">
                        <?= form_open('employee/employee/register', 'id="form"'); ?>
                        <div class="register-card-body">
                            <h5 class="lead mb-4">Employee Registration
                            </h5>
                            <div class="row">
                                <div class="col-12 col-xl-12">
                                    <div class="form-group">
                                        <label>Select Role</label>
                                        <select class="form-control role <?= form_error('user-select-role') ? 'is-invalid' : '' ?>" name="user-select-role" id="select-role">
                                            <option selected="selected" disabled></option>
                                            <option value="1">Administrator</option>
                                            <option value="5">Approver</option>
                                            <option value="2">Marketing</option>
                                            <option value="3">Documentation</option>
                                            <option value="4">Super User</option>
                                        </select>
                                        <?php echo form_error('user-select-role'); ?>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control <?= form_error('emp-first') ? 'is-invalid' : '' ?>" placeholder="First name" name="emp-first" value="<?= set_value('emp-first'); ?>">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                        <?= form_error('emp-first'); ?>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Middle name (Optional)" name="emp-middle" value="<?= set_value('emp-middle'); ?>">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                        <?= form_error('emp-middle'); ?>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-12">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control <?= form_error('emp-last') ? 'is-invalid' : '' ?>" placeholder="Last name" name="emp-last" value="<?= set_value('emp-last'); ?>">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                        <?php echo form_error('emp-last'); ?>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control <?= form_error('emp-username') ? 'is-invalid' : '' ?>" placeholder="Email" name="emp-username" value="<?= set_value('emp-username'); ?>">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                        <?php echo form_error('emp-username'); ?>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control <?= form_error('emp-dob') ? 'is-invalid' : '' ?>" placeholder="Date of Birth" name="emp-dob" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </div>
                                        </div>
                                        <?php echo form_error('emp-dob'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-default" id="reset-fields">Reset</button>
                            <button type="submit" class="btn btn-danger float-right">Create User</button>
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