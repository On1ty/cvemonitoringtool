<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper border border-left-0 border-right-0 border-bottom-0">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Settings</h1>
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
                    <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?= $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('error')) : ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?= $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card card-danger card-outline">
                        <?= form_open('employee/set'); ?>
                        <div class="register-card-body">
                            <h5 class="lead mb-4">
                                Set ID MMYY
                            </h5>
                            <p class="font-weight-bold"><?= "{$id_settings['mm']}{$id_settings['yy']}-" . str_pad($id_settings['sequence'], 3, '0', STR_PAD_LEFT);  ?></p>
                            <div class="row">
                                <div class="col-12 col-xl-4">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control <?= form_error('id-mm') ? 'is-invalid' : '' ?>" placeholder="MM" value="<?= $id_settings['mm'] ?>" name="id-mm" data-inputmask-alias="datetime" data-inputmask-inputformat="mm" data-mask>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </div>
                                        </div>
                                        <?php echo form_error('id-mm'); ?>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-4">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control <?= form_error('id-yy') ? 'is-invalid' : '' ?>" placeholder="YY" value="<?= $id_settings['yy'] ?>" name="id-yy" data-inputmask-alias="datetime" data-inputmask-inputformat="yy" data-mask>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </div>
                                        </div>
                                        <?php echo form_error('id-yy'); ?>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-4">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control <?= form_error('id-sequence') ? 'is-invalid' : '' ?>" value="<?= $id_settings['sequence'] ?>" placeholder="Sequence" name="id-sequence">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="fas fa-hashtag"></i>
                                            </div>
                                        </div>
                                        <?php echo form_error('id-sequence'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-default" id="clear-fields">Clear</button>
                            <button type="submit" class="btn btn-danger float-right">Save</button>
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