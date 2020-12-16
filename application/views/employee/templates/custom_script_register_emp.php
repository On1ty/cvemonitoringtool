<!-- InputMask -->
<script src="<?= base_url() ?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url() ?>plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url() ?>plugins/select2/js/select2.full.min.js"></script>
<script>
    //Datemask2 mm/dd/yyyy
    $(function() {
        $('[data-mask]').inputmask();
        $('.role').select2({
            placeholder: 'Role',
            minimumResultsForSearch: -1
        });

        $('#reset-fields').on('click', function() {
            $('.role').val(null).trigger('change');
            $('#form')[0].reset();
        });
    });
</script>