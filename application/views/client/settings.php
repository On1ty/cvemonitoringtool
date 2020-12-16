<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper border border-left-0 border-right-0 border-bottom-0">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Account Settings</h1>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="card card-primary card-outline">
						<div class="card-body box-profile">
							<h1 class="text-center">
								<?= $client->client_first; ?>
								<?= $client->client_last; ?>
							</h1>
							<p class="text-muted text-center"><?= date('Y-m-d h:i A', strtotime($client->created_time)); ?></p>

							<ul class="list-group list-group-unbordered mb-3">
								<li class="list-group-item">
									<b>School</b> <a class="float-right">
										<?= empty($client->school) ?  'No Data' : $client->school ?>
									</a>
								</li>
								<li class="list-group-item">
									<b>Intake Date</b> <a class="float-right">
										<?= empty($client->intake_date) ?  'No Data' : $client->intake_date ?>
									</a>
								</li>
								<li class="list-group-item">
									<b>Student ID</b> <a class="float-right">
										<?= empty($client->student_id) ?  'No Data' : $client->student_id ?>
									</a>
								</li>
								<li class="list-group-item">
									<b>Program</b> <a class="float-right">
										<?= empty($client->program) ?  'No Data' : $client->program ?>
									</a>
								</li>
								<li class="list-group-item">
									<b>Reservation Fee</b> <a class="float-right">
										<?= empty($client->reservation_fee) ?  'No Data' : $client->reservation_fee ?>
									</a>
								</li>
								<li class="list-group-item">
									<b>Tuition Fee Deposit</b> <a class="float-right">
										<?= empty($client->tuition_fee_depo) ?  'No Data' : $client->tuition_fee_depo ?>
									</a>
								</li>
								<li class="list-group-item">
									<b>Contract Fee</b> <a class="float-right">
										<?= empty($client->contract_fee) ?  'No Data' : $client->contract_fee ?>
									</a>
								</li>
								<li class="list-group-item">
									<b>Refund/Withdrawal Deadline</b> <a class="float-right">
										<?= empty($client->deadline) ?  'No Data' : $client->deadline ?>
									</a>
								</li>
								<li class="list-group-item border-bottom-0">
									<b>Deferral Intake</b> <a class="float-right">
										<?= empty($client->deferral_intake) ?  'No Data' : $client->deferral_intake ?>
									</a>
								</li>
							</ul>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
				<div class="col-md-8">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">
								<li class="nav-item"><a class="nav-link active" href="#info" data-toggle="tab">Account
										Info</a></li>
								<li class="nav-item"><a class="nav-link" href="#pass" data-toggle="tab">Account
										Password</a></li>
							</ul>
						</div><!-- /.card-header -->
						<div class="card-body">
							<div class="tab-content">
								<div class="active tab-pane" id="info">
									<?= form_open('settings/change/info', 'class="form-horizontal", id="account_info_form"') ?>
									<div class="form-group row">
										<label for="inputName" class="col-sm-4 col-form-label">First name</label>
										<div class="col-sm-8">
											<input type="text" name="first_name" class="form-control" placeholder="First name" value="<?= $client->client_first; ?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="inputName" class="col-sm-4 col-form-label">Middle name</label>
										<div class="col-sm-8">
											<input type="text" name="middle_name" class="form-control" placeholder="Middle name" value="<?= $client->client_middle; ?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="inputName" class="col-sm-4 col-form-label">Last name</label>
										<div class="col-sm-8">
											<input type="text" name="last_name" class="form-control" placeholder="Last name" value="<?= $client->client_last; ?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="inputEmail" class="col-sm-4 col-form-label">Email</label>
										<div class="col-sm-8">
											<input type="email" name="email" class="form-control" placeholder="Email" value="<?= $client->client_email; ?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="inputEmail" class="col-sm-4 col-form-label">Contact</label>
										<div class="col-sm-8">
											<input type="text" name="phone" class="form-control" placeholder="Phone" value="<?= $client->phone; ?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="inputEmail" class="col-sm-4 col-form-label">Other Contact</label>
										<div class="col-sm-8">
											<input type="text" name="other_phone" class="form-control" placeholder="Other Phone" value="<?= $client->other_phone; ?>">
										</div>
									</div>
									<div class="form-group float-right">
										<button type="submit" class="btn btn-danger">Save changes</button>
									</div>
									<?= form_close(); ?>
								</div>
								<div class="tab-pane" id="pass">
									<?= form_open('settings/change/password', 'class="form-horizontal", id="account_password_form"') ?>
									<div class="form-group row">
										<label for="inputName" class="col-sm-4 col-form-label">Current</label>
										<div class="col-sm-8">
											<input type="password" autocomplete="off" class="form-control <?= form_error('current') ? 'is-invalid' : '' ?>" name="current_pass" placeholder="Current password" value="<?= set_value('current'); ?>">
											<?php echo form_error('current'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label for="inputName" class="col-sm-4 col-form-label">New</label>
										<div class="col-sm-8">
											<input type="password" autocomplete="off" class="form-control <?= form_error('new') ? 'is-invalid' : '' ?>" name="new_pass" placeholder="New password" value="<?= set_value('new'); ?>">
											<?php echo form_error('new'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label for="inputName" class="col-sm-4 col-form-label">Retype</label>
										<div class="col-sm-8">
											<input type="password" autocomplete="off" class="form-control <?= form_error('retype') ? 'is-invalid' : '' ?>" name="retype_pass" placeholder="Retype password" value="<?= set_value('retype'); ?>">
											<?php echo form_error('retype'); ?>
										</div>
									</div>
									<div class="form-group float-right">
										<button type="submit" class="btn btn-danger">Save changes</button>
									</div>
									<?= form_close(); ?>
								</div>
								<!-- /.tab-pane -->
							</div>
							<!-- /.tab-content -->
						</div><!-- /.card-body -->
					</div>
					<!-- /.nav-tabs-custom -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->