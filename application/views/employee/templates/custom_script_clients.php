<!-- Select2 -->
<script src="<?= base_url() ?>plugins/select2/js/select2.full.min.js"></script>
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
                'url': '<?php echo site_url('employee/load/clients') ?>',
                'type': 'GET'
            },
            "order": [],
            "columnDefs": [{
                "targets": 'no-sort',
                "orderable": false,
            }, {
                "targets": [0,5,6,7,8,10,12,13,14,15,16,17,18,19,20,21],
                "visible": false,
                "searchable": false
            }]
            <?php if ($this->session->employee_role == 4 || $this->session->employee_role == 5) : ?>,
                dom: 'lBfrtip',
                buttons: [
                    'excel'
                ]
            <?php endif; ?>,
        });

        $('#wrapper').on('click', '.send-pass', function(ev) {
            var href = $(this).attr('href');
            if (!$('#dataConfirmModal').length) {
                $('.content-wrapper').append('<div class="modal fade text-sm" id="dataConfirmModal"> <div class="modal-dialog modal-sm"> <div class="modal-content"> <div class="modal-header bg-danger"> <p class="modal-title font-weight-bold">Send credentials</p></div> <div class="modal-body"> <p>One fine body&hellip;</p> </div> <div class="modal-footer justify-content-between"> <a type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</a> <a type="button" class="btn btn-danger btn-sm" id="dataConfirmOK">Yes</a> </div> </div> </div> </div>');
            }
            $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
            $('#dataConfirmOK').attr('href', href);
            $('#dataConfirmModal').modal({
                show: true
            });
            return false;
        });

        $('#wrapper').on('click', '.endorse', function(ev) {
            let href = $(this).attr('href');
            let modalHtml;
            if (!$('#uploadLoaModal').length) {
                modalHtml = '<div class="modal fade text-sm" id="uploadLoaModal">';
                modalHtml += '  <div class="modal-dialog modal-sm">';
                modalHtml += '      <div class="modal-content">';
                modalHtml += '          <div class="modal-header bg-danger">';
                modalHtml += '              <p class="modal-title font-weight-bold">Endorse to Documentation Team</p>';
                modalHtml += '          </div>';
                modalHtml += '          <div class="modal-body">';
                modalHtml += '              <p>Total Admin Fee: <strong id="total_fee"></strong></p>';
                modalHtml += '              <p>Contract Price: <strong>0.00</strong></p>';
                modalHtml += '          </div>';
                modalHtml += '          <div class="modal-footer justify-content-between">';
                modalHtml += '              <a class="btn btn-default btn-sm" data-dismiss="modal">Cancel</a>';
                modalHtml += '              <a class="btn btn-danger btn-sm" id="dataConfirmOK">Endorse</a>';
                modalHtml += '          </div>';
                modalHtml += '      </div>';
                modalHtml += '  </div>';
                modalHtml += '</div>';
                $('.content-wrapper').append(modalHtml);
            }
            $('#total_fee').html($(this).attr('data-message'));
            $('#dataConfirmOK').attr('href', href);
            $('#uploadLoaModal').modal({
                show: true
            });
            return false;
        });

        $('#wrapper').on('click', '.orientation', function(ev) {
            let href = $(this).attr('href');
            let modalHtml;
            if (!$('#uploadLoaModal').length) {
                modalHtml = '<div class="modal fade text-sm" id="dataConfirmModal">';
                modalHtml += '  <div class="modal-dialog modal-sm">';
                modalHtml += '      <div class="modal-content">';
                modalHtml += '          <div class="modal-header bg-danger">';
                modalHtml += '              <p class="modal-title font-weight-bold">Endorse to Documentation Team</p>';
                modalHtml += '          </div>';
                modalHtml += '          <div class="modal-body">';
                modalHtml += '          </div>';
                modalHtml += '          <div class="modal-footer justify-content-between">';
                modalHtml += '              <a class="btn btn-default btn-sm" data-dismiss="modal">Cancel</a>';
                modalHtml += '              <a class="btn btn-danger btn-sm" id="dataConfirmOK">Proceed</a>';
                modalHtml += '          </div>';
                modalHtml += '      </div>';
                modalHtml += '  </div>';
                modalHtml += '</div>';
                $('.content-wrapper').append(modalHtml);
            }
            $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-message'));
            $('#dataConfirmOK').attr('href', href);
            $('#dataConfirmModal').modal({
                show: true
            });
            return false;
        });

        $('.employer').select2({
            placeholder: 'Search...',
            minimumInputLength: 2,
            minimumResultsForSearch: 10,
            ajax: {
                url: '<?= base_url() ?>employee/load/search/employee',
                dataType: 'json',
                type: 'GET',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true,
            }
        });

        $('#wrapper').on('click', '.counselor', function() {
            const id = $(this).attr('id');
            $('#update_frm').val(id);
        });
    });
</script>