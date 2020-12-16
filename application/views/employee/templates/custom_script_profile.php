<script src="https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js"></script>
<script src="<?= base_url(); ?>plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
    $(function() {

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        const mainForm = $('#main_form_fetch');
        const feesForm = $('#fees_form_fetch');
        const datesForm = $('#dates_form_fetch');
        const contactForm = $('#contact_form_fetch');
        const educationalForm = $('#educational_form_fetch');
        const noteForm = $('#note_form_fetch');


        mainForm.submit((e) => {
            e.preventDefault();

            const formData = new FormData(mainForm[0]);

            const endpoint = '<?= base_url() ?>employee/update/form/main/<?= $client->id_lead ?>';

            fetch(endpoint, {
                method: "POST",
                body: formData
            }).then(function(response) {
                return response.json();
            }).then(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Main form information has been updated successfully'
                })
            });
        });

        feesForm.submit((e) => {
            e.preventDefault();

            const formData = new FormData(feesForm[0]);

            const endpoint = '<?= base_url() ?>employee/update/form/fees/<?= $client->id_lead ?>';

            fetch(endpoint, {
                method: "POST",
                body: formData
            }).then(function(response) {
                return response.json();
            }).then(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Fees has been updated successfully'
                })
            });
        });

        datesForm.submit((e) => {
            e.preventDefault();

            const formData = new FormData(datesForm[0]);

            const endpoint = '<?= base_url() ?>employee/update/form/dates/<?= $client->id_lead ?>';

            fetch(endpoint, {
                method: "POST",
                body: formData
            }).then(function(response) {
                return response.json();
            }).then(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Important Dates form has been updated successfully'
                })
            });
        });

        contactForm.submit((e) => {
            e.preventDefault();

            const formData = new FormData(contactForm[0]);

            const endpoint = '<?= base_url() ?>employee/update/form/contact/<?= $client->id_lead ?>';

            fetch(endpoint, {
                method: "POST",
                body: formData
            }).then(function(response) {
                return response.json();
            }).then(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Contact form has been updated successfully'
                })
            });
        });

        educationalForm.submit((e) => {
            e.preventDefault();

            const formData = new FormData(educationalForm[0]);

            const endpoint = '<?= base_url() ?>employee/update/form/educational/<?= $client->id_lead ?>';

            fetch(endpoint, {
                method: "POST",
                body: formData
            }).then(function(response) {
                return response.json();
            }).then(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Educational form has been updated successfully'
                })
            });
        });

        noteForm.submit((e) => {
            e.preventDefault();

            const formData = new FormData(noteForm[0]);

            const endpoint = '<?= base_url() ?>employee/notes/add/<?= $client->id_lead ?>/<?= $this->session->employee_realid ?>';

            fetch(endpoint, {
                method: "POST",
                body: formData
            }).then(function(response) {
                return response.json();
            }).then(function(obj) {
                if (obj.status == 'success') {
                    let html_string = `<div class="col-md-4">
                            <div class="card">
                                <div class="card-header text-sm">
                                    <h3 class="card-title"><span class="text-primary font-weight-bold">${obj.data.emp_name}</span>
                                        -  <span class="badge badge-danger">${obj.data.role}</span>
                                    </h3>
                                    <br>
                                    <span class="text-secondary">${obj.data.date}</span>
                                </div>
                                <div class="card-body">
                                    ${obj.data.note}
                                </div>
                            </div>
                        </div>`;

                    if ($('#notes-h1').length) {
                        console.log('meron');
                        $('#notes-h1').remove();
                    }

                    $("#notes-row").prepend(html_string);
                    $('#note-modal').modal('toggle');
                    $('#note-text-area').val('');
                    Toast.fire({
                        icon: 'success',
                        title: 'Note added successfully'
                    })
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Do not leave it blank!'
                    })
                }
            });
        });

        $('#v-pills-files').on('click', '.confirmation', function(ev) {
            var href = $(this).attr('href');
            if (!$('#dataConfirmModal').length) {
                $('.content-wrapper').append('<div class="modal fade text-sm" id="dataConfirmModal"> <div class="modal-dialog modal-sm"> <div class="modal-content"> <div class="modal-header bg-danger"> <p class="modal-title font-weight-bold" id="title"></p></div> <div class="modal-body"> <p>One fine body&hellip;</p> </div> <div class="modal-footer justify-content-between"> <a type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</a> <a type="button" class="btn btn-danger btn-sm" id="dataConfirmOK">Yes</a> </div> </div> </div> </div>');
            }
            $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
            $('#dataConfirmModal').find('#title').text($(this).attr('data-title'));
            $('#dataConfirmOK').attr('href', href);
            $('#dataConfirmModal').modal({
                show: true
            });
            return false;
        });

        $("#file_tbl").DataTable({
            "responsive": true,
            "autoWidth": false,
            "ordering": false,
            'ajax': {
                'url': '<?php echo site_url('employee/load/clients/profile/files/' . $this->uri->segment(5)) ?>',
                'type': 'GET'
            },
            pageLength: 50,
            lengthMenu: [50, 100, 200, 500],
            rowGroup: {
                dataSrc: [0, 1]
            },
            columnDefs: [{
                targets: [0, 1],
                visible: false
            }]
        });
        $('#v-pills-details').on('click', '.activation', function(ev) {
            var href = $(this).attr('href');
            if (!$('#dataConfirmModal').length) {
                $('.content-wrapper').append('<div class="modal fade text-sm" id="dataConfirmModal"> <div class="modal-dialog modal-sm"> <div class="modal-content"> <div class="modal-header bg-danger"> <p class="modal-title font-weight-bold">Activate/Deactivate</p></div> <div class="modal-body"> <p>One fine body&hellip;</p> </div> <div class="modal-footer justify-content-between"> <a type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</a> <a type="button" class="btn btn-danger btn-sm" id="dataConfirmOK">Yes</a> </div> </div> </div> </div>');
            }
            $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
            $('#dataConfirmOK').attr('href', href);
            $('#dataConfirmModal').modal({
                show: true
            });
            return false;
        });

        var tbl_his_pay = $("#payment-history-table").DataTable({
            "retrieve": true,
            "responsive": true,
            "autoWidth": false,
            "stateSave": true,
            "stateSaveCallback": function(settings, data) {
                localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data))
            },
            "stateLoadCallback": function(settings) {
                return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance))
            },
            'ajax': {
                'url': '<?php echo site_url('employee/load/history/pay/' . $this->uri->segment(5)) ?>',
                'type': 'GET'
            },
            "order": [],
            "columnDefs": [{
                "targets": 'no-sort',
                "orderable": false,
            }]
        });

        $('#v-pills-files').on('click', '.open-on', function(ev) {
            var href = $(this).attr('href');
            if (!$('#dataConfirmModal').length) {
                $('.content-wrapper').append('<div class="modal fade text-sm" id="dataConfirmModal"> <div class="modal-dialog modal-sm"> <div class="modal-content"> <div class="modal-header bg-default border-bottom-0"> <p class="modal-title font-weight-bold">Update stage</p></div> <div class="modal-body"> <p>One fine body&hellip;</p> </div> <div class="modal-footer border-top-0 justify-content-between"> <a type="button" class="text-primary" data-dismiss="modal">Cancel</a><form method="POST" action="' + href + '" accept-charset="utf-8"><button type="submit" name="open-close" class="btn btn-primary btn-sm" id="dataConfirmOK">Continue</button></form></div> </div> </div> </div>');
            }
            $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
            $('#dataConfirmOK').attr('href', href);
            $('#dataConfirmModal').modal({
                show: true
            });
            return false;
        });

        $('#v-pills-files').on('click', '.close-off', function(ev) {
            var href = $(this).attr('href');
            if (!$('#dataConfirmModal').length) {
                $('.content-wrapper').append('<div class="modal fade text-sm" id="dataConfirmModal"> <div class="modal-dialog modal-sm"> <div class="modal-content"> <div class="modal-header bg-default border-bottom-0"> <p class="modal-title font-weight-bold">Update stage</p></div> <div class="modal-body"> <p>One fine body&hellip;</p> </div> <div class="modal-footer border-top-0 justify-content-between"> <a type="button" class="text-primary" data-dismiss="modal">Cancel</a><form method="POST" action="' + href + '" accept-charset="utf-8"><button type="submit" name="open-close" class="btn btn-primary btn-sm" id="dataConfirmOK">Continue</button></form></div> </div> </div> </div>');
            }
            $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
            $('#dataConfirmOK').attr('href', href);
            $('#dataConfirmModal').modal({
                show: true
            });
            return false;
        });
    });
</script>