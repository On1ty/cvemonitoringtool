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
			<div class="row justify-content-center">
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
									<?= form_open('employee/settings/change/info', 'class="form-horizontal", id="account_info_form"') ?>
									<div class="form-group row">
										<label for="inputName" class="col-sm-4 col-form-label">First name</label>
										<div class="col-sm-8">
											<input type="text" name="first_name" class="form-control" placeholder="First name" value="<?= $emp->emp_first; ?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="inputName" class="col-sm-4 col-form-label">Middle name</label>
										<div class="col-sm-8">
											<input type="text" name="middle_name" class="form-control" placeholder="Middle name" value="<?= $emp->emp_middle; ?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="inputName" class="col-sm-4 col-form-label">Last name</label>
										<div class="col-sm-8">
											<input type="text" name="last_name" class="form-control" placeholder="Last name" value="<?= $emp->emp_last; ?>">
										</div>
									</div>
									<div class="form-group float-right">
										<button type="submit" class="btn btn-danger">Save changes</button>
									</div>
									<?= form_close(); ?>
								</div>
								<div class="tab-pane" id="pass">
									<?= form_open('employee/settings/change/password', 'class="form-horizontal", id="account_password_form"') ?>
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