<!-- InputMask -->
<script src="<?= base_url() ?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url() ?>plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url() ?>plugins/select2/js/select2.full.min.js"></script>
<script>
    //Datemask2 mm/dd/yyyy
    $(function() {
        $('[data-mask]').inputmask();

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

        $('.lead-select').select2({
            placeholder: 'Search by Name, ID or Email',
            minimumInputLength: 2,
            minimumResultsForSearch: 10,
            ajax: {
                url: '<?= base_url() ?>employee/load/search/lead',
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

        $('.lead-select').on('select2:select', function(e) {
            var data = e.params.data;
            $('#first_name').val(data.first_name);
            $('#middle_name').val(data.middle_name);
            $('#last_name').val(data.last_name);
            $('#phone').val(data.phone);
            $('#email').val(data.email);
        });

        $('#reset-fields').on('click', function() {
            $('#form')[0].reset();
            $('.employer').val(null).trigger('change');
            $('.lead-select').val(null).trigger('change');
        });
    });
</script>