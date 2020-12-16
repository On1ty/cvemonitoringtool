<div class="content-wrapper border border-left-0 border-right-0 border-bottom-0">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Lead Table</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row justify-content-start">
                <section class="col-lg-6">
                    <div class="card card-danger card-outline">
                        <div class="card-body">
                            <?= form_open_multipart('employee/import/csv', 'id="import-csv"') ?>
                            <div class="form-group">
                                <label for="exampleInputFile">Import CSV File</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input <?= form_error('csv-input-file') ? 'is-invalid' : '' ?>" id="csv-input-file" name="csv-input-file">
                                        <label class="custom-file-label" for="csv-input-file">Choose file</label>
                                    </div>
                                </div>
                                <?= form_error('csv-input-file'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block import">Import</button>
                            <?= form_close() ?>
                        </div>
                    </div>
                </section>
            </div>
            <div class="row justify-content-lg-center">
                <section class="col-lg-12">
                    <?php if ($this->session->flashdata('imported')) : ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?= $this->session->flashdata('imported'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('imported_empty')) : ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?= $this->session->flashdata('imported_empty'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card card-danger">
                        <div class="card-body">
                            <table id="imported-csv" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Campaign Name</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
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
</div>