<!-- bs-custom-file-input -->
<script src="<?= base_url() ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script type="text/javascript">
    $(function() {
        bsCustomFileInput.init();

        var tbl = $("#imported-csv").DataTable({
            "retrieve": true,
            "responsive": true,
            "autoWidth": false,
            search: {
                regex: false,
                smart: false
            },
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            'ajax': {
                'url': '<?php echo site_url('employee/load/imported') ?>',
                'type': 'GET'
            },
            "columnDefs": [{
                "targets": [0],
                "visible": false,
            }],
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
            ],
        });

        $('#imported-csv_filter').append('<button class="btn btn-default btn-sm clear ml-1 mb-1">Clear</button>');

        $('#imported-csv_filter').on('click', '.clear', function() {
            tbl.search('').draw();
        });

        $('#wrapper').on('mouseover', '.campaign', function() {
            $(this).css('cursor', 'pointer');
        });

        $('#wrapper').on('click', '.campaign', function() {
            tbl.search($(this).html()).draw();
        });
    });
</script>