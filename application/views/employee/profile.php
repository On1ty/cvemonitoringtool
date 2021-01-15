<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper border border-left-0 border-right-0 border-bottom-0">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <!-- <div class="col-sm-6">
                    <h1>'s Profile</h1>
                </div> -->
                <div class="col-md-12">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header text-white" style="background: url('<?= base_url() ?>/dist/img/cover-name.jpg') center center; background-size:cover; height: 20rem;">
                            <h1 class="widget-user-username text-left"><strong><?= $client->client_last; ?></strong></h1>
                            <h2 class="widget-user-desc text-left"><?= $client->client_first; ?>&nbsp;<?= $client->client_middle; ?></h2>
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row justify-content-lg-center">
                <div class="col-lg-12">
                    <?php if ($this->session->flashdata('activate')) : ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?= $this->session->flashdata('activate'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('deactivate')) : ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?= $this->session->flashdata('deactivate'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('info')) : ?>
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?= $this->session->flashdata('info'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?= $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?= $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-3">
                            <div class="info-box elevation-0 border">
                                <div class="info-box-content">
                                    <div class="nav flex-column nav-pills text-center" id="v-pills-tab">
                                        <a class="nav-link active" data-toggle="pill" href="#v-pills-files">Stages</a>
                                        <a class="nav-link" data-toggle="pill" href="#v-pills-details">Client Details</a>
                                        <a class="nav-link" data-toggle="pill" href="#v-pills-pay">Pay History</a>
                                        <a class="nav-link" data-toggle="pill" href="#v-pills-notes">Notes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-files">
                                    <div class="row">
                                        <?php foreach ($stages as $key => $val) : ?>
                                            <div class="col-12 col-md-12 col-lg-6 mb-2">
                                                <div class="card elevation-4">
                                                    <?php if ($val->stage == 'Client Onboarding') : ?>
                                                        <img class="card-img-top" sizes="(max-width: 3500px) 40vw, 1400px" loading="lazy" srcset="
                                                            <?= base_url('dist/img/on-boarding_om6luu/') ?>on-boarding_om6luu_c_scale,w_480.jpg 480w,
                                                            <?= base_url('dist/img/on-boarding_om6luu/') ?>on-boarding_om6luu_c_scale,w_726.jpg 726w,
                                                            <?= base_url('dist/img/on-boarding_om6luu/') ?>on-boarding_om6luu_c_scale,w_926.jpg 926w,
                                                            <?= base_url('dist/img/on-boarding_om6luu/') ?>on-boarding_om6luu_c_scale,w_1108.jpg 1108w,
                                                            <?= base_url('dist/img/on-boarding_om6luu/') ?>on-boarding_om6luu_c_scale,w_1280.jpg 1280w,
                                                            <?= base_url('dist/img/on-boarding_om6luu/') ?>on-boarding_om6luu_c_scale,w_1400.jpg 1400w" src="<?= base_url('dist/img/on-boarding_om6luu/') ?>on-boarding_om6luu_c_scale,w_1400.jpg" alt="">
                                                    <?php elseif ($val->stage == 'Enrollment') : ?>
                                                        <img class="card-img-top" sizes="(max-width: 1400px) 100vw, 1400px" loading="lazy" srcset="
                                                            <?= base_url('dist/img/enrollment_heg7fc/') ?>enrollment_heg7fc_c_scale,w_200.jpg 200w,
                                                            <?= base_url('dist/img/enrollment_heg7fc/') ?>enrollment_heg7fc_c_scale,w_392.jpg 392w,
                                                            <?= base_url('dist/img/enrollment_heg7fc/') ?>enrollment_heg7fc_c_scale,w_542.jpg 542w,
                                                            <?= base_url('dist/img/enrollment_heg7fc/') ?>enrollment_heg7fc_c_scale,w_662.jpg 662w,
                                                            <?= base_url('dist/img/enrollment_heg7fc/') ?>enrollment_heg7fc_c_scale,w_782.jpg 782w,
                                                            <?= base_url('dist/img/enrollment_heg7fc/') ?>enrollment_heg7fc_c_scale,w_895.jpg 895w,
                                                            <?= base_url('dist/img/enrollment_heg7fc/') ?>enrollment_heg7fc_c_scale,w_999.jpg 999w,
                                                            <?= base_url('dist/img/enrollment_heg7fc/') ?>enrollment_heg7fc_c_scale,w_1098.jpg 1098w,
                                                            <?= base_url('dist/img/enrollment_heg7fc/') ?>enrollment_heg7fc_c_scale,w_1193.jpg 1193w,
                                                            <?= base_url('dist/img/enrollment_heg7fc/') ?>enrollment_heg7fc_c_scale,w_1280.jpg 1280w,
                                                            <?= base_url('dist/img/enrollment_heg7fc/') ?>enrollment_heg7fc_c_scale,w_1372.jpg 1372w,
                                                            <?= base_url('dist/img/enrollment_heg7fc/') ?>enrollment_heg7fc_c_scale,w_1400.jpg 1400w" src="<?= base_url('dist/img/enrollment_heg7fc/') ?>enrollment_heg7fc_c_scale,w_1400.jpg" alt="">
                                                    <?php elseif ($val->stage == 'Release of LOA/OOP') : ?>
                                                        <img class="card-img-top" loading="lazy" sizes="(max-width: 1400px) 100vw, 1400px" srcset="
                                                            <?= base_url('dist/img/release-loa-oop_iaqrvm/') ?>release-loa-oop_iaqrvm_c_scale,w_200.jpg 200w,
                                                            <?= base_url('dist/img/release-loa-oop_iaqrvm/') ?>release-loa-oop_iaqrvm_c_scale,w_519.jpg 519w,
                                                            <?= base_url('dist/img/release-loa-oop_iaqrvm/') ?>release-loa-oop_iaqrvm_c_scale,w_773.jpg 773w,
                                                            <?= base_url('dist/img/release-loa-oop_iaqrvm/') ?>release-loa-oop_iaqrvm_c_scale,w_922.jpg 922w,
                                                            <?= base_url('dist/img/release-loa-oop_iaqrvm/') ?>release-loa-oop_iaqrvm_c_scale,w_1062.jpg 1062w,
                                                            <?= base_url('dist/img/release-loa-oop_iaqrvm/') ?>release-loa-oop_iaqrvm_c_scale,w_1192.jpg 1192w,
                                                            <?= base_url('dist/img/release-loa-oop_iaqrvm/') ?>release-loa-oop_iaqrvm_c_scale,w_1297.jpg 1297w,
                                                            <?= base_url('dist/img/release-loa-oop_iaqrvm/') ?>release-loa-oop_iaqrvm_c_scale,w_1392.jpg 1392w,
                                                            <?= base_url('dist/img/release-loa-oop_iaqrvm/') ?>release-loa-oop_iaqrvm_c_scale,w_1400.jpg 1400w" src="<?= base_url('dist/img/release-loa-oop_iaqrvm/') ?>release-loa-oop_iaqrvm_c_scale,w_1400.jpg" alt="">
                                                    <?php elseif ($val->stage == 'Endorsement to Documentation Team') : ?>
                                                        <img class="card-img-top" loading="lazy" sizes="(max-width: 1400px) 100vw, 1400px" srcset="
                                                            <?= base_url('dist/img/endorse-to-doc-team_oymkqd/') ?>endorse-to-doc-team_oymkqd_c_scale,w_200.jpg 200w,
                                                            <?= base_url('dist/img/endorse-to-doc-team_oymkqd/') ?>endorse-to-doc-team_oymkqd_c_scale,w_472.jpg 472w,
                                                            <?= base_url('dist/img/endorse-to-doc-team_oymkqd/') ?>endorse-to-doc-team_oymkqd_c_scale,w_669.jpg 669w,
                                                            <?= base_url('dist/img/endorse-to-doc-team_oymkqd/') ?>endorse-to-doc-team_oymkqd_c_scale,w_827.jpg 827w,
                                                            <?= base_url('dist/img/endorse-to-doc-team_oymkqd/') ?>endorse-to-doc-team_oymkqd_c_scale,w_983.jpg 983w,
                                                            <?= base_url('dist/img/endorse-to-doc-team_oymkqd/') ?>endorse-to-doc-team_oymkqd_c_scale,w_1123.jpg 1123w,
                                                            <?= base_url('dist/img/endorse-to-doc-team_oymkqd/') ?>endorse-to-doc-team_oymkqd_c_scale,w_1253.jpg 1253w,
                                                            <?= base_url('dist/img/endorse-to-doc-team_oymkqd/') ?>endorse-to-doc-team_oymkqd_c_scale,w_1372.jpg 1372w,
                                                            <?= base_url('dist/img/endorse-to-doc-team_oymkqd/') ?>endorse-to-doc-team_oymkqd_c_scale,w_1400.jpg 1400w" src="<?= base_url('dist/img/endorse-to-doc-team_oymkqd/') ?>endorse-to-doc-team_oymkqd_c_scale,w_1400.jpg" alt="">
                                                    <?php elseif ($val->stage == 'Orientation') : ?>
                                                        <img class="card-img-top" loading="lazy" sizes="(max-width: 1400px) 100vw, 1400px" srcset="
                                                            <?= base_url('dist/img/orientation_vnbc3k/') ?>orientation_vnbc3k_c_scale,w_200.jpg 200w,
                                                            <?= base_url('dist/img/orientation_vnbc3k/') ?>orientation_vnbc3k_c_scale,w_450.jpg 450w,
                                                            <?= base_url('dist/img/orientation_vnbc3k/') ?>orientation_vnbc3k_c_scale,w_635.jpg 635w,
                                                            <?= base_url('dist/img/orientation_vnbc3k/') ?>orientation_vnbc3k_c_scale,w_796.jpg 796w,
                                                            <?= base_url('dist/img/orientation_vnbc3k/') ?>orientation_vnbc3k_c_scale,w_931.jpg 931w,
                                                            <?= base_url('dist/img/orientation_vnbc3k/') ?>orientation_vnbc3k_c_scale,w_1056.jpg 1056w,
                                                            <?= base_url('dist/img/orientation_vnbc3k/') ?>orientation_vnbc3k_c_scale,w_1182.jpg 1182w,
                                                            <?= base_url('dist/img/orientation_vnbc3k/') ?>orientation_vnbc3k_c_scale,w_1284.jpg 1284w,
                                                            <?= base_url('dist/img/orientation_vnbc3k/') ?>orientation_vnbc3k_c_scale,w_1378.jpg 1378w,
                                                            <?= base_url('dist/img/orientation_vnbc3k/') ?>orientation_vnbc3k_c_scale,w_1400.jpg 1400w" src="<?= base_url('dist/img/orientation_vnbc3k/') ?>orientation_vnbc3k_c_scale,w_1400.jpg" alt="">
                                                    <?php elseif ($val->stage == 'Completion') : ?>
                                                        <img class="card-img-top" loading="lazy" sizes="(max-width: 1400px) 100vw, 1400px" srcset="
                                                            <?= base_url('dist/img/completion_xcrfmj/') ?>completion_xcrfmj_c_scale,w_200.jpg 200w,
                                                            <?= base_url('dist/img/completion_xcrfmj/') ?>completion_xcrfmj_c_scale,w_469.jpg 469w,
                                                            <?= base_url('dist/img/completion_xcrfmj/') ?>completion_xcrfmj_c_scale,w_659.jpg 659w,
                                                            <?= base_url('dist/img/completion_xcrfmj/') ?>completion_xcrfmj_c_scale,w_813.jpg 813w,
                                                            <?= base_url('dist/img/completion_xcrfmj/') ?>completion_xcrfmj_c_scale,w_912.jpg 912w,
                                                            <?= base_url('dist/img/completion_xcrfmj/') ?>completion_xcrfmj_c_scale,w_1027.jpg 1027w,
                                                            <?= base_url('dist/img/completion_xcrfmj/') ?>completion_xcrfmj_c_scale,w_1118.jpg 1118w,
                                                            <?= base_url('dist/img/completion_xcrfmj/') ?>completion_xcrfmj_c_scale,w_1220.jpg 1220w,
                                                            <?= base_url('dist/img/completion_xcrfmj/') ?>completion_xcrfmj_c_scale,w_1308.jpg 1308w,
                                                            <?= base_url('dist/img/completion_xcrfmj/') ?>completion_xcrfmj_c_scale,w_1394.jpg 1394w,
                                                            <?= base_url('dist/img/completion_xcrfmj/') ?>completion_xcrfmj_c_scale,w_1400.jpg 1400w" src="<?= base_url('dist/img/completion_xcrfmj/') ?>completion_xcrfmj_c_scale,w_1400.jpg" alt="">
                                                    <?php elseif ($val->stage == 'Compilation') : ?>
                                                        <img class="card-img-top" loading="lazy" sizes="(max-width: 1400px) 100vw, 1400px" srcset="
                                                            <?= base_url('dist/img/compilation_wqpnly/') ?>compilation_wqpnly_c_scale,w_200.jpg 200w,
                                                            <?= base_url('dist/img/compilation_wqpnly/') ?>compilation_wqpnly_c_scale,w_389.jpg 389w,
                                                            <?= base_url('dist/img/compilation_wqpnly/') ?>compilation_wqpnly_c_scale,w_535.jpg 535w,
                                                            <?= base_url('dist/img/compilation_wqpnly/') ?>compilation_wqpnly_c_scale,w_650.jpg 650w,
                                                            <?= base_url('dist/img/compilation_wqpnly/') ?>compilation_wqpnly_c_scale,w_772.jpg 772w,
                                                            <?= base_url('dist/img/compilation_wqpnly/') ?>compilation_wqpnly_c_scale,w_886.jpg 886w,
                                                            <?= base_url('dist/img/compilation_wqpnly/') ?>compilation_wqpnly_c_scale,w_977.jpg 977w,
                                                            <?= base_url('dist/img/compilation_wqpnly/') ?>compilation_wqpnly_c_scale,w_1075.jpg 1075w,
                                                            <?= base_url('dist/img/compilation_wqpnly/') ?>compilation_wqpnly_c_scale,w_1168.jpg 1168w,
                                                            <?= base_url('dist/img/compilation_wqpnly/') ?>compilation_wqpnly_c_scale,w_1259.jpg 1259w,
                                                            <?= base_url('dist/img/compilation_wqpnly/') ?>compilation_wqpnly_c_scale,w_1342.jpg 1342w,
                                                            <?= base_url('dist/img/compilation_wqpnly/') ?>compilation_wqpnly_c_scale,w_1389.jpg 1389w,
                                                            <?= base_url('dist/img/compilation_wqpnly/') ?>compilation_wqpnly_c_scale,w_1400.jpg 1400w" src="<?= base_url('dist/img/compilation_wqpnly/') ?>compilation_wqpnly_c_scale,w_1400.jpg" alt="">
                                                    <?php elseif ($val->stage == 'Assessment & Finalization') : ?>
                                                        <img class="card-img-top" loading="lazy" sizes="(max-width: 1400px) 100vw, 1400px" srcset="
                                                            <?= base_url('dist/img/assessment_txmxvm/') ?>assessment_txmxvm_c_scale,w_200.jpg 200w,
                                                            <?= base_url('dist/img/assessment_txmxvm/') ?>assessment_txmxvm_c_scale,w_614.jpg 614w,
                                                            <?= base_url('dist/img/assessment_txmxvm/') ?>assessment_txmxvm_c_scale,w_877.jpg 877w,
                                                            <?= base_url('dist/img/assessment_txmxvm/') ?>assessment_txmxvm_c_scale,w_1141.jpg 1141w,
                                                            <?= base_url('dist/img/assessment_txmxvm/') ?>assessment_txmxvm_c_scale,w_1336.jpg 1336w,
                                                            <?= base_url('dist/img/assessment_txmxvm/') ?>assessment_txmxvm_c_scale,w_1400.jpg 1400w" src="<?= base_url('dist/img/assessment_txmxvm/') ?>assessment_txmxvm_c_scale,w_1400.jpg" alt="">
                                                    <?php elseif ($val->stage == 'RCIC Quality Check') : ?>
                                                        <img class="card-img-top" loading="lazy" sizes="(max-width: 1400px) 100vw, 1400px" srcset="
                                                            <?= base_url('dist/img/quality-check_sda6yx/') ?>quality-check_sda6yx_c_scale,w_200.jpg 200w,
                                                            <?= base_url('dist/img/quality-check_sda6yx/') ?>quality-check_sda6yx_c_scale,w_522.jpg 522w,
                                                            <?= base_url('dist/img/quality-check_sda6yx/') ?>quality-check_sda6yx_c_scale,w_763.jpg 763w,
                                                            <?= base_url('dist/img/quality-check_sda6yx/') ?>quality-check_sda6yx_c_scale,w_967.jpg 967w,
                                                            <?= base_url('dist/img/quality-check_sda6yx/') ?>quality-check_sda6yx_c_scale,w_1136.jpg 1136w,
                                                            <?= base_url('dist/img/quality-check_sda6yx/') ?>quality-check_sda6yx_c_scale,w_1305.jpg 1305w,
                                                            <?= base_url('dist/img/quality-check_sda6yx/') ?>quality-check_sda6yx_c_scale,w_1400.jpg 1400w" src="<?= base_url('dist/img/quality-check_sda6yx/') ?>quality-check_sda6yx_c_scale,w_1400.jpg" alt="">
                                                    <?php elseif ($val->stage == 'Lodging of VISA Application') : ?>
                                                        <img class="card-img-top" loading="lazy" sizes="(max-width: 1400px) 100vw, 1400px" srcset="
                                                            <?= base_url('dist/img/visa_jrqzza/') ?>visa_jrqzza_c_scale,w_200.jpg 200w,
                                                            <?= base_url('dist/img/visa_jrqzza/') ?>visa_jrqzza_c_scale,w_374.jpg 374w,
                                                            <?= base_url('dist/img/visa_jrqzza/') ?>visa_jrqzza_c_scale,w_491.jpg 491w,
                                                            <?= base_url('dist/img/visa_jrqzza/') ?>visa_jrqzza_c_scale,w_611.jpg 611w,
                                                            <?= base_url('dist/img/visa_jrqzza/') ?>visa_jrqzza_c_scale,w_712.jpg 712w,
                                                            <?= base_url('dist/img/visa_jrqzza/') ?>visa_jrqzza_c_scale,w_820.jpg 820w,
                                                            <?= base_url('dist/img/visa_jrqzza/') ?>visa_jrqzza_c_scale,w_922.jpg 922w,
                                                            <?= base_url('dist/img/visa_jrqzza/') ?>visa_jrqzza_c_scale,w_1018.jpg 1018w,
                                                            <?= base_url('dist/img/visa_jrqzza/') ?>visa_jrqzza_c_scale,w_1116.jpg 1116w,
                                                            <?= base_url('dist/img/visa_jrqzza/') ?>visa_jrqzza_c_scale,w_1208.jpg 1208w,
                                                            <?= base_url('dist/img/visa_jrqzza/') ?>visa_jrqzza_c_scale,w_1302.jpg 1302w,
                                                            <?= base_url('dist/img/visa_jrqzza/') ?>visa_jrqzza_c_scale,w_1377.jpg 1377w,
                                                            <?= base_url('dist/img/visa_jrqzza/') ?>visa_jrqzza_c_scale,w_1400.jpg 1400w" src="<?= base_url('dist/img/visa_jrqzza/') ?>visa_jrqzza_c_scale,w_1400.jpg" alt="">
                                                    <?php endif; ?>
                                                    <div class="card-img-overlay">
                                                        <?php if (!empty($method->searchArray($current_and_done_stage, $val->stage))) : ?>
                                                            <?php $row = $method->searchArray($current_and_done_stage, $val->stage) ?>
                                                            <?php if ($row[0]->status == 'done') : ?>
                                                                <span class="badge badge-success badge-pill">Completed</span>
                                                            <?php else : ?>
                                                                <span class="badge badge-danger badge-pill">Current</span>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        <?php if (
                                                            $val->stage != 'Release of LOA/OOP' &&
                                                            $val->stage != 'Endorsement to Documentation Team' &&
                                                            $val->stage != 'Orientation' &&
                                                            $val->stage != 'Compilation' &&
                                                            $val->stage != 'Assessment & Finalization' &&
                                                            $val->stage != 'RCIC Quality Check' &&
                                                            $val->stage != 'Lodging of VISA Application'
                                                        ) : ?>
                                                            <?php if ($current_stage[0]->stage == $val->stage) : ?>
                                                                <?php if ($number_of_files_submitted <= 0) : ?>
                                                                    <span class="badge badge-dark badge-pill">Not Started</span>
                                                                <?php else : ?>
                                                                    <span class="badge badge-info badge-pill">Ongoing</span>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title text-sm"><?= $val->stage ?></h5>
                                                        <p class="card-text text-secondary"> Stage <?= $key + 1 ?></p>
                                                    </div>
                                                    <div class="card-footer bg-white">
                                                        <?php if (!empty($method->searchArray($current_and_done_stage, $val->stage))) : ?>
                                                            <div class="float-left">
                                                                <?php if ($this->session->employee_role == 4) : ?>
                                                                    <?php if ($val->switch == 0) : ?>
                                                                        <a class="card-link open-on" href="<?= base_url() ?>employee/update/stage/<?= $val->id ?>/1" data-confirm="This will open the stage for Mr/Mrs. <?= $client->client_last; ?>"><i class="fas fa-lock"></i></a>
                                                                    <?php else : ?>
                                                                        <a class="card-link close-off" href="<?= base_url() ?>employee/update/stage/<?= $val->id ?>/0" data-confirm="This will close the stage for Mr/Mrs. <?= $client->client_last; ?>"><i class="fas fa-lock-open"></i></a>
                                                                    <?php endif; ?>
                                                                <?php else : ?>
                                                                    <span class="card-link text-secondary"><i class="fas fa-lock"></i></span>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="float-right">
                                                                <?php if ($val->stage == 'Client Onboarding') : ?>
                                                                    <?php if (
                                                                        $this->session->employee_role == 2 ||
                                                                        $this->session->employee_role == 3 ||
                                                                        $this->session->employee_role == 5
                                                                    ) : ?>
                                                                        <a href="<?= base_url() ?>employee/clients/profile/id/<?= $this->uri->segment(5) ?>/stage<?= $key + 1 ?>" class="card-link">View Files</a>
                                                                    <?php endif; ?>
                                                                <?php elseif ($val->stage == 'Enrollment') : ?>
                                                                    <?php if ($this->session->employee_role != 1) : ?>
                                                                        <a href="<?= base_url() ?>employee/clients/profile/id/<?= $this->uri->segment(5) ?>/stage<?= $key + 1 ?>" class="card-link">View Files</a>
                                                                    <?php endif; ?>
                                                                <?php elseif ($val->stage == 'Release of LOA/OOP') : ?>
                                                                    <?php if (!empty($method->searchArray($current_and_done_stage, 'Endorsement to Documentation Team', 'stage'))) : ?>
                                                                        <?php $row = $method->searchArray($current_and_done_stage, 'Endorsement to Documentation Team', 'stage') ?>
                                                                        <?php if ($row[0]->status == 'done') : ?>
                                                                            <?php if ($this->session->employee_role == 3) : ?>
                                                                                <a href="<?= base_url() ?>employee/clients/profile/id/<?= $this->uri->segment(5) ?>/stage<?= $key + 1 ?>" class="card-link">Open</a>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    <?php else : ?>
                                                                        <?php if (
                                                                            $this->session->employee_role == 1 ||
                                                                            $this->session->employee_role == 3 ||
                                                                            $this->session->employee_role == 5
                                                                        ) : ?>
                                                                            <a href="<?= base_url() ?>employee/clients/profile/id/<?= $this->uri->segment(5) ?>/stage<?= $key + 1 ?>" class="card-link">Open</a>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                <?php elseif ($val->stage == 'Endorsement to Documentation Team') : ?>
                                                                    <?php if ($this->session->employee_role == 3) : ?>
                                                                        <?php if ($row[0]->status != 'done') : ?>
                                                                            <a href="<?= base_url() ?>employee/clients/stage/approve/Endorsement to Documentation Team/<?= $client->id_lead ?>" class="confirmation" data-title="Proceed to Orientation" data-confirm="Are you sure you want to proceed to Orientation stage?">Proceed to Orientation</a>
                                                                        <?php endif; ?>
                                                                    <?php else : ?>
                                                                        <?php if ($row[0]->status != 'done') : ?>
                                                                            <span class="card-link text-primary text-sm">Waiting for Documentation Team</span>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                <?php elseif ($val->stage == 'Completion') : ?>
                                                                    <?php if ($row[0]->status != 'done') : ?>
                                                                        <?php if ($this->session->employee_role == 3) : ?>
                                                                            <a href="<?= base_url() ?>employee/clients/profile/id/<?= $this->uri->segment(5) ?>/stage<?= $key + 1 ?>" class="card-link">View Files</a>
                                                                        <?php endif; ?>
                                                                    <?php else : ?>
                                                                        <?php if ($this->session->employee_role == 5 || $this->session->employee_role == 3 || $this->session->employee_role == 4) : ?>
                                                                            <a href="<?= base_url() ?>employee/clients/profile/id/<?= $this->uri->segment(5) ?>/stage<?= $key + 1 ?>" class="card-link">View Files</a>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                <?php elseif ($val->stage == 'Compilation') : ?>
                                                                    <?php if ($this->session->employee_role == 5) : ?>
                                                                        <?php if ($row[0]->status != 'done') : ?>
                                                                            <a href="<?= base_url() ?>employee/clients/stage/approve/Compilation/<?= $client->id_lead ?>" class="confirmation text-sm" data-title="Proceed to Assessment & Finalization" data-confirm="Are you sure you want to proceed to Assessment & Finalization stage?">Proceed to Assessment</a>
                                                                        <?php endif; ?>
                                                                    <?php else : ?>
                                                                        <?php if ($row[0]->status != 'done') : ?>
                                                                            <span class="card-link text-secondary text-sm">Waiting for Approver</span>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                <?php elseif ($val->stage == 'Assessment & Finalization') : ?>
                                                                    <?php if ($this->session->employee_role == 5) : ?>
                                                                        <?php if ($row[0]->status != 'done') : ?>
                                                                            <a href="<?= base_url() ?>employee/clients/stage/approve/Assessment and Finalization/<?= $client->id_lead ?>" class="confirmation text-sm" data-title="Proceed to RCIC Quality Check" data-confirm="Are you sure you want to proceed to RCIC Quality Check stage?">Proceed to RCIC Quality Check</a>
                                                                        <?php endif; ?>
                                                                    <?php else : ?>
                                                                        <?php if ($row[0]->status != 'done') : ?>
                                                                            <span class="card-link text-secondary text-sm">Waiting for Approver</span>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                <?php elseif ($val->stage == 'RCIC Quality Check') : ?>
                                                                    <?php if ($this->session->employee_role == 5) : ?>
                                                                        <?php if ($row[0]->status != 'done') : ?>
                                                                            <a href="<?= base_url() ?>employee/clients/stage/approve/RCIC Quality Check/<?= $client->id_lead ?>" class="confirmation text-sm" data-title="Proceed to Lodging of VISA Application" data-confirm="Are you sure you want to proceed to Lodging of VISA Application stage?">Proceed to Lodging of VISA</a>
                                                                        <?php endif; ?>
                                                                    <?php else : ?>
                                                                        <?php if ($row[0]->status != 'done') : ?>
                                                                            <span class="card-link text-secondary text-sm">Waiting for Approver</span>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                <?php elseif ($val->stage == 'Lodging of VISA Application') : ?>
                                                                    <?php if ($this->session->employee_role == 5) : ?>
                                                                        <?php if ($row[0]->status != 'done') : ?>
                                                                            <a href="<?= base_url() ?>employee/clients/profile/id/<?= $this->uri->segment(5) ?>/stage<?= $key + 1 ?>" class="card-link">Upload</a>
                                                                        <?php endif; ?>
                                                                    <?php else : ?>
                                                                        <?php if ($row[0]->status != 'done') : ?>
                                                                            <span class="card-link text-secondary text-sm">Waiting for Approver</span>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php else : ?>
                                                            <?php if ($val->stage == 'Completion') : ?>
                                                                <?php if ($this->session->employee_role == 3) : ?>
                                                                    <?php if ($row[0]->status != 'done') : ?>
                                                                        <div class="float-left">
                                                                            <?php if ($this->session->employee_role == 4) : ?>
                                                                                <?php if ($val->switch == 0) : ?>
                                                                                    <a class="card-link open-on" href="<?= base_url() ?>employee/update/stage/<?= $val->id ?>/1" data-confirm="This will open the stage for Mr/Mrs. <?= $client->client_last; ?>"><i class="fas fa-lock"></i></a>
                                                                                <?php else : ?>
                                                                                    <a class="card-link close-off" href="<?= base_url() ?>employee/update/stage/<?= $val->id ?>/0" data-confirm="This will close the stage for Mr/Mrs. <?= $client->client_last; ?>"><i class="fas fa-lock-open"></i></a>
                                                                                <?php endif; ?>
                                                                            <?php else : ?>
                                                                                <span class="card-link text-secondary"><i class="fas fa-lock"></i></span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <div class="float-right text-secondary">
                                                                            <a href="<?= base_url() ?>employee/clients/profile/id/<?= $this->uri->segment(5) ?>/stage<?= $key + 1 ?>" class="card-link">View Files</a>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php else : ?>
                                                                    <div class="float-left text-secondary">
                                                                        <span class="card-link"><i class="fas fa-lock"></i></span>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php else : ?>
                                                                <div class="float-left text-secondary">
                                                                    <span class="card-link"><i class="fas fa-lock"></i></span>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-details">
                                    <div class="card">
                                        <div class="card-header">
                                            Main
                                        </div>
                                        <div class="card-body">
                                            <?= form_open("employee/update/form/main/$client->id_lead", 'id="main_form_fetch"') ?>
                                            <div class="form-group row border-bottom">
                                                <label class="col-12 col-md-3 col-form-label"><i class="fas fa-school"></i>&nbsp;School</label>
                                                <div class="col-12 col-md-9 text-right">
                                                    <?php if ($this->session->employee_role != 1) : ?>
                                                        <input type="text" name="school" value="<?= $client->school ?>" class="form-control form-control-sm" placeholder="Empty">
                                                    <?php else : ?>
                                                        <?= empty($client->school) ?  'No Data' : $client->school ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="form-group row border-bottom">
                                                <label class="col-12 col-md-3 col-form-label"><i class="fas fa-calendar-day"></i>&nbsp;Intake Date</label>
                                                <div class="col-12 col-md-9 text-right">
                                                    <?php if ($this->session->employee_role != 1) : ?>
                                                        <input type="text" name="intake_date" value="<?= $client->intake_date ?>" class="form-control form-control-sm" placeholder="Empty">
                                                    <?php else : ?>
                                                        <?= empty($client->intake_date) ?  'No Data' : $client->intake_date ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="form-group row border-bottom">
                                                <label class="col-12 col-md-3 col-form-label"><i class="fas fa-id-card-alt"></i>&nbsp;Student ID</label>
                                                <div class="col-12 col-md-9 text-right">
                                                    <?php if ($this->session->employee_role != 1) : ?>
                                                        <input type="text" name="student_id" value="<?= $client->student_id ?>" class="form-control form-control-sm" placeholder="Empty">
                                                    <?php else : ?>
                                                        <?= empty($client->student_id) ?  'No Data' : $client->student_id ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="form-group row border-bottom">
                                                <label class="col-12 col-md-3 col-form-label"><i class="fas fa-file-alt"></i>&nbsp;Program</label>
                                                <div class="col-12 col-md-9 text-right">
                                                    <?php if ($this->session->employee_role != 1) : ?>
                                                        <input type="text" name="program" value="<?= $client->program ?>" class="form-control form-control-sm" placeholder="Empty">
                                                    <?php else : ?>
                                                        <?= empty($client->program) ?  'No Data' : $client->program ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php if ($this->session->employee_role != 1) : ?>
                                                <button type="submit" class="btn btn-primary btn-sm float-right">Update</button>
                                            <?php endif; ?>
                                            <?= form_close() ?>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            Fees
                                        </div>
                                        <div class="card-body">
                                            <?= form_open("employee/update/form/fees/$client->id_lead", 'id="fees_form_fetch"') ?>
                                            <div class="form-group row border-bottom">
                                                <label class="col-12 col-md-9 col-form-label"><i class="fas fa-tags"></i>&nbsp;Reservation Fee</label>
                                                <div class="col-12 col-md-3 text-right">
                                                    <?php if ($this->session->employee_role == 1) : ?>
                                                        <input type="text" name="reservation_fee" value="<?= $client->reservation_fee ?>" class="form-control form-control-sm" placeholder="Empty">
                                                    <?php else : ?>
                                                        <?= empty($client->reservation_fee) ?  'No Data' : $client->reservation_fee ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="form-group row border-bottom">
                                                <label class="col-12 col-md-9 col-form-label"><i class="fas fa-tags"></i>&nbsp;Tuition Fee Deposit</label>
                                                <div class="col-12 col-md-3 text-right">
                                                    <?php if ($this->session->employee_role == 1) : ?>
                                                        <input type="text" name="tuition_fee" value="<?= $client->tuition_fee_depo ?>" class="form-control form-control-sm" placeholder="Empty">
                                                    <?php else : ?>
                                                        <?= empty($client->tuition_fee_depo) ?  'No Data' : $client->tuition_fee_depo ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="form-group row border-bottom">
                                                <label class="col-12 col-md-9 col-form-label"><i class="fas fa-tags"></i>&nbsp;Contract Fee</label>
                                                <div class="col-12 col-md-3 text-right">
                                                    <?php if ($this->session->employee_role == 1) : ?>
                                                        <input type="text" name="contract_fee" value="<?= $client->contract_fee ?>" class="form-control form-control-sm" placeholder="Empty">
                                                    <?php else : ?>
                                                        <?= empty($client->contract_fee) ?  'No Data' : $client->contract_fee ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php if ($this->session->employee_role == 1) : ?>
                                                <button type="submit" class="btn btn-primary btn-sm float-right">Update</button>
                                            <?php endif; ?>
                                            <?= form_close() ?>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            Important Dates
                                        </div>
                                        <div class="card-body">
                                            <?= form_open("employee/update/form/dates/$client->id_lead", 'id="dates_form_fetch"') ?>
                                            <div class="form-group row border-bottom">
                                                <label class="col-12 col-md-9 col-form-label"><i class="fas fa-calendar-day"></i>&nbsp;Refund/Withdrawal Deadline</label>
                                                <div class="col-12 col-md-3 text-right">
                                                    <?php if ($this->session->employee_role != 1) : ?>
                                                        <input type="text" name="refund_deadline" value="<?= $client->deadline ?>" class="form-control form-control-sm" placeholder="Empty">
                                                    <?php else : ?>
                                                        <?= empty($client->deadline) ?  'No Data' : $client->deadline ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="form-group row border-bottom">
                                                <label class="col-12 col-md-9 col-form-label"><i class="fas fa-calendar-day"></i>&nbsp;Deferral Intake</label>
                                                <div class="col-12 col-md-3 text-right">
                                                    <?php if ($this->session->employee_role != 1) : ?>
                                                        <input type="text" name="deferral_intake" value="<?= $client->deferral_intake ?>" class="form-control form-control-sm" placeholder="Empty">
                                                    <?php else : ?>
                                                        <?= empty($client->deferral_intake) ?  'No Data' : $client->deferral_intake ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="form-group row border-bottom">
                                                <label class="col-12 col-md-9 col-form-label"><i class="fas fa-calendar-day"></i>&nbsp;Birthdate</label>
                                                <div class="col-12 col-md-3 text-right">
                                                    <?php if ($this->session->employee_role != 1) : ?>
                                                        <input type="text" name="birthdate" value="<?= $client->birthdate ?>" class="form-control form-control-sm" placeholder="Empty">
                                                    <?php else : ?>
                                                        <?= empty($client->birthdate) ?  'No Data' : $client->birthdate ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="form-group row border-bottom">
                                                <label class="col-12 col-md-9 col-form-label"><i class="fas fa-calendar-day"></i>&nbsp;Created</label>
                                                <div class="col-12 col-md-3 text-right">
                                                    <?= date('Y-m-d h:i A', strtotime($client->created_time)); ?>
                                                </div>
                                            </div>
                                            <?php if ($this->session->employee_role != 1) : ?>
                                                <button type="submit" class="btn btn-primary btn-sm float-right">Update</button>
                                            <?php endif; ?>
                                            <?= form_close() ?>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            Contact Information
                                        </div>
                                        <div class="card-body">
                                            <?= form_open("employee/update/form/contact/$client->id_lead", 'id="contact_form_fetch"') ?>
                                            <div class="form-group row border-bottom">
                                                <label class="col-12 col-md-9 col-form-label"><i class="fas fa-envelope"></i>&nbsp;Email</label>
                                                <div class="col-12 col-md-3 text-right">
                                                    <?php if ($this->session->employee_role != 1) : ?>
                                                        <input type="text" name="email" value="<?= $client->client_email ?>" class="form-control form-control-sm" placeholder="Empty">
                                                    <?php else : ?>
                                                        <?= empty($client->client_email) ?  'No Data' : $client->client_email ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="form-group row border-bottom">
                                                <label class="col-12 col-md-9 col-form-label"><i class="fas fa-phone"></i>&nbsp;Contact</label>
                                                <div class="col-12 col-md-3 text-right">
                                                    <?php if ($this->session->employee_role != 1) : ?>
                                                        <input type="text" name="phone" value="<?= $client->phone ?>" class="form-control form-control-sm" placeholder="Empty">
                                                    <?php else : ?>
                                                        <?= empty($client->phone) ?  'No Data' : $client->phone ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="form-group row border-bottom">
                                                <label class="col-12 col-md-9 col-form-label"><i class="fas fa-phone"></i>&nbsp;Other Contact</label>
                                                <div class="col-12 col-md-3 text-right">
                                                    <?php if ($this->session->employee_role != 1) : ?>
                                                        <input type="text" name="other_phone" value="<?= $client->other_phone ?>" class="form-control form-control-sm" placeholder="Empty">
                                                    <?php else : ?>
                                                        <?= empty($client->other_phone) ?  'No Data' : $client->other_phone ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="form-group row border-bottom">
                                                <label class="col-12 col-md-5 col-form-label"><i class="fas fa-map-marker"></i>&nbsp;Address</label>
                                                <div class="col-12 col-md-7 text-right">
                                                    <?php if ($this->session->employee_role != 1) : ?>
                                                        <input type="text" name="address" value="<?= $client->address ?>" class="form-control form-control-sm" placeholder="Empty">
                                                    <?php else : ?>
                                                        <?= empty($client->address) ?  'No Data' : $client->address ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php if ($this->session->employee_role != 1) : ?>
                                                <button type="submit" class="btn btn-primary btn-sm float-right">Update</button>
                                            <?php endif; ?>
                                            <?= form_close() ?>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            Educational Background
                                        </div>
                                        <div class="card-body">
                                            <?= form_open("employee/update/form/educational/$client->id_lead", 'id="educational_form_fetch"') ?>
                                            <div class="form-group row border-bottom">
                                                <label class="col-12 col-md-9 col-form-label"><i class="fas fa-graduation-cap"></i>&nbsp;Graduate School</label>
                                                <div class="col-12 col-md-3 text-right">
                                                    <?php if ($this->session->employee_role != 1) : ?>
                                                        <input type="text" name="graduate_school" value="<?= $client->graduate_school ?>" class="form-control form-control-sm" placeholder="Empty">
                                                    <?php else : ?>
                                                        <?= empty($client->graduate_school) ?  'No Data' : $client->graduate_school ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="form-group row border-bottom">
                                                <label class="col-12 col-md-9 col-form-label"><i class="fas fa-school"></i>&nbsp;High School</label>
                                                <div class="col-12 col-md-3 text-right">
                                                    <?php if ($this->session->employee_role != 1) : ?>
                                                        <input type="text" name="high_school" value="<?= $client->high_school ?>" class="form-control form-control-sm" placeholder="Empty">
                                                    <?php else : ?>
                                                        <?= empty($client->high_school) ?  'No Data' : $client->high_school ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="form-group row border-bottom">
                                                <label class="col-12 col-md-9 col-form-label"><i class="fas fa-university"></i>&nbsp;College</label>
                                                <div class="col-12 col-md-3 text-right">
                                                    <?php if ($this->session->employee_role != 1) : ?>
                                                        <input type="text" name="college" value="<?= $client->college ?>" class="form-control form-control-sm" placeholder="Empty">
                                                    <?php else : ?>
                                                        <?= empty($client->college) ?  'No Data' : $client->college ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php if ($this->session->employee_role != 1) : ?>
                                                <button type="submit" class="btn btn-primary btn-sm float-right">Update</button>
                                            <?php endif; ?>
                                            <?= form_close() ?>
                                        </div>
                                    </div>
                                    <?php if ($this->session->employee_role == 4) : ?>
                                        <div class="card">
                                            <div class="card-header">
                                                Account Activation
                                            </div>
                                            <div class="card-body">
                                                <p class="text-justify">Once you deactivate the account, the Client will be no more access to the portal. Even though, you can activate the account if you disabled it.</p>
                                                <div class="d-flex border-bottom">
                                                    <div class="mr-auto p-2">
                                                        <strong>Account Status</strong>
                                                    </div>
                                                    <div class="p-2">
                                                        <?php if ($client->isActive == 0) : ?>
                                                            <a href="<?= base_url() ?>employee/clients/account/activate/<?= $this->uri->segment(5) ?>" class="btn btn-success btn-xs activation" data-confirm="Are you sure you want to activate this clients account?"><b>Activate Account</b></a>
                                                        <?php elseif ($client->isActive == 1) : ?>
                                                            <a href="<?= base_url() ?>employee/clients/account/deactivate/<?= $this->uri->segment(5) ?>" class="btn btn-danger btn-xs activation" data-confirm="Are you sure you want to deactivate this clients account?"><b>Deactivate Account</b></a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="tab-pane fade" id="v-pills-pay">
                                    <div class="card">
                                        <div class="card-body">
                                            <table id="payment-history-table" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Type</th>
                                                        <th>Amount</th>
                                                        <th>Remarks</th>
                                                        <th>Date Paid</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-notes">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <button class="btn btn-primary float-right btn-sm" data-target="#note-modal" data-toggle="modal"><i class="fas fa-plus"></i> Add</button>
                                        </div>
                                        <div class="col-12">
                                            <div class="row" id="notes-row">
                                                <?php if (empty($notes)) : ?>
                                                    <h1 id="notes-h1" class="col-11 text-center text-secondary m-5">NOTES</h1>
                                                <?php else : ?>
                                                    <?php foreach ($notes as $val) : ?>
                                                        <div class="col-md-4">
                                                            <div class="card">
                                                                <div class="card-header text-sm">
                                                                    <h3 class="card-title"><span class="text-primary font-weight-bold"><?= $val->emp_last ?></span>
                                                                        - <?php if ($val->role == 1) :  ?>
                                                                            <span class="badge badge-danger">Administrator</span>
                                                                        <?php elseif ($val->role == 2) :  ?>
                                                                            <span class="badge badge-danger">Marketing</span>
                                                                        <?php elseif ($val->role == 3) :  ?>
                                                                            <span class="badge badge-danger">Documentation</span>
                                                                        <?php elseif ($val->role == 4) :  ?>
                                                                            <span class="badge badge-danger">Super User</span>
                                                                        <?php elseif ($val->role == 5) :  ?>
                                                                            <span class="badge badge-danger">Approver</span>
                                                                        <?php endif; ?>
                                                                    </h3>
                                                                    <br>
                                                                    <span class="text-secondary"><?= date('m/d/Y h:i A', strtotime($val->noted_date)) ?></span>
                                                                </div>
                                                                <div class="card-body">
                                                                    <?= $val->note ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
<div class="modal fade" id="note-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <p class="modal-title font-weight-bold">Take a note</p>
            </div>
            <?= form_open("employee/notes/add/$client->id_lead/" . $this->session->employee_realid, 'id="note_form_fetch"') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>Note</label>
                    <textarea name="note" class="form-control" rows="3" placeholder="Enter ..." spellcheck="false" id="note-text-area"></textarea>
                    <span class="error invalid-feedback" style="display: none;">Do not leave it empty!</span>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" id="cancel" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" name="add">Add</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</div>