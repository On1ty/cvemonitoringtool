<div class="content-wrapper border border-left-0 border-right-0 border-bottom-0">
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark"> Stages</h1>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="container">
			<div class="row">
				<?php foreach ($stages as $key => $val) : ?>
					<div class="col-12 col-md-12 col-lg-4">
						<?php if (
							$val->stage != 'Release of LOA/OOP' &&
							$val->stage != 'Endorsement to Documentation Team' &&
							$val->stage != 'Orientation'
						) : ?>
							<?php if ($val->switch != 0) : ?>
								<a href="stages/stage<?= $key + 1 ?>" class="card-link">
								<?php endif; ?>
							<?php endif; ?>
							<div class="card elevation-3">
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
								<?php if ($val->switch == 0) : ?>
									<div class="overlay dark rounded-0">
										<i class="text-white fas fa-5x fa-lock"></i>
									</div>
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
									<?php else : ?>
										<?php if ($current_stage[0]->stage == $val->stage) : ?>
											<span class="badge badge-info badge-pill">In Progress</span>
										<?php endif; ?>
									<?php endif; ?>
								</div>
								<div class="card-body">
									<h5 class="card-title text-sm"><?= $val->stage ?></h5>
									<p class="card-text text-secondary"> Stage <?= $key + 1 ?></p>
								</div>
							</div>
							<?php if (
								$val->stage != 'Release of LOA/OOP' &&
								$val->stage != 'Endorsement to Documentation Team' &&
								$val->stage != 'Orientation'
							) : ?>
								</a>
							<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>