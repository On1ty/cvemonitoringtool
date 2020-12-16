<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper border border-left-0 border-right-0 border-bottom-0">
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header text-white" style="background: url('<?= base_url() ?>/dist/img/<?= $stage_img_path ?>') center center; background-size:cover; height: 20rem;">
                            <h1 class="widget-user-desc text-left"><strong><?= $client->client_last; ?></strong></h1>
                            <h1 class="widget-user-username text-left"><?= $stage_name; ?></h1>
                            <h4 class="text-left">
                                <?php if (!empty($method->searchArray($current_and_done_stage, $stage_name, 'stage'))) : ?>
                                    <?php $row = $method->searchArray($current_and_done_stage, $stage_name, 'stage') ?>
                                    <?php if ($row[0]->status == 'done') : ?>
                                        <span class="badge badge-success badge-pill">Completed</span>
                                    <?php else : ?>
                                        <span class="badge badge-danger badge-pill">Current</span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                    <a class="nav-link btn btn-primary" href="<?= base_url() ?>employee/clients/profile/id/<?= $this->uri->segment(5) ?>">Go back</a>
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
                                <div class="col-12 col-lg-4 mb-3">
                                    <div class="input-group input-group-sm" style="width:250px;">
                                        <div class="input-group-prepend">
                                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                        </div>
                                        <input type="text" name="table_search" class="form-control float-right filter" placeholder="Search by Document">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-8 mb-3 text-right">
                                    <?php if ($stage_name != 'Release of LOA/OOP') : ?>
                                        <?php if (!empty($files)) : ?>
                                            <a href="<?= base_url() ?>employee/clients/files/download/archieve/<?= $client->id_lead ?>/<?= $stage_name; ?>" class="btn btn-sm btn-primary">
                                                <i class="fas fa-file-archive"></i>
                                                Download all files as Archive
                                            </a>
                                        <?php endif ?>
                                    <?php endif; ?>
                                    <?php if (!empty($method->searchArray($current_and_done_stage, $stage_name, 'stage'))) : ?>
                                        <?php $row = $method->searchArray($current_and_done_stage, $stage_name, 'stage') ?>
                                        <?php if ($row[0]->status != 'done') : ?>
                                            <?php if ($stage_name == 'Client Onboarding') : ?>
                                                <?php if (
                                                    $this->session->employee_role == 2 ||
                                                    $this->session->employee_role == 3
                                                ) : ?>
                                                    <a href="<?= base_url() ?>employee/clients/stage/approve/<?= $stage_name ?>/<?= $client->id_lead ?>" class="btn btn-sm btn-danger confirmation" data-title="Approve Stage" data-confirm="Proceeding to next stage, do you want to continue?">
                                                        Proceed to Enrollment
                                                    </a>
                                                <?php endif; ?>
                                            <?php elseif ($stage_name == 'Enrollment') : ?>
                                                <?php if ($this->session->employee_role == 5) : ?>
                                                    <a href="<?= base_url() ?>employee/clients/stage/approve/<?= $stage_name ?>/<?= $client->id_lead ?>" class="btn btn-sm btn-danger confirmation" data-title="Approve Stage" data-confirm="Proceeding to next stage, do you want to continue?">
                                                        Proceed to Release of LOA/OOP
                                                    </a>
                                                <?php endif; ?>
                                            <?php elseif ($stage_name == 'Completion') : ?>
                                                <?php if ($this->session->employee_role == 3) : ?>
                                                    <a href="<?= base_url() ?>employee/clients/stage/approve/<?= $stage_name ?>/<?= $client->id_lead ?>" class="btn btn-sm btn-danger confirmation" data-title="Approve Stage" data-confirm="Proceeding to next stage, do you want to continue?">
                                                        Proceed to Compilation
                                                    </a>
                                                <?php endif; ?>
                                            <?php elseif ($stage_name == 'Lodging of VISA Application') : ?>
                                                <?php if ($this->session->employee_role == 5) : ?>
                                                    <a href="<?= base_url() ?>employee/clients/stage/approve/<?= $stage_name ?>/<?= $client->id_lead ?>" class="btn btn-sm btn-danger confirmation" data-title="Approve Stage" data-confirm="Proceeding to next stage, do you want to continue?">
                                                        Complete
                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <?php if ($this->session->flashdata('error')) : ?>
                                    <div class="col-12">
                                        <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <?= $this->session->flashdata('error'); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($this->session->flashdata('success')) : ?>
                                    <div class="col-12">
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
                                                        <?php if (!empty($method->searchArray($current_and_done_stage, 'Release of LOA/OOP', 'stage'))) : ?>
                                                            <?php $current_stage_data = $method->searchArray($current_and_done_stage, 'Release of LOA/OOP', 'stage') ?>
                                                            <?php if ($current_stage_data[0]->status == 'done') : ?>
                                                                <?php if ($this->session->employee_role == 3) : ?>
                                                                    <?php if (!empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                        <?php if ($row[0]->type != 'N/A') : ?>
                                                                            <a href="<?= base_url('uploads') ?>/<?= $row[0]->uploaded_by ?>/<?= $row[0]->encrypt . $row[0]->type ?>" class="" download="">Download</a>
                                                                        <?php endif ?>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php else : ?>
                                                            <?php if ($this->session->employee_role == 2 || $this->session->employee_role == 3) : ?>
                                                                <?php if (!empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                    <?php if ($row[0]->type != 'N/A') : ?>
                                                                        <a href="<?= base_url('uploads') ?>/<?= $row[0]->uploaded_by ?>/<?= $row[0]->encrypt . $row[0]->type ?>" class="" download="">Download</a>
                                                                    <?php endif ?>
                                                                <?php endif ?>
                                                                <?php if (empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                    <a href="" class="manual-upload ml-3" data-toggle="modal" data-doc="<?= $val->code ?>" data-form="<?= $val->form ?>" data-stage="<?= $stage_name; ?>" data-target="#manual-upload-modal">Manual Upload</a>
                                                                <?php endif ?>
                                                                <?php if (!empty($method->searchArray($files, $val->code, 'doc'))) : ?>
                                                                    <?php if ($this->session->employee_role != 3) : ?>
                                                                        <a href="<?= base_url() ?>employee/clients/files/reject/<?= $row[0]->id ?>/<?= $row[0]->uploaded_by ?>" class="confirmation ml-3" data-title="Reject Document" data-confirm="To confirm deletion, please click the &quot;Proceed Button&quot;">Reject</a>
                                                                    <?php endif ?>
                                                                <?php endif ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
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
                                                    <?php if ($this->session->employee_role == 5) : ?>
                                                        <?php if (!empty($method->searchArray($files, 'LOA/OOP', 'doc'))) : ?>
                                                            <?php $row = $method->searchArray($files, 'LOA/OOP', 'doc') ?>
                                                            <?php if ($row[0]->type != 'N/A') : ?>
                                                                <a href="<?= base_url('uploads') ?>/LOA or OOP/<?= $row[0]->encrypt . $row[0]->type ?>" class="" download="">Download</a>
                                                            <?php endif ?>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                    <?php if ($this->session->employee_role != 1) : ?>
                                                        <?php if (empty($files)) : ?>
                                                            <a href="" class="manual-upload" data-toggle="modal" data-target="#manual-upload-modal" data-doc="LOA/OOP" data-form="Releasing of LOA/OOP" data-stage="<?= $stage_name; ?>">Upload LOA/OOP</a>
                                                        <?php else : ?>
                                                            <a href="<?= base_url() ?>employee/clients/files/reject/<?= $files[0]->id ?>/<?= $files[0]->uploaded_by ?>" class="confirmation ml-3" data-title="Reject Document" data-confirm="Are you sure? This will remove on clients portal too.">Remove LOA/OOP</a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php elseif ($stage_name == 'Release of LOA/OOP') : ?>
                                    <div class="col-12 file-card">
                                        <div class="info-box border">
                                            <span class="info-box-icon text-secondary">
                                                <i class="fas fa-cog fa-spin"></i>
                                            </span>
                                            <div class="info-box-content text-dark">
                                                <span class="info-box-text mb-1">Release of LOA/OOP</span>
                                                <?php if (!empty($files)) : ?>
                                                    <h6 class="card-subtitle text-muted">Date Release: <?= $files[0]->upload_date ?></h6>
                                                <?php endif; ?>
                                                <span class="info-box-number">Clients Admin Fee: &#8369;<?= number_format($total_admin_fee, 2) ?></span>
                                                <span class="info-box-number">Contract Fee: &#8369;
                                                    <?php if (empty($client->contract_fee)) : ?>
                                                        <?= number_format(0, 2) ?>
                                                    <?php else : ?>
                                                        <?= number_format($client->contract_fee, 2) ?>
                                                    <?php endif; ?>
                                                </span>
                                                <div class="progress-description text-right">
                                                    <?php if ($row[0]->status != 'done') : ?>
                                                        <?php if ($this->session->employee_role == 1) : ?>
                                                            <a href="<?= base_url() ?>employee/clients/stage/approve/Release of LOA or OOP/<?= $client->id_lead ?>" class="confirmation" data-title="Endorse to Documentation Team" data-confirm="Are you sure you want to endorse this client to Documentation Team?">Endorse to Documentation Team</a>
                                                        <?php else : ?>
                                                            <span class="text-primary">Waiting for Admin to Endorse to Documentation Team</span>
                                                        <?php endif; ?>
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

                                <?php elseif ($stage_name == 'Lodging of VISA Application') : ?>
                                    <div class="col-12 file-card">
                                        <div class="info-box border">
                                            <span class="info-box-icon text-secondary">
                                                <i class="fas fa-file-upload"></i>
                                            </span>
                                            <div class="info-box-content text-dark">
                                                <span class="info-box-text mb-1">Approval to Lodge Visa</span>
                                                <h6 class="card-subtitle text-muted"></h6>
                                                <?php if (empty($files)) : ?>
                                                    <span class="info-box-number">No Visa uploaded</span>
                                                <?php else : ?>
                                                    <span class="info-box-number"><?= $files[0]->file ?>&nbsp;•&nbsp;<?= date('m-d-Y', strtotime($files[0]->upload_date)) ?></span>
                                                <?php endif; ?>
                                                <div class="progress-description text-right">
                                                    <?php if ($this->session->employee_role != 1) : ?>
                                                        <?php if (!empty($method->searchArray($files, 'VISA', 'doc'))) : ?>
                                                            <?php $row = $method->searchArray($files, 'VISA', 'doc') ?>
                                                            <?php if ($row[0]->type != 'N/A') : ?>
                                                                <a href="<?= base_url('uploads') ?>/LOA or OOP/<?= $row[0]->encrypt . $row[0]->type ?>" class="" download="">Download</a>
                                                            <?php endif ?>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                    <?php if ($this->session->employee_role == 5) : ?>
                                                        <?php if (empty($files)) : ?>
                                                            <a href="" class="manual-upload" data-toggle="modal" data-target="#manual-upload-modal" data-doc="VISA" data-form="VISA" data-stage="<?= $stage_name; ?>">Upload VISA</a>
                                                        <?php else : ?>
                                                            <a href="<?= base_url() ?>employee/clients/files/reject/<?= $files[0]->id ?>/<?= $files[0]->uploaded_by ?>" class="confirmation ml-3" data-title="Reject Document" data-confirm="Are you sure? This will remove on clients portal too.">Remove LOA/OOP</a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
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