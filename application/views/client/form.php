<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper border border-left-0 border-right-0 border-bottom-0">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header text-white" style="background: url('<?= base_url() ?>/dist/img/<?= $stage_img_path ?>') center center; background-size:cover; height: 15rem;">
                            <h1 class="widget-user-desc text-left"><strong><?= $stage_name; ?></strong></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row justify-content-lg-center">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-3">
                            <div class="info-box elevation-0 border">
                                <div class="info-box-content">
                                    <a class="nav-link btn btn-primary" href="<?= base_url() ?>stages">Go back</a>
                                </div>
                            </div>
                            <?php if ($stage_name == 'Completion') : ?>
                                <div class="info-box elevation-0 border">
                                    <div class="info-box-content">
                                        <div class="nav flex-column nav-pills text-center" id="v-pills-tab">
                                            <a class="nav-link active" data-toggle="pill" href="#v-pills-one">Financial Documents for Regular Process</a>
                                            <a class="nav-link" data-toggle="pill" href="#v-pills-two">Verifiable Source of Funds for Regular Process</a>
                                            <a class="nav-link" data-toggle="pill" href="#v-pills-three">Evidence of Ties to Philippines</a>
                                            <a class="nav-link" data-toggle="pill" href="#v-pills-four">Other Documents</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-12 col-lg-9">
                            <div class="row" id="files-div">
                                <div class="col-12 mb-3">
                                    <div class="input-group input-group-sm" style="width:250px;">
                                        <div class="input-group-prepend">
                                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                        </div>
                                        <input type="text" name="table_search" class="form-control float-right filter" placeholder="Search by Document">
                                    </div>
                                </div>
                                <?php if ($this->session->flashdata('error')) : ?>
                                    <div class="col-12 mb-1">
                                        <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <?= $this->session->flashdata('error'); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($this->session->flashdata('success')) : ?>
                                    <div class="col-12 mb-1">
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <?= $this->session->flashdata('success'); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($stage_name == 'Client Onboarding') : ?>
                                    <?php foreach ($identity_documents as $val) : ?>
                                        <div class="col-12 file-card" data-string="<?= $val->doc ?>&nbsp;<?= $val->form ?>">
                                            <div class="info-box border">
                                                <span class="info-box-icon text-secondary">
                                                    <?php if (empty($method->searchArray($files, $val->code))) : ?>
                                                        <i class="fas fa-file-upload"></i>
                                                    <?php else : ?>
                                                        <?php $row = $method->searchArray($files, $val->code) ?>
                                                        <?php if ($row[0]->type == '.csv') : ?>
                                                            <i class="fas fa-file-csv"></i>
                                                        <?php elseif ($row[0]->type == '.jpg') : ?>
                                                            <i class="fas fa-file-image"></i>
                                                        <?php elseif ($row[0]->type == '.png') : ?>
                                                            <i class="fas fa-file-image"></i>
                                                        <?php elseif ($row[0]->type == '.docx') : ?>
                                                            <i class="fas fa-file-word"></i>
                                                        <?php elseif ($row[0]->type == '.pdf') : ?>
                                                            <i class="fas fa-file-pdf"></i>
                                                        <?php elseif ($row[0]->type == 'N/A') : ?>
                                                            <i class="fas fa-pen-square"></i>
                                                        <?php else : ?>
                                                            <i class="fas fa-file"></i>
                                                        <?php endif; ?>
                                                    <?php endif ?>
                                                </span>
                                                <div class="info-box-content text-dark">
                                                    <span class="info-box-text mb-1"><?= $val->doc ?></span>
                                                    <h6 class="card-subtitle text-muted"><?= $val->form ?></h6>
                                                    <?php if (empty($method->searchArray($files, $val->code))) : ?>
                                                        <span class="info-box-number">No document uploaded</span>
                                                    <?php else : ?>
                                                        <?php $row = $method->searchArray($files, $val->code) ?>
                                                        <span class="info-box-number">
                                                            <?php if ($row[0]->type == 'N/A') : ?>
                                                                <i><?= $row[0]->file ?></i>
                                                            <?php else : ?>
                                                                <?= $row[0]->file ?>
                                                            <?php endif ?>
                                                            &nbsp;•&nbsp;<?= date('m-d-Y', strtotime($row[0]->upload_date)) ?>
                                                        </span>
                                                    <?php endif ?>
                                                    <div class="progress-description text-right mt-3">
                                                        <?php if (empty($method->searchArray($files, $val->code))) : ?>
                                                            <a href="" class="manual-upload ml-3" data-toggle="modal" data-doc="<?= $val->code ?>" data-form="<?= $val->form ?>" data-stage="<?= $stage_name; ?>" data-target="#manual-upload-modal">Upload</a>
                                                        <?php endif ?>
                                                        <?php if (!empty($method->searchArray($files, $val->code))) : ?>
                                                            <a href="<?= base_url() ?>employee/clients/files/reject/<?= $row[0]->id ?>/<?= $row[0]->uploaded_by ?>" class="confirmation ml-3" data-title="Cancel Document" data-confirm="To confirm cancelation, please click the &quot;Proceed Button&quot;">Cancel</a>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php elseif ($stage_name == 'Enrollment') : ?>
                                    <div class="col-12 file-card">
                                        <div class="info-box border">
                                            <span class="info-box-icon text-secondary">
                                                <i class="fas fa-file-upload"></i>
                                            </span>
                                            <div class="info-box-content text-dark">
                                                <span class="info-box-text mb-1">LOA/OOP</span>
                                                <h6 class="card-subtitle text-muted">Releasing of LOA/OOP</h6>
                                                <?php if (empty($files)) : ?>
                                                    <span class="info-box-number">No LOA/OOP uploaded</span>
                                                <?php else : ?>
                                                    <span class="info-box-number"><?= $files[0]->file ?>&nbsp;•&nbsp;<?= date('m-d-Y', strtotime($files[0]->upload_date)) ?></span>
                                                <?php endif; ?>
                                                <div class="progress-description text-right">
                                                    <?php if (empty($files)) : ?>
                                                        <a href="" class="manual-upload" data-toggle="modal" data-target="#manual-upload-modal" data-doc="LOA/OOP" data-form="Releasing of LOA/OOP" data-stage="<?= $stage_name; ?>">Upload LOA/OOP</a>
                                                    <?php else : ?>
                                                        <a href="<?= base_url() ?>employee/clients/files/reject/<?= $files[0]->id ?>/<?= $files[0]->uploaded_by ?>" class="confirmation ml-3" data-title="Reject Document" data-confirm="Are you sure? This will remove on clients portal too.">Remove LOA/OOP</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php elseif ($stage_name == 'Completion') : ?>
                                    <div class="tab-content col-12">
                                        <div class="tab-pane fade show active" id="v-pills-one">
                                            <?php foreach ($financial_documents_for_regular_process as $val) : ?>
                                                <div class="col-12 file-card" data-string="<?= $val->doc ?>&nbsp;<?= $val->form ?>">
                                                    <div class="info-box border">
                                                        <span class="info-box-icon text-secondary">
                                                            <?php if (empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                <i class="fas fa-file-upload"></i>
                                                            <?php else : ?>
                                                                <?php $row = $method->searchArray($files, $val->code, 'doc') ?>
                                                                <?php if ($row[0]->type == '.csv') : ?>
                                                                    <i class="fas fa-file-csv"></i>
                                                                <?php elseif ($row[0]->type == '.jpg') : ?>
                                                                    <i class="fas fa-file-image"></i>
                                                                <?php elseif ($row[0]->type == '.png') : ?>
                                                                    <i class="fas fa-file-image"></i>
                                                                <?php elseif ($row[0]->type == '.docx') : ?>
                                                                    <i class="fas fa-file-word"></i>
                                                                <?php elseif ($row[0]->type == '.pdf') : ?>
                                                                    <i class="fas fa-file-pdf"></i>
                                                                <?php elseif ($row[0]->type == 'N/A') : ?>
                                                                    <i class="fas fa-pen-square"></i>
                                                                <?php else : ?>
                                                                    <i class="fas fa-file"></i>
                                                                <?php endif; ?>
                                                            <?php endif ?>
                                                        </span>
                                                        <div class="info-box-content text-dark">
                                                            <span class="info-box-text mb-1"><?= $val->doc ?></span>
                                                            <h6 class="card-subtitle text-muted"><?= $val->form ?></h6>
                                                            <?php if (empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                <span class="info-box-number">No document uploaded</span>
                                                            <?php else : ?>
                                                                <?php $row = $method->searchArray($files, $val->code, 'doc') ?>
                                                                <span class="info-box-number">
                                                                    <?php if ($row[0]->type == 'N/A') : ?>
                                                                        <i><?= $row[0]->file ?></i>
                                                                    <?php else : ?>
                                                                        <?= $row[0]->file ?>
                                                                    <?php endif ?>
                                                                    &nbsp;•&nbsp;<?= date('m-d-Y', strtotime($row[0]->upload_date)) ?>
                                                                </span>
                                                            <?php endif ?>
                                                            <div class="progress-description text-right mt-3">
                                                                <?php if ($this->session->employee_role == 2 || $this->session->employee_role == 3) : ?>
                                                                    <?php if (!empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                        <?php if ($row[0]->type != 'N/A') : ?>
                                                                            <a href="<?= base_url('uploads') ?>/<?= $row[0]->form ?>/<?= $row[0]->encrypt . $row[0]->type ?>" class="" download="">Download</a>
                                                                        <?php endif ?>
                                                                    <?php endif ?>
                                                                    <?php if (empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                        <a href="" class="manual-upload ml-3" data-toggle="modal" data-doc="<?= $val->code ?>" data-form="<?= $val->form ?>" data-stage="<?= $stage_name; ?>" data-target="#manual-upload-modal">Manual Upload</a>
                                                                    <?php endif ?>
                                                                    <?php if (!empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                        <a href="<?= base_url() ?>employee/clients/files/reject/<?= $row[0]->id ?>/<?= $row[0]->uploaded_by ?>" class="confirmation ml-3" data-title="Reject Document" data-confirm="To confirm deletion, please click the &quot;Proceed Button&quot;">Reject</a>
                                                                    <?php endif ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-two">
                                            <?php foreach ($verifiable_source_funds_regular as $val) : ?>
                                                <div class="col-12 file-card" data-string="<?= $val->doc ?>&nbsp;<?= $val->form ?>">
                                                    <div class="info-box border">
                                                        <span class="info-box-icon text-secondary">
                                                            <?php if (empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                <i class="fas fa-file-upload"></i>
                                                            <?php else : ?>
                                                                <?php $row = $method->searchArray($files, $val->code, 'doc') ?>
                                                                <?php if ($row[0]->type == '.csv') : ?>
                                                                    <i class="fas fa-file-csv"></i>
                                                                <?php elseif ($row[0]->type == '.jpg') : ?>
                                                                    <i class="fas fa-file-image"></i>
                                                                <?php elseif ($row[0]->type == '.png') : ?>
                                                                    <i class="fas fa-file-image"></i>
                                                                <?php elseif ($row[0]->type == '.docx') : ?>
                                                                    <i class="fas fa-file-word"></i>
                                                                <?php elseif ($row[0]->type == '.pdf') : ?>
                                                                    <i class="fas fa-file-pdf"></i>
                                                                <?php elseif ($row[0]->type == 'N/A') : ?>
                                                                    <i class="fas fa-pen-square"></i>
                                                                <?php else : ?>
                                                                    <i class="fas fa-file"></i>
                                                                <?php endif; ?>
                                                            <?php endif ?>
                                                        </span>
                                                        <div class="info-box-content text-dark">
                                                            <span class="info-box-text mb-1"><?= $val->doc ?></span>
                                                            <h6 class="card-subtitle text-muted"><?= $val->form ?></h6>
                                                            <?php if (empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                <span class="info-box-number">No document uploaded</span>
                                                            <?php else : ?>
                                                                <?php $row = $method->searchArray($files, $val->code, 'doc') ?>
                                                                <span class="info-box-number">
                                                                    <?php if ($row[0]->type == 'N/A') : ?>
                                                                        <i><?= $row[0]->file ?></i>
                                                                    <?php else : ?>
                                                                        <?= $row[0]->file ?>
                                                                    <?php endif ?>
                                                                    &nbsp;•&nbsp;<?= date('m-d-Y', strtotime($row[0]->upload_date)) ?>
                                                                </span>
                                                            <?php endif ?>
                                                            <div class="progress-description text-right mt-3">
                                                                <?php if ($this->session->employee_role == 2 || $this->session->employee_role == 3) : ?>
                                                                    <?php if (!empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                        <?php if ($row[0]->type != 'N/A') : ?>
                                                                            <a href="<?= base_url('uploads') ?>/<?= $row[0]->form ?>/<?= $row[0]->encrypt . $row[0]->type ?>" class="" download="">Download</a>
                                                                        <?php endif ?>
                                                                    <?php endif ?>
                                                                    <?php if (empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                        <a href="" class="manual-upload ml-3" data-toggle="modal" data-doc="<?= $val->code ?>" data-form="<?= $val->form ?>" data-stage="<?= $stage_name; ?>" data-target="#manual-upload-modal">Manual Upload</a>
                                                                    <?php endif ?>
                                                                    <?php if (!empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                        <a href="<?= base_url() ?>employee/clients/files/reject/<?= $row[0]->id ?>/<?= $row[0]->uploaded_by ?>" class="confirmation ml-3" data-title="Reject Document" data-confirm="To confirm deletion, please click the &quot;Proceed Button&quot;">Reject</a>
                                                                    <?php endif ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-three">
                                            <?php foreach ($evidence_ties_ph as $val) : ?>
                                                <div class="col-12 file-card" data-string="<?= $val->doc ?>&nbsp;<?= $val->form ?>">
                                                    <div class="info-box border">
                                                        <span class="info-box-icon text-secondary">
                                                            <?php if (empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                <i class="fas fa-file-upload"></i>
                                                            <?php else : ?>
                                                                <?php $row = $method->searchArray($files, $val->code, 'doc') ?>
                                                                <?php if ($row[0]->type == '.csv') : ?>
                                                                    <i class="fas fa-file-csv"></i>
                                                                <?php elseif ($row[0]->type == '.jpg') : ?>
                                                                    <i class="fas fa-file-image"></i>
                                                                <?php elseif ($row[0]->type == '.png') : ?>
                                                                    <i class="fas fa-file-image"></i>
                                                                <?php elseif ($row[0]->type == '.docx') : ?>
                                                                    <i class="fas fa-file-word"></i>
                                                                <?php elseif ($row[0]->type == '.pdf') : ?>
                                                                    <i class="fas fa-file-pdf"></i>
                                                                <?php elseif ($row[0]->type == 'N/A') : ?>
                                                                    <i class="fas fa-pen-square"></i>
                                                                <?php else : ?>
                                                                    <i class="fas fa-file"></i>
                                                                <?php endif; ?>
                                                            <?php endif ?>
                                                        </span>
                                                        <div class="info-box-content text-dark">
                                                            <span class="info-box-text mb-1"><?= $val->doc ?></span>
                                                            <h6 class="card-subtitle text-muted"><?= $val->form ?></h6>
                                                            <?php if (empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                <span class="info-box-number">No document uploaded</span>
                                                            <?php else : ?>
                                                                <?php $row = $method->searchArray($files, $val->code, 'doc') ?>
                                                                <span class="info-box-number">
                                                                    <?php if ($row[0]->type == 'N/A') : ?>
                                                                        <i><?= $row[0]->file ?></i>
                                                                    <?php else : ?>
                                                                        <?= $row[0]->file ?>
                                                                    <?php endif ?>
                                                                    &nbsp;•&nbsp;<?= date('m-d-Y', strtotime($row[0]->upload_date)) ?>
                                                                </span>
                                                            <?php endif ?>
                                                            <div class="progress-description text-right mt-3">
                                                                <?php if ($this->session->employee_role == 2 || $this->session->employee_role == 3) : ?>
                                                                    <?php if (!empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                        <?php if ($row[0]->type != 'N/A') : ?>
                                                                            <a href="<?= base_url('uploads') ?>/<?= $row[0]->form ?>/<?= $row[0]->encrypt . $row[0]->type ?>" class="" download="">Download</a>
                                                                        <?php endif ?>
                                                                    <?php endif ?>
                                                                    <?php if (empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                        <a href="" class="manual-upload ml-3" data-toggle="modal" data-doc="<?= $val->code ?>" data-form="<?= $val->form ?>" data-stage="<?= $stage_name; ?>" data-target="#manual-upload-modal">Manual Upload</a>
                                                                    <?php endif ?>
                                                                    <?php if (!empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                        <a href="<?= base_url() ?>employee/clients/files/reject/<?= $row[0]->id ?>/<?= $row[0]->uploaded_by ?>" class="confirmation ml-3" data-title="Reject Document" data-confirm="To confirm deletion, please click the &quot;Proceed Button&quot;">Reject</a>
                                                                    <?php endif ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-four">
                                            <?php foreach ($other_documents as $val) : ?>
                                                <div class="col-12 file-card" data-string="<?= $val->doc ?>&nbsp;<?= $val->form ?>">
                                                    <div class="info-box border">
                                                        <span class="info-box-icon text-secondary">
                                                            <?php if (empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                <i class="fas fa-file-upload"></i>
                                                            <?php else : ?>
                                                                <?php $row = $method->searchArray($files, $val->code, 'doc') ?>
                                                                <?php if ($row[0]->type == '.csv') : ?>
                                                                    <i class="fas fa-file-csv"></i>
                                                                <?php elseif ($row[0]->type == '.jpg') : ?>
                                                                    <i class="fas fa-file-image"></i>
                                                                <?php elseif ($row[0]->type == '.png') : ?>
                                                                    <i class="fas fa-file-image"></i>
                                                                <?php elseif ($row[0]->type == '.docx') : ?>
                                                                    <i class="fas fa-file-word"></i>
                                                                <?php elseif ($row[0]->type == '.pdf') : ?>
                                                                    <i class="fas fa-file-pdf"></i>
                                                                <?php elseif ($row[0]->type == 'N/A') : ?>
                                                                    <i class="fas fa-pen-square"></i>
                                                                <?php else : ?>
                                                                    <i class="fas fa-file"></i>
                                                                <?php endif; ?>
                                                            <?php endif ?>
                                                        </span>
                                                        <div class="info-box-content text-dark">
                                                            <span class="info-box-text mb-1"><?= $val->doc ?></span>
                                                            <h6 class="card-subtitle text-muted"><?= $val->form ?></h6>
                                                            <?php if (empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                <span class="info-box-number">No document uploaded</span>
                                                            <?php else : ?>
                                                                <?php $row = $method->searchArray($files, $val->code, 'doc') ?>
                                                                <span class="info-box-number">
                                                                    <?php if ($row[0]->type == 'N/A') : ?>
                                                                        <i><?= $row[0]->file ?></i>
                                                                    <?php else : ?>
                                                                        <?= $row[0]->file ?>
                                                                    <?php endif ?>
                                                                    &nbsp;•&nbsp;<?= date('m-d-Y', strtotime($row[0]->upload_date)) ?>
                                                                </span>
                                                            <?php endif ?>
                                                            <div class="progress-description text-right mt-3">
                                                                <?php if ($this->session->employee_role == 2 || $this->session->employee_role == 3) : ?>
                                                                    <?php if (!empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                        <?php if ($row[0]->type != 'N/A') : ?>
                                                                            <a href="<?= base_url('uploads') ?>/<?= $row[0]->form ?>/<?= $row[0]->encrypt . $row[0]->type ?>" class="" download="">Download</a>
                                                                        <?php endif ?>
                                                                    <?php endif ?>
                                                                    <?php if (empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                        <a href="" class="manual-upload ml-3" data-toggle="modal" data-doc="<?= $val->code ?>" data-form="<?= $val->form ?>" data-stage="<?= $stage_name; ?>" data-target="#manual-upload-modal">Manual Upload</a>
                                                                    <?php endif ?>
                                                                    <?php if (!empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                        <a href="<?= base_url() ?>employee/clients/files/reject/<?= $row[0]->id ?>/<?= $row[0]->uploaded_by ?>" class="confirmation ml-3" data-title="Reject Document" data-confirm="To confirm deletion, please click the &quot;Proceed Button&quot;">Reject</a>
                                                                    <?php endif ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<div class="modal fade" id="manual-upload-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <p class="modal-title font-weight-bold">Manual upload file</p>
            </div>
            <?= form_open_multipart('employee/clients/files/manual-upload') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label id="label_file"></label>
                    <div class="input-group">
                        <input id="manual_file_remarks" name="manual_file_remarks" value="<?= set_value('manual_file_remarks') ?>" type="text" class="form-control" placeholder="Remarks" style="display:none;">
                        <div class="custom-file" id="manual_file_div">
                            <input type="file" class="custom-file-input" id="manual_file_input" name="manual_file_input">
                            <label class="custom-file-label" for="manual_file_input"></label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="manual_check" name="manual_check" <?= $this->session->flashdata('') ? 'checked' : ''; ?>>
                                    <label for="manual_check" class="custom-control-label">N/A</label>
                                </div>
                            </span>
                        </div>
                        <span class="error invalid-feedback" style="display: none;">Please enter a reason on the Remarks field</span>
                    </div>
                    <input type="hidden" id="stage" name="stage" value="" />
                    <input type="hidden" id="form" name="form" value="" />
                    <input type="hidden" id="doc" name="doc" value="" />
                    <input type="hidden" name="id_lead" value="<?= $client->id_lead ?>" />
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" id="cancel" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Upload</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</div>