<div class="content-wrapper border border-left-0 border-right-0 border-bottom-0">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Prospect List</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row justify-content-lg-center">
                <section class="col-lg-12 mb-2">
                    <button class="btn btn-info mr-1 float-right" id="delete-registered-attended" data-confirm="Are you sure you want to delete all registered and attended status? This action cannot be undone.">Delete registered and attended status</button>
                </section>
                <section class="col-lg-12">
                    <?php if ($this->session->flashdata('pay_success')) : ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?= $this->session->flashdata('pay_success'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('delete_register_attended')) : ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?= $this->session->flashdata('delete_register_attended'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('delete_register_attended_row_0')) : ?>
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?= $this->session->flashdata('delete_register_attended_row_0'); ?>
                        </div>
                    <?php endif; ?>
                    <?= validation_errors(); ?>
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" role="tablist" id="main-tab">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="pill" href="#lead" role="tab">Lead</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#walkin" role="tab">Walk-in</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#payment-history" role="tab">Payment History</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="lead" role="tabpanel">
                                    <table id="lead-table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Campaign Name</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                                <?php if ($this->session->employee_role == 1) : ?>
                                                    <th class="no-sort"></th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody id="wrapper">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="walkin" role="tabpanel">
                                    <table id="walkin-table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                                <?php if ($this->session->employee_role == 1) : ?>
                                                    <th class="no-sort"></th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody id="wrapper-walkin">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="payment-history" role="tabpanel">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Lead Payment</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Walk-in Payment</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <table id="payment-history-table" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Type</th>
                                                        <th>Amount</th>
                                                        <th>Remarks</th>
                                                        <th>Date Paid</th>
                                                        <?php if ($this->session->employee_role == 1 || $this->session->employee_role == 4) : ?>
                                                            <th class="no-sort"></th>
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody id="wrapper2">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                            <table id="payment-history-table-walkin" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Type</th>
                                                        <th>Amount</th>
                                                        <th>Remarks</th>
                                                        <th>Date Paid</th>
                                                        <?php if ($this->session->employee_role == 1 || $this->session->employee_role == 4) : ?>
                                                            <th class="no-sort"></th>
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody id="wrapper3">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="modal fade" id="pay-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <p class="modal-title font-weight-bold">Payment</p>
                </div>
                <?= form_open((isset($last_url_pay_error) ? $last_url_pay_error : ''), 'id="pay-form"') ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Payment Type</label>
                        <select class="form-control" name="type">
                            <option value="1">Assessment</option>
                            <option value="2">Admin</option>
                            <option value="3">Others</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control <?= form_error('amount') ? 'is-invalid' : '' ?>" placeholder="Amount" name="amount" value="<?= set_value('amount') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-coins"></i>
                            </div>
                        </div>
                        <?php echo form_error('amount'); ?>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control <?= form_error('user-dob') ? 'is-invalid' : '' ?>" placeholder="Date paid" name="user-dob" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask value="<?= set_value('user-dob') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                        </div>
                        <?php echo form_error('user-dob'); ?>
                    </div>
                    <div class="form-group">
                        <label>Remarks</label>
                        <input type="text" class="form-control" placeholder="Remarks (Optional)" name="remarks">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Post</button>
                </div>
                <?= form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>