<script src="<?= base_url() ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
    $(function() {
        bsCustomFileInput.init();
        manual_field();
        $('#manual_check').change(manual_field);


        $('#files-div').on('click', '.manual-upload', function(ev) {
            $('#label_file').text($(this).attr('data-doc'));
            $('#form').val($(this).attr('data-form'));
            $('#doc').val($(this).attr('data-doc'));
            $('#stage').val($(this).attr('data-stage'));
        });

        $('#files-div').on('click', '.confirmation', function(ev) {
            var href = $(this).attr('href');
            if (!$('#dataConfirmModal').length) {
                $('.content-wrapper').append('<div class="modal fade text-sm" id="dataConfirmModal"> <div class="modal-dialog modal-sm"> <div class="modal-content"> <div class="modal-header bg-danger"> <p class="modal-title font-weight-bold" id="title"></p></div> <div class="modal-body"> <p>One fine body&hellip;</p> </div> <div class="modal-footer justify-content-between"> <a type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</a> <a type="button" class="btn btn-danger btn-sm" id="dataConfirmOK">Proceed</a> </div> </div> </div> </div>');
            }
            $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
            $('#dataConfirmModal').find('#title').text($(this).attr('data-title'));
            $('#dataConfirmOK').attr('href', href);
            $('#dataConfirmModal').modal({
                show: true
            });
            return false;
        });

        $(".filter").on("keyup", function() {
            var input = $(this).val().toUpperCase();

            $(".file-card").each(function() {
                if ($(this).data("string").toUpperCase().indexOf(input) < 0) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            })
        });

        $('form').submit(function() {
            if ($('#manual_check').is(':checked')) {
                var remarks = $.trim($('#manual_file_input').val());
                if (remarks === '') {
                    $('.invalid-feedback').show();
                    return false;
                }
            }
        });

        $('#cancel').click(function() {
            $('.invalid-feedback').hide();
        });

        function manual_field() {
            $('.invalid-feedback').hide();
            if ($(this).is(':checked')) {
                $("#manual_file_remarks").show();
                $("#manual_file_div").hide();
            } else {
                if (!$('#manual_file_div').is(":visible")) {
                    $("#manual_file_div").show();
                    $("#manual_file_remarks").hide();
                }
            }
        }
    });
</script>