<div class="content-wrapper border border-left-0 border-right-0 border-bottom-0">
	<div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">List of Users</h1>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="container">
			<div class="row justify-content-lg-center">
				<section class="col-lg-12">
					<?php if ($this->session->flashdata('updated')) : ?>
						<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<?= $this->session->flashdata('updated'); ?>
						</div>
					<?php endif; ?>
					<?php if ($this->session->flashdata('error')) : ?>
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<?= $this->session->flashdata('error'); ?>
						</div>
					<?php endif; ?>
					<?= validation_errors(); ?>
					<div class="card card-danger card-outline">
						<div class="card-body">
							<table id="clients-list" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Role</th>
										<th>Email</th>
										<th>Date Created</th>
										<th class="no-sort"></th>
									</tr>
								</thead>
								<tbody id="wrapper">
								</tbody>
							</table>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
	<div class="modal fade" id="update-counselor">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-danger">
					<p class="modal-title font-weight-bold">Counselor Maintenance</p>
				</div>
				<?= form_open('employee/update/counselor') ?>
				<div class="modal-body">
					<div class="form-group">
						<label>Assign Counselor</label>
						<select class="form-control employer" name="user-select-employer">
							<option value="<?= set_value('user-select-employer'); ?>">
								<?= set_value('user-select-employer'); ?></option>
						</select>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-danger" id="update_frm" name="update-counselor">Update</button>
				</div>
				<?= form_close() ?>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</div>