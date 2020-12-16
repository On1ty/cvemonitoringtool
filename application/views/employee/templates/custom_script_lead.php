<!-- InputMask -->
<script src="<?= base_url() ?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url() ?>plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script src="<?= base_url() ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script>
    $(function() {

        <?php if (form_error('user-dob') || form_error('amount')) : ?>
            $('#pay-modal').modal('show')
        <?php endif; ?>

        bsCustomFileInput.init();

        $('[data-mask]').inputmask();
        var tbl = $("#lead-table").DataTable({
            "retrieve": true,
            "responsive": true,
            "autoWidth": false,
            "stateSave": true,
            search: {
                regex: false,
                smart: false
            },
            "stateSaveCallback": function(settings, data) {
                localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data))
            },
            "stateLoadCallback": function(settings) {
                return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance))
            },
            'ajax': {
                'url': '<?php echo site_url('employee/load/lead') ?>',
                'type': 'GET'
            },
            "order": [],
            "columnDefs": [{
                "targets": 'no-sort',
                "orderable": false,
            }]
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
                'url': '<?php echo site_url('employee/load/payment') ?>',
                'type': 'GET'
            },
            "order": [],
            "columnDefs": [{
                "targets": 'no-sort',
                "orderable": false,
            }]
            <?php if ($this->session->employee_role == 4 || $this->session->employee_role == 5) : ?>,
                dom: 'lBfrtip',
                buttons: [
                    'excel'
                ]
            <?php endif; ?>,
        });

        var tbl_his_pay_walkin = $("#payment-history-table-walkin").DataTable({
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
                'url': '<?php echo site_url('employee/load/payment/walk-in') ?>',
                'type': 'GET'
            },
            "order": [],
            "columnDefs": [{
                "targets": 'no-sort',
                "orderable": false,
            }]
            <?php if ($this->session->employee_role == 4 || $this->session->employee_role == 5) : ?>,
                dom: 'lBfrtip',
                buttons: [
                    'excel'
                ]
            <?php endif; ?>,
        });

        var tbl_walkin = $("#walkin-table").DataTable({
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
                'url': '<?php echo site_url('employee/load/walk-in') ?>',
                'type': 'GET'
            },
            "order": [],
            "columnDefs": [{
                "targets": 'no-sort',
                "orderable": false,
            }]
        });

        $('#lead-table_filter').append('<button class="btn btn-default btn-sm clear ml-1 mb-1">Clear</button>');

        $('#lead-table_filter').on('click', '.clear', function() {
            tbl.search('').draw();
        });

        $('#wrapper').on('mouseover', '.campaign', function() {
            $(this).css('cursor', 'pointer');
        });

        $('#wrapper').on('click', '.campaign', function() {
            tbl.search($(this).html()).draw();
        });

        $('#payment-history-table_filter').append('<button class="btn btn-default btn-sm clear-h ml-1 mb-1">Clear</button>');

        $('#payment-history-table_filter').on('click', '.clear-h', function() {
            tbl_his_pay.search('').draw();
        });

        $('#wrapper').on('click', '.pay', function(ev) {
            var href = '<?= base_url() ?>' + $(this).attr('href');
            $('#pay-form').attr('action', href);
        });

        $('#wrapper-walkin').on('click', '.pay', function(ev) {
            var href = '<?= base_url() ?>' + $(this).attr('href');
            $('#pay-form').attr('action', href);
        });

        $('#walkin-table_filter').append('<button class="btn btn-default btn-sm clear ml-1 mb-1">Clear</button>');

        $('#walkin-table_filter').on('click', '.clear', function() {
            tbl.search('').draw();
        });

        $('#wrapper2').on('click', '.delete-pay', function(ev) {
            var href = $(this).attr('href');
            if (!$('#dataConfirmModal').length) {
                $('.content-wrapper').append('<div class="modal fade text-sm" id="dataConfirmModal"> <div class="modal-dialog modal-sm"> <div class="modal-content"> <div class="modal-header bg-danger"> <p class="modal-title font-weight-bold">Delete</p></div> <div class="modal-body"> <p>One fine body&hellip;</p> </div> <div class="modal-footer justify-content-between"> <a type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</a> <a type="button" class="btn btn-danger btn-sm" id="dataConfirmOK">Yes</a> </div> </div> </div> </div>');
            }
            $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
            $('#dataConfirmOK').attr('href', href);
            $('#dataConfirmModal').modal({
                show: true
            });
            return false;
        });

        $('#payment-history-table tbody').on('click', '.edit-payment-history', function() {
            var data = tbl_his_pay.row($(this).parents('tr')).data();
            var href = '<?= base_url() ?>' + $(this).attr('href');
            let amount = data['2'].replace(/(<([^>]+)>)/gi, "");
            let date = data['4'].replace(/(<([^>]+)>)/gi, "");
            let remarks = data['3'].replace(/(<([^>]+)>)/gi, "");
            remarks = remarks === 'No Remarks' ? '' : remarks;
            $('#pay-form').attr('action', href);
            $("input[name='amount']").val(amount);
            $("input[name='user-dob']").val(date);
            $("input[name='remarks']").val(remarks);
        });

        $('#payment-history-table-walkin tbody').on('click', '.edit-payment-history', function() {
            var data = tbl_his_pay_walkin.row($(this).parents('tr')).data();
            var href = '<?= base_url() ?>' + $(this).attr('href');
            let amount = data['2'].replace(/(<([^>]+)>)/gi, "");
            let date = data['4'].replace(/(<([^>]+)>)/gi, "");
            let remarks = data['3'].replace(/(<([^>]+)>)/gi, "");
            remarks = remarks === 'No Remarks' ? '' : remarks;
            $('#pay-form').attr('action', href);
            $("input[name='amount']").val(amount);
            $("input[name='user-dob']").val(date);
            $("input[name='remarks']").val(remarks);
            console.log(data);
        });

        $('#wrapper').on('click', '.reg2', function(ev) {
            var href = $(this).attr('href');
            if (!$('#dataConfirmModal').length) {
                $('.content-wrapper').append('<div class="modal fade text-sm" id="dataConfirmModal"> <div class="modal-dialog modal-sm"> <div class="modal-content"> <div class="modal-header bg-danger"> <p class="modal-title font-weight-bold">Update Status</p></div> <div class="modal-body"> <p>One fine body&hellip;</p> </div> <div class="modal-footer justify-content-between"> <a type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</a><form method="POST" action="' + '<?= site_url() ?>' + href + '" accept-charset="utf-8"><button type="submit" name="edit-registered-attended" class="btn btn-danger btn-sm" id="dataConfirmOK">Continue</button></form></div> </div> </div> </div>');
            }
            $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
            $('#dataConfirmOK').attr('href', href);
            $('#dataConfirmModal').modal({
                show: true
            });
            return false;
        });

        $('#wrapper').on('click', '.att1', function(ev) {
            var href = $(this).attr('href');
            if (!$('#dataConfirmModal').length) {
                $('.content-wrapper').append('<div class="modal fade text-sm" id="dataConfirmModal"> <div class="modal-dialog modal-sm"> <div class="modal-content"> <div class="modal-header bg-danger"> <p class="modal-title font-weight-bold">Update Status</p></div> <div class="modal-body"> <p>One fine body&hellip;</p> </div> <div class="modal-footer justify-content-between"> <a type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</a><form method="POST" action="' + '<?= site_url() ?>' + href + '" accept-charset="utf-8"><button type="submit" name="edit-registered-attended" class="btn btn-danger btn-sm" id="dataConfirmOK">Continue</button></form></div> </div> </div> </div>');
            }
            $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
            $('#dataConfirmOK').attr('href', href);
            $('#dataConfirmModal').modal({
                show: true
            });
            return false;
        });

        $('#delete-registered-attended').on('click', function(ev) {
            var href = $(this).attr('href');
            if (!$('#dataConfirmModal').length) {
                $('.content-wrapper').append('<div class="modal fade text-sm" id="dataConfirmModal"> <div class="modal-dialog modal-sm"> <div class="modal-content"> <div class="modal-header bg-danger"> <p class="modal-title font-weight-bold">Delete</p></div> <div class="modal-body"> <p>One fine body&hellip;</p> </div> <div class="modal-footer justify-content-between"> <a type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</a><form method="POST" action="' + '<?= site_url('employee/delete/registered/attended/status') ?>' + '" accept-charset="utf-8"><button type="submit" name="delete-registered-attended" class="btn btn-danger btn-sm" id="dataConfirmOK">Yes</button></form></div> </div> </div> </div>');
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