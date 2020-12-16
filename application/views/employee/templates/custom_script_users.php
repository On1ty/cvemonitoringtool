<script>
    $(function() {
        $("#clients-list").DataTable({
            "responsive": true,
            "autoWidth": false,
            "stateSave": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "stateSaveCallback": function(settings, data) {
                localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data))
            },
            "stateLoadCallback": function(settings) {
                return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance))
            },
            'ajax': {
                'url': '<?php echo site_url('employee/load/users') ?>',
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
                    'excel', {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        customize: function(doc) {
                            console.dir(doc)
                            doc.content[1].margin = [100, 0, 100, 0] //left, top, right, bottom
                        }
                    }
                ]
            <?php endif; ?>,
        });

        $('#wrapper').on('click', '.send-pass', function(ev) {
            var href = $(this).attr('href');
            if (!$('#dataConfirmModal').length) {
                $('.content-wrapper').append('<div class="modal fade text-sm" id="dataConfirmModal"> <div class="modal-dialog modal-sm"> <div class="modal-content"> <div class="modal-header bg-danger"> <p class="modal-title font-weight-bold">Reset Password</p></div> <div class="modal-body"> <p>One fine body&hellip;</p> </div> <div class="modal-footer justify-content-between"> <a type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</a> <a type="button" class="btn btn-danger btn-sm" id="dataConfirmOK">Yes</a> </div> </div> </div> </div>');
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